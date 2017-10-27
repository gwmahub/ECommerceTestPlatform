<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Address;


class AddressFixtures extends Fixture
{

	public function load(ObjectManager $manager)
	{

		$addressgege = new Address();
		$addressgege->setFirstname('Gégé');
		$addressgege->setLastname('Dubuisson');
		$addressgege->setAddress('Rue des boubous,45');
		$addressgege->setAddresscompl('');
		$addressgege->setPostcode('1000');
		$addressgege->setCity('Bruxelles');
		$addressgege->setCountry('Belgium');
		$addressgege->setPhone('4878565');
		$addressgege->setMobile('45987865');
		$addressgege->setUser( $this->getReference('gege')  );
		$manager->persist($addressgege);
		
		$addressrobert = new Address();
		$addressrobert->setFirstname('Robert');
		$addressrobert->setLastname('Lamer');
		$addressrobert->setAddress('Rue des deroutes,45');
		$addressrobert->setAddresscompl('Livrer derrière le pot de fleurs svp !!!!');
		$addressrobert->setPostcode('1000');
		$addressrobert->setCity('Bruxelles');
		$addressrobert->setCountry('Belgium');
		$addressrobert->setPhone('4878826');
		$addressrobert->setMobile('45981234');
		$addressrobert->setUser( $this->getReference('robert')  );
		$manager->persist($addressrobert);
		
		$addressingrid = new Address();
		$addressingrid->setFirstname('Ingrid');
		$addressingrid->setLastname('Lavalenche');
		$addressingrid->setAddress('Rue des flocons,69');
		$addressingrid->setAddresscompl('');
		$addressingrid->setPostcode('4530');
		$addressingrid->setCity('Ans');
		$addressingrid->setCountry('Belgium');
		$addressingrid->setPhone('4878555');
		$addressingrid->setMobile('45984321');
		$addressingrid->setUser( $this->getReference('ingrid') );
		$manager->persist($addressingrid);

		$addressalicia = new Address();
		$addressalicia->setFirstname('Alicia');
		$addressalicia->setLastname('Latempete');
		$addressalicia->setAddress('Rue du vent,869');
		$addressalicia->setAddresscompl('');
		$addressalicia->setPostcode('8160');
		$addressalicia->setCity('Hotton');
		$addressalicia->setCountry('Belgium');
		$addressalicia->setPhone('4878777');
		$addressalicia->setMobile('45989876');
		$addressalicia->setUser( $this->getReference('alicia') );
		$manager->persist($addressalicia);


		$manager->flush();

		$this->addReference('addressgege',$addressgege );
		$this->addReference('addressrobert',$addressrobert );
		$this->addReference('addressingrid',$addressingrid );
		$this->addReference('addressalicia',$addressalicia );
	}

	public function getDependencies() {
		return array(
			UserFixtures::class,
		);
	}

}
