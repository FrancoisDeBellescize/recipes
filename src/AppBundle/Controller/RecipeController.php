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
  public function indexAction(Request $request)
  {
    $em    = $this->get('doctrine.orm.entity_manager');
    $dql   = "SELECT r FROM AppBundle:Recipe r ORDER BY r.created_at DESC";
    $query = $em->createQuery($dql);

    $paginator  = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
      $query, /* query NOT result */
      $request->query->getInt('page', 1) /* page number */,
      6 /* limit per page */
    );
    return $this->render('recipe/index.html.twig', array('recipes' => $pagination));
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

    $ingredients = $this->getDoctrine()->getRepository('AppBundle:Ingredient')->findAll();

    return $this->render('recipe/search.html.twig', array('form' => $form->createView(), 'ingredients' => $ingredients));
  }

  /**
  * @Route("/search/autocomplete", name="recipe_search_autocomplete")
  */
  public function searchAutocompleteAction(Request $request)
  {
    $data = array();
    $term = trim(strip_tags($request->get('term')));

    $em = $this->getDoctrine()->getManager();

    $recipes = $em->getRepository('AppBundle:Recipe')->createQueryBuilder('c')
    ->where('c.name LIKE :name')
    ->setParameter('name', '%'.$term.'%')
    ->setMaxResults(3)
    ->getQuery()
    ->getResult();

    $data["recipes"] = array();
    foreach ($recipes as $recipe)
    {
      $data["recipes"][] = array(
        "name" => $recipe->getName(),
         "id" => $recipe->getId(),
         "slug" => $recipe->getSlug(),
         "image" => $this->container->get('sonata.media.twig.extension')->path($recipe->getMedia(), 'reference')
       );
    }

    $ingredients = $em->getRepository('AppBundle:Ingredient')->createQueryBuilder('i')
    ->where('i.name LIKE :name')
    ->setParameter('name', '%'.$term.'%')
    ->setMaxResults(5)
    ->getQuery()
    ->getResult();

    $data["ingredients"] = array();
    foreach ($ingredients as $ingredient)
    {
      $data["ingredients"][] = array(
        "name" => $ingredient->getName(),
         "id" => $ingredient->getId()
       );
    }

    $response = new JsonResponse();
    $response->setData($data);

    return $response;
  }
}
