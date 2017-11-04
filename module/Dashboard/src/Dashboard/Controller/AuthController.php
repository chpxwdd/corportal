<?php

/**
 * 
 */

namespace Dashboard\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService as AuthService,
    Zend\Authentication\Adapter\Ldap as AuthAdapter,
    Zend\Authentication\Storage\Session as AuthStorage;
use Dashboard\Form\LoginForm;

/**
 * 
 */
class AuthController extends AbstractActionController {

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $em
     * @access protected
     * @return PostController
     */
    protected function setEntityManager(EntityManager $em) {
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
    protected function getEntityManager() {
	if (null === $this->_em) {
	    $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
	}
	return $this->_em;
    }

    public function indexAction() {
	return $this->redirect()->toRoute("auth/login");
    }

    public function loginAction() {
	$username = $this->params()->fromPost('username');
	$password = $this->params()->fromPost('password');
	$type = 'ldap'; // @todo перевод на combobox $this->params()->fromPost('type');

	if (!$username || !$password || !$type) {
	    $viewmodel = new ViewModel();
	    $viewmodel->setVariable('form', new LoginForm());

	    return $viewmodel;
	}
	$config = $this->getServiceLocator()->get('config');
	$authOptions = $config[$type]['config'];
	$authNamespace = $config[$type]['namespace'];

	$adapter = new AuthAdapter($authOptions, $username, $password);
	$service = new AuthService();
	$storage = new AuthStorage();
	$service->setAdapter($adapter);
	$service->setStorage($storage);
	$auth = $service->authenticate($adapter);

	if (!$auth->isValid()) {
	    $this->flashMessenger()
		->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_DANGER)
		->addMessage('Вход в систему не выполнен!')
		->addMessage('Повторите попытку или воспользуйтесь процедурой восстановления пароля! ')
		->addMessage(sprintf('<a href="%s" alt="Восстановить">Восстановить</a>', 'auth/login'));

	    return $this->redirect()->toRoute('auth/login');
	}

	/**
	 * @todo needed push into storage model script
	 * 	if (null !== $this->getEntityManager()->getRepository("\Dashboard\Entity\User")->findOneBy(array('username' => $username))){}
	 */
	// insert into session storage
	$data = new \stdClass();
	$data->role = 'member';
	$data->code = $auth->getCode();
	$data->identity = $username;

	$storage->getNamespace($authNamespace);
	$storage->write($data);

	$this->flashMessenger()
	    ->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_SUCCESS)
	    ->addMessage('Вход в систему выполнен успешно!')
	    ->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_INFO)
	    ->addMessage('Вы были перемещены в Dashboard.');


	return $this->redirect()->toRoute('dashboard');
    }

    public function logoutAction() {
	$storage = new AuthStorage();
	$storage->clear();

	$this->flashMessenger()
	    ->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_SUCCESS)
	    ->addMessage('Выход из системы выполнен успешно!')
	    ->setNamespace(\Core\Controller\Plugin\Messenger::CORE_MESSENGER_INFO)
	    ->addMessage('Вы были перемещены на стартовую страницу.');

	return $this->redirect()->toRoute('dashboard');
    }

}
