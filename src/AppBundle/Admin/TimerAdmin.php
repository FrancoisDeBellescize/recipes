<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TimerAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
      $formMapper->add('name', null, array('label' => 'Etape'))
      ->add('time', null, array('label' => 'Time (s)'))
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
