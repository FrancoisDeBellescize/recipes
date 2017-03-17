<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Recipe
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
     * @var ArrayCollection Ingredient
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RecipeHasIngredient", mappedBy="recipe",cascade={"all"},orphanRemoval=true )
     */
    private $ingredients;


    // Constructor
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    /**
     * Set Ingredients
     *
     * @return Recipe
     */
    public function setIngredients(ArrayCollection $ingredients)
    {
        $this->ingredients = $ingredients;
        return $this;
    }

    /**
     * Get Ingredients
     *
     * @return ArrayCollection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Add Ingredient
     *
     * @param RecipeHasIngredient $ingredient
     * @return $this
     */
    public function addIngredient(RecipeHasIngredient $ingredient)
    {
        $ingredient->setRecipe($this);
        $this->ingredients[] = $ingredient;
        return $this;
    }

    /**
     * Remove Ingerdient
     *
     * @param Ingredient $ingredient
     * @return $this
     */
    public function removeIngredient(Ingredient $ingredient)
    {
        $this->ingredients->removeElement($ingredient);
        return $this;
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
     * @return Recipe
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
}
