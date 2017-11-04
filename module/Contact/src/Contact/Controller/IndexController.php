<?php

namespace Contact\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    private $title;
    private $lead;
    private $sidebar;

    public function __construct() {
	$this->title = 'Картотека';
	$this->lead = '';
    }

    /**
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction() {
	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set($this->title);
	$placeholder->getContainer('lead')->set($this->lead);

	$placeholder->getContainer('sidebar')->set($this->sidebar);

	$viewmodel = new ViewModel();
	return $viewmodel;
    }

}
