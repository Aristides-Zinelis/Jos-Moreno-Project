<?php

namespace Aris\FrontBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;


class MenuBuilder {
       private $factory;
       protected $doctrine;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
         $this->factory = $factory;
         
    }

    public function createMainMenu(Request $request)
    {   
        $menu = $this->factory->createItem('root');
        $menu->addChild('Inicio', array('route' => 'aris_front_homepage'));
        $menu->addChild('Galerias', array('route' => 'aris_front_galeria'));
        $menu->addChild('Curriculo', array('route' => 'aris_front_curriculo'));
        $menu->addChild('Contacto', array('route' => 'aris_front_contacto'));
        $menu['Inicio']->setLinkAttribute('class', 'btn btn-bordered white');
        $menu['Galerias']->setLinkAttribute('class', 'btn btn-bordered white');
        $menu['Curriculo']->setLinkAttribute('class', 'btn btn-bordered white');
        $menu['Contacto']->setLinkAttribute('class', 'btn btn-bordered white');
      
        return $menu;
    }
    
    
}
