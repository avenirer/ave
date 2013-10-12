<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->module('auth');
        $this->auth->index();
    }

	public function index()
	{
        $forgroups = array();
        $this->auth->in_groups($forgroups);
        
        
        
		$this->load->view('welcome_view');
	}
    public function test()
    {
        $this->load->view('welcome_view');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */