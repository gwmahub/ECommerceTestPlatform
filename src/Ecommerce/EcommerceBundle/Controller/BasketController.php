<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BasketController extends Controller
{
	/**
	 * Display the last products sent in the basket by the user during the current session in a navigation's bloc.
	 * If no product already sent in the basket, initialiaze the variable $products as an array()
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function basketBlocNavAction(Request $request){
		$session            = $request->getSession();
		$prodsSentInBasket  = $session->get('basket');
		// Si la variable de session 'basket' contient déjà des produits...
		if( count( $prodsSentInBasket ) > 0 ){
			// Lancement de la requête en DB qui va récupérer les infos sur les produits avec l'ID
			$products = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->findXLastProdsArray( array_keys( $prodsSentInBasket) );
		}else{
			// ... Sinon, init de $product (array).
			$products = array();
		}

		return $this->render('EcommerceBundle:Includes:ModulesLeft/basket_menu_bloc_nav.html.twig', array(
			'products'      => $products
		));
	}
	/**
	 * Handle the products sending in the basket.
	 * If the first product sent : session variable basket creation : (array) product id => qty
	 * @param $id : product id
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function basketAddProductAction($id, Request $request){
		// Récupération de la session
		$session = $request->getSession();
		// Si la variable de session 'basket' n'existe pas...
		if( !$session->has('basket') ){
			// création de la variable de session 'basket' (array)
			$session->set('basket', array() );
		}
		// ... Sinon, récupération de 'basket' dans $basket
		$basket = $session->get('basket');
		// Vérification de la présence du produit dans le panier
		if( array_key_exists($id, $basket) ){
			// Si oui, on ne fait que changer la quantité
			// Si la quantité envoyée en GET est différente de 0 ...
			if( $request->query->get('qty') !== null){
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
		// Ajout des données contenues dans $basket dans la variable de session 'basket'
		$session->set('basket', $basket);

		return $this->redirect( $this->generateUrl('ecommerce_basket') );
	}

	/**
	 * @param $id
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function basketRemoveProductAction($id, Request $request){
		$session    = $request->getSession();
		$basket     = $session->get('basket');

		if( array_key_exists( $id, $basket ) ){
			unset( $basket[$id] );
			$session->set('basket', $basket);
			$message = $session->getFlashBag()->add('success', 'Item removed with success.');
		}

		return $this->redirect( $this->generateUrl('ecommerce_basket') );
	}

	/**
	 * Get the basket data's and send them in the Twig view.
	 *      products (array): the products data's from the id available in the basket variable session
	 *      basketProdQty (array) : the qty associated to the product ID
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function basketViewAction(Request $request){
		$session = $request->getSession();

		$prodsSentInBasket = $session->get('basket');
		// Si le panier contient des produits, on stocke les données récupérées en DB dans la variable $products
		if( count( $prodsSentInBasket ) > 0 ){
			$products = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->findProdsArray( array_keys( $prodsSentInBasket ) );
		}else{
			//Sinon, on initialise la variable $products
			$products = array();
			$message = $session->getFlashBag()->add('info', 'Your basket is empty');
		}
		// Envoi des données à la vue pour affichage complet du panier
		return $this->render('EcommerceBundle:Default:basket/basket_view.html.twig', array(
			'products'      => $products,
			'basketProdQty' => $session->get('basket')
		));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function basketDeliveryAction( Request $request) {
		$userAddress    = new Address();
		$addressForm    = $this->createForm('Ecommerce\EcommerceBundle\Form\AddressType', $userAddress);
		$currentUser    = $this->get('security.token_storage')->getToken()->getUser();

		if( $request->isMethod('post') && $addressForm->handleRequest($request)->isValid() ){
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

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
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

	/**
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
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

			return $this->render('EcommerceBundle:Default:basketValidation/basket_validation.html.twig', array(
				'order' => $order
				)
			);
		}

		return $this->redirect( $this->generateUrl('ecommerce_basket_validation') );
	}
}
