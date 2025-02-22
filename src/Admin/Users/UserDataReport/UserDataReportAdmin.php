<?php

namespace App\Admin\Users\UserDataReport;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;

class UserDataReportAdmin extends AbstractAdmin
{
  /**
   * {@inheritdoc}
   */
  protected $baseRouteName = 'admin_userdata';

  /**
   * {@inheritdoc}
   */
  protected $baseRoutePattern = 'stored_userdata';

  /**
   * {@inheritdoc}
   *
   * Fields to be shown on lists
   */
  protected function configureListFields(ListMapper $list): void
  {
    $list
      ->addIdentifier('username')
      ->add('email')
      ->add(ListMapper::NAME_ACTIONS, null, [
        'actions' => [
          'retrieve' => [
            'template' => 'Admin/CRUD/list__action_retrieve_stored_user_data.html.twig',
          ],
        ],
      ])
    ;
  }

  /**
   * {@inheritdoc}
   *
   * Fields to be shown on filter forms
   */
  protected function configureDatagridFilters(DatagridMapper $filter): void
  {
    $filter->add('username', null, [
      'show_filter' => true,
    ])
      ->add('email')
    ;
  }

  protected function configureRoutes(RouteCollectionInterface $collection): void
  {
    $collection->clearExcept(['list']);
    $collection->add('retrieve', $this->getRouterIdParameter().'/retrieveUserData');
  }
}
