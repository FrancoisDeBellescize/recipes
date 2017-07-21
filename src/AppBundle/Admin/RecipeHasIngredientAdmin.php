<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RecipeHasIngredientAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
      $formMapper->add('value', null, array('label' => 'Valeur (Unité/Grammes)'))
      ->add('ingredient', 'sonata_type_model_list', array(), array('link_parameters' => array()))
      ->add('position', 'hidden')
      ->add('part', 'sonata_type_model_list', array(), array('link_parameters' => array()));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
      $datagridMapper->add('position');
      $datagridMapper->add('part');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
      $ListMapper->add('position');
    }
}
