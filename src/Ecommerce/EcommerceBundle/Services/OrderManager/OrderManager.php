<?php

namespace Ecommerce\EcommerceBundle\Services\OrderManager;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Ecommerce\EcommerceBundle\Entity\UserOrder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Exception\SessionUnavailableException;
use Symfony\Component\Security\Core\Security;

class OrderManager {

	protected $container;
	protected $session;
	protected $request;
	protected $em;
	protected $security;
	protected $createdAt;

	public function __construct( ContainerInterface $container, Session $session, RequestStack $request, EntityManager $em, TokenStorage $token_storage) {
		$this->container        = $container;
		$this->session          = $session;
		$this->request          = $request;
		$this->em               = $em;
		$this->token_storage    = $token_storage;
		$this->createdAt        = new \DateTime();

	}

	public function getProductsInBasket(){
		$prodsInBasket      = $this->em->getRepository('EcommerceBundle:Product')->findProdsArray(array_keys($this->session->get('basket')));

		return $prodsInBasket;
	}

	/**
	 * Récupère toutes les données stokées en session qui concernent la commande, les enrichi et les rassemblent dans un tableau associatif
	 *
	 * Session 'basket' : (int)id du produit => (int)qty
	 * Repo $prodsInBasket: code, name, price... Voir entité Product
	 * Session 'selected_addresses' : 'billing_address' => (int) id des 2 adresses
	 * Les adresses de livraisons et facturation:
	 *
	 * @return array
	 */
	public function getOrderDatas(){
		$selectedAdresses   = $this->session->get('selected_addresses');
		$deliveryAddress    = $this->em->getRepository('EcommerceBundle:Address')->find($selectedAdresses['delivery_address']);
		$billingAddress     = $this->em->getRepository('EcommerceBundle:Address')->find($selectedAdresses['billing_address']);
		$basket             = $this->session->get('basket');
		$prodsInBasket      = $this->getProductsInBasket();

		$orderDetailsGrouped = array();

		$totalExclVat       = 0;
		$totalVat           = 0;
		$totalInclVat       = 0;

		foreach( $prodsInBasket as $product ){

		// PRICES
			$pUnitPriceExclVAT  = $product->getPrice();
			$pUnitPriceInclVAT  = $product->getPrice() * $product->getVat()->getMultiplicate();

			$pXQtyPriceExclVAT  = $product->getPrice() * $basket[$product->getId()];
			$pXQtyPriceInclVAT  = $pXQtyPriceExclVAT * $product->getVat()->getMultiplicate();

		// TOTALS
			$totalExclVat       += $pXQtyPriceExclVAT;
			$totalInclVat       += $pXQtyPriceInclVAT;

		// --- VAT ---
			// Création du tableau vat
			// récupération des différentes TVA concernées par les produits du panier et les reprend comme index 6 => xx.xx
			if( !isset( $orderDetailsGrouped['vat'][$product->getVat()->getValue()] ) ){
				$orderDetailsGrouped['vat'][$product->getVat()->getValue()] = round( ($pXQtyPriceInclVAT - $pXQtyPriceExclVAT),2,3 );
			}else{
				$orderDetailsGrouped['vat'][$product->getVat()->getValue()] += round( ($pXQtyPriceInclVAT - $pXQtyPriceExclVAT),2,3 );

			}
			$totalVat += round( ( $pXQtyPriceInclVAT - $pXQtyPriceExclVAT),2,3 );

//			var_dump($totalVat);

			// --- PRODUCTS ---
			// Récupération des information sur le produit
			$orderDetailsGrouped['products'][$product->getId()] = array(
				'id'                => $product->getId(),
				'code'              => $product->getCode(),
				'name'              => $product->getName(),
				'uprice'            => $product->getPrice(),
				'qty'               => $basket[$product->getId()],
				'qtyprice'          => ( $product->getPrice() * $basket[$product->getId()] ),
				'vatname'           => $product->getVat()->getName(),
				'vatamt'            => round( ( $product->getPrice() * $basket[$product->getId()] ) * ( $product->getVat()->getMultiplicate()-1 ), 2, 3 ),
				'upriceincvat'      => round( ( $product->getPrice() * $basket[$product->getId()] ) * $product->getVat()->getMultiplicate(), 2, 3 ),
				'qtypriceincvat'    => ( $product->getPrice() * $basket[$product->getId()] ) * $product->getVat()->getMultiplicate()
			);
		}// END foreach $prodsInBasket

		// --- ADDRESSES ---
		$orderDetailsGrouped['delivery_address'] = array(
			'firstname'     => $deliveryAddress->getFirstname(),
			'lastname'      => $deliveryAddress->getLastname(),
			'address'       => $deliveryAddress->getAddress(),
			'addresscompl'  => $deliveryAddress->getAddresscompl(),
			'postcode'      => $deliveryAddress->getPostcode(),
			'city'          => $deliveryAddress->getCity(),
			'country'       => $deliveryAddress->getCountry(),
			'phone'         => $deliveryAddress->getPhone(),
			'mobile'        => $deliveryAddress->getMobile(),
		);

		$orderDetailsGrouped['billing_address'] = array(
			'firstname'     => $billingAddress->getFirstname(),
			'lastname'    => $billingAddress->getLastname(),
			'address'       => $billingAddress->getAddress(),
			'addresscompl'  => $billingAddress->getAddresscompl(),
			'postcode'      => $billingAddress->getPostcode(),
			'city'          => $billingAddress->getCity(),
			'country'       => $billingAddress->getCountry(),
			'phone'         => $billingAddress->getPhone(),
			'mobile'        => $billingAddress->getMobile(),
		);

		$orderDetailsGrouped['total_excl_vat']  = round($totalExclVat, 2);
		$orderDetailsGrouped['total_vat']       = round($totalVat, 2,1);
		$orderDetailsGrouped['total_incl_vat']  = round( ($totalExclVat + $totalVat),2, 1 );
		$orderDetailsGrouped['token']           = bin2hex(base64_encode( random_bytes(10)));

		return $orderDetailsGrouped;
	}

	/**
	 * Insère les données de la session en DB et retourn une response dont le content est l'ID de la commande fraîchement créée
	 *
	 * @return Response
	 */
	public function prepareOrder(){

		$currentuser    = $this->token_storage->getToken()->getUser();

		// vérifie si la session contient la commande courante
		// évite de recréer plusieurs fois la même commande
		if( !$this->session->has('userorder') ){
			// si non, instanciation de l'entité UserOrder()
			$userorder = new UserOrder();
		}else{
			// sinon, récupération de la commande par requête en DB
			$userorder = $this->em->getRepository('EcommerceBundle:UserOrder')->find( $this->session->get('userorder') );
		}
		// hydratation de l'objet  UserOrder();
		// init de la date de la commande
		$userorder->setDate( $this->createdAt);
		// récup du user courant
		$userorder->setUser( $currentuser );
		// normalement, init à 0 car pas encore validée par la banque au moment du click sur payer. Mise à 1 pour la simulation.
		$userorder->setValid(0);
		// init à 0 car la référence de la commande n'est pas encore connue au click sur payer.
		// obligation comptable d'avoir des réfs commandes qui se suivent
		// NOTE MEMO: Service à créer pour gérer cet aspect.
		$userorder->setOrdercode(0);
		$userorder->setProducts($this->session->get('basket'));
		$userorder->setOrderdetailsgrouped( $this->getOrderDatas() );

	// Si la commande n'existe pas en session
		if( !$this->session->has('userorder') ){
			// on persist les données mises à jour
			$this->em->persist( $userorder );
			// on les ajoute la session
			$this->session->set('userorder', $userorder);
		}
	// Sinon si la commande existe déjà en base, on met à jour directement
		$this->em->flush();

		return $userorder->getId();

//		return new Response( $userorder->getId() ); // MEMO supprimer la réponse pour ne garder que l'ID
	}

	/**
	 * Récupère les informations de la commande fraichement créée en DB grâce à l'ID renvoyé par prepareOrder()
	 * @return null|object
	 */
	public function getOrderDetails(){

		return $this->em->getRepository('EcommerceBundle:UserOrder')->find( $this->prepareOrder() );
	}

	/**
	 * Validation de la commande après retour de l'api de la banque et génération du code puis de la référence complète
	 *
	 * Méthode appellée dans OrderController via la route ecommerce_order_pay /bank/api/{orderid}
	 *
	 * @param $orderid
	 *
	 * @return bool
	 */
	public function orderValidation(){
		$orderToValidate = $this->getOrderDetails();

// Vérifie SI la commande existe ou si elle n'a pas déjà été validée
		if( !$orderToValidate || $orderToValidate->getValid() === 1 ){
			throw new NotFoundHttpException( 'La commande n\'existe pas ou a déjà été validée' );
		}

		$orderToValidate->setValid(1);
		$orderToValidate->setOrdercode($this->container->get('ecommerce.order_code_generator')->orderCode() );

		$this->em->persist($orderToValidate);
		$this->em->flush();

		if( $orderToValidate->getValid() === 1 && $orderToValidate->getOrderCode() !== 0){

			$customerId = $orderToValidate->getUser()->getId();
			$date       = $orderToValidate->getDate()->getTimestamp();
			$orderCode  = $orderToValidate->getOrderCode();

			$orderFullRef = $customerId.'_'.$date.'_'.$orderCode;

			$orderToValidate->setOrderfullref( $orderFullRef );

			$this->em->persist($orderToValidate);
			$this->em->flush();

			$this->session->remove('basket');
			$this->session->remove('selected_addresses');
			$this->session->remove('userorder');

			return true;
		}

		return false;
	}

} //END class