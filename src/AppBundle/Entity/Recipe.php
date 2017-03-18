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
     * @ORM\OrderBy({"position" = "ASC"})
    */
    private $ingredients;

    /**
     * @var ArrayCollection Steps
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Step", mappedBy="recipe",cascade={"all"},orphanRemoval=true )
     * @ORM\OrderBy({"position" = "ASC"})
    */
    private $steps;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cookTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $preparationTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
     private $restTime;

     /**
      * @ORM\Column(type="integer")
      */
      private $forPerson;

    // Constructor
    public function __construct()
    {
      $this->ingredients = new ArrayCollection();
      $this->steps = new ArrayCollection();
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
     * Set Steps
     *
     * @return Recipe
     */
    public function setSteps(ArrayCollection $steps)
    {
        $this->steps = $steps;
        return $this;
    }

    /**
     * Get Steps
     *
     * @return ArrayCollection
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Add Step
     *
     * @param Step $step
     * @return $this
     */
    public function addStep(Step $step)
    {
        $step->setRecipe($this);
        $this->steps[] = $step;
        return $this;
    }

    /**
     * Remove Step
     *
     * @param Step $step
     * @return $this
     */
    public function removeStep(Step $step)
    {
        $this->steps->removeElement($step);
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

    /**
     * Set cookTime
     *
     * @param integer $cookTime
     *
     * @return Recipe
     */
    public function setCookTime($cookTime)
    {
        $this->cookTime = $cookTime;

        return $this;
    }

    /**
     * Get cookTime
     *
     * @return integer
     */
    public function getCookTime()
    {
        return $this->cookTime;
    }

    /**
     * Set preparationTime
     *
     * @param integer $preparationTime
     *
     * @return Recipe
     */
    public function setPreparationTime($preparationTime)
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    /**
     * Get preparationTime
     *
     * @return integer
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    public function __toString(){
        return $this->getName();
    }

    /**
     * Set restTime
     *
     * @param integer $restTime
     *
     * @return Recipe
     */
    public function setRestTime($restTime)
    {
        $this->restTime = $restTime;

        return $this;
    }

    /**
     * Get restTime
     *
     * @return integer
     */
    public function getRestTime()
    {
        return $this->restTime;
    }

    /**
     * Set forPerson
     *
     * @param integer $forPerson
     *
     * @return Recipe
     */
    public function setForPerson($forPerson)
    {
        $this->forPerson = $forPerson;

        return $this;
    }

    /**
     * Get forPerson
     *
     * @return integer
     */
    public function getForPerson()
    {
        return $this->forPerson;
    }
}
