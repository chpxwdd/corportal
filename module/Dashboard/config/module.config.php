<?php

return array(
    'navigation' => array(
	'default' => array(
	    array('label' => 'Dashboard', 'route' => 'dashboard', 'action' => 'index', 'pages' => array(
		    array('label' => 'Users', 'route' => 'dashboard/user', 'action' => 'index', 'pages' => array()),
		    array('label' => 'Roles', 'route' => 'dashboard/role', 'action' => 'index', 'pages' => array()),
		    array('label' => 'Resources', 'route' => 'dashboard/resource', 'action' => 'index', 'pages' => array()),
		    array('label' => 'Permissions', 'route' => 'dashboard/permission', 'action' => 'index', 'pages' => array()),
		)
	    ),
//	    array('label' => 'Login', 'route' => 'auth/login', 'action' => 'login'),
//	    array('label' => 'Logout', 'route' => 'auth/logout', 'action' => 'logout'),
	),
    ),
    'router' => array(
	'routes' => array(
	    'dashboard' => array(
		'type' => 'Literal',
		'options' => array(
		    'route' => '/dashboard',
		    'defaults' => array(
			'__NAMESPACE__' => 'Dashboard\Controller',
			'controller' => 'Index',
			'action' => 'index')
		),
		'may_terminate' => true,
		'child_routes' => array(
		    'user' => array(
			'type' => 'Segment', 
			'options' => array(
			    'route' => '/user[/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*', 
				'id' => '[0-9]+', 
				'page' => '[0-9]+', 
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC'
				),
			    'defaults' => array(
				'controller' => 'Dashboard\Controller\User',
				'action' => 'index'
				),
			), 
		    ),
		    'role' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/role[/:action][/:id][/page/:page][/order_by/:order_by][/order/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'controller' => 'Dashboard\Controller\Role',
				'action' => 'index',
			    ),
			),
			'may_terminate' => true,
			'child_routes' => array()
		    ),
		    'resource' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/resource[/:action][/:id][/page/:page][/order_by/:order_by][/order/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'controller' => 'Dashboard\Controller\Role',
				'action' => 'index',
			    ),
			),
		    ),
		    'permission' => array(
			'type' => 'Segment',
			'options' => array(
			    'route' => '/permission[/:action][/:id][/page/:page][/order_by/:order_by][/order/:order]',
			    'constraints' => array(
				'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
				'id' => '[0-9]+',
				'page' => '[0-9]+',
				'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
				'order' => 'ASC|DESC',
			    ),
			    'defaults' => array(
				'controller' => 'Dashboard\Controller\Role',
				'action' => 'index',
			    ),
			),
		    ),
		),
	    ),
	    'auth' => array(
		'type' => 'Literal',
		'options' => array(
		    'route' => '/auth',
		    'defaults' => array(
			'__NAMESPACE__' => 'Dashboard\Controller',
			'controller' => 'Auth',
			'action' => 'index',
		    ),
		),
		'may_terminate' => true,
		'child_routes' => array(
		    'login' => array(
			'type' => 'Literal',
			'options' => array(
			    'route' => '/login',
			    'defaults' => array(
				'__NAMESPACE__' => 'Dashboard\Controller',
				'controller' => 'Auth',
				'action' => 'login',
			    ),
			),
		    ),
		    'logout' => array(
			'type' => 'Literal',
			'options' => array(
			    'route' => '/logout',
			    'defaults' => array(
				'__NAMESPACE__' => 'Dashboard\Controller',
				'controller' => 'Auth',
				'action' => 'logout',
			    ),
			),
		    ),
		),
	    ),
	),
    ),
    'controllers' => array(
	'invokables' => array(
	    'Dashboard\Controller\Index' => 'Dashboard\Controller\IndexController',
	    'Dashboard\Controller\User' => 'Dashboard\Controller\UserController',
	    'Dashboard\Controller\Role' => 'Dashboard\Controller\RoleController',
	    'Dashboard\Controller\Resource' => 'Dashboard\Controller\ResourceController',
	    'Dashboard\Controller\Permission' => 'Dashboard\Controller\PermissionController',
	    'Dashboard\Controller\Auth' => 'Dashboard\Controller\AuthController',
	),
    ),
    'view_manager' => array(
	'template_path_stack' => array(
	    'Dashboard' => __DIR__ . '/../view',
	),
    ),
    'doctrine' => array(
	'driver' => array(
	    'dashboard_entity' => array(
		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
		'paths' => __DIR__ . '/../src/Dashboard/Entity',
	    ),
	    'orm_default' => array(
		'drivers' => array(
		    'Dashboard\Entity' => 'dashboard_entity',
		),
	    ),
	),
    ),
);
