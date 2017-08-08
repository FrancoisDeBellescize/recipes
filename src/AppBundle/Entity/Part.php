<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Sluggable\Util\Urlizer;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeRepository")
 */
class Part
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

  // Constructor
  public function __construct()
  {
    $this->name = "New Part";
  }

  public function __toString(){
    return $this->name;
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
