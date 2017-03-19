<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RecipeController extends Controller
{
  /**
   * @Route("/recipe", name="recipe_index")
   */
  public function indexAction()
  {
    $repository = $this->getDoctrine()->getRepository('AppBundle:Recipe');
    $recipes = $repository->findAll();

    if (!$recipes){
      throw $this->createNotFoundException('The recipe does not exist');
    }

    return $this->render('recipe/index.html.twig', array("recipes" => $recipes));
  }

  /**
  * Matches /recipe/*
  *
  * @Route("/recipe/{slug}", name="recipe_show")
  */
  public function showAction($slug)
  {
    $repository = $this->getDoctrine()->getRepository('AppBundle:Recipe');
    $recipe = $repository->findOneBySlug($slug);

    if (!$recipe){
      throw $this->createNotFoundException('The recipe does not exist');
    }

    return $this->render('recipe/show.html.twig', array("recipe" => $recipe));
  }

  /**
   * @Route("/search", name="recipe_search")
   */
  public function searchAction()
  {
    return $this->render('recipe/search.html.twig');
  }

  /**
   * @Route("/search/autocomplete", name="recipe_search_autocomplete")
   */
  public function searchAutocompleteAction(Request $request)
  {
    $names = array();
    $term = trim(strip_tags($request->get('term')));

    $em = $this->getDoctrine()->getManager();

    $entities = $em->getRepository('AppBundle:Ingredient')->createQueryBuilder('c')
       ->where('c.name LIKE :name')
       ->setParameter('name', '%'.$term.'%')
       ->getQuery()
       ->getResult();

    foreach ($entities as $entity)
    {
        $names[] = $entity->getName();
    }

    $response = new JsonResponse();
    $response->setData($names);

    return $response;
  }
}
