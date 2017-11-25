<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Vat;


class VatFixtures extends Fixture
{

	public function load(ObjectManager $manager)
	{

		$vat1 = new Vat();
		$vat1->setName('VAT 6%');
		$vat1->setMultiplicate(1.06); // 100/106=0.943 ?!
		$vat1->setValue(6);
		$manager->persist($vat1);

		$vat2 = new Vat();
		$vat2->setName('VAT 21%');
		$vat2->setMultiplicate(1.21);
		$vat2->setValue(21);
		$manager->persist($vat2);


		$manager->flush();

		$this->addReference('vat1',$vat1 );
		$this->addReference('vat2',$vat2 );
	}

}
