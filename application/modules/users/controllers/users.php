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
		else
		{
			$userdata = array('email' => '', 'iduser' => '', 'logged_in'=>'0', 'groups'=>'');
			//redirect(site_url(),'refresh');
			//echo 'session expired';
		}
        $this->load->model('users_model');
    }

    public function index()
    {
        if($this->session->userdata('logged_in')=='1')
        {
        	$this->users_model->update(array('last_action'=>date('Y-m-d H:i:s')),array('idusers'=>$this->udata['id']));
            return TRUE;
            //redirect(site_url(),'refresh');
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
        	if($this->session->userdata('logged_in')=='1')
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
			else
			{
				redirect('users/login');
			}

        }
    }
    public function login()
    {
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
                		echo 'Incorrect email/password. Stop trying and contact administrator.';
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
    	if($this->session->userdata('logged_in')=='1')
        {
	        $userdata = array('email' => '', 'iduser' => '', 'logged_in'=>'', 'groups'=>'');
	        $this->session->unset_userdata($userdata);
	        $this->session->sess_destroy();
		}
	    redirect('users/login','refresh');
    }
    public function get_users($nogroup=null)
    {
    	if($this->session->userdata('logged_in')=='1')
        {
	        if($this->in_groups(array('admin')))
	        {
	        	$users_nogroup = $this->users_model->get_users_nogroup();
				if(!empty($nogroup) && $nogroup == 'nogroup')
				{
					$users = $this->users_model->get_users_nogroup();
				}
				else
				{
					$users = $this->users_model->get_users();
				}
				if(!empty($users))
				{
					$users_arr = array();
					foreach($users as $user)
					{
						if(!array_key_exists($user->idusers, $users_arr))
						{
							$users_arr[$user->idusers] = array('idusers'=>$user->idusers,'name'=>$user->first_name.' '.$user->last_name,'email'=>$user->email,'status'=>$user->status,'last_login'=>$user->last_login,'groups'=>array($user->idgroups=>$user->namegroups));
						}
						else
						{
							$users_arr[$user->idusers]['groups'][$user->idgroups]=$user->namegroups;
						}
					}
				}
	            $data['users'] = $users_arr;
				if(!empty($users_nogroup))
				{
					$data['nogroup'] = sizeof($users_nogroup);
				}
				else
				{
					$data['nogroup'] = '0';
				}
				if(!empty($nogroup) && $nogroup == 'nogroup')
				{
					$this->load->view('users_nogroup_view',$data);
				}
				else
				{
					$this->load->view('users_view',$data);
				}

	        }
	        else
	        {
	            redirect(site_url(),'refresh');
	        }
		}
		else
		{
			redirect('users/login','refresh');
		}
    }

	public function add_user()
	{
		if(($this->session->userdata('logged_in')=='1') && $this->in_groups(array('admin')))
        {
        	$groups = $this->users_model->get_groups();
			$data['groups']=$groups;
        	$this->load->view('user_add_view',$data);
		}
		else
		{
			redirect(site_url(),'refresh');
		}

	}
	public function add_user_submit()
	{
		if(($this->session->userdata('logged_in')=='1') && $this->in_groups(array('admin')))
        {
			$this->form_validation->set_rules('first_name','First name','trim|min_length[3]|required');
			$this->form_validation->set_rules('last_name','Last name','trim|min_length[3]|required');
			$this->form_validation->set_rules('email','Email','trim|valid_email|is_unique[users.email]|required');
			$this->form_validation->set_rules('password','Password','trim|min_length[6]');
			$this->form_validation->set_rules('password_check','Password check','trim|min_length[6]|matches[password]');
			$this->form_validation->set_rules('groups[]','Groups','trim|is_natural');
			if($this->form_validation->run($this)===FALSE)
			{
				$this->add_user();
				//$this->load->view('user_edit_view');
			}
			else
			{
				$first_name = $this->input->post('first_name');
				$last_name = $this->input->post('last_name');
				$email = $this->input->post('email');
				$password = md5($this->input->post('password'));
				$groups = $this->input->post('groups');
				$iduser = $this->users_model->add_user(array('email'=>$email,'password'=>$password));
				if(!empty($iduser))
				{
					if($this->users_model->add_user_details(array('first_name'=>$first_name,'last_name'=>$last_name,'idusers'=>$iduser)) && $this->users_model->update_user_groups($groups,array('idusers'=>$iduser)))
					{
						redirect('users/get_users','refresh');
					}
					else
					{
						echo 'bummer. something went wrong...';
					}
				}
				else
				{
					echo 'bummer. something went wrong...';
				}
			}
		}
		else
		{
			redirect(site_url(),'refresh');
		}
	}
	public function edit_user($iduser)
	{
		if($this->session->userdata('logged_in')=='1')
        {
			if($iduser == $this->udata['id'])
			{
				redirect('users/profile','refresh');
			}
			if($this->in_groups(array('admin')))
			{
				$user = $this->users_model->get_user(array('users.idusers'=>$iduser));
				$usergroups = $this->users_model->get_user_groups(array('users_groups.idusers'=>$iduser));
				$usergroups_arr = array();
				if(!empty($usergroups))
				{
					foreach($usergroups as $group)
					{
						$usergroups_arr[]=$group['idgroups'];
					}
				}
				//print_r($usergroups_arr);
				$groups = $this->users_model->get_groups();
				if(!empty($groups))
				{
					$options = array();
					foreach($groups as $group)
					{
						if(in_array($group->idgroups,$usergroups_arr))
						{
							$checked = TRUE;
						}
						else
						{
							$checked = FALSE;
						}
						$options[]=array('value'=>$group->idgroups,'name'=>$group->name,'checked'=>$checked);
					}
				}
				$data['groupoptions'] = $options;
				$data['user'] = $user;
				$this->load->view('user_edit_view',$data);
			}
			else
			{
				redirect(site_url(),'refresh');
			}
		}
		else
		{
			redirect('users/login','refresh');
		}
	}
	public function edit_user_submit()
	{
		if($this->session->userdata('logged_in')=='1')
        {
			if($this->in_groups(array('admin')))
			{
				$this->form_validation->set_rules('id_user','ID user','trim|is_natural_no_zero|required');
				//$this->form_validation->set_rules('id_user','ID user','callback_id_check');
				$this->form_validation->set_rules('first_name','First name','trim|min_length[3]|required');
				$this->form_validation->set_rules('last_name','Last name','trim|min_length[3]|required');
				$this->form_validation->set_rules('email','Email','trim|valid_email|callback_email_check|required');
				$this->form_validation->set_rules('password','Password','trim|min_length[6]');
				$this->form_validation->set_rules('password_check','Password check','trim|min_length[6]|matches[password]');
				$this->form_validation->set_rules('groups[]','Groups','trim|is_natural');
				if($this->form_validation->run($this)===FALSE)
				{
					$this->edit_user($this->input->post('id_user'));
					//$this->load->view('user_edit_view');
				}
				else
				{
					$where_arr = array();
					$id_user = $this->input->post('id_user');
					if($id_user == $this->udata['id'])
					{
						redirect('users/own_settings','refresh');
					}
					else
					{

						$where_arr['idusers'] = $id_user;
						$newdata = array();
						$email = $this->input->post('email');
						$potentialuser = $this->users_model->get_user(array('users.idusers !='=>$id_user,'users.email'=>$email));
						if(!empty($potentialuser))
						{
							echo 'Email address is already in use by another user. Return and try a new email';
							exit;
						}
						$user = $this->users_model->get_user(array('users.idusers'=>$id_user));
						if($user->email!=$email)
						{
							$newdata['email'] = $email;
						}
						$password = $this->input->post('password');
						if(!empty($password))
						{
							$newdata['password'] = md5($password);
						}
						if(!empty($newdata))
						{
							$this->users_model->update_user($newdata,$where_arr);
						}
						$newdetailsdata = array();
						$first_name = $this->input->post('first_name');
						if($user->first_name!=$first_name)
						{
							$newdetailsdata['first_name'] = $first_name;
						}
						$last_name = $this->input->post('last_name');
						if($user->last_name!=$last_name)
						{
							$newdetailsdata['last_name'] = $last_name;
						}
						if(!empty($newdetailsdata))
						{
							$this->users_model->update_user_details($newdetailsdata,$where_arr);
						}
						$groups = $this->input->post('groups');
						$this->users_model->update_user_groups($groups,$where_arr);
						redirect('users/get_users','refresh');
					}

				}
			}
		}
		else
		{
			redirect('users/login','refresh');
		}
	}
	public function change_status()
	{
		if(($this->session->userdata('logged_in')=='1') && $this->in_groups(array('admin')))
        {
        	$iduser = $this->uri->segment(3);
			$newstatus = $this->uri->segment(4);
			if($iduser!=$this->udata['id'])
			{
				if($this->users_model->update_user(array('status'=>$newstatus),array('idusers'=>$iduser))===FALSE)
				{
					echo 'damn it... something went terribly wrong...';
					exit;
				}
			}
			redirect('users/get_users','refresh');
		}
		else {
			redirect(site_url(),'refresh');
		}
	}
	public function delete_user()
	{
		if(($this->session->userdata('logged_in')=='1') && $this->in_groups(array('admin')))
        {
        	$iduser = $this->uri->segment(3);
			if($iduser!=$this->udata['id'])
			{
				if($this->users_model->delete_user(array('idusers'=>$iduser,'status'=>'0'))===FALSE)
				{
					echo 'damn it... something went terribly wrong on users table';
					exit;
				}
				if($this->users_model->delete_user_details(array('idusers'=>$iduser))===FALSE)
				{
					echo 'damn it... something went wrong on user details table';
					exit;
				}
				if($this->users_model->delete_user_groups(array('idusers'=>$iduser))===FALSE)
				{
					echo 'damn it... something went wrong on user groups table';
					exit;
				}
			}
			redirect('users/get_users','refresh');
		}
		else
		{
			redirect(site_url(),'refresh');
		}
	}

	public function get_groups()
    {
    	if($this->session->userdata('logged_in')=='1')
        {
	        if($this->in_groups(array('admin')))
	        {
	            $groups = $this->users_model->get_groups();
	            $data['groups'] = $groups;
	            $this->load->view('groups_view',$data);
	        }
	        else
	        {
	            redirect(site_url(),'refresh');
	        }
		}
		else
		{
			redirect('users/login','refresh');
		}
    }
	public function add_group()
	{
		if($this->session->userdata('logged_in')=='1')
		{
			if($this->in_groups(array('admin')))
	        {
	        	$this->load->view('group_add_view');
	        }
	        else
	        {
	            redirect(site_url(),'refresh');
	        }
		}
		else
		{
			redirect('users/login','refresh');
		}
	}
	public function add_group_submit()
	{
		if($this->session->userdata('logged_in')=='1')
		{
			if($this->in_groups(array('admin')))
	        {
	        	$this->form_validation->set_rules('name','Group name','trim|alpha|required');
				$this->form_validation->set_rules('description','Group description','trim|required');
				if($this->form_validation->run()===FALSE)
				{
					$this->load->view('group_add_view');
				}
				else
				{
					$group_name = strtolower($this->input->post('name'));
					$group_description = $this->input->post('description');
					if(!$this->users_model->add_group(array('description'=>$group_description, 'name'=>$group_name)))
					{
						echo 'Damn it... Are there too many groups or whaaaaaaaat?...';
						exit;
					}
					redirect('users/get_groups','refresh');
				}

	        }
	        else
	        {
	            redirect(site_url(),'refresh');
	        }
		}
		else
		{
			redirect('users/login','refresh');
		}
	}
	public function edit_group()
	{
		if($this->session->userdata('logged_in')=='1')
		{
			if($this->in_groups(array('admin')))
	        {
	        	$idgroup = $this->uri->segment(3);
	            $group = $this->users_model->get_group(array('idgroups'=>$idgroup));
	            $data['group'] = $group;
	            $this->load->view('group_edit_view',$data);
	        }
	        else
	        {
	            redirect(site_url(),'refresh');
	        }
		}
		else
		{
			redirect('users/login','refresh');
		}
	}
	public function edit_group_submit()
	{
		if($this->session->userdata('logged_in')=='1')
		{
			if($this->in_groups(array('admin')))
	        {
	        	$this->form_validation->set_rules('id_group','Group ID','trim|is_natural_no_zero|required');
				$this->form_validation->set_rules('description','Group description','trim|required');
				if($this->form_validation->run()===FALSE)
				{
					$this->load->view('group_edit_view');
				}
				else
				{
					$group_id = $this->input->post('id_group');
					$group_description = $this->input->post('description');
					if(!($this->users_model->update_group(array('description'=>$group_description),array('idgroups'=>$group_id))))
					{
						echo 'Damn it... I almost had it...';
						exit;
					}
					redirect('users/get_groups','refresh');
				}

	        }
	        else
	        {
	            redirect(site_url(),'refresh');
	        }
		}
		else
		{
			redirect('users/login','refresh');
		}
	}
	public function delete_group()
	{
		if($this->session->userdata('logged_in')=='1')
		{
			if($this->in_groups(array('admin')))
	        {
	        	$idgroup = $this->uri->segment(3);
				if($idgroup != '1')
				{
					if(!$this->users_model->delete_group(array('idgroups'=>$idgroup)))
					{
						echo 'Errors! Oh, so many errors!...';
						exit;
					}
					redirect('users/get_groups','refresh');
				}
				else
				{
					redirect('users/get_groups','refresh');
				}
	        }
	        else
	        {
	            redirect(site_url(),'refresh');
	        }
		}
		else
		{
			redirect('users/login','refresh');
		}
	}
	public function profile()
	{
		if($this->session->userdata('logged_in')=='1')
        {
			$iduser = $this->udata['id'];
			$user = $this->users_model->get_user(array('users.idusers'=>$iduser));
			$data['user']=$user;
			$usergroups = $this->users_model->get_user_groups(array('users_groups.idusers'=>$iduser));
			$data['usergroups'] = $usergroups;
			$this->load->view('profile_view',$data);
		}
		else
		{
			redirect('users/login','refresh');
		}
	}
}