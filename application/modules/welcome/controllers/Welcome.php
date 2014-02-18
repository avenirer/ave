<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MX_Controller {

    public function __construct() {
        parent::__construct();
		Modules::run('users/index');
        //$this->load->module('users');
        //$this->users->index();
    }

	public function index()
	{
        $forgroups = array();
		Modules::run('users/in_groups',$forgroups);
        //$this->users->in_groups($forgroups);
		$this->load->view('welcome_view');
	}
    public function test()
    {
        $this->load->view('welcome_view');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */