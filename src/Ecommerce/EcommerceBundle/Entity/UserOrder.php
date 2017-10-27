<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserOrder
 *
 * @ORM\Table(name="ec_user_order")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\UserOrderRepository")
 */
class UserOrder
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="valid", type="boolean")
     */
    private $valid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ordercode", type="string", length=255, nullable=false)
     */
    private $ordercode;

    /**
     * @var array
     *
     * @ORM\Column(name="products", type="array")
     */
    private $products;

	/**
	 * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="userorders" )
	 * @ORM\JoinColumn(nullable=true)
	 */
	protected $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valid
     *
     * @param boolean $valid
     *
     * @return UserOrder
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get valid
     *
     * @return bool
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return UserOrder
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
	

    /**
     * Set products
     *
     * @param array $products
     *
     * @return UserOrder
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get products
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }



    /**
     * Set user
     *
     * @param \User\UserBundle\Entity\User $user
     *
     * @return UserOrder
     */
    public function setUser(\User\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ordercode
     *
     * @param string $ordercode
     *
     * @return UserOrder
     */
    public function setOrdercode($ordercode)
    {
        $this->ordercode = $ordercode;

        return $this;
    }

    /**
     * Get ordercode
     *
     * @return string
     */
    public function getOrdercode()
    {
        return $this->ordercode;
    }
}
