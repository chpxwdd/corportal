<?php

namespace Workflow\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="staff_document")
 * @ORM\Entity(repositoryClass="\Staff\Repository\Document")
 */
class Document
{

    /**
     * id keyfield
     * 
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * unique number of document
     * 
     * @ORM\Column(type="string", unique=true)
     */
    private $number;

    /**
     * resource of document
     * 
     * @ORM\ManyToOne(targetEntity="\Workflow\Entity\Resource")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     */
    private $resource;

}
