<?php

namespace Aris\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Aris\MainBundle\Entity\Galeria;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="Aris\MainBundle\Entity\ImagesRepository")
 */
class Images extends AbstractUploader
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;
    
     /**
     * @var string
     *
     * @ORM\Column(name="secuencia", type="string", length=255)
     */
    private $secuencia;

  

    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer")
     */
    private $sort;
    
    
     /**
     * @see Entity/Galeria
     * @ORM\ManyToOne(targetEntity="Galeria", inversedBy="images")
     * @ORM\JoinColumn(name="galeria_id", referencedColumnName="id")
     */
    protected $galeria = null;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

  

    /**
     * Set sort
     *
     * @param integer $sort
     * @return Images
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer 
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set galeria
     *
     * @param \Aris\MainBundle\Entity\Galeria $galeria
     * @return Images
     */
    public function setGaleria(\Aris\MainBundle\Entity\Galeria $galeria = null)
    {
        $this->galeria = $galeria;

        return $this;
    }

    /**
     * Get galeria
     *
     * @return \Aris\MainBundle\Entity\Galeria 
     */
    public function getGaleria()
    {
        return $this->galeria;
    }

    protected function getUploadDir() {
        return 'uploads/images';
        
    }
    
    public function __toString()
    {
       return $this->nombre;
    }

   

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Images
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
     /**
     * Set nombre
     *
     * @param string $secuencia
     * @return Images
     */
    public function setSecuencia($secuencia)
    {
        $this->secuencia = $secuencia;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getSecuencia()
    {
        return $this->secuencia;
    }

   
  
}
