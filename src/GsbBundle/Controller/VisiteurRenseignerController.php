<?php

namespace GsbBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GsbBundle\Entity\FicheFrais;
use GsbBundle\Form\FicheFraisType;
use GsbBundle\Entity\LigneFraisForfait;
use GsbBundle\Form\LigneFraisForfaitType;
use GsbBundle\Form\LigneFraisHorsForfaitType;
use GsbBundle\Entity\LigneFraisHorsForfait;

class VisiteurRenseignerController extends Controller
{    
    public function modifierFicheAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $fiche = $rep->findOneById($id) ;
        
        $form = $this->createForm(new FicheFraisType(), $fiche) ;
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $fiche->setDateModif(new \DateTime());
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
            
            $fiche = $ligne->getFicheFrais();
            $fiche->setDateModif(new \DateTime());
            $em->persist($fiche);
            
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
            
            $fiche = $ligne->getFicheFrais();
            $fiche->setDateModif(new \DateTime());
            $em->persist($fiche);
            
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
            
            $fiche = $ligne->getFicheFrais();
            $fiche->setDateModif(new \DateTime());
            $em->persist($fiche);
            
            $em->flush();
            return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $ligne->getFicheFrais()->getId()));
        }
           
        return $this->render('GsbBundle:Body:RenseignerLigneHorsForfait.html.twig', array('form' => $form->createView()));
    }
    
    public function supprimerLigneHorsForfaitAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:LigneFraisHorsForfait');
        $ligne = $rep->findOneById($id) ;
        
        $em = $this->getDoctrine()->getManager();
        
        $fiche = $ligne->getFicheFrais();
        $fiche->setDateModif(new \DateTime());
        $em->persist($fiche);
        
        $em->remove($ligne);
            
        $em->flush();
        return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $ligne->getFicheFrais()->getId()));
    }
    
    public function ajouterFicheAction(){
        $repFiche = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $dateToday = new \DateTime();
        
        $ficheExistante = $repFiche->findOneBy(array("mois" => $dateToday->format("m"), "annee" => $dateToday->format("Y"))) ;
        if ($ficheExistante !== null){
            return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $ficheExistante->getId()));
        }
        
        
        
        
        $repVisiteur = $this->getDoctrine()->getRepository('GsbBundle:Visiteur');
        $repEtat = $this->getDoctrine()->getRepository('GsbBundle:Etat');
        $repFrais = $this->getDoctrine()->getRepository('GsbBundle:FraisForfait');
        
        $em = $this->getDoctrine()->getManager();
        
        $session = $this->get("session");
        
        $visiteur = $repVisiteur->findOneById($session->get("utilisateur")->getId());
        
        
        
        $fiche = new FicheFrais();
        $fiche->setVisiteur($visiteur);
        $fiche->setEtat($repEtat->findOneById(1));
        $fiche->setAnnee($dateToday->format("Y"));
        $fiche->setMois($dateToday->format("m"));
        $fiche->setMontantValide(0.00);
        $fiche->setNbJustificatif(0);
        $fiche->setDateModif($dateToday);
        
        $toutLesTypes = $repFrais->findAll();
        
        $em->persist($fiche) ;
                
        foreach($toutLesTypes as $unTypeDeFrais){
            $ligne = new LigneFraisForfait();
            $ligne->setFicheFrais($fiche);
            $ligne->setFraisForfait($unTypeDeFrais);
            $ligne->setQuantite(0);
            $em->persist($ligne) ;
        }
        
        
        $em->flush();
        return $this->redirectToRoute("gsb_visiteur_detailFiche", array("id"=> $fiche->getId()));
    }
}
