<?php

return array(
    'controllers' => array(
	'invokables' => array(
	    'Corporate\Controller\Index' => 'Corporate\Controller\IndexController',
	    'Corporate\Controller\Office' => 'Corporate\Controller\OfficeController',
	),
    ),
    'navigation' => array(
	'default' => array(
	    array(
		'label' => 'Организация',
		'route' => 'corporate',
		'action' => 'index',
		'pages' => array(
		    array(
			'label' => 'Офисы',
			'route' => 'corporate/office',
			'action' => 'index',
			'pages' => array()
		    ),
		)
	    ),
	),
    ),
    'router' => array(
	'routes' => array(
	    'corporate' => array(
		'type' => 'Literal',
		'options' => array(
		    'route' => '/corporate',
		    'defaults' => array(
			'__NAMESPACE__' => 'Corporate\Controller',
			'controller' => 'Index',
			'action' => 'index',
		    ),
		),
		'may_terminate' => true,
		'child_routes' => array(
		    'office' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/office[/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'__NAMESPACE__' => 'Corporate\Controller',
				'controller' => 'Office',
				'action' => 'index',
			    ),
			),
			'may_terminate' => true,
			'child_routes' => array(),
		    ),
		),
	    ),
	),
    ),
    'view_manager' => array(
	'template_path_stack' => array(
	    'Corporate' => __DIR__ . '/../view',
	),
    ),
    'doctrine' => array(
	'driver' => array(
	    'corporate_entity' => array(
		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
		'paths' => __DIR__ . '/../src/Corporate/Entity',
	    ),
	    'orm_default' => array(
		'drivers' => array(
		    'Corporate\Entity' => 'corporate_entity'
		),
	    ),
	),
    ),
);
