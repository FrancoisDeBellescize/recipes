<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 */
class RecipeHasIngredient
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=true)
     */
    private $recipe;

    /**
     * @var \AppBundle\Entity\Ingredient
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ingredient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    /**
     * @ORM\Column(type="integer")
     */
    protected $value;

    /**
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

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
     * Set recipe
     *
     * @param  \AppBundle\Entity\Recipe $recipe
     * @return RecipeHasIngredient
     */
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return \AppBundle\Entity\Recipe
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Set ingredient
     *
     * @param  \AppBundle\Entity\Ingredient $ingredient
     * @return RecipeHasIngredient
     */
    public function setIngredient(Ingredient $ingredient)
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
     * Print for admin
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getIngredient()->getName();
    }

    /**
     * Set value
     *
     * @param integer $value
     *
     * @return RecipeHasIngredient
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
     * Set position
     *
     * @param integer $position
     *
     * @return RecipeHasIngredient
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }
}
