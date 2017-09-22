<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
  public function getFilters()
  {
    return array(
      new \Twig_SimpleFilter('getUnit', array($this, 'getUnit')),
      new \Twig_SimpleFilter('sortByPart', array($this, 'sortByPartFilter')),
      new \Twig_SimpleFilter('secondToTime', array($this, 'secondToTime')),
    );
  }

  public function secondToTime($seconde)
  {
    $h = floor($seconde / 3600);
    if ($h < 10) $h = "0" . $h;
    $m = floor($seconde % 3600 / 60);
    if ($m < 10) $m = "0" . $m;
    $s = floor($seconde % 3600 % 60);
    if ($s < 10) $s = "0" . $s;
    return ($h . ' : ' . $m . ' : ' . $s);
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

  public function sortByPartFilter($ingredients)
  {
    $parts = array();
    foreach ($ingredients as $recipeHasIngredient){

      // If ingredient is in a Part
      if ($recipeHasIngredient->getPart()){
        $partId = $recipeHasIngredient->getPart()->getId();
      }
      else {
        $partId = -1;
      }

      if (!array_key_exists($partId, $parts)){
        $parts[$partId] = array();
        if ($partId != -1){
          $parts[$partId]["name"] = $recipeHasIngredient->getPart()->getName();
          $parts[$partId]["id"] = $recipeHasIngredient->getPart()->getId();
        }
        $parts[$partId]["ingredients"] = array();
      }

      $parts[$partId]["ingredients"][] = $recipeHasIngredient;
    }

    asort($parts);
    return $parts;
  }
}
