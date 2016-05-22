<?php

namespace GsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConnexionController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GsbBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function connexionAction(){
        return $this->render('GsbBundle:Connexion:index.html.twig', array('name' => "test"));
        
    }
}
