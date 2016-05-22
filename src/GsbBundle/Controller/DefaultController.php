<?php

namespace GsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GsbBundle:Default:index.html.twig', array('name' => $name));
    }
}
