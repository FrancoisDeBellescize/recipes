<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
  public function getFilters()
  {
    return array(
      new \Twig_SimpleFilter('getUnit', array($this, 'getUnit')),
    );
  }

  public function getUnit($recipeHasIngredient)
  {
    if ($recipeHasIngredient->getIngredient()->getInUnit() == true)
    return $recipeHasIngredient->getValue();

    if ($recipeHasIngredient->getIngredient()->getGram() == null && $recipeHasIngredient->getIngredient()->getMilliliter() != null)
    return ($recipeHasIngredient->getValue() . " ml");

    if ($recipeHasIngredient->getIngredient()->getGram() != null && $recipeHasIngredient->getIngredient()->getMilliliter() == null)
    return ($recipeHasIngredient->getValue() . " gr");

    if ($recipeHasIngredient->getIngredient()->getGram() != null && $recipeHasIngredient->getIngredient()->getMilliliter() != null){
      $ml = $recipeHasIngredient->getValue() / $recipeHasIngredient->getIngredient()->getGram() * $recipeHasIngredient->getIngredient()->getMilliliter();
      return ($recipeHasIngredient->getValue() . " gr / " . intval($ml) . " ml");
    }

    return ($recipeHasIngredient->getValue());
  }
}
