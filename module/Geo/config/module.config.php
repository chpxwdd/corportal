<?php

return array(
  'controllers' => array(
    'invokables' => array(
      'Geo\Controller\Index' => 'Geo\Controller\IndexController',
      'Geo\Controller\Location' => 'Geo\Controller\LocationController',
    ),
  ),
  'navigation' => array(
    'default' => array(
      array(
	'label' => 'Geo',
	'route' => 'geo',
	'action' => 'index',
	'pages' => array(
	    array(
	    'label' => 'Локация',
	    'route' => 'geo/location',
	    'action' => 'index',
	    'pages' => array(),
	  ),
	),
      ),
    ),
  ),
  'router' => array(
    'routes' => array(
      'geo' => array(
	'type' => 'Literal',
	'options' => array(
	  'route' => '/geo',
	  'defaults' => array(
	    '__NAMESPACE__' => 'Geo\Controller',
	    'controller' => 'Index',
	    'action' => 'index',
	  ),
	),
	'may_terminate' => true,
	'child_routes' => array(
	  'location' => array(
	    'type' => 'Segment',
	    'options' => array(
	      'route' => '/location/[:action][/:id][/page/:page][/order_by/:order_by][/:order]',
	      'constraints' => array(
		'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
		'id' => '[0-9]+',
		'page' => '[0-9]+',
		'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
		'order' => 'ASC|DESC',
	      ),
	      'defaults' => array(
		'controller' => 'Geo\Controller\Location',
		'action' => 'index',
	      ),
	    ),
	  ),
	),
      ),
    ),
  ),
  'doctrine' => array(
    'driver' => array(
      'geo_entity' => array(
	'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
	'paths' => __DIR__ . '/../src/Geo/Entity',
      ),
      'orm_default' => array(
	'drivers' => array(
	  'Geo\Entity' => 'geo_entity',
	),
      ),
    ),
  ),
  'view_manager' => array(
    'template_path_stack' => array(
      'Geo' => __DIR__ . '/../view',
    ),
  ),
);
