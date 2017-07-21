<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    return $this->render('recipe/show.html.twig', array("recipe" => $recipe, "orderedIngredients" => $recipe->getIngredientsGroupByPart()));
  }

  /**
  * @Route("/search", name="recipe_search")
  */
  public function searchAction(Request $request)
  {
    $form = $this->createForm('AppBundle\Form\RecipeType', null);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $data = $form->get('ingredients')->getData();

      $em = $this->getDoctrine()->getManager();
      $recipes = $em->getRepository('AppBundle:Recipe')->findByIngredients($data);
      return $this->render('recipe/search_result.html.twig', array('recipes' => $recipes));
    }

    return $this->render('recipe/search.html.twig', array('form' => $form->createView()));
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
      $names[] = array("name" => $entity->getName(), "id" => $entity->getId());
    }

    $response = new JsonResponse();
    $response->setData($names);

    return $response;
  }
}
