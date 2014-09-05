<?php

namespace Aris\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Aris\MainBundle\Entity\Images;
/**
 * Galeria
 *
 * @ORM\Table(name="galeria")
 * @ORM\Entity(repositoryClass="Aris\MainBundle\Entity\GaleriaRepository")
 */
class Galeria extends AbstractUploader
{
    
     public function __construct()
    {
        $this->images = new ArrayCollection();
    }
    
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="Images", mappedBy="galeria")
     */
    protected $images;


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
     * Set name
     *
     * @param string $name
     * @return Galeria
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Galeria
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

 

   
    
     public function __toString()
    {
       return $this->name;
    }

    protected function getUploadDir() {
        return 'uploads/galerias';
    }


     /**
     * Add images
     *
     * @param \Aris\MainBundle\Entity\Images $images
     * @return Galeria
     */
    public function addImages(\Aris\MainBundle\Entity\Images $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Aris\MainBundle\Entity\Images $images
     */
    public function removeImages(\Aris\MainBundle\Entity\Images $images)
    {
        $this->images->removeElement($images);
    }

   
  

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}
