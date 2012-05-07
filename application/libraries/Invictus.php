<?php

if (! defined('BASEPATH')) exit('No direct script access');

class Invictus 
{
    private $_uri;
    private $_action;
    
    public function setUri($uri)
    {
        $this->_uri = $uri;
        
        return $this;
    }
    
    public function setAction($action) 
    {
      $this->_action = $action;
      
      return $this;
    }
    
    public function get($assoc = false)
    {
      //if (!$this->_uri) $this->_uri = INVICTUS_API_URI;
      
      return json_decode(file_get_contents($this->_uri . $this->_action), $assoc);
    }
}
