<?php

namespace GsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ConnexionController extends Controller
{
    
    public function deconnexionAction(){
        //$session = new Session();
        $session = $this->container->get('session');
        $session->invalidate();
        return $this->redirectToRoute("gsb_connexion");
    }
    
    public function connexionAction(){
        // Récupération des services
        $rep = $this->getDoctrine()->getManager()->getRepository("GsbBundle:Utilisateur");
        $repVisi = $this->getDoctrine()->getManager()->getRepository("GsbBundle:Visiteur");
        $repCompta = $this->getDoctrine()->getManager()->getRepository("GsbBundle:Comptable");
        // Fin récupération des services
        
        $form = $this->createFormBuilder()
                ->add('login', 'text')
                ->add('motDePasse', 'password')
                ->add('valider', 'submit')
                ->add('annuler', 'reset')
                ->getForm();
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        $session = $this->container->get('session');
        $session->start();
        
        if($form->isValid()){
            $data = $form->getData();
            // Condition pour la connexion
            // Reste a allez vérifier dans la BDD
            
            $utilisateurLambda = $rep->findOneBy(array("login" => $data["login"], "mdp" => $data["motDePasse"]));
            
            if($utilisateurLambda != null){
                
                if($utilisateurLambda->getType() == "comptable"){
                    $utilisateur = $repCompta->findOneBy(array("utilisateur" => $utilisateurLambda->getId()));
                    
                }else if($utilisateurLambda->getType() == "visiteur"){
                    $utilisateur = $repVisi->findOneBy(array("utilisateur" => $utilisateurLambda->getId()));
                }else{}
                
                $session->set("typeUtilisateur", $utilisateurLambda->getType());
                $session->set("utilisateur", $utilisateur);
                return $this->redirectToRoute("gsb_consulter");
            }
            return $this->render('GsbBundle:Connexion:Connexion.html.twig', array('form' => $form->createView()));
        }
        
        return $this->render('GsbBundle:Connexion:Connexion.html.twig', array(
            'form' => $form->createView()));
        
    }
}
