<?php

namespace BibleWorm\ApiBundle\Bible;

class Bible
{
    protected $translations = array();
    
    public $books = array();
    
    
    function __construct()
    {
        # code...
    }
    
    public function addTranslation($name, $translation)
    {
        $translations[$name] = $translation;
    }
    
    public function getTranslation($name)
    {
        if (array_key_exists($name, $this->translations)) {
            return $this->translations[$name];
        }
    }
}
