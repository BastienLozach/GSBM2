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
        $name = "test";
        
        $form = $this->createFormBuilder()
                ->add('login', 'text')
                ->add('motDePasse', 'password')
                ->add('valider', 'submit')
                ->add('annuler', 'reset')
                ->getForm();
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $data = $form->getData();
            // Condition pour la connexion
            // Reste a allez vérifier dans la BDD
            
            if($data["login"] == "Moi" && $data["motDePasse"] == "azerty"){
                return $this->render('GsbBundle:Template:Template.html.twig', array(
                    'page' => "Accueil",
                    'name' => $data["login"]));
            }
        }
        
        return $this->render('GsbBundle:Connexion:index.html.twig', array('name' => $name, 'form' => $form->createView()));
        
    }
}
