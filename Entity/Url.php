<?php

namespace EXS\NormalizedUrlBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Url
 *
 * @ORM\Table(name="urls",indexes={@Index(name="hashkey_idx", columns={"hashkey"})})
 * @ORM\Entity(repositoryClass="EXS\NormalizedUrlBundle\Entity\Repository\UrlRepository")
 */
class Url
{
    /**
     * @var int
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
     * @var Host
     *
     * @ORM\ManyToOne(targetEntity="EXS\NormalizedUrlBundle\Entity\Host")
     * @ORM\JoinColumn(name="host_id", referencedColumnName="id", nullable=true, onDelete="set null")
     */
    private $host;

    /**
     * @var Path
     *
     * @ORM\ManyToOne(targetEntity="EXS\NormalizedUrlBundle\Entity\Path")
     * @ORM\JoinColumn(name="path_id", referencedColumnName="id", nullable=true, onDelete="set null")
     */
    private $path;

    /**
     * @var Querystring
     *
     * @ORM\ManyToOne(targetEntity="EXS\NormalizedUrlBundle\Entity\Querystring")
     * @ORM\JoinColumn(name="querystring_id", referencedColumnName="id", nullable=true, onDelete="set null")
     */
    private $querystring;

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
     *
     * @return Url
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
      * @param Host $host
      *
      * @return Url
      */
    public function setHost(Host $host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get url host
     *
     * @return Host
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set url path
     *
     * @param Path $path
     *
     * @return Url
     */
    public function setPath(Path $path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get url path
     *
     * @return Path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set url querystring
     *
     * @param Querystring $querystring
     *
     * @return Url
     */
    public function setQuerystring(Querystring $querystring)
    {
        $this->querystring = $querystring;

        return $this;
    }

    /**
     * Get url querystring
     *
     * @return Querystring
     */
    public function getQuerystring()
    {
        return $this->querystring;
    }

    /**
     * Set logged datetime
     *
     * @param \Datetime $logged
     *
     * @return Url
     */
    public function setLogged($logged)
    {
        $this->logged = $logged;

        return $this;
    }

    /**
     * Get logged datetime
     *
     * @return \Datetime
     */
    public function getLogged()
    {
        return $this->logged;
    }
}
