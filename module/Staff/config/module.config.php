<?php

return array(
    'controllers' => array(
	'invokables' => array(
	    'Staff\Controller\Index' => 'Staff\Controller\IndexController',
	    'Staff\Controller\Company' => 'Staff\Controller\CompanyController',
	    'Staff\Controller\Department' => 'Staff\Controller\DepartmentController',
	    'Staff\Controller\Position' => 'Staff\Controller\PositionController',
	    'Staff\Controller\Employee' => 'Staff\Controller\EmployeeController',
	),
    ),
    'navigation' => array(
	'default' => array(
	    array(
		'label' => 'Служба персонала',
		'route' => 'staff',
		'action' => 'index',
		'pages' => array(
		    array(
			"label" => "Управление",
			"route" => "staff",
			"action" => "index",
			"pages" => array(),
		    ),
		    array(
			'label' => 'Позиция',
			'route' => 'staff/position',
			'action' => 'index',
			'pages' => array(),
		    ),
		    array(
			'label' => 'Сотрудник',
			'route' => 'staff/employee',
			'action' => 'index',
			'pages' => array(),
		    ),
		    array(
			'label' => 'Подразделение',
			'route' => 'staff/department',
			'action' => 'index',
			'pages' => array(),
		    ),
		    array(
			'label' => 'Предприятие',
			'route' => 'staff/company',
			'action' => 'index',
			'pages' => array(),
		    ),
		),
	    ),
	),
    ),
    'router' => array(
	'routes' => array(
	    'staff' => array(
		'type' => 'Literal',
		'options' => array(
		    'route' => '/staff',
		    'defaults' => array(
			'__NAMESPACE__' => 'Staff\Controller',
			'controller' => 'Index',
			'action' => 'index',
		    ),
		),
		'may_terminate' => true,
		'child_routes' => array(
		    'position' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/position/[:action][/:id][/page/:page][/order_by/:order_by][/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'controller' => 'Staff\Controller\Position',
				'action' => 'index',
			    ),
			),
		    ),
		    'employee' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/employee/[:action][/:id][/page/:page][/order_by/:order_by][/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'controller' => 'Staff\Controller\Employee',
				'action' => 'index',
			    ),
			),
		    ),
		    'department' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/department/[:action][/:id][/page/:page][/order_by/:order_by][/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'controller' => 'Staff\Controller\Department',
				'action' => 'index',
			    ),
			),
		    ),
		    'company' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/company[/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'controller' => 'Staff\Controller\Company',
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
	    'staff_entity' => array(
		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
		'paths' => __DIR__ . '/../src/Staff/Entity',
	    ),
	    'orm_default' => array(
		'drivers' => array(
		    'Staff\Entity' => 'staff_entity',
		),
	    ),
	),
    ),
    'view_manager' => array(
	'template_path_stack' => array(
	    'Staff' => __DIR__ . '/../view',
	),
    ),
);
