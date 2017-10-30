<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Media;


class MediaFixtures extends Fixture
{

	public function load(ObjectManager $manager)
	{
		$img_legumes = new Media();
		$img_legumes->setPath('https://www.espace-musculation.com/wp-content/uploads/2011/10/legume.jpg');
		$img_legumes->setAlt('Légumes');
		$manager->persist($img_legumes);

		$img_framb = new Media();
		$img_framb->setPath('http://images.all-free-download.com/images/graphicthumb/fresh_fruits_vector_572284.jpg');
		$img_framb->setAlt('Framboise');
		$manager->persist($img_framb);		
		
		$img_haricot = new Media();
		$img_haricot->setPath('http://www.villageemporium.co.uk/wp-content/uploads/2015/08/frozen-vegetables.png');
		$img_haricot->setAlt('Haricot');
		$manager->persist($img_haricot);				
		
		$img_banane = new Media();
		$img_banane->setPath('https://www.hindimeaning.com/pictures/fruits/banana.jpg');
		$img_banane->setAlt('Banane');
		$manager->persist($img_banane);		
		
		$img_pasteq = new Media();
		$img_pasteq->setPath('http://www.petmd.com/sites/default/files/watermellon.jpg');
		$img_pasteq->setAlt('Pastèque');
		$manager->persist($img_pasteq);		
		
		$img_raisins = new Media();
		$img_raisins->setPath('https://img.aws.livestrongcdn.com/ls-article-image-673/ds-photo/getty/article/106/107/475058135.jpg');
		$img_raisins->setAlt('Raisins');
		$manager->persist($img_raisins);		
		
		$img_ananas = new Media();
		$img_ananas->setPath('http://data.whicdn.com/images/37053378/large.jpg');
		$img_ananas->setAlt('Ananas');
		$manager->persist($img_ananas);		
		
		$img_poivron = new Media();
		$img_poivron->setPath('http://www.shponline.co.uk/wp-content/uploads/2015/11/paprika-421088_640.jpg');
		$img_poivron->setAlt('Poivron');
		$manager->persist($img_poivron);		
		
		$img_carot = new Media();
		$img_carot->setPath('https://pbs.twimg.com/media/CPvRQHmWEAA8CQe.png');
		$img_carot->setAlt('Carotte');
		$manager->persist($img_carot);		
		
		$img_tomat = new Media();
		$img_tomat->setPath('http://www.travelnewsnamibia.com/wp-content/uploads/tomatoes.jpg');
		$img_tomat->setAlt('Tomate');
		$manager->persist($img_tomat);		
		
		$img_artich = new Media();
		$img_artich->setPath('https://www.colruyt.be/sites/default/files/styles/teaser_740x/public/generic_page/artisjok_1.jpg?itok=4g2Uc0w5');
		$img_artich->setAlt('Artichaud');
		$manager->persist($img_artich);

		$img_agrumes = new Media();
		$img_agrumes->setPath('http://biaugeaud.com/wp-content/uploads/2015/10/agrumes-illus.png');
		$img_agrumes->setAlt('Agrumes');
		$manager->persist($img_agrumes);

		$img_fruits_secs = new Media();
		$img_fruits_secs->setPath('http://www.musculaction.com/images/560-fruits-secs-2.jpg');
		$img_fruits_secs->setAlt('Fruits secs');
		$manager->persist($img_fruits_secs);

		$img_leg_feuil = new Media();
		$img_leg_feuil->setPath('https://storenotrefamilleprod.blob.core.windows.net/images/cms/diaporama/331193/331193_large.jpg');
		$img_leg_feuil->setAlt('Légumes-feuilles');
		$manager->persist($img_leg_feuil);

		$img_leg_tiges = new Media();
		$img_leg_tiges->setPath('https://www.metro.ca/userfiles/image/fruits-vegetables-herbs/stalk-vegetables/stalkveg-header.jpg');
		$img_leg_tiges->setAlt('Légumes-tiges');
		$manager->persist($img_leg_tiges);

		$img_leg_fleurs = new Media();
		$img_leg_fleurs->setPath('https://thumbs.dreamstime.com/b/l%C3%A9gumes-de-chou-fleur-romanesco-et-artichauts-de-brocoli-47057758.jpg');
		$img_leg_fleurs->setAlt('Légumes-fleurs');
		$manager->persist($img_leg_fleurs);

		$img_leg_fruits = new Media();
		$img_leg_fruits->setPath('https://cdn.pixabay.com/photo/2014/07/08/14/22/vegetables-387503_960_720.jpg');
		$img_leg_fruits->setAlt('Légumes-fruits');
		$manager->persist($img_leg_fruits);

		$img_leg_racines = new Media();
		$img_leg_racines->setPath('http://nhmoi.naturhouse.fr/uploads/modules/recettes/large/78-salade-de-legumes-racine-pesoperfecto18.jpg');
		$img_leg_racines->setAlt('Légumes-racines');
		$manager->persist($img_leg_racines);

		$img_fruits = new Media();
		$img_fruits->setPath('http://lite987.com/files/2015/07/RS9818_481194973-scr.jpg');
		$img_fruits->setAlt('Fruits');
		$manager->persist($img_fruits);

		$img_fruits_rg = new Media();
		$img_fruits_rg->setPath('https://www.topsante.com/var/topsante/storage/images/nutrition-et-recettes/la-sante-par-les-aliments/les-bons-aliments/fruits-rouges-des-aliments-sante-10705/87518-2-fre-FR/Fruits-rouges-des-aliments-sante.jpg');
		$img_fruits_rg->setAlt('Fruits rouges');
		$manager->persist($img_fruits_rg);

		$img_fruits_tropic = new Media();
		$img_fruits_tropic->setPath('https://www.topsante.com/var/topsante/storage/images/nutrition-et-recettes/la-sante-par-les-aliments/les-bons-aliments/fruits-rouges-des-aliments-sante-10705/87518-2-fre-FR/Fruits-rouges-des-aliments-sante.jpg');
		$img_fruits_tropic->setAlt('Fruits tropicaux');
		$manager->persist($img_fruits_tropic);

		$manager->flush();

		$this->addReference('img_legumes', $img_legumes);
		$this->addReference('img_framb', $img_framb);
		$this->addReference('img_haricot', $img_haricot);
		$this->addReference('img_banane', $img_banane);
		$this->addReference('img_pasteq', $img_pasteq);
		$this->addReference('img_raisins', $img_raisins);
		$this->addReference('img_ananas', $img_ananas);
		$this->addReference('img_poivron', $img_poivron);
		$this->addReference('img_carot', $img_carot);
		$this->addReference('img_tomat', $img_tomat);
		$this->addReference('img_artich', $img_artich);
		$this->addReference('img_agrumes', $img_agrumes);
		$this->addReference('img_fruits_secs', $img_fruits_secs);
		$this->addReference('img_leg_feuil', $img_leg_feuil);
		$this->addReference('img_leg_tiges', $img_leg_tiges);
		$this->addReference('img_leg_fleurs', $img_leg_fleurs);
		$this->addReference('img_leg_fruits', $img_leg_fruits);
		$this->addReference('img_leg_racines', $img_leg_racines);
		$this->addReference('img_fruits', $img_fruits);
		$this->addReference('img_fruits_rg', $img_fruits_rg);
		$this->addReference('img_fruits_tropic', $img_fruits_tropic);
	}

}
