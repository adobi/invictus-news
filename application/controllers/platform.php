<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Platform extends MY_Controller 
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
        
        $this->load->model('Platforms', 'model');
        
        $data['items'] = $this->model->fetchAll();
        
        $this->template->build('platform/index', $data);
    }
    
    public function edit() 
    {
        $data = array();
        
        $id = $this->uri->segment(3);
        
        $this->load->model('Platforms', 'model');
        
        $item = false;
        if ($id) {
            $item = $this->model->find((int)$id);
        }
        $data['item'] = $item;
        
        $this->form_validation->set_rules("name", "Name", "trim|required");
		
        
        if ($this->form_validation->run()) {
            
            $this->load->library('Sanitizer', 'sanitizer');
            
            $_POST['url'] = $this->sanitizer->sanitize_title_with_dashes($_POST['name']);
            
            if ($id) {
                $this->model->update($_POST, $id);
            } else {
                $this->model->insert($_POST);
            }
            redirect(base_url().'platform');
        }
        $this->template->build('platform/edit', $data);
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('Platforms', 'model');
            
            $this->model->delete($id);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
}