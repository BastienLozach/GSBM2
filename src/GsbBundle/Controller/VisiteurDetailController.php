<?php

namespace GsbBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VisiteurDetailController extends Controller
{
    public function detailFicheAction($id){
        
        $rep = $this->getDoctrine()->getRepository('GsbBundle:FicheFrais');
        $fiche = $rep->findOneById($id) ;
        
               
        return $this->render('GsbBundle:Body:DetailFicheDeFrais.html.twig', array('fiche' => $fiche));
    }
    

}
