<?php

namespace AppBundle\Controller

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\author;

class DefaultController extends Controller
{
    public function indexAction($author)
    {
        return $this->render('Default:index.html.twig', array('author'=>$author));
    }
}