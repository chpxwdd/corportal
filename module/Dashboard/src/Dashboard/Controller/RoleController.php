<?php

namespace Dashboard\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class RoleController extends AbstractActionController
{

    /**
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('roles');
	$placeholder->getContainer('lead')->set('dashboard');

	return new ViewModel();
    }

}