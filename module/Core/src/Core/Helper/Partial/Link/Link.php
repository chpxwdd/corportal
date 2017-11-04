<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Helper\Partial\Link;

use Core\Helper\Partial\Glyph;

/**
 * Description of Action
 *
 * @author Alexander Cherepanov <cherepanov@sodis.ru>
 */
class Link {

    private $value = '';

    /**
     *
     * @var Glyph 
     */
    private $glyph;
    private $attributes = array();
    private $queryParams = array();
    private $acceptedAttributes = array(
      "target",
      "alt",
      "class",
      "style",
      "rel",
      "href"
    );

    public function __construct($name, $href, $value = NULL, $glyph = NULL, $attributes = array(), $queryParams = array()) {

	$this->setAttribute("id", $name);
	
	$this->setAttribute("href", $href);
	$this->value = $value;

	if (!empty($glyph)) {
	    $this->glyph = $glyph;
	}

	if (!$this->value && !$this->glyph) {
	    $this->value = 'link';
	}

	if (empty($attributes)) {
	    return;
	}

	foreach ($attributes as $key => $value) {
	    $this->setAttribute($key, $value);
	}
	
    }
    

    /**
     * 
     * @param string $key
     * @param sting $value
     * @return Link
     */
    public function setAttribute($key, $value) {

	if (!in_array($key, $this->acceptedAttributes)) {
	    return $this;
	}

	$this->attributes[$key] = $value;

	return $this;
    }

    /**
     * 
     * @return string
     */
    private function renderAttributes() {
	$render = (string) '';

	if (empty($this->attributes)) {
	    return $render;
	}

	foreach ($this->attributes as $key => $value) {
	    $render .= sprintf('%s="%s"', $key, $value);
	}

	
	return $render;
    }

    /**
     * 
     *  @return string
     */
    public function render() {
	
	$glyph = (string)'';
	if(!empty($this->glyph)){
	    $glyph .= $this->glyph->render();
	}
	
	if(!empty($this->value)){
	    $glyph .= "&nbsp;";
	}
	
	return sprintf("<a %s>%s%s</a>"
	    , $this->renderAttributes()
	    , $glyph
	    , $this->value
	);
    }

    /**
     * 
     * @return string
     */
    public function __toString() {
	return $this->render();
    }

}
