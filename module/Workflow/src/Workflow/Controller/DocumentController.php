<?php

namespace Workflow\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DocumentController extends AbstractActionController
{

    private $title;
    private $lead;

    /**
     * class constructor
     * 
     * @access public
     */
    public function __construct()
    {
	$this->title = 'Документы';
	$this->lead = 'документооборот';
    }

    /**
     * @access public
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set($this->title);
	$placeholder->getContainer('lead')->set($this->lead);

	$viewmodel = new ViewModel();

	return $viewmodel;
    }

}
