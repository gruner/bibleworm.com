<?php

namespace BibleWorm\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('BibleWormMobileBundle:Default:index.html.twig');
    }
}
