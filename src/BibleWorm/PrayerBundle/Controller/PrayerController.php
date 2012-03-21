<?php

namespace BibleWorm\PrayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use BibleWorm\PrayerBundle\Entity\Prayer;
use BibleWorm\PrayerBundle\Form\Type\PrayerType;

/**
 * @Route("/p")
 */
class PrayerController extends Controller
{
    /**
     * @Route("/new", name="new_prayer")
     * @Method("GET")
     * @Template
     */
    public function newPrayerAction()
    {
        $prayer = new Prayer();
        $form = $this->createForm(new PrayerType(), $prayer);
        
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/shared", name="get_shared_prayers")
     * @Method("GET")
     * @Template
     */
    public function getSharedPrayersAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('BibleWormPrayerBundle:Prayer');
        
        return array(
            'prayers' => $repository->findShared()
        );
    }
    
    /**
     * @Route("/{id}", name="get_prayer")
     * @Method("GET")
     * @Template
     */
    public function getPrayerAction($id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        $prayer = $this->getPrayer($id);
        $form = $this->createForm(new PrayerType(), $prayer);
        
        return array(
            'prayer'   => $prayer,
            'form'     => $form->createView(),
        );
    }
    
    /**
     * @Route("/", name="post_prayers")
     * @Method("POST")
     * @Template
     */
    public function postPrayersAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $prayer = new Prayer();
        $prayer->setUser($user);
        
        $form = $this->createForm(new PrayerType(), $prayer);
        
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($prayer);
            $em->flush();
            
            if ($request->isXmlHttpRequest()) {
                return new Response(json_encode(array(
                    'prayer' => array(
                        'id' => $prayer->getId(),
                        'name' => $prayer->getName(),
                        'notes' => $prayer->getNotes(),
                        'links' => array(
                            'edit' => $this->get('router')
                                ->generate('edit_prayer', array('id' => $prayer->getId())),
                            'delete' => $this->get('router')
                                ->generate('delete_prayer', array('id' => $prayer->getId()))
                        ))))
                );
            }

            return $this->redirect($this->generateUrl('get_dashboard'));
        } else {
            # forward to template for errors
        }
    }
    
    /**
     * @Route("/{id}", name="update_prayer")
     * Method("POST")
     * @Template
     */
    public function updatePrayerAction($id)
    {
    }
    
    /**
     * @Route("/{id}", name="archive_prayer")
     * Method("POST")
     */
    public function archivePrayerAction($id)
    {
        $prayer = $this->getPrayer($id);
        $prayer->setIsActive(false);
        $this->savePrayer($prayer);
        
        return new Response('true');
    }
    
    /**
     * @Route("/{id}/destroy", name="delete_prayer")
     * Method("POST")
     * @Template
     */
    public function deletePrayerAction($id)
    {
    }
    
    protected function getPrayer($id)
    {
        $prayer = $this->getDoctrine()
            ->getRepository('BibleWormPrayerBundle:Prayer')
            ->find($id);

        if (!$prayer) {
            throw $this->createNotFoundException('This prayer does not exist or has been deleted');
        }
        
        return $prayer;
    }
    
    protected function savePrayer($prayer)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($prayer);
        $em->flush();
    }
}
