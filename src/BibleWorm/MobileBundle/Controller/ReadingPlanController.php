<?php

namespace BibleWorm\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

class ReadingPlanController extends Controller
{
    public function getReadingPlanAction()
    {
        $readingPlan = Yaml::parse(__DIR__.'/../Resources/readingplans/victory_bible.yml');
        
        return $this->render('BibleWormMobileBundle:ReadingPlan:index.html.twig', array('readingPlan' => $readingPlan));
    }
    
    // public function getReadingPlanDayAction($day)
    // {
    //     $readingPlan = Yaml::parse(__DIR__.'/../Resources/readingplans/victory_bible.yml');
    //     
    //     if (!array_key_exists($day, $readingPlan)) {
    //         # code...
    //     }
    //     
    //     return $this->render('BibleWormMobileBundle:ReadingPlan:day.html.twig', array(
    //         'day' => $day,
    //         'readings' => $readingPlan[$day]
    //     ));
    // }
    
    public function getPassageAction($book, $chapter, $verse)
    {
        $ref = $book.' '.$chapter;
        
        if (!empty($verse)) {
            $ref .= ':'.$verse;
        }
        
        $bible = $this->get('bw_api.bible');
        $passage = $bible->getTranslation('ESV')->lookup($ref);
        
        return $this->render('BibleWormMobileBundle:ReadingPlan:passage.html.twig', array(
            'reference' => $ref,
            'passage' => $passage
        ));
    }
}
