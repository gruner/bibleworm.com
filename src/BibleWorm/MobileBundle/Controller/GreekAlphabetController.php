<?php

namespace BibleWorm\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class GreekAlphabetController extends Controller
{
    public function indexAction()
    {
        return $this->render('BibleWormMobileBundle:GreekAlphabet:index.html.twig');
    }
}
