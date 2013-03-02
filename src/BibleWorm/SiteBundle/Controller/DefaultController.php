<?php

namespace BibleWorm\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('bw_mobile_homepage'));
        //return $this->render('BibleWormSiteBundle:Page:home.html.twig', array('slug' => 'BibleWorm'));
    }
    
    public function getPageAction($slug)
    {
        try {
            $template = $this->renderView('BibleWormSiteBundle:Page:'.$slug.'.html.twig', array('slug' => $slug));
        } catch (\Exception $e) {
            throw $this->createNotFoundException(sprintf('No page found named "%s"', $slug));
        }
        
        return new Response($template);
    }
}
