<?php

namespace BibleWorm\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

class DefaultController extends Controller
{
    /**
     * There is currently only one reading plan, so the id param is ignored
     */
    public function getReadingPlanAction($id)
    {
        $readingPlan = Yaml::parse(__DIR__.'/../Resources/reading_plans/victory_bible.yml');
        
        return new Response(json_encode($readingPlan));
    }
}
