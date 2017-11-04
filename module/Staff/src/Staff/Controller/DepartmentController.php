<?php

namespace Staff\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Staff\Entity\Department;
use Staff\Form\DepartmentForm;

class DepartmentController extends AbstractActionController
{

    /**
     * page placeholder title in view script 
     * 
     * @access private
     * @var string
     */
    private $title;

    /**
     * page placeholder lead in view script 
     *
     * @access private
     * @var string 
     */
    private $lead;

    /**
     * @access protected
     * @var EntityManager
     */
    protected $_em;

    /**
     * class constructor
     */
    public function __construct()
    {
	$this->title = 'подразделения';
	$this->lead = 'служба персонала';
    }

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $em
     * @access protected
     * @return PostController
     */
    protected function setEntityManager(EntityManager $em)
    {
	$this->_em = $em;
	return $this;
    }

    /**
     * Returns the EntityManager
     *
     * Fetches the EntityManager from ServiceLocator if it has not been initiated
     * and then returns it
     *
     * @access protected
     * @return EntityManager
     */
    protected function getEntityManager()
    {
	if (null === $this->_em)
	{
	    $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
	}
	return $this->_em;
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

	// отображение структуры предприятия
	$em = $this->getEntityManager();
	$repository = $em->getRepository("\Staff\Entity\Department");

	// получаем всю структуру
	$rowset = $repository->findAll();

	$viewmodel = new ViewModel();
	$viewmodel->setVariable('rowset', $rowset);

	return $viewmodel;
    }

    public function addAction()
    {

	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('Организовать подразделение');
	$placeholder->getContainer('lead')->set($this->lead);

	$em = $this->getEntityManager();
	$department = new Department();
	$form = new DepartmentForm($em);
	$form->init();
	$form->bind($department);

	// если данные отправлены на сохранение
	$request = $this->getRequest();
	if ($request->isPost())
	{
	    $form->setValidationGroup('name');
	    $form->setData($request->getPost());

	    if ($form->isValid())
	    {
		// save data
		$data = $request->getPost();

		$company = $em->find('Staff\Entity\Company', $data->get('company'));
		$parent = $em->find('Staff\Entity\Department', $data->get('parent'));
		$name = $request->getPost()->get('name');

		$department->setCompany($company);
		$department->setParent($parent);
		$department->setName($name);

		$em->persist($department);
		$em->flush();

		$this->flashMessenger()->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_SUCCESS);
		$this->flashMessenger()->addMessage('Департамент успешно сохранен в базе данных');

		return $this->redirect()->toRoute('staff/department');
	    }
	}


	$viewmodel = new ViewModel();
	$viewmodel->setVariable('form', $form);

	return $viewmodel;
    }

    public function editAction()
    {
	$id = $this->params()->fromRoute($id, null);

	if (null == $id)
	{
	    $this->flashMessenger()->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_DANGER);
	    $this->flashMessenger()->addMessage('Департамент не найден в базе данных');

	    return $this->redirect()->toRoute('staff/department');
	}


	$placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
	$placeholder->getContainer('title')->set('Изменить подразделение');
	$placeholder->getContainer('lead')->set($this->lead);

	$em = $this->getEntityManager();
	$department = new Department();
	$form = new DepartmentForm($em);
	$form->init($id);
	$form->bind($department);

	$viewmodel = new ViewModel();
	$viewmodel->setVariable('form', $form);

	return $viewmodel;
    }

    public function deleteAction()
    {
	
    }

}
