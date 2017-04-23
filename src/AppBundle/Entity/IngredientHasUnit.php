<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 */
class IngredientHasUnit
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Ingredient
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ingredient", inversedBy="units")
     * @ORM\JoinColumn(nullable=true)
     */
    private $ingredient;

    /**
     * @var \AppBundle\Entity\Unit
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    /**
     * @ORM\Column(type="float")
     */
    protected $value;

    /**
     * Constructor
     */
    public function __construct()
    {

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
     * Set value
     *
     * @param integer $value
     *
     * @return IngredientHasUnit
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set ingredient
     *
     * @param \AppBundle\Entity\Ingredient $ingredient
     *
     * @return IngredientHasUnit
     */
    public function setIngredient(\AppBundle\Entity\Ingredient $ingredient = null)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get ingredient
     *
     * @return \AppBundle\Entity\Ingredient
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * Set unit
     *
     * @param \AppBundle\Entity\Unit $unit
     *
     * @return IngredientHasUnit
     */
    public function setUnit(\AppBundle\Entity\Unit $unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \AppBundle\Entity\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
