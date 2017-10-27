<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Category;
use Ecommerce\EcommerceBundle\Entity\Media;


class CategoryFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{

		$cat_leg = new Category();
		$cat_leg->setName('Légumes');
		$cat_leg->setImage($this->getReference('img_legumes'));
		$manager->persist($cat_leg);

		$cat_leg_feuilles = new Category();
		$cat_leg_feuilles->setName('Légumes-feuilles');
		$cat_leg_feuilles->setImage($this->getReference('img_leg_feuil'));
		$manager->persist($cat_leg_feuilles);

		$cat_leg_tiges = new Category();
		$cat_leg_tiges->setName('Légumes-tiges');
		$cat_leg_tiges->setImage($this->getReference('img_leg_tiges'));
		$manager->persist($cat_leg_tiges);

		$cat_leg_fleurs = new Category();
		$cat_leg_fleurs->setName('Légumes-fleurs');
		$cat_leg_fleurs->setImage($this->getReference('img_leg_fleurs'));
		$manager->persist($cat_leg_fleurs);

		$cat_leg_racines = new Category();
		$cat_leg_racines->setName('Légumes-racines');
		$cat_leg_racines->setImage($this->getReference('img_leg_racines'));
		$manager->persist($cat_leg_racines);

		$cat_fruits = new Category();
		$cat_fruits->setName('Fruits');
		$cat_fruits->setImage($this->getReference('img_fruits'));
		$manager->persist($cat_fruits);

		$cat_agrumes = new Category();
		$cat_agrumes->setName('Agrumes');
		$cat_agrumes->setImage($this->getReference('img_agrumes'));
		$manager->persist($cat_agrumes);

		$cat_fruits_rouges = new Category();
		$cat_fruits_rouges->setName('Fruits rouges');
		$cat_fruits_rouges->setImage($this->getReference('img_fruits_rg'));
		$manager->persist($cat_fruits_rouges);

		$cat_fruits_secs = new Category();
		$cat_fruits_secs->setName('Fruits secs');
		$cat_fruits_secs->setImage($this->getReference('img_fruits_secs'));
		$manager->persist($cat_fruits_secs);

		$cat_fruits_tropic = new Category();
		$cat_fruits_tropic->setName('Fruits tropicaux');
		$cat_fruits_tropic->setImage($this->getReference('img_fruits_tropic'));
		$manager->persist($cat_fruits_tropic);



		$manager->flush();

		$this->addReference('cat_leg', $cat_leg);
		$this->addReference('cat_leg_feuilles', $cat_leg_feuilles);
		$this->addReference('cat_leg_tiges', $cat_leg_tiges);
		$this->addReference('cat_leg_fleurs', $cat_leg_fleurs);
		$this->addReference('cat_leg_racines', $cat_leg_racines);
		$this->addReference('cat_fruits', $cat_fruits);
		$this->addReference('cat_agrumes', $cat_agrumes);
		$this->addReference('cat_fruits_rouges', $cat_fruits_rouges);
		$this->addReference('cat_fruits_secs', $cat_fruits_secs);
		$this->addReference('cat_fruits_tropic', $cat_fruits_tropic);

	}

	public function getDependencies(){
		return array(
			MediaFixtures::class,
		);
	}

}
