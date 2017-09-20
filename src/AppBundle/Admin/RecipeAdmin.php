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
    $formMapper->with('Général')
    ->add('name')
    ->add('media', 'sonata_type_model_list',
      array('label' => 'Image', 'required' => false),
      array('link_parameters' => array('context' => $this->getRequest()->get('context')))
    )
    ->add('cookTime', null, array('label' => 'Cook Time (in minutes)'))
    ->add('preparationTime', null, array('label' => 'Preparation Time (in minutes)'))
    ->add('restTime', null, array('label' => 'Rest Time (in minutes)'))
    ->add('forPerson', null, array('label' => 'For x Person'))
    ->add('description', null, array('label' => 'Description'))
    ->end()
    ->with('Etapes')
    ->add('steps', 'sonata_type_collection',
    array('label' => 'Etapes',
    'by_reference' => false,
    'required' => false),
    array(
      'edit' => 'inline',
      'sortable' => 'position',
      'inline' => 'table',
    ))
    ->end()
    ->with('Etapes')
    ->add('timers', 'sonata_type_collection',
    array('label' => 'Timers',
    'by_reference' => false,
    'required' => false),
    array(
      'edit' => 'inline',
      'sortable' => 'position',
      'inline' => 'table',
    ))
    ->end()
    ->with('Ingredients')
    ->add('ingredients', 'sonata_type_collection',
    array('label' => 'Ingrédients',
    'by_reference' => false,
    'required' => false),
    array(
      'edit' => 'inline',
      'sortable' => 'position',
      'inline' => 'table',
    ))
    ->end();
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
