<?php

namespace Aris\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * curriculo
 *
 * @ORM\Table(name="curriculo")
 * @ORM\Entity(repositoryClass="Aris\MainBundle\Entity\CurriculoRepository")
 */
class Curriculo extends AbstractUploader
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="text")
     */
    private $texto;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return curriculo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return curriculo
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    protected function getUploadDir() {
        return 'uploads/cv';
        
    }

    public function __toString() {
        return $this->title;
    }

   
}
