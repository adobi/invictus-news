<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Bridge extends MY_Model 
{
    protected $_name = "in_bridge";
    protected $_primary = "id";
    
    /**
     * adott hirhez kerdezi le a hozza tartozo jatekokat, platformokat
     *
     * @param string $rumorId 
     * @param string $type ha hamis akkor jatekot es platformot is visszaad
     * @param string $onlyIds ha igaz akkor csak a $type-nak megfelelo id-ket adja vissza
     * @return array
     * @author Dobi Attila
     */
    public function fetchForRumor($rumorId, $type = false, $onlyIds = false)
    {
        if (!$rumorId) {
            
            return false;
        }
        
        $sql = "select b.*, g.name as game, p.name as platform from $this->_name as b join in_game as g on b.game_id = g.id join in_platform p on b.platform_id = p.id where b.rumor_id = $rumorId";
        
        //dump($sql);
        
        $result = $this->execute($sql);
        //dump($result);
        if (!$result) return false;
        
        if (!$type) return $result;
        
        $return = array();
        foreach ($result as $item) {
            $prop = $type.'_id';
            $return[] = $item->$prop;
        }
        
        return array_unique($return);
    }
    
    public function isCompletedForRumor($rumorId) 
    {
        if (!$rumorId) return false;
        
        $allItems = count($this->fetchForRumor($rumorId));
        
        $sql = "select id from in_bridge where rumor_id = $rumorId and link_text is not null and link_url is not null and image is not null";

        $completedItems = count($this->execute($sql));
        
        return $allItems === $completedItems;
    }
    
    public function insertForAllPlarforms($data)
    {
      if (!$data) return false;
      
      
      
      $this->load->model('Platforms', 'platforms');
      
      $platforms = $this->platforms->fetchAll();
      
      if (!$platforms) return false;
      //dump($data);
      $imageName = $data['image_name'];
      $imageUrl = $data['image_url'];
      unset($data['image_name']);unset($data['image_url']);
      $error = false;
      foreach ($platforms as $item) {
        $data['image'] = $this->_getImageFromUrl($imageUrl, $imageName);
        $data['platform_id'] = $item->id;
        
        if ($data['image']) 
          $this->insert($data);
        else {
          $error = true;
        }
      }
      
      return !$error;
    }
    
    /** 
     * get an image from the remote
     *
     * @param string $url 
     * @param string $name 
     * @return string the name of the loaded image
     * @author Dobi Attila
     */
    private function _getImageFromUrl($url, $name)
    {
      
      if (!$url || !$name) return false;
      
      //dump($url); dump($name);
      $imageBinary = file_get_contents($url);
      
      $this->config->load('upload');
      
      $image = md5(str_replace(' ', '', microtime())).'_'.$name;
      file_put_contents($this->config->item('upload_path').$image, $imageBinary);
      
      return $image;
    }
    
}