<?php

namespace BibleWorm\ApiBundle\Bible\Translation;

class ESV
{
    protected $key,
              $options,
              $baseUrl = 'http://www.esvapi.org/v2/rest/passageQuery';
    
    function __construct()
    {
        $this->key = 'IP';
        $this->options = array(
            'include-passage-references' => 'false',
            'include-audio-link' => 'false'
        );
    }
    
    public function setKey($key)
    {
        $this->key = $key;
    }
    
    protected function getUrlQueryString($passage)
    {
        $this->options['passage'] = urlencode($passage);
        $this->options['key'] = $this->key;
        
        $queryPairs = array();
        
        foreach ($this->options as $key => $value) {
            $queryPairs[]= $key.'='.$value;
        }
        
        return implode('&', $queryPairs);
    }
    
    protected function getUrl($passage)
    {
        return $this->baseUrl.'?'.$this->getUrlQueryString($passage);
    }
    
    public function lookup($passage)
    {
        $data = fopen($this->getUrl($passage), "r") ;

        if ($data)
        {
           while (!feof($data))
           {
              $buffer = fgets($data, 4096);
              echo $buffer;
           }
           fclose($data);
        }
        else
        {
           die("fopen failed for url to webservice");
        }
    }
}