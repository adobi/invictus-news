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
        $this->form_validation->set_rules('link_url', 'Link url', 'trim|required|callback_check_http');
        
        $error = '';
        $redirect = false;
        if ($this->form_validation->run()) {
            //dump($this->upload->do_upload('image')); die;
            if ($this->upload->do_upload('image')) {
                
                if ($id) {
                    
                    $this->_deleteImage($id);
                }
                
                $_POST['image'] = $this->upload->file_name;
            } else {
                if ($item && !$item->image)
                    $error .= '<p>The file field is required</p>';
            }
             
            $update = 0;       
            if ($id) {
                
                if (false === strpos($_POST['link_url'], 'http://')) {
                    $_POST['link_url'] = 'http://'.$_POST['link_url'];
                }
                
                $_POST['link_url'] = preg_replace("/\?.*/", '', $_POST['link_url']);
                
                $this->load->model('Games', 'games');
                $gameName = $this->games->find($item->game_id)->name;
                $this->load->model('Platforms', 'platforms');
                $platformName = $this->platforms->find($item->platform_id)->name;
                $_POST['link_url'] = $_POST['link_url'] . '?utm_source='.urlencode($gameName) . '&utm_medium=In-Game+News&utm_content='.urlencode($platformName).'&utm_campaign='.urlencode($_POST['link_text']);

                $response = json_decode($this->model->get_bitly_short_url($_POST['link_url']));
                
                if ($response->status_code === 200) {
                  
                  $_POST['link_url'] = $response->data->url;
  
                  $this->model->update($_POST, $id);
                }
                
                //$update = 1;
            } else {
                //$this->model->insert($_POST);
            }
            
            //$this->session->set_flashdata('message', 'Item saved');
            
            
            $finished = false;
            if (!$this->model->isCompletedForRumor($item->rumor_id)) {
                
                //redirect($_SERVER['HTTP_REFERER']);
                
                //$redirect = 1;
                //$finished = true;
            } else {
                //redirect(base_url().'dashboard');
                
                //$redirect = 2;
            }
            
        } else {
            
            $error .= validation_errors();
            
            if ($_POST) {
                
                //redirect($_SERVER['HTTP_REFERER']);
                
                $redirect = 1;
            }
        }
        
        //dump($item, $error, $redirect); die;
        
        //dump($error); dump($redirect);die;
        //$this->session->set_flashdata('error', $error);
        
        //dump(str_replace("\n", '', $error)); die;
        
        if ($error) {
            $this->session->set_flashdata('message', str_replace("\n", '', $error));
        } else {
            $this->session->set_flashdata('message', 'Item saved');
        }

        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
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