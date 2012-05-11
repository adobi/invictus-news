<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Bridge extends MY_Model 
{
    protected $_name = "in_bridge";
    protected $_primary = "id";

                    
    private $bitlyApiKey = 'R_c279e7aa82400801e49fe4b2cf455020';
    private $login = 'invictusgames';
    private $format = "json";
    
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
        
        foreach ($result as $item) {
          $response = json_decode($this->get_bitly_long_url($item->link_url));
          $item->bitly_link = $item->link_url;
          if ($response && $response->status_code === 200 && $response->data->expand[0]->long_url) {
            
            $item->link_url = $response->data->expand[0]->long_url;
          }
        }
        
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
      
      $imageName = $data['image_name'];
      $imageUrl = $data['image_url'];
      $gameName = $data['game_name'];
      unset($data['image_name']);unset($data['image_url']); unset($data['game_name']);
      $error = false;
      $url = $data['link_url'];
      foreach ($platforms as $item) {
        $data['image'] = $this->_getImageFromUrl($imageUrl, $imageName);
        $data['platform_id'] = $item->id;
        
        $data['link_url'] = $url . '?utm_source='.urlencode($gameName) . '&utm_medium=In-Game+News&utm_content='.urlencode($item->name).'&utm_campaign='.urlencode($gameName.' Release');
        
        if ($data['image']) 
          $this->insert($data);
        else {
          $error = true;
        }
      }
      
      return !$error;
    }

        
    public function get_bitly_short_url($url) 
    {
      if (!$url) return false;
      
      $connectURL = 'http://api.bit.ly/v3/shorten?login='.$this->login.'&apiKey='.$this->bitlyApiKey.'&uri='.urlencode($url).'&format='.$this->format;
      return $this->curl_get_result($connectURL);
    }
    
    /* returns expanded url */
    public function get_bitly_long_url($url) 
    {
      if (!$url) return false;
      
      $connectURL = 'http://api.bit.ly/v3/expand?login='.$this->login.'&apiKey='.$this->bitlyApiKey.'&shortUrl='.urlencode($url).'&format='.$this->format;
      return $this->curl_get_result($connectURL);
    }
    
    /* returns a result form url */
    private function curl_get_result($url) 
    {
      $ch = curl_init();
      $timeout = 5;
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
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