<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Rumors extends MY_Model 
{
    protected $_name = "in_rumor";
    protected $_primary = "id";
    
    public function fetchForUser($userId) 
    {
        if (!$userId) return false;
        
        $this->load->model('Users', 'user');
        
        $user = $this->user->find($userId);
        
        if (!$user) return false;
        
        if ($user->role === '1') {
            
            return $this->fetchAll();
        } else {
            
            $sql = "select * from in_rumor r join in_bridge b on r.id = b.rumor_id where b.game_id in (select game_id from in_user_game where user_id = $userId)";
            
            return $this->execute($sql);
            
        }
    }
}