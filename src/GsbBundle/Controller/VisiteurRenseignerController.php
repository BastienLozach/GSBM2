<?php

namespace GsbBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GsbBundle\Form\FicheFraisType;
use GsbBundle\Form\LigneFraisForfaitType;

class VisiteurRenseignerController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GsbBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function ajouterFicheAction(){
        
        $fiche = new FicheFrais() ;
        $fiche->setVisiteur($this->getSession()->getUtilisateur());
        
        
        $form = $this->createForm(new FicheFraisType(), $fiche) ;
        
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            $em->flush();
        }
        
               
        return $this->render('GsbBundle:Body:RenseignerFiche.html.twig', array('form' => $form->createView()));
        
    }
    
    public function modifierFicheAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $fiche = $rep->findOneById($id) ;
        
        $form = $this->createForm(new FicheFraisType(), $fiche) ;
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        $lesFormulairesLigneFrais = array();
        $lesVuesLigneFrais = array();
        foreach($ligne as $fiche->getLigneFraisForfait()){
            $unForm = $this->createForm(new LigneFraisForfaitType(), $ligne) ;
            $unForm->handleRequest($request);
            array_push($lesFormulairesLigneFrais, $unForm);
            array_push($lesVuesLigneFrais, $unForm);
        }
        
        
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            
            
            foreach($unForm as $lesFormulairesLigneFrais){
                if($unForm->isValid()){
                    $em->persist($unForm->getEntity());
                }
            }
            $em->flush();
            return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $id));
        }
        
               
        return $this->render('GsbBundle:Body:RenseignerFiche.html.twig', array('form' => $form->createView(), "lesVuesLigneFrais" => $lesVuesLigneFrais));
        
    }
    
}
