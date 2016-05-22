<?php

namespace GsbBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RenseignerController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GsbBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function ajouterFicheAction(){
        
        $fiche = new FicheFrais() ;
        $fiche->setVisiteur($this->getSession()->getUtilisateur());
        
        
        $form = $this->createForm(FicheFraisType::Type, $fiche) ;
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            $em->flush();
        }
        
               
        return $this->render('GsbBundle:Body:RenseignerFiche.html.twig', array('form' => $form));
        
    }
    
        public function modifierFicheAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $fiche = $rep->findOneById($id) ;
        
        $form = $this->createForm(FicheFraisType::Type, $fiche) ;
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            $em->flush();
        }
        
               
        return $this->render('GsbBundle:Body:RenseignerFiche.html.twig', array('form' => $form));
        
    }
    
}
