<?php

namespace User\UserBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use User\UserBundle\Entity\User;


class UserFixtures extends Fixture
{

	public function load(ObjectManager $manager)
	{

		$gege = new User();
		$gege->setUsername('gege');
		$gege->setEmail('gege@gege.io');
		$encoder    = $this->container->get('security.password_encoder');
		$password   = $encoder->encodePassword($gege, 'pass_1234');
		$gege->setPassword($password);
		$gege->setEnabled(1);
		$manager->persist($gege);
		
		$robert = new User();
		$robert->setUsername('robert');
		$robert->setEmail('roro@roro.io');
		$encoder    = $this->container->get('security.password_encoder');
		$password   = $encoder->encodePassword($robert, 'pass_1234');
		$robert->setPassword($password);
		$robert->setEnabled(1);
		$manager->persist($robert);
		
		$ingrid = new User();
		$ingrid->setUsername('ingrid');
		$ingrid->setEmail('gritou@grigri.io');
		$encoder    = $this->container->get('security.password_encoder');
		$password   = $encoder->encodePassword($ingrid, 'pass_1234');
		$ingrid->setPassword($password);
		$ingrid->setEnabled(1);
		$manager->persist($ingrid);
		
		$alicia = new User();
		$alicia->setUsername('alicia');
		$alicia->setEmail('lili@lilie.io');
		$encoder    = $this->container->get('security.password_encoder');
		$password   = $encoder->encodePassword($alicia, 'pass_1234');
		$alicia->setPassword($password);
		$alicia->setEnabled(1);
		$manager->persist($alicia);
		
		$taina = new User();
		$taina->setUsername('taina');
		$taina->setEmail('nana@nana.io');
		$encoder    = $this->container->get('security.password_encoder');
		$password   = $encoder->encodePassword($taina, 'pass_1234');
		$taina->setPassword($password);
		$taina->setEnabled(1);
		$manager->persist($taina);		


		$manager->flush();

		$this->addReference('gege',$gege );
		$this->addReference('robert',$robert );
		$this->addReference('ingrid',$ingrid );
		$this->addReference('alicia',$alicia );
		$this->addReference('taina',$taina );
	}

}
