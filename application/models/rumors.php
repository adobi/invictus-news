<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Rumors extends MY_Model 
{
    protected $_name = "in_rumor";
    protected $_primary = "id";
    
    public function fetchForUser($userId, $filters = array(), $page = false) 
    {
        if (!$userId) return false;
        
        $this->load->model('Users', 'user');
        
        $user = $this->user->find($userId);
        
        $perPage = ITEMS_PER_PAGE;
        
        if (!$page) $page = 0;
                
        if (!$user) return false;
        
        if ($user->role === '1') {
            
            if (empty($filters)) {
                /*
                return $this->execute("select 
                                        r.* 
                                        , (select group_concat(concat_ws(' - ', g.name, p.name), ' ') from in_bridge b join in_platform p on b.platform_id = p.id join in_game g on b.game_id = g.id where b.rumor_id = r.id) gp
                                      from in_rumor r order by created desc");
                */
                
                $sql = "select distinct r.*
                                , (select group_concat(distinct(g.name), ' ') from in_bridge b join in_game g on b.game_id = g.id where b.rumor_id = r.id) as games
                                , (select group_concat(distinct(p.name), ' ') from in_bridge b join in_platform p on b.platform_id = p.id where b.rumor_id = r.id) as platforms
                            from in_rumor r order by created desc limit $perPage offset $page
                        ";
                
                $result = $this->execute($sql);
                $return['result'] = $result;
                $return['count'] = @current($this->execute('select count(id) as total from in_rumor'))->total;
                
                return $return;
            }
            
            $games = false;
            if (isset($filters['games'])) {
                $games = join(', ', $filters['games']);
            }
            
            $platforms = false;
            if (isset($filters['platforms'])) {
                $platforms = join(', ', $filters['platforms']);
            }
            
            if ($games || $platforms) {
                
                
                $sql = "select distinct r.*
                            , (select group_concat(distinct(g.name), ' ') from in_bridge b join in_game g on b.game_id = g.id where b.rumor_id = r.id) as games
                            , (select group_concat(distinct(p.name), ' ') from in_bridge b join in_platform p on b.platform_id = p.id where b.rumor_id = r.id) as platforms
                            from in_rumor r where id in ( select rumor_id from in_bridge";
                $sqlTotal = "select count(distinct r.id) as total from in_rumor r where id in ( select rumor_id from in_bridge";
                if ($games && $platforms) {
                    
                    $s = " where game_id in ($games) and platform_id in ($platforms)";
                    $sql .= $s;
                    $sqlTotal .= $s;
                } else {
                    
                    if ($games) {
                        $s = " where game_id in ($games)";
                        $sql .= $s;
                        $sqlTotal .= $s;
                    }
                        
                    if ($platforms) {
                        $s = " where platform_id in ($platforms)";
                        $sql .= $s;
                        $sqlTotal .= $s;
                    }
                }
                    
                $sql .= " )  limit $perPage offset $page";
                $sqlTotal .= ")";
                
                $result = $this->execute($sql);
                $return['result'] = $result;
                $return['count'] = @current($this->execute($sqlTotal))->total;
                
                return $return;
            }
            
            return false;
            
        } else {
            
            $sql = "select  distinct r.*
                        , (select group_concat(distinct(g.name), ' ') from in_bridge b join in_game g on b.game_id = g.id where b.rumor_id = r.id and  b.game_id in (select game_id from in_user_game where user_id = $userId)) as games
                        , (select group_concat(distinct(p.name), ' ') from in_bridge b join in_platform p on b.platform_id = p.id where b.rumor_id = r.id and  b.game_id in (select game_id from in_user_game where user_id = $userId)) as platforms
                        from in_rumor r join in_bridge b on r.id = b.rumor_id and b.game_id in (select game_id from in_user_game where user_id = $userId)  limit $perPage offset $page";
            $result = $this->execute($sql);
            $return['result'] = $result;
            $return['count'] = @current($this->execute("select count(distinct r.id) as total from in_rumor r join in_bridge b on r.id = b.rumor_id where b.game_id in (select game_id from in_user_game where user_id = $userId)"))->total;
            //dump($return); die;
            return $return;            
        }
        
        return false;
    }
    
    /**
     * adott jatekohoz adott platformon visszaadja a $count-nak megfelelo szamu hirt
     *
     * @param string $game 
     * @param string $platform 
     * @param string $count 
     * @return void
     * @author Dobi Attila
     */
    public function fetchRumorsForApi($game, $platform, $count)
    {
        $this->load->model('Games', 'games');
        $this->load->model('Platforms', 'platforms');

        $games = $this->games->fetchAll();
        
        $gameRequest = $game;
        if ($games) {
          
          if ($gameRequest === "roc") 
            $gameRequest = "race-of-champions";
          else {
            foreach ($games as $item) {
              if (strpos($game, $item->url) !== false || strpos($item->url, $game) !== false) {
                $gameRequest = $item->url;
              }
            }
          }
        }
        
        $game = @$this->games->findBy('url', $gameRequest)->id;
        
        $platforms = $this->platforms->fetchAll();
        
        $platformRequest = $platform;
        if ($platforms) {
          foreach ($platforms as $item) {
            if (strpos($platform, $item->url) !== false || strpos($item->url, $platform) !== false) {
              $platformRequest = $item->url;
            }
          }
        }
        
        $platform = @$this->platforms->findBy('url', $platformRequest)->id;
        
        $newsResult = $this->getLatest($game, $platform, $count);
        
        $news = $newsResult ? $newsResult->result() : false;
        if (!$news) {
            
            return "<response><news><error>Empty</error></news></response>";
        }
        
        $this->load->config('upload');
        
        $baseUrl = "\n<uri>".base_url().$this->config->item('upload_dir')."</uri>";
        
        $thumb = $this->find($news[0]->id)->thumbnail;
        $thumbXML = "\n<thumbnail>$thumb</thumbnail>\n";
        
        $newsXML = str_replace('&#45;', '-', $this->toXML($newsResult, array('root'=>'news', 'element'=>'item')));
        
        //$newsXML = str_replace("&apos;", "'", $newsXML);
        
        return "<response>$baseUrl$thumbXML$newsXML\n</response>";
    }
    
    public function getLatest($game, $platform, $count)
    {
        if (!$game || !$platform) {
            
            return false;
        }
        
        //$sql = "select * from $this->_name where id in (select rumor_id from in_bridge where game_id = $game and platform_id = $platform) order by created desc limit $count";
        $sql = "select 
                    r.id, r.title, r.description, UNIX_TIMESTAMP(r.created) as created
                    , b.link_text, b.link_url, b.image 
                from 
                    $this->_name r 
                    join in_bridge b on r.id = b.rumor_id and b.game_id = $game and b.platform_id = $platform 
                where r.active = 1 
                order by created desc ";
        if (is_numeric($count)) $sql .= " limit $count";
        //dump($sql); die;
        return $this->execute($sql, true);
    }
    
    public function duplicate($id)
    {
        if (!$id) return false;
        
        $item = $this->find($id);
        
        if (!$item) return false;
        
        $rumorCopy = array();
        $rumorCopy['title'] = $item->title;
        $rumorCopy['description'] = $item->description;
        $rumorCopy['created'] = date('Y-m-d H:i:s');
        $rumorCopy['active'] = 0;
        $rumorCopy['thumbnail'] = $this->_duplicateImage($item->thumbnail);
        
        $rumorCopyId = $this->insert($rumorCopy);
        
        $this->load->model('Bridge', 'bridge');
        
        $settings = $this->bridge->fetchForRumor($item->id);
        
        if (!$settings) return $rumorCopyId;
        
        foreach ($settings as $s) {
            $settingsCopy = array();
            $settingsCopy['rumor_id'] = $rumorCopyId;
            $settingsCopy['game_id'] = $s->game_id;
            $settingsCopy['platform_id'] = $s->platform_id;
            $settingsCopy['link_text'] = $s->link_text;
            $settingsCopy['link_url'] = $s->link_url;
            $settingsCopy['image'] = $this->_duplicateImage($s->image);
            
            $this->bridge->insert($settingsCopy);
        }
        
        return $rumorCopyId;
    }
    
    public function insertFromRemote($data)
    {
      if (!$data) return false;
      
      $insertData = array(
        'title'=>$data['title'],
        'description'=>$data['description'],
        'created' => date('Y-m-d H:i:s'),
        'active'=>$data['make_active']
      );
      
      $insertData['thumbnail'] = $this->_getImageFromUrl($data['thumbnail'], $data['thumbnail_name']);

      if (!$insertData['thumbnail']) return json_encode(array('message'=>'Image not saved'));

      $inserted = parent::insert($insertData);
      
      if (!$inserted) {
        return json_encode(array('message'=>'News not created'));
      }
      
      /**
       * insert for all platforms
       */
      $this->load->model('Bridge', 'bridge');
      
      if (isset($data['target_games']) && !empty($data['target_games'])) {
        
        $this->load->model('Games', 'games');
        
        foreach ($data['target_games'] as $game) {
          $forPlatforms = $this->bridge->insertForAllPlarforms(array(
            'rumor_id'=>$inserted, 
            'game_id'=>$game, 
            'link_text'=>$data['link_text'], 
            'link_url'=>$data['link_url'], 
            'image_url'=>$data['image'],
            'image_name'=>$data['image_name'],
            'game_name' =>$this->games->find($game)->name
          ));          
        }
      } else {
      
        $forPlatforms = $this->bridge->insertForAllPlarforms(array(
          'rumor_id'=>$inserted, 
          'game_id'=>$data['game_id'], 
          'link_text'=>$data['link_text'], 
          'link_url'=>$data['link_url'], 
          'image_url'=>$data['image'],
          'image_name'=>$data['image_name'],
          'game_name' =>$this->games->find($data['game_id'])->name
        ));        
      }

      
      if ($forPlatforms) {
          
        return json_encode(array('insert_id'=>$inserted, 'message'=>'News created'));
      } else {
        return json_encode(array('insert_id'=>$inserted, 'message'=>'Problem with platforms'));
      }
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
      if ($url && $name) {
        
        $imageBinary = file_get_contents($url);
        
        $this->config->load('upload');
        
        $image = time().'_'.$name;
        file_put_contents($this->config->item('upload_path').$image, $imageBinary);
        
        return $image;
      } 
      
      return false;
    }
    
    private function _duplicateImage($image) 
    {
        if (!$image) return false;
        
        $imageNameParts = explode('_', $image);
        
        $imageNameParts[0] = time();
        
        $newImageName = implode('_', $imageNameParts);
        
        $this->config->load('upload');
        
        copy($this->config->item('upload_path').$image, $this->config->item('upload_path').$newImageName);
        
        return $newImageName;
    }
}