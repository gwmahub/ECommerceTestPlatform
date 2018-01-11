<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="ec_product")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\ProductRepository")
 */
class Product
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
	 * @var \DateTime
	 *
	 * @ORM\Column(name="createdat", type="datetime")
	 */
	protected $createdat;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="updatedat", type="datetime",  nullable=true)
	 */
	protected $updatedat;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="code", type="string", length=255, nullable=true)
	 */
	private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */

    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="availability", type="boolean")
     */
    private $availability;
	/**
	 * @var boolean
	 * @ORM\Column(name="isonline", type="boolean")
	 */
    private $isonline;

	/**
	 * @ORM\ManyToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\Category", cascade={"persist"} )
	 * @ORM\JoinColumn(nullable=true)
	 */
    protected $category;

    /**
     * @ORM\OneToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\Media", cascade={"persist", "remove"} )
     * @ORM\JoinColumn(nullable=true)
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\Vat", cascade={"persist"} )
     * @ORM\JoinColumn(nullable=true)
     */
    protected $vat;



    public function __construct(){
    	$this->createdat = new \DateTime();
    }

	public function setFileTargetDir(){
		return '/products';
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
	 * Set code
	 *
	 * @param string $code
	 *
	 * @return Product
	 */
	public function setCode($code)
	{
		$this->code = $code;

		return $this;
	}

	/**
	 * Get code
	 *
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

	/**
	 * Set availability
	 *
	 * @param boolean $availability
	 *
	 * @return Product
	 */
	public function setAvailability($availability)
	{
		$this->availability = $availability;

		return $this;
	}

	/**
	 * Get availability
	 *
	 * @return boolean
	 */
	public function getAvailability()
	{
		return $this->availability;
	}

	/**
	 * Set isonline
	 *
	 * @param boolean $isonline
	 *
	 * @return Product
	 */
	public function setIsonline($isonline)
	{
		$this->isonline = $isonline;

		return $this;
	}

	/**
	 * Get isonline
	 *
	 * @return boolean
	 */
	public function getIsonline()
	{
		return $this->isonline;
	}

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set vat
     *
     * @param float $vat
     *
     * @return Product
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return float
     */
    public function getVat()
    {
        return $this->vat;
    }



    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Product
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     *
     * @return Product
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    /**
     * Get updatedat
     *
     * @return \DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }
}
