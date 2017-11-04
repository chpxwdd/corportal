<?php

/**
 * @see https://framework.zend.com/manual/2.4/en/modules/zend.form.advanced-use-of-forms.html Phone Form Element
 */
return array(
  'controllers' => array(
    'invokables' => array(
      'Core\Controller\Base' => 'Core\Controller\BaseController',
    ),
  ),
  'controller_plugins' => array(
    'invokables' => array(
      'pluginSearch' => 'Core\Controller\Plugin\Search',
      'pluginAuth' => 'Core\Controller\Plugin\Auth',
      'pluginMessenger' => 'Core\Controller\Plugin\Messenger',
    )
  ),
  'service_manager' => array(
    'abstract_factories' => array(
      'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
      'Zend\Log\LoggerAbstractServiceFactory',
    ),
    'aliases' => array(
      'translator' => 'MvcTranslator',
    ),
    "factories" => array(
      "navigation" => "Zend\Navigation\Service\DefaultNavigationFactory",
    ),
  ),
  'form_elements' => array(
    'invokables' => array(
      'phone' => 'Core\Form\Element\Phone'
    )
  ),
  'translator' => array(
    'locale' => 'en_US',
    'translation_file_patterns' => array(
      array(
	'type' => 'gettext',
	'base_dir' => __DIR__ . '/../language',
	'pattern' => '%s.mo',
      ),
    ),
  ),
  'view_manager' => array(
    'display_not_found_reason' => true,
    'display_exceptions' => true,
    'doctype' => 'HTML5',
    'not_found_template' => 'error/404',
    'exception_template' => 'error/index',
    'template_map' => array(
      'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
      'error/404' => __DIR__ . '/../view/error/404.phtml',
      'error/index' => __DIR__ . '/../view/error/index.phtml',
      'partial/menu.phtml' => __DIR__ . '/../view/layout/partial/navigation/menu.phtml',
      'partial/mainmenu.phtml' => __DIR__ . '/../view/layout/partial/navigation/mainmenu.phtml',
      'partial/breadcrumb.phtml' => __DIR__ . '/../view/layout/partial/navigation/breadcrumb.phtml',
      'partial/toolbar.phtml' => __DIR__ . '/../view/layout/partial/grid/toolbar.phtml',
      'partial/grid.phtml' => __DIR__ . '/../view/layout/partial/grid/grid.phtml',
      'partial/grid-panel.phtml' => __DIR__ . '/../view/layout/partial/grid/grid-panel.phtml',
      'partial/paginator.phtml' => __DIR__ . '/../view/layout/partial/grid/paginator.phtml',
      'partial/panel.phtml' => __DIR__ . '/../view/layout/partial/block/panel.phtml',
      // --------------------------------------------------------------------------------------------------------
      // FORMS
      // --------------------------------------------------------------------------------------------------------
      'partial/form' => __DIR__ . '/../view/layout/partial/form.phtml',
    ),
    'template_path_stack' => array(
      __DIR__ . '/../view',
    ),
  ),
);
