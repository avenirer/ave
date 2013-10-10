<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {


    // here we define the groups for which the controller has visibility
    // if we define $forgroups as array('all') that means that the controller is visible by all the groups
    // the groups that are available are: 'all', 'admin','members'.
    //protected $forgroups = array('all');


    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
      //print_r($this->usergroups);
      $this->load->view('welcome_view');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */