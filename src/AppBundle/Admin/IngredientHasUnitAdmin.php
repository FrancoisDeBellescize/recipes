<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class IngredientHasUnitAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
      $formMapper->add('value', null, array('label' => 'Valeur'))
      ->add('unit', 'sonata_type_model_list', array(), array('link_parameters' => array()));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
    }
}
