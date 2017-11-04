<?php

namespace Lunch\Controller;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
/**/
use Core\Controller\BaseController;
use Core\Helper\Partial\Grid;

class IndexController extends BaseController
{

    public function __construct()
    {
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
	return $this->getViewModel();
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function orderAction()
    {
	$order = $this->params()->fromRoute('id', 0);
	if ($order)// если передан id заказа то меняем заголовок
	{
	    $this->setLead('просмотр заказа #' . $order);
	}
	return $this->getViewModel();
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function weekAction()
    {
	
	$om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	$rowset = $om->getRepository("\Lunch\Entity\Week")->findAll();

	$page = (int) $this->params()->fromRoute('page', 0);
	$paginator = new Paginator(new ArrayAdapter($rowset));
	$paginator->setCurrentPageNumber($page);
	$paginator->setItemCountPerPage(10);
	$paginator->setPageRange(5);

	return $this->getViewModel()
			->setVariable('content', $paginator)
			->setVariable('footer', 'footer');
    }

}
