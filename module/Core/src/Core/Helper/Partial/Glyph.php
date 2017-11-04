<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Helper\Partial;

/**
 * Description of Action
 *
 * @author Alexander Cherepanov <cherepanov@sodis.ru>
 */
class Glyph {

    /**
     *
     * @var string 
     */
    private $name;

    public function __construct($name) {
	$this->name = $name;
    }

    public function render() {
	return sprintf("<span class='glyphicon glyphicon-%s'></span>", $this->name);
    }

    public function __toString() {
	return $this->render();
    }

}
