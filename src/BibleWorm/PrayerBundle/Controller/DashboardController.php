<?php

namespace BibleWorm\PrayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use BibleWorm\PrayerBundle\Entity\Prayer;
use BibleWorm\PrayerBundle\Form\Type\PrayerType;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="get_dashboard")
     * @Template()
     */
    public function getDashboardAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        # not logged in
        # return a different template
        if (false) {
            $content = $this->renderView('BibleWormPrayerBundle:Dashboard:getHomepage.html.twig');
            return new Response($content);
        }
        
        $repository = $this->getDoctrine()
            ->getRepository('BibleWormPrayerBundle:Prayer');

        // $query = $repository->createQueryBuilder('p')
        //     ->where('p.isActive = true')
        //     ->where('p.user = :user')
        //     ->setParameter('user', $user)
        //     ->getQuery();
            
        $prayer = new Prayer();
        $form = $this->createForm(new PrayerType(), $prayer);
        
        return array(
            'prayers' => $repository->findActiveByUserId($user->getId()),
            'recentlyArchivedPrayers' =>  $repository->findRecentlyArchivedByUserId($user->getId()),
            'form' => $form->createView()
        );
    }
}
