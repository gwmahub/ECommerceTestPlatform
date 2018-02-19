<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Ecommerce\EcommerceBundle\Entity\Address;
use Ecommerce\EcommerceBundle\Form\AddressType;
use Ecommerce\EcommerceBundle\Services\FormHandler\AddressHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BasketController extends Controller
{
	public function basketBlocNavAction(Request $request){
		$session = $request->getSession();
		$prodsSentInBasket = $session->get('basket');

		if( count( $prodsSentInBasket ) > 0 ){
			$products = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->findXLastProdsArray( array_keys( $prodsSentInBasket) );
		}else{
			// init de la variable products
			$products = array();
		}

		return $this->render('EcommerceBundle:Includes:ModulesLeft/basket_menu_bloc_nav.html.twig', array(
			'products'      => $products
		));

	}

	public function basketAddProductAction($id, Request $request){

		// Récupération de la session
		$session = $request->getSession();

		// Vérification de l'existence ou non de la variable de session basket
		if( !$session->has('basket') ){
			// Si non, création array session "basket"
			$session->set('basket', array() );
		}
		// Récupération de la valeur de la variable de session (array) basket à une variable (array) $basket
		$basket = $session->get('basket');

		// Vérification de la présence du produit dans le panier
		if( array_key_exists($id, $basket) ){
			// Si oui, on ne fait que changer la quantité
			// Vérification que la quantité est différente de 0 en récupérant la valeur get
			if( $request->query->get('qty') !== null){
				$previousQty = $request->query->get('qty');
				// On assigne la nouvelle quantité au produit déjà présent dans le panier
				$basket[$id] = (int) $request->query->get('qty');
				$message = $session->getFlashBag()->add('success', 'Quantity updated with success.');
			}
		// Sinon, le produit n'existe pas encore dans le panier
		}else{
			// Vérification que la quantité est différente de 0 en récupérant la valeur get
			if( $request->query->get('qty') !== null){
				// On assigne la nouvelle quantité au produit déjà présent dans le panier
				$basket[$id] = (int) $request->query->get('qty');
			}
			$message = $session->getFlashBag()->add('success', 'Item sent in your basket with success.');

		}
			$session->set('basket', $basket);

		return $this->redirect( $this->generateUrl('ecommerce_basket') );

	}

	public function basketRemoveProductAction($id, Request $request){
		$session = $request->getSession();
		$basket = $session->get('basket');

		if( array_key_exists( $id, $basket ) ){
			unset( $basket[$id] );
			$session->set('basket', $basket);
			$message = $session->getFlashBag()->add('success', 'Item removed with success.');
		}

		return $this->redirect( $this->generateUrl('ecommerce_basket') );
	}

	public function basketViewAction(Request $request)
	{
		$session = $request->getSession();
//		$session->remove('basket');
//		die();
		$prodsSentInBasket = $session->get('basket');
		if( count( $prodsSentInBasket ) > 0 ){
			$products = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->findProdsArray( array_keys( $prodsSentInBasket ) );
		}else{
			// init de la variable products
			$products = array();
			$message = $session->getFlashBag()->add('info', 'Your basket is empty');
		}

		return $this->render('EcommerceBundle:Default:basket/basket_view.html.twig', array(
			'products'      => $products,
			'basketProdQty' => $session->get('basket')
		));
	}

	public function basketDeliveryAction( Request $request) {
//		$em             = $this->getDoctrine()->getManager();
		$userAddress    = new Address();
		$addressForm    = $this->createForm('Ecommerce\EcommerceBundle\Form\AddressType', $userAddress
//			, array(
//			'entity_manager' => $em,
//		)

		);
		$currentUser = $this->get('security.token_storage')->getToken()->getUser();

		if( $request->isMethod('post') && $addressForm->handleRequest($request)->isValid() ){ // MEMO : doesn't work with test $addressForm->isSubmitted() !!!!
			$userAddress->setUser($currentUser);
			$em = $this->getDoctrine()->getManager();
			$em->persist($userAddress);
			$em->flush();

			return $this->redirect($this->generateUrl('ecommerce_basket_delivery'));
		}

		return $this->render('EcommerceBundle:Default:basketDelivery/basket_delivery.html.twig', array(
				'currentUser'   => $currentUser,
				'form'          => $addressForm->createView()
			)
		);

	}





	public function basketDeliveryAddressDeleteAction( Request $request, $id ){
		$session            = $request->getSession();
		$em                 = $this->getDoctrine()->getManager();
		$currentUserAddress = $em->getRepository('EcommerceBundle:Address')->find($id);
		$currentUser        = $this->get('security.token_storage')->getToken()->getUser();

		if( $currentUser !== $currentUserAddress->getUser() || !$currentUserAddress ){

			return $this->redirect( $this->generateUrl('ecommerce_basket_delivery') );
		}

		$em->remove($currentUserAddress);
		$em->flush();

		$message = $session->getFlashbag()->add('success', 'Address deleted with success');
		return $this->redirect( $this->generateUrl('ecommerce_basket_delivery') );
	}



	public function setSelectedAddressesOnSession( Request $request ){
		$session = $request->getSession();

		if( !$session->has('selected_addresses') ){ $session->set('selected_addresses', array()); }
		$selectedAdresses = $session->get('selected_addresses');

		if( $request->get('delivery_address') !== null && $request->get('billing_address') !== null ){
			$selectedAdresses['delivery_address']   = (int) $request->get('delivery_address');
			$selectedAdresses['billing_address']    = (int) $request->get('billing_address');
		}else{

			 return $this->redirect( $this->generateUrl('ecommerce_basket_validation') );
		}

		$session->set('selected_addresses', $selectedAdresses);

		return $this->redirect( $this->generateUrl('ecommerce_basket_validation') );
	}

	public function basketValidationAction( Request $request ){

		if( $request->isMethod('post') ){
			$this->setSelectedAddressesOnSession($request);
			$order = $this->get('ecommerce.order_manager')->getOrderDetails();
//var_dump($order);
			return $this->render('EcommerceBundle:Default:basketValidation/basket_validation.html.twig', array(
				'order' => $order
				)
			);
		}

		return $this->redirect( $this->generateUrl('ecommerce_basket_validation') );
	}
}
