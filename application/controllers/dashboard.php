<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Dashboard extends MY_Controller 
{
    public function index() 
    {
        $data = array();
        
        $this->load->model("Rumors", 'model');
        
        $data['items'] = $this->model->fetchAll();
        
        $this->template->build('dashboard/index', $data);
    }
}