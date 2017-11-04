<?php

namespace Currency\Form\Rates;

use Zend\Form\Form;
use Zend\Form\Element;

class Filter extends Form
{

    public function __construct($repository, $name = null)
    {

	parent::__construct($name);

	//--------------------------------------------------------------------------------------------------------------
	// date range
	$elemDateStart = new Element('start');
	$elemDateStart->setLabel('from')
		->setLabelAttributes(array('class'=>'form-group'))
		->setAttribute('type', 'text')
		->setAttribute('class', 'form-control datepicker')
		->setValue('01.' . date('m.Y'));

	$elemDateEnd = new Element('end');
	$elemDateEnd->setLabel('to')
		->setLabelAttributes(array('class'=>'form-group'))
		->setAttribute('type', 'text')
		->setAttribute('class', 'form-control datepicker')
		->setValue(date('d.m.Y'));

	$collDateRange = new Element\Collection('daterange');
	$collDateRange->setLabel('Date range')
		->setAttribute('id', 'daterange')
		->add($elemDateStart)
		->add($elemDateEnd);


	//--------------------------------------------------------------------------------------------------------------
	// hidden currency from
	$collFids = new Element\Collection('fids');
	$collFids->setAttribute('id', 'fids')
		->setLabelAttributes(array('style' => 'display:none'));

	$rowsetFids = $repository->findByState(2);
	foreach ($rowsetFids as $currency)
	{
	    $hidden = new Element\Hidden($currency->getAbbr());
	    $hidden->setValue($currency->getAbbr())
		    ->setLabel($currency->getTitle())
		    ->setLabelAttributes(array('style' => 'display:none'));
	    $collFids->add($hidden);
	}


	//--------------------------------------------------------------------------------------------------------------
	// checkboxes currency to
	$collTids = new Element\Collection('tids');
	$collTids->setLabel('Currency list')
		->setAttribute('id', 'tids');

	$checkAll = new Element\Checkbox('checkall');
	$checkAll->setLabel('select all')
		->setAttribute('checked', 'checked')
		->setLabelAttributes(array('class' => 'checkbox'));
	$collTids->add($checkAll);

	$rowsetTids = $repository->findByState(array(1, 2));
	foreach ($rowsetTids as $currency)
	{
	    $checkbox = new Element\Checkbox($currency->getAbbr());
	    $checkbox->setAttribute('checked', 'checked')
		    ->setCheckedValue($currency->getAbbr())
		    ->setUncheckedValue(null)
		    ->setLabel($currency->getTitle())
		    ->setLabelAttributes(array(
			'class' => 'checkbox',
			'style' => 'margin:0'
		    ))
		    ->setUseHiddenElement(FALSE);
	    $collTids->add($checkbox);
	}


	//-------------------------------------------------------------------------------------------------------------
	// buttons operations
	$parse = new Element\Button('parse');
	$parse->setLabel('parse')
		->setAttribute('type', 'button')
		->setAttribute('class', 'btn btn-primary');

	$reset = new Element\Button('reset');
	$reset->setLabel('Reset')
		->setAttribute('type', 'reset')
		->setAttribute('class', 'btn btn-default');

	$collBtnGroup = new Element\Collection('operation');
	$collBtnGroup->setAttribute('class', 'btn-group')
		->add($parse)
		->add($reset);

	$this->setName('form_filter')
		->setAttribute('class', 'horizontal')
		->setAttribute('action', NULL)
		->setAttribute('method', 'POST')
		->add($collDateRange)
		->add($collFids)
		->add($collTids)
		->add($collBtnGroup);
    }

}
