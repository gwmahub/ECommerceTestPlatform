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
     * @ORM\Column(name="productcode", type="string", length=255, nullable=true)
     */
    private $productcode;

    /**
     * @var array
     *
     * @ORM\Column(name="products", type="array")
     */
    private $products;


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
     * Set productcode
     *
     * @param string $productcode
     *
     * @return UserOrder
     */
    public function setProductcode($productcode)
    {
        $this->productcode = $productcode;

        return $this;
    }

    /**
     * Get productcode
     *
     * @return string
     */
    public function getProductcode()
    {
        return $this->productcode;
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
}

