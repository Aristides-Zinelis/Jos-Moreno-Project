<?php

namespace Aris\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Aris\MainBundle\Entity\Galeria;

class MenuBuilder {
       private $factory;
        protected $doctrine;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, $doctrine)
    {
        $this->factory = $factory;
         $this->doctrine = $doctrine;
    }

    public function createMainMenu(Request $request)
    {   
        $menu = $this->factory->createItem('root');
        $menu->addChild('Galerias', array('route' => 'galeria'));
        $menu->addChild('Curriculo', array('route' => 'curriculo'));
        $menu->addChild('Cerrar Sesión', array('route' => 'logout'));
       
        return $menu;
    }
    
    
}
