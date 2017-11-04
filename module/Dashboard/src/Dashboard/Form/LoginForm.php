<?php

namespace Dashboard\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter;

class LoginForm extends Form
{

    public function __construct($name = 'login')
    {

	parent::__construct($name);

	$username = new Element\Text('username');
	$username->setLabel('Username')
		->setLabelAttributes(array('class' => 'form-group'))
		->setAttribute('class', 'form-control');

	$password = new Element\Password('password');
	$password->setLabel('Password')
		->setLabelAttributes(array('class' => 'form-group'))
		->setAttribute('class', 'form-control');

	$type = new Element\Select('type');
	$type->setLabel('Type')
		->setLabelAttributes(array('class' => 'form-group'))
		->setEmptyOption('choose type...')
		->setValueOptions(array('ldap' => 'ldap sodis.ru','db' => 'database strorage'))
		->setAttribute('class', 'form-control');

	$remember = new Element\Checkbox('remember');
	$remember->setLabel('remember me')
		->setAttribute("checked", "")
		->setCheckedValue(TRUE)
		->setUncheckedValue(null)
		->setLabelAttributes(array("class" => "checkbox"))
		->setUseHiddenElement(FALSE);

	$signin = new Element\Submit('submit');
	$signin->setValue('Sign in')
		->setAttributes(array('type' => 'submit','class' => 'btn btn-primary'));

//	$operation = new Element\Collection('operation');
//	$operation->setAttribute('class', 'btn-group')
//	->add($signin);

	$this->setName($name)
		->setLabel('Log in')
		->setAttribute('', NULL)
		->setAttribute('method', 'POST')
		->setAttribute('action', '')
//		->setAttributes(array('class' => 'simple'))
		->add($username)
		->add($password)
//		->add($type)
		->add($remember)
		->add($signin)
//		->add($operation)
	;

	$this->setInputFilter($this->createInputFilter());
    }

    public function createInputFilter()
    {
	$inputFilter = new InputFilter\InputFilter();

	$username = new InputFilter\Input('username');
	$username->setRequired(true);
	$inputFilter->add($username);

	$password = new InputFilter\Input('password');
	$password->setRequired(true);
	$inputFilter->add($password);

	$type = new InputFilter\Input('type');
	$type->setRequired(true);
	$inputFilter->add($type);

	return $inputFilter;
    }

}
