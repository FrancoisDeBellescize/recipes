<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit", cascade={"persist"},cascade={"all"})
     */
    private $defaultUnit;

    /**
    * @var ArrayCollection Unit
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\IngredientHasUnit", mappedBy="ingredient",cascade={"all"},orphanRemoval=true )
    */
    private $units;

    // Constructor
    public function __construct()
    {
      $this->units = new ArrayCollection();
    }

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
     * Add unit
     *
     * @param \AppBundle\Entity\IngredientHasUnit $unit
     *
     * @return Ingredient
     */
    public function addUnit(\AppBundle\Entity\IngredientHasUnit $unit)
    {
        $unit->setIngredient($this);
        $this->units[] = $unit;

        return $this;
    }

    /**
     * Remove unit
     *
     * @param \AppBundle\Entity\IngredientHasUnit $unit
     */
    public function removeUnit(\AppBundle\Entity\IngredientHasUnit $unit)
    {
        $this->units->removeElement($unit);
    }

    /**
     * Get units
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Set defaultUnit
     *
     * @param \AppBundle\Entity\Unit $defaultUnit
     *
     * @return Ingredient
     */
    public function setDefaultUnit(\AppBundle\Entity\Unit $defaultUnit = null)
    {
        $this->defaultUnit = $defaultUnit;

        return $this;
    }

    /**
     * Get defaultUnit
     *
     * @return \AppBundle\Entity\Unit
     */
    public function getDefaultUnit()
    {
        return $this->defaultUnit;
    }
}
