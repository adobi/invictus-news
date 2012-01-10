<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once(BASEPATH.'core/Controller'.EXT);

class MY_Controller extends CI_Controller 
{
    //php 5 constructor
    public function __construct() 
    {

        parent::__construct();
        
        if ($this->uri->segment(1) !== 'auth' && ($this->uri->segment(1) !== 'games' && $this->uri->segment(1) !== 'press' ) && !$this->session->userdata('logged_in')) {
            
            redirect(base_url() . 'auth/login');
            
        }
    }
}
