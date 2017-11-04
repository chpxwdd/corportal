<?php

return array(
    'controllers' => array(
	'invokables' => array(
	    'Worktime\Controller\Index' => 'Worktime\Controller\IndexController',
	),
    ),
    'navigation' => array(
	'default' => array(
	    array(
		'label' => 'Учет рабочего времени',
		'route' => 'worktime',
		'action' => 'index',
		'pages' => array(
		    array(
			'label' => 'Статистика',
			'route' => 'worktime',
			'action' => 'index',
			'pages' => array()
		    ),
		)
	    ),
	),
    ),
    'router' => array(
	'routes' => array(
	    'worktime' => array(
		'type' => 'Literal',
		'options' => array(
		    'route' => '/worktime',
		    'defaults' => array(
			'__NAMESPACE__' => 'Worktime\Controller',
			'controller' => 'Index',
			'action' => 'index',
		    ),
		),
		'may_terminate' => true,
		'child_routes' => array(
		),
	    ),
	),
    ),
    'view_manager' => array(
	'template_path_stack' => array(
	    'Worktime' => __DIR__ . '/../view',
	),
    ),
//    'doctrine' => array(
//	'driver' => array(
//	    'common_worktime_entity' => array(
//		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
//		'paths' => __DIR__ . '/../src/Worktime/Entity',
//	    ),
//	    'orm_default' => array(
//		'drivers' => array(
//		    'Worktime\Entity' => 'common_worktime_entity'
//		),
//	    ),
//	),
//    ),
);
