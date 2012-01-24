<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Rumor extends MY_Controller 
{
    public function index() 
    {
        $data = array();
        
        $this->load->model('', 'model');
        
        $data['items'] = $this->model->fetchAll(array('order'=>array('by'=>'created', 'dest'=>'desc')));
        
        
        $this->template->build('/index', $data);
    }
    
    public function edit() 
    {
        $data = array();
        
        $id = $this->uri->segment(3);
        
        $this->load->model('Rumors', 'model');
        $this->load->model('Games', 'game');
        $this->load->model('Platforms', 'platform');
        $this->load->model('Usergames', 'usergames');
        $this->load->model('Bridge', 'bridge');
        
        /**
         * azoknak a jatekoknak a lekerdezese amilyekhez joga van az aktualis usernek
         *
         * @author Dobi Attila
         */
        $games = $this->usergames->fetchForUser($this->session->userdata('logged_in')->id);
        if (!$games) {
            //$games = $this->game->toAssocArray('id', 'name', $this->game->fetchAll(array('order'=>array('by'=>'name', 'dest'=>'asc'))));
            $games = $this->game->toAssocArray('id', 'name', $this->game->fetchAll());
        } else {
            $games = $this->usergames->toAssocArray('id', 'name', $games);
        }
        $data['games'] = $games;

        $data['platforms'] = $this->game->toAssocArray('id', 'name', $this->platform->fetchAll());
        
        $item = false; $for_games = false; $for_platforms = false;
        if ($id) {
            $item = $this->model->find((int)$id);
            $for_games = $this->bridge->fetchForRumor($id, 'game', true);
            $for_platforms = $this->bridge->fetchForRumor($id, 'platform', true);
        }
        $data['item'] = $item;
        $data['for_games'] = $for_games;
        $data['for_platforms'] = $for_platforms;
        
        $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length['.TITLE_MAX_LENGTH.']');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length['.DESCRIPTION_MAX_LENGTH.']');
        $this->form_validation->set_rules('games[]', 'Games', 'trim|required');
        $this->form_validation->set_rules('platforms[]', 'Platforms', 'trim|required');
        
        if ($this->form_validation->run() && (!$item || !$item->thumbnail) &&isset($_FILES['thumbnail']['size']) && $_FILES['thumbnail']['size'] !== 0) {
        
            if ($this->upload->do_upload('thumbnail')) {
                
                if ($id) {
                    
                    $this->_deleteImage($id);
                }
                
                $_POST['thumbnail'] = $this->upload->file_name;
            }            
            
            $games = $_POST['games'];
            unset($_POST['games']);
            
            $platforms = $_POST['platforms'];
            unset($_POST['platforms']);
            
            $insert = false; 
            if ($id) {
                $this->model->update($_POST, $id);
            } else {
                
                $_POST['created'] = date('Y-m-d H:i:s', time());
                
                $id = $this->model->insert($_POST);
                
                $insert = true;
            }
            
            $rows = $this->bridge->fetchForRumor($id);
            //dump($rows); die;
            $this->bridge->delete(array('rumor_id'=>$id));
            
            foreach ($games as $game) {
                foreach ($platforms as $platform) {
                    $d = array(
                        'rumor_id'=>$id, 
                        'game_id'=>$game, 
                        'platform_id'=>$platform,
                    );
                    if ($rows) {
                        
                        foreach ($rows as $row) {
                            if ($row->game_id == $game && $row->platform_id == $platform) {
                                
                                $d['link_text'] = $row->link_text;
                                $d['link_url'] = $row->link_url;
                                $d['image'] = $row->image;
                            }
                        }
                    }
                    $this->bridge->insert($d);
                    $insert = true;
                }
            }
            
            /*
                TODO delete files from uploads/original which are not in db
            */
            
            $this->session->set_userdata('rumor_edited', true);
            
            if (!$this->uri->segment(3)) {
                redirect(base_url() . 'rumor/settings/'.$id);
            }
            
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($_FILES && (!isset($_FILES['thumbnail']['size']) || $_FILES['thumbnail']['size'] === 0)) {
                
                $data['file_missing'] = 'Thumbnail is required';
            }
        }
        $this->template->build('rumor/edit', $data);
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            
            $this->load->model('Bridge', 'bridge');
            
            $this->bridge->delete(array('rumor_id'=>$id));
            
            $this->_deleteImage($id, true);
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
    
    public function settings()
    {
        $id = $this->uri->segment(3);
        
        $data = array();
        
        $this->load->model('Rumors', 'model');
        $this->load->model('Bridge', 'bridge');
        
        $data['rumor'] = $this->model->find($id);
        
        $data['items'] = $this->bridge->fetchForRumor($id);
        
        $this->template->build('rumor/settings', $data);
    }   
    
    public function activate()
    {
        $this->load->model('Rumors', 'rumor');
        
        $this->rumor->update(array('active'=>1), $this->uri->segment(3));
        
        redirect($_SERVER['HTTP_REFERER']);
    } 

    public function inactivate()
    {
        $this->load->model('Rumors', 'rumor');
        
        $this->rumor->update(array('active'=>0), $this->uri->segment(3));
        
        redirect($_SERVER['HTTP_REFERER']);
    } 
    
    private function _deleteImage($id, $withRecord = false) 
    {
        $this->load->model('Rumors', 'model');
        
        $item = $this->model->find($id);
        
        if ($item && $item->thumbnail) {
            $this->load->config('upload');
            
            @unlink($this->config->item('upload_path') . $item->thumbnail);
        }
        
        if (!$withRecord) {
            
            $this->model->update(array('thumbnail'=>null), $id);
        }
        
        return $withRecord ? $this->model->delete($id) : true;
    }   
    
    private function removeElement($array, $element)
    {
        foreach ($array as $i => $value) {
            if ($value == $element) unset($array[$i]);
        }
        
        return $array;
    } 
}