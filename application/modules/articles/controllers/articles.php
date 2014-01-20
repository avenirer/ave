<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends MX_Controller {
    protected $udata = array();
    //private $currenturl = '';
    public function __construct() {
        parent::__construct();
        Modules::run('users/index');
    }
	public function index()
	{
		$forgroups = array();
		Modules::run('users/in_groups',$forgroups);
		$this->load->view('articles_homepage_view');
	}
}