<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Games extends MY_Model 
{
    protected $_name = "in_game";
    protected $_primary = "id";
    
    public function fetchAll($params = array(), $current = false, $showSelfColumns = true)
    {
        //$games = parent::fetchAll();
        
        $this->load->library('Api', 'api');
        
        return $this->api->setUri(INVICTUS_API_URI)->getGames();
    }
}