<?php

namespace Core;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {

    /**
     * 
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e) {
	$app = $e->getApplication();
	$em = $app->getEventManager();

	$em->attach('route', array($this, 'loadAuthorization'), 2);
	$em->attach('route', array($this, 'loadMessenger'), 3);

	$moduleRouteListener = new ModuleRouteListener();
	$moduleRouteListener->attach($em);
    }

    /**
     * 
     * @param MvcEvent $e
     */
    public function loadMessenger(MvcEvent $e) {
	$app = $e->getApplication();
	$sm = $app->getServiceManager();
	$shm = $app->getEventManager()->getSharedManager();
	$router = $sm->get('router');
	$request = $sm->get('request');
	if (null !== $router->match($request)) {
	    $shm->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) use ($sm) { $sm->get('ControllerPluginManager')->get('pluginMessenger')->load($e); }, 2);
	}
    }

    /**
     * 
     * @param MvcEvent $e
     */
    public function loadAuthorization(MvcEvent $e) {
	$app = $e->getApplication();
	$sm = $app->getServiceManager();
	$shm = $app->getEventManager()->getSharedManager();
	$router = $sm->get('router');
	$request = $sm->get('request');
	if (null !== $router->match($request)) {
	    $shm->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) use ($sm) { $sm->get('ControllerPluginManager')->get('pluginAuth')->doAuthorization($e); }, 2);
	}
    }


    /**
     *  @return array
     */
    public function getServiceConfig() { /**/ }

    /**
     * @return array
     */
    public function getControllerConfig() { /**/ }

    /**
     * 
     * @return void
     */
    public function getConfig() {
	return include __DIR__ . '/config/module.config.php';
    }

    /**
     * 
     * @return Array
     */
    public function getAutoloaderConfig() {
	return array('Zend\Loader\StandardAutoloader' => array('namespaces' => array(__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__)));
    }

}
