<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class IngredientAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
      $formMapper->add('name', 'text')
      ->add('inUnit')
      ->add('gram')
      ->add('milliliter');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
      $datagridMapper->add('name')
      ->add('inUnit')
      ->add('gram')
      ->add('milliliter');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
      $listMapper->addIdentifier('name')
      ->addIdentifier('inUnit');
    }
}
