<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Game_and_platform extends MY_Controller 
{
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
        
        $this->form_validation->set_rules('link_text', 'Link text', 'trim|required');
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
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($_POST) {
                
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('Bridge', 'model');
            
            $this->model->delete($id);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function delete_image() 
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            
            $this->_deleteImage($id);
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