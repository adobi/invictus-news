<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Api extends MY_Controller 
{
    private $_doctype = '<?xml version="1.0" encoding="utf-8" ?>';
    
    public function index() 
    {
        echo 'hello';
    }
    
    public function get_thumbnail()
    {

        
        dump($game);
    }
    
    public function get_news()
    {
        $game = $this->uri->segment(3);
        $platform = $this->uri->segment(4);
        $count = $this->uri->segment(5) ? $this->uri->segment(5) : 5;
        
        $this->load->model('Rumors', 'rumor');
        
        $response = $this->_doctype . $this->rumor->fetchRumorsForApi($game, $platform, $count);
        
        echo $response;
        
        die;
    }
}    
