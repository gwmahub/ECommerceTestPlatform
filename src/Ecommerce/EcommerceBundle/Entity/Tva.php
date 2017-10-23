<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tva
 *
 * @ORM\Table(name="ec_tva")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\TvaRepository")
 */
class Tva
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
     * @var float
     *
     * @ORM\Column(name="multiplicate", type="float")
     */
    private $multiplicate;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;


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
     * Set multiplicate
     *
     * @param float $multiplicate
     *
     * @return Tva
     */
    public function setMultiplicate($multiplicate)
    {
        $this->multiplicate = $multiplicate;

        return $this;
    }

    /**
     * Get multiplicate
     *
     * @return float
     */
    public function getMultiplicate()
    {
        return $this->multiplicate;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Tva
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set value
     *
     * @param float $value
     *
     * @return Tva
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}

