<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\UserOrder;


class UserOrderFixtures extends Fixture
{

	public function load(ObjectManager $manager)
	{

		$userordergege = new UserOrder();
		$userordergege->setValid('1');
		$userordergege->setDate( new \DateTime() );
		$userordergege->setOrdercode('20171027011120');
		$userordergege->setProducts( array(
			'0' => array( '1' => '5'),
			'1' => array( '2' => '9'),
			'2' => array( '4' => '3'),
		) );
		$userordergege->setUser( $this->getReference('gege') );
		$manager->persist($userordergege);		
		
		$userorderrobert = new UserOrder();
		$userorderrobert->setValid('1');
		$userorderrobert->setDate( new \DateTime() );
		$userorderrobert->setOrdercode('20170927011121');
		$userorderrobert->setProducts( array(
			'0' => array( '1' => '5'),
			'1' => array( '3' => '1'),
			'2' => array( '4' => '3'),
		) );
		$userorderrobert->setUser( $this->getReference('robert') );
		$manager->persist($userorderrobert);		
		
		$userorderalicia = new UserOrder();
		$userorderalicia->setValid('1');
		$userorderalicia->setDate( new \DateTime() );
		$userorderalicia->setOrdercode('20171012011119');
		$userorderalicia->setProducts( array(
			'0' => array( '1' => '1'),
			'1' => array( '2' => '4'),
			'2' => array( '4' => '389'),
		) );
		$userorderalicia->setUser( $this->getReference('alicia') );
		$manager->persist($userorderalicia);		
		
		$userorderingrid = new UserOrder();
		$userorderingrid->setValid('1');
		$userorderingrid->setDate( new \DateTime() );
		$userorderingrid->setOrdercode('20171012311112');
		$userorderingrid->setProducts( array(
			'0' => array( '1' => '1'),
			'1' => array( '2' => '4'),
			'2' => array( '4' => '100'),
		) );
		$userorderingrid->setUser( $this->getReference('ingrid') );
		$manager->persist($userorderingrid);		

		$userordertaina = new UserOrder();
		$userordertaina->setValid('1');
		$userordertaina->setDate( new \DateTime() );
		$userordertaina->setOrdercode('20171022011122');
		$userordertaina->setProducts( array(
			'0' => array( '1' => '54'),
			'1' => array( '2' => '1'),
			'2' => array( '4' => '7'),
		) );
		$userordertaina->setUser( $this->getReference('taina') );
		$manager->persist($userordertaina);


		$manager->flush();
	}

	public function getDependencies() {
		return array(
			UserFixtures::class,
		);
	}


}
