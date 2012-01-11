<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Usergames extends MY_Model 
{
    protected $_name = "in_user_game";
    protected $_primary = "id";
    
    public function fetchForUser($userId, $onlyIds = false)
    {
        if (!$userId) {
            
            return false;
        }

        $this->load->library('Api', 'api');
        
        $result = $this->api->setUri(INVICTUS_API_URI)->getGames();
        
        if (!$result) return false;
        
        $this->load->model('Games', 'game');
        $this->game->execute('truncate table ' . $this->game->getName().';');
        foreach ($result as $r) {
            $this->game->insert(array('id'=>$r->id, 'name'=>$r->name));
        }
        
        /*
        $gameIds = array();
        $gameNames = array();
        foreach ($result as $r) {
            $gameIds[] = $r->id;
            $gameNames[$r->id] = $r->name;
        }
        */
        
        $result = $this->fetchRows(array(
            'join'=>array(
                array('table'=>'in_game', 'condition'=>'in_user_game.game_id=in_game.id', 'columns'=>array('in_game.name'))
            ),
            'where'=>array('user_id'=>$userId),
        ));
        
        if (!$result) {
            
            return false;
        }
        
        //foreach ($result as $i=>$r) {
        //    if (in_array($r->game_id, $gameIds)) $r->name = $gameNames[$r->game_id];
        //}
        
        $usersGames = $this->fetchRows(array('where'=>array('user_id'=>$userId)));
        
        if (!$usersGames) {
            
            return $result;
        }
        
        if (!$onlyIds) {
            
            return $result;
        }
        
        if (!$result) {
            
            return false;
        }
        
        $return = array();
        foreach ($result as $item) {
            $return[] = $item->game_id;
        }
        //dump($return); die;
        return $return;
    }
}