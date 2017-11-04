<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Helper\Partial;

/**
 * Description of Widget
 *
 * @author cherepanov
 */
class Widget
{

    const BS_STATE_DEFAULT = 'default';
    const BS_STATE_SUCCESS = 'success';
    const BS_STATE_INFO = 'info';
    const BS_STATE_WARNING = 'warning';
    const BS_STATE_PRIMARY = 'primary';
    const BS_STATE_DANGER = 'danger';

    /**
     * array of application twitter bootstarp 3 widgets
     * 
     * @var array 
     */
    protected $widgets;

    /**
     *
     * @var string 
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     * constructor
     */
    public function __construct()
    {
	$this->widgets = array();
    }

    /**
     * add widget to widgets array
     * 
     * @param \Core\ $widget
     * @return \Core\Helper\Partial\TwitterBootstrap
     */
    public function addWidget(Widget $widget)
    {
	$this->widgets[] = $widget;

	return $this;
    }

}
