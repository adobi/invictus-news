<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Platforms extends MY_Model 
{
    protected $_name = "in_platform";
    protected $_primary = "id";
    
    public function initFromApi()
    {
      
      $data = $this->invictus->setUri(INVICTUS_API_URI)->setAction('platforms')->getPlatforms(true);
      
      if (!$data) return false;
      
      foreach ($data as &$item) {
        unset($item['image']);
        $item['url'] = $this->sanitizer->sanitize_title_with_dashes($item['name']);
      }
      
      $this->truncate();
      
      $this->bulk_insert($data);
      
    }
}