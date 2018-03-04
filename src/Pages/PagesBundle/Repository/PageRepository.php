<?php

namespace Pages\PagesBundle\Repository;

/**
 * PageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageRepository extends \Doctrine\ORM\EntityRepository
{
	public function getTrashedPages(){

		return $this->createQueryBuilder('p')
			->select('p')
			->where('p.deletedAt IS NOT null')
			->getQuery()->getResult();
	}
}
