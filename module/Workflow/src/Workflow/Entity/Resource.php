<?php

namespace Workflow\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="workflow_resources")
 * @ORM\Entity(repositoryClass="\Workflow\Repository\Resources")
 */
class Resource
{

    /**
     * id keyfield
     * 
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

}
