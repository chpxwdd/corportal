<?php

namespace Core\Helper\Partial;

use Core\Helper\Partial\Link\Link;
use Core\Helper\Partial\Glyph;

class Grid {

    /** @var string */
    private $id;

    /** @var string */
    private $class = '';

    /** @var array */
    private $headers = array();

    /** @var array */
    private $rowHeader = FALSE;

    /** @var array */
    private $rowset = array();

    /** @var Glyph */
    private $glyphCaption;

    /** @var array */
    private $caption = '';

    /** @var array */
    private $actions = array();

    /** @var array */
    private $features = array();

    /**
     * 
     * @param array $rowset
     * @param array $headers
     * @param string $caption
     */
    public function __construct($rowset, $headers, $caption = '') {
	$this->headers = $headers;
	$this->rowset = $rowset;
	$this->caption = $caption;
    }

    /**
     * 
     *  @return $this 
     */
    public function setGlyphCaption(Glyph $glyph) {
	$this->glyphCaption = $glyph;

	return $this;
    }

    /** @return boolean */
    public function getGlyphCaption() {
	return $this->glyphCaption;
    }

    /** @return string */
    public function renderCaption() {

	if (!$this->caption) {
	    return '';
	}

	return sprintf('<a href="#" onclick="return false;">%s %s</a>'
	    , !empty($this->glyphCaption) ? $this->glyphCaption->render() : ''
	    , $this->caption
	);
    }

    /**
     * 
     * @param Link $action
     * @return $this.
     */
    public function addRowAction(Link $action) {
	if (in_array($action, $this->rowActions)) {
	    return $this;
	}

	array_push($this->rowActions, $action);
    }
    
    /**
     * 
     * @param Link $action
     * @return $this
     */
    public function addAction(Link $action) {

	if (in_array($action, $this->actions)) {
	    return $this;
	}

	array_push($this->actions, $action);
    }

    /**
     * 
     *  @return array 
     */
    public function getActions() {
	return $this->actions;
    }

    /**
     * 
     * @return string 
     */
    public function renderActions() {

	if (empty($this->actions)) {
	    return FALSE;
	}

	$render = '';
	foreach ($this->actions as $action) {
	    $render .= $action->render();
	}
	return sprintf("<div>%s<div>", $render);
    }

    /**
     * 
     * @return array
     */
    public function getRowHeader() {
	return $this->rowHeader;
    }

    /**
     * 
     * @param boolean $state
     */
    public function setRowHeader($state = TRUE) {
	$this->rowHeader = $state;
    }

    /**
     * 
     * @param array $features
     * @return array
     */
    public function setFeatures($features) {

	foreach ($features as $name => $feature) {
	    $this->features[$name] = $feature;
	}
	return $this->features;
    }

    /**
     * 
     * @return array
     */
    public function getFeatures() {
	return $this->features;
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    public function getFeature($name) {
	return $this->features[$name];
    }

    /**
     * 
     * @param type $name
     * @param type $feature
     */
    public function setFeature($name, $feature) {
	$this->features[$name] = $feature;
	return $this;
    }

    /**
     * 
     * @return string
     */
    public function getId() {
	return $this->id;
    }

    /**
     * 
     * @param string $id 
     */
    public function setId($id) {
	$this->id = $id;

	return $this;
    }

    /**
     * Возвращает заголовок таблицы
     * 
     * @return type 
     */
    public function getCaption() {
	return $this->caption;
    }

    /**
     * Устанавливает заголовок таблицы
     * 
     * @param string $caption
     * @return $this
     */
    public function setCaption($caption) {
	$this->caption = $caption;
	return $this;
    }

    /**
     * Возвращает сассив CSS классов таблицы
     * 
     * @return array
     */
    public function getClass() {
	return $this->class;
    }

    /**
     * 
     * @param array $class
     * @return $this
     */
    public function setClass($class) {
	$this->class = implode(" ", $class);
	return $this;
    }

    /**
     * 
     * @return array
     */
    public function getHeaders() {
	if (!empty($this->rowActions) && !empty($this->headers)) {
	    $headerOperations = "Операции";
	    if (in_array($headerOperations, $this->headers)) {
		return $this->headers;
	    }
	    array_push($this->headers, "Операции");
	}

	return $this->headers;
    }

    /**
     * 
     * @param type $headers
     * @return $this
     */
    public function setHeaders($headers) {
	$this->headers = $headers;
	return $this;
    }

    /** @return array */
    public function getRowset() {
	return $this->rowset;
    }

    /**
     * 
     * @param array $rowset
     * @return $this
     */
    public function setRowset($rowset) {
	$this->rowset = $rowset;
	return $this;
    }

}
