<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Form\Element;

use Zf2DoctrineAutocomplete\Form\Element\ObjectAutocomplete;

/**
 * Description of Autocomplete
 *
 * @author Alexander Cherepanov <cherepanov@sodis.ru>
 */
class Autocomplete extends ObjectAutocomplete {

    private $initialized = false;

    public function setOptions($options) {
	if (!$this->initialized) {
	    $options = array_merge($options, array(
	      'class' => get_class($this),
	      'object_manager' => $options['sm']->get('Doctrine\ORM\EntityManager'), // For Doctrine ORM
	      // 'object_manager' => $options['sm']->get('doctrine.documentmanager.odm_default'), // For Doctrine ODM (Mongodb)
	      'target_class' => '\Geo\Entity\Country',
	      'searchFields' => array('id', 'title_ru'),
	      'empty_item_label' => 'Nothing found',
	      'select_warning_message' => 'Select a itemName in list',
	      'property' => 'title_ru',
	      'orderBy' => array('title_ru', 'ASC')
	    ));
	    $this->initialized = true;
	}

	parent::setOptions($options);
    }

}
