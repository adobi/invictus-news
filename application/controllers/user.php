<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class User extends MY_Controller 
{
    public function index() 
    {
        $data = array();
        
        $this->load->model('Users', 'model');
        
        $data['items'] = $this->model->fetchAll(array('order'=>array('by'=>'username', 'dest'=>'asc')));
        
        $this->template->build('user/index', $data);
    }
    
    public function edit() 
    {
        $data = array();
        
        $id = $this->uri->segment(3);
        
        $this->load->model('Users', 'model');
        $this->load->model('Games', 'game');
        $this->load->model('Usergames', 'usergames');
        
        $data['games'] = $this->game->toAssocArray('id', 'name', $this->game->fetchAll(array('order'=>array('by'=>'name', 'dest'=>'asc'))));
        
        $item = false;
        $usergames = false;
        if ($id) {
            $item = $this->model->find((int)$id);
            $usergames = $this->usergames->fetchForUser($id, true);
        }
        $data['item'] = $item;
        $data['usergames'] = $usergames;
        
        $this->form_validation->set_rules("username", "Username", "trim|required");
		
		if (!$id)
    		$this->form_validation->set_rules("password", "Password", "trim|required");

	    $this->form_validation->set_rules("role", "Role", "trim|required");
		
        if ($this->form_validation->run()) {
            
            $games = false;
            if ($_POST['games']) {
                
                $games = $_POST['games'];
                
                unset($_POST['games']);
            }
            
            if ($id) {
                
                if (isset($_POST['password']) && $_POST['password']) {
                    
                    $_POST['password'] = md5($_POST['password']);
                } else {
                    
                    unset($_POST['password']);
                }
                
                $this->model->update($_POST, $id);
            } else {
                
                $_POST['password'] = md5($_POST['password']);
                
                $id = $this->model->insert($_POST);
            }

            if ($games) {
                
                foreach ($games as $game) {
                    
                    $this->usergames->insert(array('game_id'=>$game, 'user_id'=>$id));
                }
            } else {
                $this->usergames->delete(array('user_id'=>$id));
            }
            
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->template->build('user/edit', $data);
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('Users', 'model');
            
            $this->model->delete($id);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
}