<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Platforms extends MY_Model 
{
    protected $_name = "in_platform";
    protected $_primary = "id";
    
    public function initFromApi()
    {
      
      $data = $this->invictus->setUri(INVICTUS_API_URI)->setAction('platforms')->get(true);
      
      if (!$data) return false;
      
      foreach ($data as &$item) {
        unset($item['image']);
        unset($item['image_name']);
        $item['url'] = $this->sanitizer->sanitize_title_with_dashes($item['name']);
      }
      
      $this->truncate();
      
      $this->bulk_insert($data);
      
    }
}