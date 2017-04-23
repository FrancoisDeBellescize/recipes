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
    $value = $recipeHasIngredient->getValue();
    $display = $value . $recipeHasIngredient->getIngredient()->getDefaultUnit()->getSymbol();

    $units = $recipeHasIngredient->getIngredient()->getUnits();
    foreach ($units as $ingredientHasUnit){
      $display = $display . " / " . $value * $ingredientHasUnit->getValue() . $ingredientHasUnit->getUnit()->getSymbol();
    }
    return $display;
  }
}
