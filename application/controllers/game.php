<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Game extends MY_Controller 
{
    
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in')->role !== '1') {
            
            redirect(base_url().'dashboard');
        }
        
    }
        
    public function index() 
    {
        $data = array();
        
        $this->load->library('Api', 'api');
        
        $data['items'] = $this->api->setUri(INVICTUS_API_URI)->getGames();
        
        $this->template->build('game/index', $data);
    }
    
    public function edit() 
    {
        $data = array();
        
        $id = $this->uri->segment(3);
        
        $this->load->model('Games', 'model');
        
        $item = false;
        if ($id) {
            $item = $this->model->find((int)$id);
        }
        $data['item'] = $item;
        
        $this->form_validation->set_rules("name", "Name", "trim|required");
		
        
        if ($this->form_validation->run()) {
        
            if ($id) {
                $this->model->update($_POST, $id);
            } else {
                $this->model->insert($_POST);
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->template->build('game/edit', $data);
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('Games', 'model');
            
            $this->model->delete($id);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
}