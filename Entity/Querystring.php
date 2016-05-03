<?php

namespace EXS\NormalizedUrlBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Querystring
 *
 * @ORM\Table(name="querystrings")
 * @ORM\Entity(repositoryClass="EXS\NormalizedUrlBundle\Entity\Repository\QuerystringRepository")
 */
class Querystring
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
     * Get querystring id
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set querystring name
     * 
     * @param string $name
     * @return EXS\NormalizedUrlBundle\Entity\Querystring
     */    
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get querystring name 
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
     * @return EXS\NormalizedUrlBundle\Entity\Querystring
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
