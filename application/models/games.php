<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Games extends MY_Model 
{
    protected $_name = "in_game";
    protected $_primary = "id";
    /*
    public function fetchAll($params = array(), $current = false, $showSelfColumns = true)
    {
        //$games = parent::fetchAll();
        
        if (!$this->session->userdata('api_loaded')) {
            
            
            $this->load->library('Api', 'api');
            
            return $this->api->setUri(INVICTUS_API_URI)->getGames();
        } else {
            
            return parent::fetchAll($params, $current, $showSelfColumns);
        }
    }
    */
    public function initFromApi()
    {
      
      $data = $this->invictus->setUri(INVICTUS_API_URI)->setAction('games')->get(true);
      
      if (!$data) return false;
      
      $d = array();
      foreach ($data as $item) {
        
        $d[] = array('id'=>$item['id'], 'name'=>$item['name'], 'url'=>$item['url']);
      }
      
      $this->truncate();
      
      $this->bulk_insert($d);
    }    
}