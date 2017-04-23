<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\RecipeHasIngredientType;

class RecipeType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('ingredients', CollectionType::class, array(
      'entry_type' => RecipeHasIngredientType::class,
      'allow_add' => true,
      'attr' => array("class" => 'row')
    ))
    ->add('save', SubmitType::class, array('label' => 'Rechercher'));
  }
}
