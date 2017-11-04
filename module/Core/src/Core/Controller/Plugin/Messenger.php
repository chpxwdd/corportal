<?php

namespace Core\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\FlashMessenger;

class Messenger extends AbstractPlugin
{

    const CORE_MESSENGER_DEFAULT = 'default';
    const CORE_MESSENGER_SUCCESS = 'success';
    const CORE_MESSENGER_INFO = 'info';
    const CORE_MESSENGER_DANGER = 'danger';
    const CORE_MESSENGER_WARNING = 'warning';

    protected $_fm;

    public function __construct()
    {
	$this->_fm = new FlashMessenger();
    }

    protected function getFlashMessenger()
    {
	return $this->_fm;
    }

    public function load(MvcEvent $e)
    {
	$messages = array();

	$this->_fm->setNamespace(self::CORE_MESSENGER_SUCCESS);

	if ($this->_fm->hasMessages())
	{
	    $messages[self::CORE_MESSENGER_SUCCESS] = $this->_fm->getMessages();
	}

	$this->_fm->clearMessages();
	$this->_fm->setNamespace(self::CORE_MESSENGER_INFO);
	if ($this->_fm->hasMessages())
	{
	    $messages[self::CORE_MESSENGER_INFO] = $this->_fm->getMessages();
	}

	$this->_fm->clearMessages();
	$this->_fm->setNamespace(self::CORE_MESSENGER_DANGER);
	if ($this->_fm->hasMessages())
	{
	    $messages[self::CORE_MESSENGER_DANGER] = $this->_fm->getMessages();
	}

	$this->_fm->clearMessages();
	$this->_fm->setNamespace(self::CORE_MESSENGER_DEFAULT);

	if ($this->_fm->hasMessages())
	{

	    if (isset($messages[self::CORE_MESSENGER_WARNING]))
	    {
		$messages[self::CORE_MESSENGER_WARNING] = array_merge($messages[self::CORE_MESSENGER_WARNING], $this->_fm->getMessages());
	    }
	    else
	    {
		$messages[self::CORE_MESSENGER_WARNING] = $this->_fm->getMessages();
	    }
	}
	$this->_fm->clearMessages();

	$e->getViewModel()->setVariable('flashMessages', $messages);
    }

}
