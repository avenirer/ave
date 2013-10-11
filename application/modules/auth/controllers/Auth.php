<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
      //print_r($this->usergroups);
      //$this->load->view('welcome_view');
    }
    public function login()
    {
      //print_r($this->usergroups);
      $this->load->view('login_view');
    }
    public function login_submit()
    {
        $this->form_validation->set_rules('email','Email','trim|valid_email|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        
        if($this->form_validation->run())
        {
            $username = $this->input->post('email');
            $password = $this->input->post('password');
            
            //redirect('auth/members');
        }
        else
        {
            $this->load->view('login_view');
        }
    }
    public function members()
    {
        echo 'ok';
    }
}