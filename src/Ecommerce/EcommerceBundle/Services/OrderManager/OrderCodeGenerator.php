<?php

namespace Ecommerce\EcommerceBundle\Services\OrderManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Symfony\Component\DependencyInjection\Container;

class OrderCodeGenerator {

	protected $container;
	protected $em;

	public function __construct( Container $container, EntityManager $em ){
		$this->container    = $container;
		$this->em           = $em;
	}
	/**
	 * Incrémentation du code de la commande déjà existente ou lancement du générateur du premier code
	 * @return int|string
	 */
	public function OrderCode(){
		$userOrder = $this->em->getRepository('EcommerceBundle:UserOrder')->findOneBy(
			array( 'valid' => 1 ),
			array( 'id' => 'DESC' )
		);
		if( !$userOrder){
			return 1;
		}

		return $userOrder->getOrdercode() +1;
	}
}