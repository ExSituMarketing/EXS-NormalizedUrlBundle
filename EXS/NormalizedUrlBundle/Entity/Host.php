<?php

namespace NormalizedUrlBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hosts
 *
 * @ORM\Table(name="hosts")
 * @ORM\Entity(repositoryClass="NormalizedUrlBundle\Entity\Repository\HostRepository")
 */
class Host
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
     * Get host id
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set host name
     * 
     * @param string $name
     * @return \NormalizedUrlBundle\Entity\Host
     */    
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get host name 
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
     * @return \NormalizedUrlBundle\Entity\Host
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
