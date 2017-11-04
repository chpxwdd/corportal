<?php

namespace Corporate\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="corporate_office")
 * @ORM\Entity(repositoryClass="\Corporate\Repository\Office")
 */
class Office
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $office;

    /**
     * Office title
     * 
     * @ORM\Column(name="title", type="string")
     * @var string
     */
    private $title;
    
    /**
     * Office code
     * 
     * @ORM\Column(name="code", type="string", length=3, unique=true)
     * @var string
     */
    private $code;
    
    /**
     * Office adress
     * 
     * @ORM\Column(name="adress", type="string", unique=true)
     * @var string
     */
    private $adress;
    
    /**
     * Office geolocation latitude
     * 
     * @ORM\Column(name="latitude", type="decimal", precision=15, scale=2)
     * @var float
     */
    private $latitude;
    
    /**
     * Office geolocation longitude
     * 
     * @ORM\Column(name="longitude", type="decimal", precision=15, scale=2)
     * @var float
     */
    private $longitude;
    

}
