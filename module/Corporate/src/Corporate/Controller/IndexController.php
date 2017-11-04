<?php 

namespace Corporate\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    private $title;
    private $lead;
    private $form;

    public function __construct()
    {
	$this->title = 'корпоративные ресурсы';
	$this->lead = 'sodis travel company';
//	$this->form = 'учет рабочего времени';
    }

    /**
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set($this->title);
	$placeholder->getContainer('lead')->set($this->lead);
	
	$vm = new ViewModel();
	
	return $vm;
    }


}
