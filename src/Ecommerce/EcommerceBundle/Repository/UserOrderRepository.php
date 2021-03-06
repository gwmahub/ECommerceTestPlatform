<?php

namespace Ecommerce\EcommerceBundle\Repository;

/**
 * UserOrderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserOrderRepository extends \Doctrine\ORM\EntityRepository
{
	public function getOrdersByUser($userid){

		return $this->createQueryBuilder('o')
		            ->select('o')
		            ->where('o.user = :userid')
		            ->andWhere('o.valid = 1')
		            ->andWhere('o.ordercode != 0')
		            ->orderBy('o.id', 'DESC')
		            ->setParameter('userid', $userid)
		            ->getQuery()->getResult();
	}

	public function getTheLastsOrdersByUser($user, $limit){

		return $this->createQueryBuilder('o')
		            ->select('o')
		            ->where('o.user = :user')
		            ->andWhere('o.valid = 1')
		            ->andWhere('o.ordercode != 0')
		            ->orderBy('o.id', 'DESC')
					->setMaxResults($limit)
		            ->setParameter('user', $user )
		            ->getQuery()->getResult();
	}

	public function getBillsByUser($userid){

		return $this->createQueryBuilder('o')
			->select('o')
			->where('o.user = :userid')
			->andWhere('o.valid = 1')
			->andWhere('o.ordercode != 0')
			->orderBy('o.id')
			->setParameter('userid', $userid)
			->getQuery()->getResult();
	}

	public function getBillsByDate( $date ){
		return $this->createQueryBuilder('o')
			->select('o')
			->where('o.date > :date')
			->andWhere('o.valid = 1')
			->orderBy('o.id')
			->setParameter('date', $date)
			->getQuery()->getResult();
	}

	/**
	 * Get all not validated (valid=0) orders by the current user in the DB
	 * Useful for the dedicated page
	 */
	public function getTheNotValidatedOrdersByUser($user){
		return $this->createQueryBuilder('o')
			->select('o')
			->where('o.user = :user')
			->andWhere('o.valid = 0')
			->orderBy('o.id','DESC')
			->setParameter('userid', $user)
			->getQuery()->getResult();
	}
	/**
	 * Get the last not validated order in the DB
	 * Useful for the Dashboard
	 */
	public function getTheLastNotValidatedOrdersByUser($user, $limit){
		return $this->createQueryBuilder('o')
			->select('o')
			->where('o.user = :user')
			->andWhere('o.valid = 0')
			->orderBy('o.id','DESC')
			->setMaxResults($limit)
			->setParameter('user', $user)
			->getQuery()->getResult();
	}
}
