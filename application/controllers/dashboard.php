<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Dashboard extends MY_Controller 
{
    public function index() 
    {
        $data = array();
        
        $this->load->model("Rumors", 'model');
        $this->load->model('Games', 'game');        
        $this->load->model('Platforms', 'platform');
        $this->load->model('Usergames', 'usergames');
                
        $games = $this->usergames->fetchForUser($this->session->userdata('logged_in')->id);
        if (!$games) {
            //$games = $this->game->toAssocArray('id', 'name', $this->game->fetchAll(array('order'=>array('by'=>'name', 'dest'=>'asc'))));
            $games = $this->game->toAssocArray('id', 'name', $this->game->fetchAll());
        } else {
            $games = $this->usergames->toAssocArray('id', 'name', $games);
        }
        $data['games'] = $games;

        $data['platforms'] = $this->game->toAssocArray('id', 'name', $this->platform->fetchAll());        
        
        $result = $this->model->fetchForUser($this->session->userdata('logged_in')->id, $_POST, $this->uri->segment(3));
        
        $data['items'] = $result['result'];
        
        $data['pagination_links'] = $this->paginate('dashboard/index/', 3, $result['count']);
        
        $this->template->build('dashboard/index', $data);
    }
}