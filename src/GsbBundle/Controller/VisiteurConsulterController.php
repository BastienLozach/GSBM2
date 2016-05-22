<?php

namespace GsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class VisiteurConsulterController extends Controller
{   
    
    public function consulterHistoriqueAction(){
        $detailPage = array();
        
        $detailPage["titre"] = "Consulter fiche de frais";
        //$detailPage["boutonDetail"] = "gsb_visiteur_detailFiche";
        $detailPage["page"] = "gsb_visiteur_consulterHistorique";
        
        return $this->consulter($detailPage);
    }
    
    public function consulterARembourserAction(){
        $detailPage = array();
        
        $detailPage["titre"] = "Consulter fiche de frais a rembourser";
        //$detailPage["boutonDetail"] = "gsb_visiteur_detailFicheARembourser";
        $detailPage["page"] = "gsb_visiteur_consulterARembourser";
        
        return $this->consulter($detailPage);
    }
    
    public function consulterAValiderAction(){
        $detailPage = array();
        
        $detailPage["titre"] = "Consulter fiche de frais a valider";
        //$detailPage["boutonDetail"] = "gsb_visiteur_detailFicheAValider";
        $detailPage["page"] = "gsb_visiteur_consulterAValider";
        
        return $this->consulter($detailPage);
    }
    
    public function consulterRembourseesAction(){
        $detailPage = array();
        
        $detailPage["titre"] = "Consulter fiche de frais a valider";
        //$detailPage["boutonDetail"] = "gsb_visiteur_detailFicheRembourse";
        $detailPage["page"] = "gsb_visiteur_consulterRemboursees";
        
        return $this->consulter($detailPage);
    }
    
    private function consulter($detailPage){
        $detailPage["boutonDetail"] = "gsb_visiteur_detailFiche";
        // Récupération des services
        $repFicheFrais = $this->getDoctrine()->getRepository("GsbBundle:FicheFrais");
        $repVisiteur = $this->getDoctrine()->getRepository("GsbBundle:Visiteur");
        $repEtat = $this->getDoctrine()->getRepository("GsbBundle:Etat");
        // Fin récupération des services
        
        $session = $this->get("session");
        $session->start();
        
        switch($detailPage["page"]){
            case "gsb_visiteur_consulterHistorique":
                $fiches = $repFicheFrais->findByVisiteur($session->get("utilisateur"));
                break;
            case "gsb_visiteur_consulterARembourser":
                $etat = $repEtat->findOneById(2);
                $fiches = $repFicheFrais->findBy(array("etat" => $etat, "visiteur" => $session->get("utilisateur")));
                break;
            case "gsb_visiteur_consulterAValider":
                $etat = $repEtat->findOneById(1);
                $fiches = $repFicheFrais->findBy(array("etat" => $etat, "visiteur" => $session->get("utilisateur")));
                break;
            case "gsb_visiteur_consulterRemboursees":
                $etat = $repEtat->findOneById(3);
                $fiches = $repFicheFrais->findBy(array("etat" => $etat, "visiteur" => $session->get("utilisateur")));
                break;
            default:
                break;
        }
        
        if($session->get("typeUtilisateur") == null){
            return $this->redirectToRoute("gsb_connexion");
        }
        
        $form = $this->createFormBuilder()
                ->add("mois", "integer", array("required"=>false))
                ->add("annee", "integer", array("required"=>false))
                ->add("rechercher", "submit")
                ->getForm();
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $donnee = $form->getData();
            $mois = $donnee["mois"];
            $annee = $donnee["annee"];
            
            
            $array = array();
            
            if($mois != ""){
                $array["mois"] = $mois;
            }
            
            if($annee != ""){
                $array["annee"] = $annee;
            }
            
            $visiteur = $repVisiteur->findOneById($session->get("utilisateur")->getId());
            $array["visiteur"] = $visiteur;
            
            $fiches = $repFicheFrais->findBy($array);
        }
        
        return $this->render('GsbBundle:Body:ConsulterFicheDeFrais.html.twig', array(
            'form' => $form->createView(),
            'fiches' => $fiches, "detailPage" => $detailPage));
    }
}
