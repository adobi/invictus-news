<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Console extends MY_Controller 
{
    public function index() 
    {
        $data = array();
        
        $this->load->model('Games', 'game');
        $this->load->model('Platforms', 'platform');
        $this->load->model('Usergames', 'usergames');
        
        /**
         * azoknak a jatekoknak a lekerdezese amilyekhez joga van az aktualis usernek
         *
         * @author Dobi Attila
         */
        $games = $this->usergames->fetchForUser(@$this->session->userdata('logged_in')->id);
        if (!$games) {
            //$games = $this->game->toAssocArray('id', 'name', $this->game->fetchAll(array('order'=>array('by'=>'name', 'dest'=>'asc'))));
            $games = $this->game->toAssocArray('id', 'name', $this->game->fetchAll());
        } else {
            $games = $this->usergames->toAssocArray('id', 'name', $games);
        }
        $data['games'] = $games;

        $data['platforms'] = $this->game->toAssocArray('id', 'name', $this->platform->fetchAll());        
        
        $this->form_validation->set_rules('game', 'Game', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('platform', 'Platform', 'trim|required|is_natural_no_zero');
        
        $result = false;
        
        if ($this->form_validation->run()) {
            
            $game = $_POST['game']; $platform = $_POST['platform'];
            $result = file_get_contents(base_url()."api/get_news/$game/$platform");
        }
        $data['result'] = $result;
        
        $this->template->build('console/index', $data);
    }
}