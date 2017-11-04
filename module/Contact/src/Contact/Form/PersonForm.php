<?php

namespace Contact\Form;

use Core\Form\BaseForm;
use Zend\Form\Element;
use Contact\Form\PersonFieldset;
use Contact\Form\PhoneFieldset;
use Doctrine\ORM\EntityManager;
use Contact\Entity\Person;
use Contact\Model\Person as PersonModel;

/**
 * Description of PersonCompleteForm
 *
 * @author Alexander Cherepanov <cherepanov@sodis.ru>
 */
class PersonForm extends BaseForm {

//put your code here

    public function __construct(EntityManager $em) {
	parent::__construct($em);
    }

    public function init(Person $person = NULL) {
	
	parent::init();

// surname
	$sname = new Element\Text();
	$sname->setName('sname');
	$sname->setLabel('Фамилия');
//fname
	$fname = new Element\Text();
	$fname->setName('fname');
	$fname->setLabel('Имя');
// Отчество
	$mname = new Element\Text();
	$mname->setName('mname');
	$mname->setLabel('Отчество');
// Дата рождения
	$birth = new Element\Date();
	$birth->setName('birth');
	$birth->setLabel('Дата рождения');	
// Пол
	$gender = new Element\Select();
	$gender->setName('gender');
	$gender->setLabel('Пол');
	$gender->setValueOptions(array(
	  PersonModel::CONTACT_PERSON_GENDER_FEMALE_VALUE => PersonModel::CONTACT_PERSON_GENDER_FEMALE_TITLE,
	  PersonModel::CONTACT_PERSON_GENDER_MALE_VALUE => PersonModel::CONTACT_PERSON_GENDER_MALE_TITLE,
	));
	$gender->setAttribute("style", "width:100px");

// Номера телефонов
// Сохранение
	$submit = new Element\Submit('person_submit');
	$submit->setValue('Сохранить');

	if ($person instanceof \Contact\Entity\Person) {
	    $id = new Element\Hidden("id");
	    $id->setValue($person->getId());
	    $fname->setValue($person->getFname());
	    $mname->setValue($person->getMname());
	    $sname->setValue($person->getSname());
	    $birth->setValue($person->getBirth());
	    $gender->setValue($person->getGender());
	}


	$this->add($this->setDecorator($sname), array('priority' => 60));
	$this->add($this->setDecorator($fname), array('priority' => 50));
	$this->add($this->setDecorator($mname), array('priority' => 40));
	$this->add($this->setDecorator($birth), array('priority' => 30));
	$this->add($this->setDecorator($gender), array('priority' => 20));
	$this->add($this->setDecorator($submit), array('priority' => 10));

	return $this;
    }

}
