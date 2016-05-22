<?php

namespace GsbBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GsbBundle\Entity\FicheFrais;
use GsbBundle\Form\FicheFraisType;
use GsbBundle\Form\LigneFraisForfaitType;
use GsbBundle\Form\LigneFraisHorsForfaitType;
use GsbBundle\Entity\LigneFraisHorsForfait;

class VisiteurRenseignerController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GsbBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function modifierFicheAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $fiche = $rep->findOneById($id) ;
        
        $form = $this->createForm(new FicheFraisType(), $fiche) ;
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            
            $em->flush();
            return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $id));
        }
           
        return $this->render('GsbBundle:Body:RenseignerFiche.html.twig', array('form' => $form->createView()));
    }
    
    public function modifierLigneAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:LigneFraisForfait');
        $ligne = $rep->findOneById($id) ;
        
        $form = $this->createForm(new LigneFraisForfaitType(), $ligne) ;
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ligne);
            
            $em->flush();
            return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $ligne->getFicheFrais()->getId()));
        }
           
        return $this->render('GsbBundle:Body:RenseignerLigne.html.twig', array('form' => $form->createView()));
    }
    
    public function modifierLigneHorsForfaitAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:LigneFraisHorsForfait');
        $ligne = $rep->findOneById($id) ;
        
        $form = $this->createForm(new LigneFraisHorsForfaitType(), $ligne) ;
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ligne);
            
            $em->flush();
            return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $ligne->getFicheFrais()->getId()));
        }
           
        return $this->render('GsbBundle:Body:RenseignerLigneHorsForfait.html.twig', array('form' => $form->createView()));
    }
    
    public function ajouterLigneHorsForfaitAction($id){
        
        $repFiche = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $repEtat = $this->getDoctrine()->getRepository('GsbBundle:Etat');
        
        $ligne = new LigneFraisHorsForfait() ;
        
        $ligne->setFicheFrais($repFiche->findOneById($id));
        $ligne->setEtat($repEtat->findOneById(1));
        
        $form = $this->createForm(new LigneFraisHorsForfaitType(), $ligne) ;
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ligne);
            
            $em->flush();
            return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $ligne->getFicheFrais()->getId()));
        }
           
        return $this->render('GsbBundle:Body:RenseignerLigneHorsForfait.html.twig', array('form' => $form->createView()));
    }
    
    public function supprimerLigneHorsForfaitAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:LigneFraisHorsForfait');
        $ligne = $rep->findOneById($id) ;
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($ligne);
            
        $em->flush();
        return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $ligne->getFicheFrais()->getId()));
    }
    
    public function ajouterFicheAction(){
        $repVisiteur = $this->getDoctrine()->getRepository('GsbBundle:Visiteur');
        $repEtat = $this->getDoctrine()->getRepository('GsbBundle:Etat');
        
        $em = $this->getDoctrine()->getManager();
        
        $session = $this->get("session");
        
        $visiteur = $repVisiteur->findOneById($session->get("utilisateur")->getId());
        
        $fiche = new FicheFrais();
        $fiche->setVisiteur($visiteur);
        $fiche->setEtat($repEtat->findOneById(1));
        $fiche->setAnnee(2016);
        $fiche->setMois(04);
        $fiche->setMontantValide(252.00);
        $fiche->setNbJustificatif(1);
        $fiche->setDateModif(new \DateTime());
        
        $em->persist($fiche) ;
        
        $em->flush();
        return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $fiche->getId()));
    }
}
