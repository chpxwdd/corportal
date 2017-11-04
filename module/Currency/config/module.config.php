<?php

return array(
    'navigation' => array(
	'default' => array(
	    array(
		'label' => 'Currency',
		'route' => 'currency',
		'action' => 'index',
		'pages' => array(
		    array('label' => 'Ресурсы', 'route' => 'currency/rates', 'action' => 'index'),
//		    array('label' => 'Справочник', 'route' => 'currency/library', 'action' => 'index'),
		),
	    ),
	),
    ),
    'router' => array(
	'routes' => array(
	    'currency' => array(
		'type' => 'Literal',
		'options' => array(
		    'route' => '/currency',
		    'defaults' => array(
			'__NAMESPACE__' => 'Currency\Controller',
			'controller' => 'Index',
			'action' => 'index',
		    ),
		),
		'may_terminate' => true,
		'child_routes' => array(
		    'service' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/service',
			    'constraints' => array(
				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
			    ),
			    'defaults' => array(
				'__NAMESPACE__' => 'Currency\Controller',
				'controller' => 'Index',
				'action' => 'index',
			    ),
			),
		    ),
		    'rates' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/rates[/:action]',
			    'constraints' => array(
				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
			    ),
			    'defaults' => array(
				'__NAMESPACE__' => 'Currency\Controller',
				'controller' => 'Rates',
				'action' => 'index',
			    ),
			    'may_terminate' => true,
			    'child_routes' => array(
				'parse' => array(
				    'type' => 'Segment',
				    'options' => array(
					'route' => '/parse',
					'defaults' => array(
					    '__NAMESPACE__' => 'Currency\Controller',
					    'controller' => 'Rates',
					    'action' => 'parse',
					),
					'constraints' => array(
					    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
				    ),
				),
				'view' => array(
				    'type' => 'Segment',
				    'options' => array(
					'route' => '/view',
					'defaults' => array(
					    '__NAMESPACE__' => 'Currency\Controller',
					    'controller' => 'Rates',
					    'action' => 'view',
					),
					'constraints' => array(
					    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
				    ),
				),
				'save' => array(
				    'type' => 'Segment',
				    'options' => array(
					'route' => '/save',
					'defaults' => array(
					    '__NAMESPACE__' => 'Currency\Controller',
					    'controller' => 'Rates',
					    'action' => 'save',
					),
				    ),
				),
			    ),
			),
		    ),
		),
	    ),
	),
    ),
    'controllers' => array(
	'invokables' => array(
	    'Currency\Controller\Index' => 'Currency\Controller\IndexController',
	    'Currency\Controller\Rates' => 'Currency\Controller\RatesController',
	),
    ),
    'doctrine' => array(
	'driver' => array(
	    'sds_currency_entity' => array(
		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
		'paths' => __DIR__ . '/../src/Currency/Entity',
	    ),
	    'orm_default' => array(
		'drivers' => array(
		    'Currency\Entity' => 'sds_currency_entity'
		),
	    ),
	),
    ),
    'view_manager' => array(
	'template_path_stack' => array(
	    'Currency' => __DIR__ . '/../view',
	),
    ),
);
