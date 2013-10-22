<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {
    protected $udata = array();
    //private $currenturl = '';
    public function __construct() {
        parent::__construct();
        
        if($this->session->userdata('logged_in')=='1')
        {
            $this->udata['id'] = $this->session->userdata('iduser');
            $this->udata['email'] = $this->session->userdata('email');
            $this->udata['groups'] = $this->session->userdata('groups');
            //$this->udata['logged'] = $this->session->userdata('logged_in');            
        }
        $this->load->model('users_model');
    }

    public function index()
    {
        //$this->currenturl = prep_url($from);
        if($this->session->userdata('logged_in')=='1')
        {
        	$this->users_model->update(array('last_action'=>date('Y-m-d H:i:s')),array('idusers'=>$this->udata['id']));
            return TRUE;
            redirect(site_url(),'refresh');
            //echo '<pre>';
            //print_r($this->udata);
            //echo '</pre>';
          //print_r($this->usergroups);
          //$this->load->view('welcome_view');
        }
        else
        {
            redirect('users/login');
        }
        
    }
    public function in_groups(array $groups_arr)
    {
        //print_r($groups_arr);
        //print_r($this->udata['groups']);
        if(empty($groups_arr))
        {
            return TRUE;
        }
        else
        {
            if(!empty($this->udata['groups']))
            {
                $allowedin = array();
                foreach($this->udata['groups'] as $group)
                {
                    $allowedin[] = $group['name'];
                }
                if(sizeof(array_intersect($allowedin, $groups_arr))>=1)
                {
                    return TRUE;
                }
                else
                {
                    redirect(site_url(),'refresh');
                }
            }
            else
            {
                return FALSE;
            }
            
        }
    }
    public function login()
    {
        if($this->session->userdata('logged_in')=='1')
        {
            $this->logout();
        }
        $this->load->view('login_view');
    }
    public function login_submit()
    {
        $this->form_validation->set_rules('email','Email','trim|valid_email|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        
        if($this->form_validation->run())
        {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $user = $this->users_model->get(array('email'=>$email,'password'=>$password,'status'=>'1'));
            if($user)
            {
                $user->groups = $this->users_model->get_user_groups(array('users_groups.idusers'=>$user->idusers));
                $userdata = array(
                    'email' => $user->email,
                    'iduser' => $user->idusers,
                    'logged_in' => '1',
                    'groups' => $user->groups
                );
                $this->session->set_userdata($userdata);
                $this->users_model->update(array('last_login'=>date('Y-m-d H:i:s'),'ip'=>$this->session->userdata('ip_address'),'login_attempts'=>'0'),array('idusers'=>$user->idusers));
                redirect(site_url(),'refresh');
                //echo $this->currenturl;
            }
			elseif($this->users_model->get(array('email'=>$email,'status'=>'1')))
            {
            	$emailpresent = $this->users_model->get(array('email'=>$email,'status'=>'1'));
            	if(!empty($emailpresent))
				{
					if($emailpresent->login_attempts<5)
					{
						$attempts = $emailpresent->login_attempts+1;
						$this->users_model->update(array('login_attempts'=>$attempts,'ip'=>$this->session->userdata('ip_address')),array('email'=>$email));
                		echo 'Incorrect email/password. Try again';
                	}
					else
					{
						$this->users_model->update(array('status'=>'0','ip'=>$this->session->userdata('ip_address')),array('email'=>$email));
                		echo 'Incorrect email/password. Stop trying';
					}
				}
            }
			else
			{
				echo 'Contact administrator';
			}
            
            //$password = hash('sha256', $this->input->post('password'));
            //echo $password;
            
            //redirect('auth/members');
        }
        else
        {
            $this->load->view('login_view');
        }
    }
    public function logout()
    {
        $userdata = array('email' => '', 'iduser' => '', 'logged_in'=>'', 'groups'=>'');
        $this->session->unset_userdata($userdata);
        $this->session->sess_destroy();
        redirect('users/login','refresh');
    }
    public function get_users()
    {
        if($this->in_groups(array('admin')))
        {
            $users = $this->users_model->get_users();
            $data['users'] = $users;
            $this->load->view('users_view',$data);
        }
        else
        {
            redirect(site_url(),'refresh');
        }
    }
	public function edit_user($iduser)
	{
		if($this->in_groups(array('admin')))
		{
			$user = $this->users_model->get(array('id'=>$iduser));
		}
	}
}