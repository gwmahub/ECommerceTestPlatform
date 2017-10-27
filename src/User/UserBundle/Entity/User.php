<?php

namespace User\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="ec_user")
 * @ORM\Entity(repositoryClass="User\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
	 * @ORM\OneToMany(targetEntity="Ecommerce\EcommerceBundle\Entity\UserOrder", mappedBy="user", cascade={"remove"} )
	 * @ORM\JoinColumn(nullable=true)
	 */
	protected $userorders;

	/**
	 * @ORM\OneToMany(targetEntity="Ecommerce\EcommerceBundle\Entity\Address", mappedBy="user", cascade={"remove"} )
	 * @ORM\JoinColumn(nullable=true)
	 */
	protected $useraddresses;


    public function __construct() {
        parent::__construct();

        $this->userorders = new ArrayCollection();
        $this->useraddresses = new ArrayCollection();
    }

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
     * Add userorder
     *
     * @param \Ecommerce\EcommerceBundle\Entity\UserOrder $userorder
     *
     * @return User
     */
    public function addUserorder(\Ecommerce\EcommerceBundle\Entity\UserOrder $userorder)
    {
        $this->userorders[] = $userorder;

        return $this;
    }

    /**
     * Remove userorder
     *
     * @param \Ecommerce\EcommerceBundle\Entity\UserOrder $userorder
     */
    public function removeUserorder(\Ecommerce\EcommerceBundle\Entity\UserOrder $userorder)
    {
        $this->userorders->removeElement($userorder);
    }

    /**
     * Get userorders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserorders()
    {
        return $this->userorders;
    }

    /**
     * Add useraddress
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Address $useraddress
     *
     * @return User
     */
    public function addUseraddress(\Ecommerce\EcommerceBundle\Entity\Address $useraddress)
    {
        $this->useraddresses[] = $useraddress;

        return $this;
    }

    /**
     * Remove useraddress
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Address $useraddress
     */
    public function removeUseraddress(\Ecommerce\EcommerceBundle\Entity\Address $useraddress)
    {
        $this->useraddresses->removeElement($useraddress);
    }

    /**
     * Get useraddresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUseraddresses()
    {
        return $this->useraddresses;
    }
}
