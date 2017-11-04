<?php

namespace Dashboard\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    /**
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('dashboard');
	$placeholder->getContainer('lead')->set('portal');

        $viewmodel = new ViewModel();
        
	return $viewmodel;
    }

}
