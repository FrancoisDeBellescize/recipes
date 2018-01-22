<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class RecipeRepository extends EntityRepository
{
  public function getLast($limit = 10){
    $qb = $this->createQueryBuilder('r');
    $qb->select('r')
    ->orderBy('r.created_at')
    ->setMaxResults($limit);

    return $qb->getQuery()->getResult();
  }

  public function findByIngredients($ingredients){

    $query = $this->createQueryBuilder('g');

    foreach ($ingredients as $key => $tmp){
      $query->innerJoin('AppBundle:RecipeHasIngredient', 'rhi' . $key , Join::WITH, 'g.id = rhi' . $key . '.recipe')
      ->andWhere('rhi' . $key . '.ingredient = :ingredient AND rhi' . $key . '.value <= :value')
      ->setParameter('ingredient', $tmp["ingredient"]->getId())
      ->setParameter('value', $tmp["value"]);
    }
    $data = $query->getQuery()->getResult();

    return $data;
  }
}
