<?php

namespace EXS\NormalizedUrlBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Url
 *
 * @ORM\Table(name="urls")
 * @ORM\Table(name="urls",indexes={@Index(name="hashkey_idx", columns={"hashkey"})})
 * @ORM\Entity(repositoryClass="EXS\NormalizedUrlBundle\Entity\Repository\UrlRepository")
 */
class Url
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
     * @ORM\Column(name="hashkey", type="string", length=32)
     */
    private $hashkey;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="EXS\NormalizedUrlBundle\Entity\Host")
     * @ORM\JoinColumn(name="host_id", referencedColumnName="id", nullable=true, onDelete="set null")
     */
    protected $host;
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="EXS\NormalizedUrlBundle\Entity\Path")
     * @ORM\JoinColumn(name="path_id", referencedColumnName="id", nullable=true, onDelete="set null")
     */
    protected $path;
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="EXS\NormalizedUrlBundle\Entity\Querystring")
     * @ORM\JoinColumn(name="querystring_id", referencedColumnName="id", nullable=true, onDelete="set null")
     */
    protected $querystring;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="logged", type="datetime")
     */
    private $logged;


    /**
     * Get url id
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url hashkey
     * 
     * @param string $hashkey
     * @return EXS\NormalizedUrlBundle\Entity\Url
     */    
    public function setHashkey($hashkey)
    {
        $this->hashkey = $hashkey;

        return $this;
    }

    /**
     * Get url hashkey
     * 
     * @return string
     */
    public function getHashkey()
    {
        return $this->hashkey;
    }

     /**
     * Set url host
     * 
     * @param int $host
     * @return EXS\NormalizedUrlBundle\Entity\Url
     */    
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get url host
     * 
     * @return int
     */
    public function getHost()
    {
        return $this->host;
    }   
    
      /**
     * Set url path
     * 
     * @param int $path
     * @return EXS\NormalizedUrlBundle\Entity\Url
     */    
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get url path
     * 
     * @return int
     */
    public function getPath()
    {
        return $this->path;
    }     
    
     /**
     * Set url querystring
     * 
     * @param int $querystring
     * @return EXS\NormalizedUrlBundle\Entity\Url
     */    
    public function setQuerystring($querystring)
    {
        $this->querystring = $querystring;

        return $this;
    }

    /**
     * Get url querystring
     * 
     * @return int
     */
    public function getQuerystring()
    {
        return $this->querystring;
    }       
    
    /**
     * Set logged datetime
     * 
     * @param Datetime $logged
     * @return EXS\NormalizedUrlBundle\Entity\Url
     */
    public function setLogged($logged)
    {
        $this->logged = $logged;

        return $this;
    }

    /**
     * Get logged datetime
     * 
     * @return Datetime
     */
    public function getLogged()
    {
        return $this->logged;
    }
}
