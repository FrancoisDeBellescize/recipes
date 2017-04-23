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
      ->add('defaultUnit')
      ->add('units', 'sonata_type_collection',
      array('label' => 'Unités',
      'by_reference' => false,
      'required' => false),
      array(
        'edit' => 'inline',
        'inline' => 'table',
      ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
      $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
      $listMapper->addIdentifier('name');
    }
}
