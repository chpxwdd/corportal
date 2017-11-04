<?php

namespace Core\Form;

use Zend\Form\Element;
use Zend\Form\Form as ZendForm;
use Doctrine\ORM\EntityManager as DoctrineEntityManager;

class BaseForm extends ZendForm {

    /**
     *
     * @access private
     * @var Doctrine\ORM\EntityManager 
     */
    private $_em;

    public function __construct(DoctrineEntityManager $em = NULL) {

	parent::__construct();

	$this->_em = $em;
	
    }

    /**
     * 
     */
    public function init() {
	parent::init();
    }

    /**
     * 
     * @param type $element
     * @return \Core\Form\Element\Radio
     */
    public function setDecorator($element) {

	// textarea text password select
	if (($element instanceof Element\Text) || ($element instanceof Element\Password) || ($element instanceof Element\Select) || ($element instanceof Element\Textarea) || ($element instanceof DoctrineSelect)) {
	    return $this->decorateTextElement($element);
	}

	if ($element instanceof Element\Date) {
	    return $this->decorateDateElement($element);
	}

	if (($element instanceof Element\Submit) || ($element instanceof Element\Button)) {

	    return $this->decorateButtonElement($element);
	}

	if ($element instanceof Element\Checkbox) {

	    return $this->decorateCheckboxElement($element);
	}

	return $element;
    }

    /**
     * 
     * @param type $element
     * @return type
     */
    public function decorateCheckboxElement(\Zend\Form\Element $element) {
	$element->setLabelAttributes(array('class' => 'checkbox'));
	
	return $element;
    }

    /**
     * 
     * @param Form\Element $element
     * @return Form\Element
     */
    public function decorateTextElement(\Zend\Form\Element $element) {
	
	$element->setLabelAttributes(array('class' => 'form-group'));
	$element->setAttributes(array('class' => 'form-control'));
	
	return $element;
    }

    /**
     * 
     * @param Form\Element $element
     * @return Form\Element
     */
    public function decorateButtonElement(\Zend\Form\Element $element) {
	$element->setAttributes(array('class' => 'btn btn-default'));
	
	return $element;
    }

    /**
     * 
     * @param Form\Element $element
     * @return Form\Element
     */
    public function decorateDateElement(\Zend\Form\Element $element) {
	
	$element->setLabelAttributes(array(
	  'class' => 'form-group datepicker-group',
	  'data-date' => date('d.m.Y'),
	  'data-date-format' => 'dd.mm.yyyy',
	));

	$element->setAttributes(array(
	  'style' => 'width:100px',
	  'class' => 'form-control datepicker',
	  'size' => '10'
	));

	return $element;
    }

}
