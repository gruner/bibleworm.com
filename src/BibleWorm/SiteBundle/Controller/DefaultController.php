<?php

namespace BibleWorm\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('BibleWormSiteBundle:Default:index.html.twig');
    }
}
