<?php

namespace Aris\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aris\MainBundle\Entity\Galeria;
use Aris\AdminBundle\Form\GaleriaType;
use Aris\MainBundle\Entity\Images;
use Aris\MainBundle\Entity\Curriculo;
use Aris\AdminBundle\Form\CurriculoType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('ArisFrontBundle:Default:index.html.twig');
    }

    public function galeriasAction() {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('ArisMainBundle:Galeria')->findAll();


        return $this->render('ArisFrontBundle:Default:galerias.html.twig', array(
                    'galerias' => $entities)
        );
    }

    public function galeriaAction($name) {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('ArisMainBundle:Galeria')->findOneByName($name);
        $secuencias = $em->getRepository('ArisMainBundle:Images')->getSecuencias($entities);

        return $this->render('ArisFrontBundle:Default:galeria.html.twig', array(
                    'galeria' => $entities,
                    'secuencias' => $secuencias)
        );
    }

    public function curiculoAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('ArisMainBundle:Curriculo')->findOneById(1);
        return $this->render('ArisFrontBundle:Default:curiculo.html.twig', array(
                    'cv' => $entities)
        );
    }

    public function contactoAction(Request $request) {
        if ($request->getMethod() == 'POST') {
            if (strlen($request->get('name')) <= 0 || strlen($request->get('email')) <= 0 || strlen($request->get('subject')) <= 0 || strlen($request->get('message')) <= 0 || !filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                $headers = '';

// this is the subject of the message
                $subject = "Website Contact: {$request->get('subject')}";
                $headers .= "Content-type: text/html\r\n";

                $message = "<b>Email</b>: {$request->get('email')}<br /><br />";
                $message .= "<b>Message</b>: {$request->get('message')}<br />";
                  
                $send = mail('polidefkis2@yahoo.com', $subject, $message, $headers);

                if ($send){
                    $this->get('session')->getFlashBag()->add('notice', 'Mensaje enviado correctamente');   
                }
                else{
                    $this->get('session')->getFlashBag()->add('error', 'Algo ha ido mal. Por favor intentalo mas tarde');
                }
            }
            }
            return $this->render('ArisFrontBundle:Default:contacto.html.twig');
        
    }
}
