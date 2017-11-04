<?php

namespace Dashboard\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{

    /**
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('corporate');
	$placeholder->getContainer('lead')->set('sodis travel');

	return new ViewModel();
    }

}
