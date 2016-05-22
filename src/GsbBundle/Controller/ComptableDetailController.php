<?php

namespace GsbBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComptableDetailController extends Controller
{
    public function detailFicheAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $fiche = $rep->findOneById($id) ;
        
               
        return $this->render('GsbBundle:Body:DetailFicheDeFrais.html.twig', array('fiche' => $fiche));
    }
    
    public function detailFicheAValiderAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $fiche = $rep->findOneById($id) ;
        
               
        return $this->render('GsbBundle:Body:DetailFicheDeFrais.html.twig', array('fiche' => $fiche));   
    }
    
    public function validerFicheAction($id){
        
        $repFiche = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $fiche = $repFiche->findOneById($id) ;
        
        $repEtat = $this->getDoctrine()->getRepository('GsbBundle:Etat');
        $etat = $repEtat->findOneById(2) ;
        
        $fiche->setEtat($etat);
        
        foreach($fiche->getLigneFraisForfait() as $uneLigne){
            $montant = $uneLigne->getQuantite() * $uneLigne->getFraisForfait()->getMontant();
            $fiche->setMontantValide($fiche->getMontantValide() + $montant);
        }
        
        $em = $this->getDoctrine()->getManager() ;
        $em->persist($fiche) ;
        $em->flush() ;
              
        return $this->redirectToRoute("gsb_comptable_detailFiche", array("id"=> $id));
    }
    
    public function rembourserFicheAction($id){
        
        $repFiche = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $fiche = $repFiche->findOneById($id) ;
        
        $repEtat = $this->getDoctrine()->getRepository('GsbBundle:Etat');
        $etat = $repEtat->findOneById(3) ;
        
        $fiche->setEtat($etat);
        
        $em = $this->getDoctrine()->getManager() ;
        $em->persist($fiche) ;
        $em->flush() ;
              
        return $this->redirectToRoute("gsb_comptable_detailFiche", array("id"=> $id));
    }
    
    public function validerFraisAction($id){
        $repFrais = $this->getDoctrine()->getRepository('GsbBundle:LigneFraisHorsForfait');
        $frais = $repFrais->findOneById($id) ;
        
        $repEtat = $this->getDoctrine()->getRepository('GsbBundle:Etat');
        $etat = $repEtat->findOneById(2) ;
        
        $frais->setEtat($etat);
        
        $fiche = $frais->getFicheFrais();
        $nbJustificatif = $frais->getNbJustificatif();
        $montant = $frais->getMontant();
        $fiche->setNbJustificatif($fiche->getNbJustificatif() + $nbJustificatif);
        $fiche->setMontantValide($fiche->getMontantValide() + $montant);
        
        $em = $this->getDoctrine()->getManager() ;
        $em->persist($frais) ;
        $em->persist($fiche) ;
        $em->flush() ;
        
              
        return $this->redirectToRoute("gsb_comptable_detailFiche", array("id"=> $frais->getFicheFrais()->getId()));
    }
    
    public function refuserFraisAction($id){
        
        $repFrais = $this->getDoctrine()->getRepository('GsbBundle:LigneFraisHorsForfait');
        $frais = $repFrais->findOneById($id) ;
        
        $repEtat = $this->getDoctrine()->getRepository('GsbBundle:Etat');
        $etat = $repEtat->findOneById(4) ;
        
        $frais->setEtat($etat);
        
        $em = $this->getDoctrine()->getManager() ;
        $em->persist($frais) ;
        $em->flush() ;
        
              
        return $this->redirectToRoute("gsb_comptable_detailFiche", array("id"=> $frais->getFicheFrais()->getId()));
    }
    
}
