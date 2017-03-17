<?php
namespace AppBundle\Admin;

use Symfony\Component\Validator\Constraints\Valid;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RecipeAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper->add('name', 'text')
    ->add('ingredients', 'sonata_type_collection',
    array('label' => 'Ingrédients',
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
