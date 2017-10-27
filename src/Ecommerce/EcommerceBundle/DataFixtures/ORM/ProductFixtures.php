<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Product;


class ProductFixtures extends Fixture
{

	public function load(ObjectManager $manager)
	{

		$prod_carot = new Product();
		$prod_carot->setName('carotte');
		$prod_carot->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem nunc, sollicitudin vel sodales consectetur, sollicitudin ut sem. Nunc nec diam pulvinar, sagittis nisl sed, rhoncus est.');
		$prod_carot->setPrice('0.56');
		$prod_carot->setAvailability('1');
		$prod_carot->setCategory( $this->getReference('cat_leg_racines') );
		$prod_carot->setImage( $this->getReference('img_leg_racines') );
		$prod_carot->setVat( $this->getReference('vat2') );
		$manager->persist($prod_carot);		
		
		$prod_banane = new Product();
		$prod_banane->setName('banane');
		$prod_banane->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem nunc, sollicitudin vel sodales consectetur, sollicitudin ut sem. Nunc nec diam pulvinar, sagittis nisl sed, rhoncus est.');
		$prod_banane->setPrice('0.75');
		$prod_banane->setAvailability('1');
		$prod_banane->setCategory( $this->getReference('cat_fruits_tropic') );
		$prod_banane->setImage( $this->getReference('img_fruits_tropic') );
		$prod_banane->setVat( $this->getReference('vat2') );
		$manager->persist($prod_banane);

		$prod_ananas = new Product();
		$prod_ananas->setName('ananas');
		$prod_ananas->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem nunc, sollicitudin vel sodales consectetur, sollicitudin ut sem. Nunc nec diam pulvinar, sagittis nisl sed, rhoncus est.');
		$prod_ananas->setPrice('1.52');
		$prod_ananas->setAvailability('1');
		$prod_ananas->setCategory( $this->getReference('cat_fruits_tropic') );
		$prod_ananas->setImage( $this->getReference('img_ananas') );
		$prod_ananas->setVat( $this->getReference('vat2') );
		$manager->persist($prod_ananas);
		
		$prod_tomate = new Product();
		$prod_tomate->setName('tomate');
		$prod_tomate->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem nunc, sollicitudin vel sodales consectetur, sollicitudin ut sem. Nunc nec diam pulvinar, sagittis nisl sed, rhoncus est.');
		$prod_tomate->setPrice('0.05');
		$prod_tomate->setAvailability('1');
		$prod_tomate->setCategory( $this->getReference('cat_leg') );
		$prod_tomate->setImage( $this->getReference('img_tomat') );
		$prod_tomate->setVat( $this->getReference('vat2') );
		$manager->persist($prod_tomate);

		$prod_framb = new Product();
		$prod_framb->setName('framboises');
		$prod_framb->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem nunc, sollicitudin vel sodales consectetur, sollicitudin ut sem. Nunc nec diam pulvinar, sagittis nisl sed, rhoncus est.');
		$prod_framb->setPrice('2.95');
		$prod_framb->setAvailability('1');
		$prod_framb->setCategory( $this->getReference('cat_fruits_rouges') );
		$prod_framb->setImage( $this->getReference('img_framb') );
		$prod_framb->setVat( $this->getReference('vat1') );
		$manager->persist($prod_framb);

		$prod_haricot = new Product();
		$prod_haricot->setName('haricot');
		$prod_haricot->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem nunc, sollicitudin vel sodales consectetur, sollicitudin ut sem. Nunc nec diam pulvinar, sagittis nisl sed, rhoncus est.');
		$prod_haricot->setPrice('3.10');
		$prod_haricot->setAvailability('1');
		$prod_haricot->setCategory( $this->getReference('cat_leg_tiges') );
		$prod_haricot->setImage( $this->getReference('img_haricot') );
		$prod_haricot->setVat( $this->getReference('vat1') );
		$manager->persist($prod_haricot);

		$prod_pasteq = new Product();
		$prod_pasteq->setName('pastèque');
		$prod_pasteq->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem nunc, sollicitudin vel sodales consectetur, sollicitudin ut sem. Nunc nec diam pulvinar, sagittis nisl sed, rhoncus est.');
		$prod_pasteq->setPrice('5.00');
		$prod_pasteq->setAvailability('1');
		$prod_pasteq->setCategory( $this->getReference('cat_fruits_tropic') );
		$prod_pasteq->setImage( $this->getReference('img_pasteq') );
		$prod_pasteq->setVat( $this->getReference('vat1') );
		$manager->persist($prod_pasteq);


		$manager->flush();

		// pas d'ajout de référence puisque pas d'autres liaisons
	}

	public function getDependencies(){
		return array(
			MediaFixtures::class,
			CategoryFixtures::class,
			VatFixtures::class,
		);
	}

}
