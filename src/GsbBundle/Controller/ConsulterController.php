<?php

namespace GsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ConsulterController extends Controller
{
    
    public function consulterAction(){
        // Récupération des services
        $rep = $this->getDoctrine()->getRepository("GsbBundle:FicheFrais");
        // Fin récupération des services
        
        $session = $this->get("session");
        if($session->get("typeUtilisateur") == null){
            return $this->redirectToRoute("gsb_connexion");
        }
        
        $form = $this->createFormBuilder()
                ->add("mois", "date")
                ->add("visiteur", "text")
                ->add("rechercher", "submit")
                ->getForm();
        
        
        $fiches = $rep->findAll();
        
        return $this->render('GsbBundle:Body:ConsulterFicheDeFrais.html.twig', array(
            'form' => $form->createView(),
            'fiches' => $fiches));
    }
    
    
}
