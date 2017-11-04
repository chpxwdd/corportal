<?php

namespace Core\Helper\Partial;

use Core\Helper\Partial\Widget;

class Panel extends Widget
{

    const BS_PANEL_SECTION_HEADING = 'heading';
    const BS_PANEL_SECTION_HEADING_TITLE = 'title';
    const BS_PANEL_SECTION_BODY = 'title';
    const BS_PANEL_SECTION_GRID = 'grid';
    const BS_PANEL_SECTION_NAV = 'nav';

    /**
     *
     * @var string
     */
    private $id;

    /**
     *
     * @var string
     */
    private $title;

    /**
     *
     * @var string
     */
    private $body;

    /**
     *
     * @var string
     */
    private $sections;

    /**
     * constructor
     */
    public function __construct()
    {
	$this->sections = array();
    }

    /**
     * 
     * @param type $section
     * @param string $type
     */
    public function addSection($section, $type = 'body')
    {
	
    }

    /**
     * 
     * @return string
     */
    public function getId()
    {
	return $this->id;
    }

    /**
     * 
     * @param string $id
     */
    public function setId($id)
    {
	$this->id = $id;
    }

    /**
     * 
     * @return array
     */
    public function getBody()
    {
	return $this->body;
    }

    /**
     * 
     * @param string $body
     */
    public function setBody($body)
    {
	$this->body = $body;
    }

    /**
     * 
     * @return array
     */
    public function getTitle()
    {
	return $this->title;
    }

    /**
     * 
     * @param string $title
     */
    public function setTitle($title)
    {
	$this->title = $title;
    }

}
