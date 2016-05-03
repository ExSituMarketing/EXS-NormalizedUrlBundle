<?php

namespace NormalizedUrlBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paths
 *
 * @ORM\Table(name="paths")
 * @ORM\Entity(repositoryClass="NormalizedUrlBundle\Entity\Repository\PathRepository")
 */
class Path
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="logged", type="datetime")
     */
    private $logged;    

    /**
     * Get path id
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set path name
     * 
     * @param string $name
     * @return \NormalizedUrlBundle\Entity\Path
     */    
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get path name 
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set logged datetime
     * 
     * @param Datetime $logged
     * @return \NormalizedUrlBundle\Entity\Path
     */
    public function setLogged($logged)
    {
        $this->logged = $logged;

        return $this;
    }

    /**
     * Get looged datetime
     * 
     * @return Datetime
     */
    public function getLogged()
    {
        return $this->logged;
    }
}
