<?php

namespace Aris\MainBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;




/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
abstract class AbstractUploader {
    
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    protected $image;
    
    protected $temp;
    
    protected $file;
    
   
    
 /**
     * Set image
     *
     * @param string $image
     * 
     */
    public function setImage($image)
    {
        $this->image = $image;

        
    }
    
    
    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
    
   
    
    
    
     
     /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function  setFile($file = null) 
    {
      if($file instanceof UploadedFile)  {
       // echo 'img: ' . $this->image;
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->image)) {
            // store the old name to delete after the update
            $this->temp = $this->image;
            $this->image = null;
        }
        
        else {
            $this->image = 'initial';
        }
      }
         
      // echo '<pre>'; \Doctrine\Common\Util\Debug::dump($this->image); echo '<pre>'; exit();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {  
        if (null !== $this->getFile()) {
            // haz lo que quieras para generar un nombre único
            $filename = sha1(uniqid(mt_rand(), true));
            $this->image = $filename.'.'.$this->getFile()->guessExtension();
           //  echo '<pre>'; \Doctrine\Common\Util\Debug::dump($this->image); echo '<pre>'; exit();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }
        
        // si hay un error al mover el archivo, move() automáticamente
        // envía una excepción. This will properly prevent
        // the entity from being persisted to the database on error
      
        $this->getFile()->move($this->getUploadRootDir(), $this->image);
      
        // check if we have an old image
        if (!file_exists($this->getUploadRootDir().'/'.$this->temp) && isset($this->temp) ) {
            // delete the old image
          
            unlink($this->getUploadRootDir().'/'.$this->temp);
          
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        
            unlink($this->getAbsolutePath());
       
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
   
    public function getAbsolutePath()
    {
        return null === $this->image
            ? null
            : $this->getUploadRootDir().'/'.$this->image;
    }

    public function getWebPath()
    {
        return null === $this->image
            ? null
            : $this->getUploadDir().'/'.$this->image;
    }

    protected function getUploadRootDir()
    {
        // la ruta absoluta del directorio donde se deben
        // guardar los archivos cargados
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

   abstract protected function getUploadDir();
    
    
}