<?php

return array(
  'controllers' => array(
    'invokables' => array(
      'Contact\Controller\Index' => 'Contact\Controller\IndexController',
      'Contact\Controller\Person' => 'Contact\Controller\PersonController',
      'Contact\Controller\Phone' => 'Contact\Controller\PhoneController',
      'Contact\Controller\Email' => 'Contact\Controller\EmailController',
      'Contact\Controller\Adress' => 'Contact\Controller\AdressController',
    ),
  ),
  'navigation' => array(
    'default' => array(
      array(
	'label' => 'Картотека',
	'route' => 'contact',
	'action' => 'index',
	'pages' => array(
	  array(
	    'label' => 'Физ. лицо',
	    'route' => 'contact/person',
	    'action' => 'index',
	    'pages' => array(),
	  ),
	  array(
	    'label' => 'Телефон',
	    'route' => 'contact/phone',
	    'action' => 'index',
	    'pages' => array(),
	  ),
	),
      ),
    ),
  ),
  'router' => array(
    'routes' => array(
      'contact' => array(
	'type' => 'Literal',
	'options' => array(
	  'route' => '/contact',
	  'defaults' => array(
	    '__NAMESPACE__' => 'Contact\Controller',
	    'controller' => 'Index',
	    'action' => 'index',
	  ),
	),
	'may_terminate' => true,
	'child_routes' => array(
	  'person' => array(
	    'type' => 'Segment',
	    'options' => array(
	      'route' => '/person/[:action][/:id][/page/:page][/order_by/:order_by][/:order]',
	      'constraints' => array(
		'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
		'id' => '[0-9]+',
		'page' => '[0-9]+',
		'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
		'order' => 'ASC|DESC',
	      ),
	      'defaults' => array(
		'controller' => 'Contact\Controller\Person',
		'action' => 'index',
	      ),
	    ),
	  ),
	  'phone' => array(
	    'type' => 'Segment',
	    'options' => array(
	      'route' => '/phone/[:action][/:id][/page/:page][/order_by/:order_by][/:order]',
	      'constraints' => array(
		'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
		'id' => '[0-9]+',
		'page' => '[0-9]+',
		'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
		'order' => 'ASC|DESC',
	      ),
	      'defaults' => array(
		'controller' => 'Contact\Controller\Phone',
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
      'contact_entity' => array(
	'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
	'paths' => __DIR__ . '/../src/Contact/Entity',
      ),
      'orm_default' => array(
	'drivers' => array(
	  'Contact\Entity' => 'contact_entity',
	),
      ),
    ),
  ),
  'view_manager' => array(
    'template_path_stack' => array(
      'Contact' => __DIR__ . '/../view',
    ),
  ),
);
