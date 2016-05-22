<?php

namespace GsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ComptableConsulterController extends Controller
{   
    
    public function consulterHistoriqueAction(){
        $detailPage = array();
        
        $detailPage["titre"] = "Consulter fiche de frais";
        $detailPage["boutonDetail"] = "gsb_comptable_detailFiche";
        $detailPage["page"] = "gsb_comptable_consulterHistorique";
        
        return $this->consulter($detailPage);
    }
    
    public function consulterARembourserAction(){
        $detailPage = array();
        
        $detailPage["titre"] = "Consulter fiche de frais a rembourser";
        $detailPage["boutonDetail"] = "gsb_comptable_detailFicheARembourser";
        $detailPage["page"] = "gsb_comptable_consulterARembourser";
        
        return $this->consulter($detailPage);
    }
    
    public function consulterAValiderAction(){
        $detailPage = array();
        
        $detailPage["titre"] = "Consulter fiche de frais a valider";
        $detailPage["boutonDetail"] = "gsb_comptable_detailFicheAValider";
        $detailPage["page"] = "gsb_comptable_consulterAValider";
        
        return $this->consulter($detailPage);
    }
    
    private function consulter($detailPage){
        // Récupération des services
        $repFicheFrais = $this->getDoctrine()->getRepository("GsbBundle:FicheFrais");
        $repVisiteur = $this->getDoctrine()->getRepository("GsbBundle:Visiteur");
        $repEtat = $this->getDoctrine()->getRepository("GsbBundle:Etat");
        // Fin récupération des services
        
        switch($detailPage["page"]){
            case "gsb_comptable_consulterHistorique":
                $fiches = $repFicheFrais->findAll();
                break;
            case "gsb_comptable_consulterARembourser":
                $etat = $repEtat->findOneById(2);
                $fiches = $repFicheFrais->findBy(array("etat" => $etat));
                break;
            case "gsb_comptable_consulterAValider":
                $etat = $repEtat->findOneById(1);
                $fiches = $repFicheFrais->findBy(array("etat" => $etat));
                break;
            default:
                break;
        }
        
        
        $session = $this->get("session");
        if($session->get("typeUtilisateur") == null){
            return $this->redirectToRoute("gsb_connexion");
        }
        
        $form = $this->createFormBuilder()
                ->add("mois", "integer", array("required"=>false))
                ->add("annee", "integer", array("required"=>false))
                ->add("visiteur", "text", array("required"=>false))
                ->add("rechercher", "submit")
                ->getForm();
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $donnee = $form->getData();
            $mois = $donnee["mois"];
            $annee = $donnee["annee"];
            $visiteur = $donnee["visiteur"];
            
            $array = array();
            
            if($mois != ""){
                $array["mois"] = $mois;
            }
            
            if($annee != ""){
                $array["annee"] = $annee;
            }
            
            if($visiteur != ""){
                $visiteur = $repVisiteur->findOneByNom($visiteur);
                $array["visiteur"] = $visiteur;
            }
            
            $fiches = $repFicheFrais->findBy($array);
        }
        
        return $this->render('GsbBundle:Body:ConsulterFicheDeFrais.html.twig', array(
            'form' => $form->createView(),
            'fiches' => $fiches, "detailPage" => $detailPage));
    }
}
