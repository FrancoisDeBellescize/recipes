<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=false)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inUnit;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gram;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $milliliter;

    /**
     * Print for admin
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return integer
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
     * @return Ingredient
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
     * Set inUnit
     *
     * @param boolean $inUnit
     *
     * @return Ingredient
     */
    public function setInUnit($inUnit)
    {
        $this->inUnit = $inUnit;

        return $this;
    }

    /**
     * Get inUnit
     *
     * @return boolean
     */
    public function getInUnit()
    {
        return $this->inUnit;
    }

    /**
     * Set gram
     *
     * @param string $gram
     *
     * @return Ingredient
     */
    public function setGram($gram)
    {
        $this->gram = $gram;

        return $this;
    }

    /**
     * Get gram
     *
     * @return string
     */
    public function getGram()
    {
        return $this->gram;
    }

    /**
     * Set milliliter
     *
     * @param string $milliliter
     *
     * @return Ingredient
     */
    public function setMilliliter($milliliter)
    {
        $this->milliliter = $milliliter;

        return $this;
    }

    /**
     * Get milliliter
     *
     * @return string
     */
    public function getMilliliter()
    {
        return $this->milliliter;
    }
}
