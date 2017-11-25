<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="ec_category")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\CategoryRepository")
 */
class Category
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=125)
     */
    private $name;

	/**
	 * @ORM\OneToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\Media", cascade={"persist", "remove"} )
	 * @ORM\JoinColumn(nullable=true)
	 */
    private $image;

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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Set image
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Media $image
     *
     * @return Category
     */
    public function setImage(\Ecommerce\EcommerceBundle\Entity\Media $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Ecommerce\EcommerceBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }
}
