<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class StepAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
      $formMapper->add('text', null, array('label' => 'Etape'))
      ->add('position', 'hidden');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
      $datagridMapper->add('position');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
      $listMapper->add('position');
    }
}
