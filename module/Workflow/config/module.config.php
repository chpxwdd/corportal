<?php

return array(
    'controllers' => array(
	'invokables' => array(
	    'Workflow\Controller\Index' => 'Workflow\Controller\IndexController',
	    'Workflow\Controller\Resource' => 'Workflow\Controller\ResourceController',
	    'Workflow\Controller\Document' => 'Workflow\Controller\DocumentController',
	),
    ),
    'navigation' => array(
	'default' => array(
	    array(
		'label' => 'Документооборот',
		'route' => 'workflow',
		'action' => 'index',
		'pages' => array(
		    array(
			'label' => 'Ресурсы',
			'route' => 'workflow/resource',
			'action' => 'index',
			'pages' => array()
		    ),
		    array(
			'label' => 'Документы',
			'route' => 'workflow/document',
			'action' => 'index',
			'pages' => array()
		    ),
		)
	    ),
	),
    ),
    'router' => array(
	'routes' => array(
	    'workflow' => array(
		'type' => 'Literal',
		'options' => array(
		    'route' => '/workflow',
		    'defaults' => array(
			'__NAMESPACE__' => 'Workflow\Controller',
			'controller' => 'Index',
			'action' => 'index',
		    ),
		),
		'may_terminate' => true,
		'child_routes' => array(
		    'resource' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/resource/[:action][/:id][/page/:page][/order_by/:order_by][/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'controller' => 'Workflow\Controller\Resource',
				'action' => 'index',
			    ),
			),
		    ),
		    'document' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/document/[:action][/:id][/page/:page][/order_by/:order_by][/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'controller' => 'Workflow\Controller\Document',
				'action' => 'index',
			    ),
			),
		    ),
		),
	    ),
	),
    ),
    'view_manager' => array(
	'template_path_stack' => array(
	    'Workflow' => __DIR__ . '/../view',
	),
    ),
    'doctrine' => array(
	'driver' => array(
	    'common_workflow_entity' => array(
		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
		'paths' => __DIR__ . '/../src/Workflow/Entity',
	    ),
	    'orm_default' => array(
		'drivers' => array(
		    'Workflow\Entity' => 'common_workflow_entity'
		),
	    ),
	),
    ),
);
