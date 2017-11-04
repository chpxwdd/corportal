<?php

namespace Currency\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    /**
     * Index page for currency module
     * 
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction() {

        $placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
        $placeholder->getContainer('title')->set('currency');
        $placeholder->getContainer('lead')->set('services');

        return new ViewModel();
    }

}
