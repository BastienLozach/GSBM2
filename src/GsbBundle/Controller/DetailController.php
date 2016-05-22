<?php

namespace GsbBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DetailController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GsbBundle:Default:index.html.twig', array('name' => $name));
    }
    
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
}
