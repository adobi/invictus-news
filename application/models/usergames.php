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
        
        $result = $this->fetchRows(array(
            'join'=>array(
                array('table'=>'in_game', 'condition'=>'in_user_game.game_id=in_game.id', 'columns'=>array('in_game.name'))
            ),
            'where'=>array('user_id'=>$userId),
        ));
        
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