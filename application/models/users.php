<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Users extends MY_Model 
{
    protected $_name = "in_user";
    protected $_primary = "id";
    
    public function login($username, $password) 
    {
        if (!$username || !$password) {
            
            return false;
        }
        
        return current($this->fetchRows(array('where'=>array('username'=>$username, 'password'=>$password))));
    }
}