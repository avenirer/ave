<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries extends MX_Controller {
    protected $udata = array();
    //private $currenturl = '';
    public function __construct() {
        parent::__construct();
        Modules::run('users/index');
        $forgroups = array();
        Modules::run('users/in_groups',$forgroups);
    }
	public function index()
	{
		$this->load->view('galleries_homepage_view');
	}
	public function add_gallery()
	{
		
	}
}
