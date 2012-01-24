<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Game_and_platform extends MY_Controller 
{
    
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in')->role !== '1') {
            
            redirect(base_url().'dashboard');
        }
        
    }
        
    public function edit() 
    {
        $data = array();
        
        $id = $this->uri->segment(3);
        
        $this->load->model('Bridge', 'model');
        
        $item = false;
        if ($id) {
            $item = $this->model->find((int)$id);
        }
        $data['item'] = $item;
        
        $this->form_validation->set_rules('link_text', 'Link text', 'trim|required|max_length['.LINK_TEXT_MAX_LENGTH.']');
        $this->form_validation->set_rules('link_url', 'Link url', 'trim|required');
        
        if ($this->form_validation->run()) {
            if ($this->upload->do_upload('image')) {
                
                if ($id) {
                    
                    $this->_deleteImage($id);
                }
                
                $_POST['image'] = $this->upload->file_name;
            } 
                    
            if ($id) {
                $this->model->update($_POST, $id);
            } else {
                //$this->model->insert($_POST);
            }
            
            $this->session->set_flashdata('message', 'Item saved');
            
            
            
            if (!$this->model->isCompletedForRumor($item->rumor_id)) {
                
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(base_url().'dashboard');
            }
            
        } else {
            
            if ($_POST) {
                
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    /*
    public function sisyphus_forms()
    {
        $forms = $this->session->userdata('sisyphus_forms');
        
        if (!$forms) {
            $forms = array();
        }
        
        $forms[] = $this->uri->segment(3);
        
        $this->session->set_userdata('sisyphus_forms', $forms);
        
        die;
    }
    */
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('Bridge', 'model');
            
            $this->model->delete($id);
            
            $this->session->set_flashdata('message', 'Settings deleted');
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function delete_image() 
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            
            $this->_deleteImage($id);
            
            $this->session->set_flashdata('message', 'Image deleted');
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }     
    
    private function _deleteImage($id, $withRecord = false) 
    {
        $this->load->model('Bridge', 'model');
        
        $item = $this->model->find($id);
        
        if ($item && $item->image) {
            $this->load->config('upload');
            
            @unlink($this->config->item('upload_path') . $item->image);
        }
        
        if (!$withRecord) {
            
            $this->model->update(array('image'=>null), $id);
        }
        
        return $withRecord ? $this->model->delete($id) : true;
    }      
}