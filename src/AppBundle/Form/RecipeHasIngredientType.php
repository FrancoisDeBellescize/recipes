<?php

namespace AppBundle\Form;

use AppBundle\Entity\RecipeHasIngredient;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RecipeHasIngredientType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('ingredient', EntityType::class, array(
      'label' => false,
      'class' => 'AppBundle:Ingredient',
      'choice_label' => function ($ingredient) {
        $symbol = $ingredient->getDefaultUnit()->getSymbol();
        if ($symbol)
        return $ingredient->getName() . " (" . $ingredient->getDefaultUnit()->getSymbol() . ")";
        return $ingredient->getName();
      },
      "attr" => array('class' => "col-md-6")))
      ->add('value', TextType::class, array(
        "attr" => array('class' => "col-md-6")
      ));
    }
  }
