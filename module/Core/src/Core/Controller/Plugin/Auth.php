<?php

namespace Core\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
/**/
use Zend\Authentication\Storage\Session as SessionStorage;

class Auth extends AbstractPlugin {

    protected $auth;
    protected $storage;

    private function getStorage($ns = 'ldap_auth') {
	if (!$this->storage) {
	    $storage = new SessionStorage();
	    $this->storage = $storage->read($ns);
	}
	return $this->storage;
    }

    public function doAuthorization($event) {
	// get list roles 
	$acl = new Acl();
	
	$acl->addRole(new Role('anonymous'));
	$acl->addRole(new Role('member'), 'anonymous');
	$acl->addRole(new Role('admin'), 'member');
	/**
	 * @todo each module must be a own binding Resource
	 */
	$acl->addResource(new Resource('Core'));
	$acl->addResource(new Resource('Dashboard'));
	$acl->addResource(new Resource('Cms'));
	$acl->addResource(new Resource('Geo'));
	$acl->addResource(new Resource('Contact'));
	$acl->addResource(new Resource('Corporate'));
	$acl->addResource(new Resource('Lunch'));
	$acl->addResource(new Resource('Staff'));
	$acl->addResource(new Resource('Currency'));
	$acl->addResource(new Resource('Worktime'));
	$acl->addResource(new Resource('Workflow'));
	//---------------------------
	$acl->addResource(new Resource('DoctrineORMModule'));
	$acl->addResource(new Resource('Zf2DoctrineAutocomplete'));
	//---------------------------
	$acl->allow('anonymous', array('DoctrineORMModule', 'Core', 'Geo'	  ,
), 'view');
//	$acl->addResource(new Resource('http://corportal.sodis.ru/zf2-doctrine-autocomplete/Core-Form-Element-Autocomplete?term=sdsd'));

	$acl->deny('anonymous', array(
	  'Cms',
	  'Worktime',
	  'Currency',
	  'Lunch',
	  'Workflow'
	    ), 'view');

	$acl->allow('anonymous', array('Dashboard'));
	$acl->allow('anonymous', array('Dashboard',"Zf2DoctrineAutocomplete"));

	$acl->allow('member', array(
	  'Staff',
	  'Worktime',
	  'Workflow',
	  'Lunch',
	  'Cms',
	  'Corporate',
	  'Currency',
	  'Contact',
	    ), 'view');

	$controller = $event->getTarget();
	$controllerClass = get_class($controller);
	$namespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

	$role = 'anonymous';

	if ($this->getStorage()) {
	    $role = $this->getStorage()->role;
	}

	if (!$acl->isAllowed($role, $namespace, 'view')) {
	    $router = $event->getRouter();
	    $url = $router->assemble(array(), array('name' => 'auth/login'));
	    $response = $event->getResponse();
	    $response->setStatusCode(302);
	    $response->getHeaders()->addHeaderLine('Location', $url);
	    $event->stopPropagation();
	}
    }

}
