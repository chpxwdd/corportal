<?php

namespace Corporate;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

      public function getServiceConfig()
    {
	
    }

    public function getControllerPluginConfig()
    {
	
    }

    public function getConfig()
    {
	return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
	return array(
	    'Zend\Loader\StandardAutoloader' => array(
		'namespaces' => array(
		    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
		),
	    ),
	);
    }

}
