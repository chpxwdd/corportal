<?php

return array(
    'controllers' => array(
	'invokables' => array(
	    'Lunch\Controller\Index' => 'Lunch\Controller\IndexController',
	),
    ),
    "navigation" => array(
	"default" => array(
	    array(
		"label" => "Lunch",
		"route" => "lunch",
		"action" => "index",
		"visible" => 1,
		'title' => 'lunch module',
		"pages" => array(
		    array(
			"label" => "Список",
			"route" => "lunch",
			"action" => "index",
			'title' => 'Список последних заказов',
		    ),
		    array(
			"label" => "Карточка заказа",
			"route" => "lunch/order",
			"action" => "order",
			'title' => 'Карточка заказа',
		    ),
		    array(
			"label" => "Управление",
			"route" => "lunch/week",
			"action" => "week",
			'title' => 'Управление',
		    ),
		),
	    ),
	),
    ),
    'router' => array(
	'routes' => array(
	    'lunch' => array(
		'type' => 'Literal',
		'options' => array(
		    'route' => '/lunch',
		    'defaults' => array(
			'__NAMESPACE__' => 'Lunch\Controller',
			'controller' => 'Index',
			'action' => 'index',
		    ),
		),
		'may_terminate' => true,
		'child_routes' => array(
		    //USER
		    'order' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/order[/:id]',
			    'constraints' => array(
				'action' => '[0-9]+',
			    ),
			    'defaults' => array(
				'__NAMESPACE__' => 'Lunch\Controller',
				'controller' => 'Index',
				'action' => 'view',
			    ),
			),
		    ),
		    //ADMIN
		    'week' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/week[/:page]',
			    'constraints' => array(
				'action' => '[0-9]+',
			    ),
			    'defaults' => array(
				'__NAMESPACE__' => 'Lunch\Controller',
				'controller' => 'Index',
				'action' => 'week',
			    ),
			),
		    ),
		),
	    ),
	),
    ),
    'doctrine' => array(
	'driver' => array(
	    'sds_lunch_entity' => array(
		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
		'paths' => __DIR__ . '/../src/Lunch/Entity',
	    ),
	    'orm_default' => array(
		'drivers' => array(
		    'Lunch\Entity' => 'sds_lunch_entity',
		),
	    ),
	),
    ),
    'view_manager' => array(
	'template_path_stack' => array(
	    'Lunch' => __DIR__ . '/../view',
	),
    ),
);
