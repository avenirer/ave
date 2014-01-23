<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authors extends MX_Controller {
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
		$data['authors'] = $this->get_authors();
		$this->load->view('authors_homepage_view',$data);
	}
	public function add_author()
	{
            $this->load->view('authors_add_view');
	}
	public function add_author_submit()
	{
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('first_name','First name','trim|required');
			$this->form_validation->set_rules('last_name','Last name','trim');
			$this->form_validation->set_rules('display_as','Display as','trim');
            $this->form_validation->set_rules('personal_page','Personal page','trim');
            $this->form_validation->set_rules('google_plus','Google plus profile','trim|is_natural');
            $this->form_validation->set_rules('facebook','Facebook profile','trim');
			$this->form_validation->set_rules('twitter','Twitter profile','trim');
			$this->form_validation->set_rules('linkedin','Linkedin','trim');
            $this->form_validation->set_rules('about','About','trim');
            if($this->form_validation->run()===FALSE)
            {
                    $this->load->view('authors_add_view');
            }
            else
            {
                    $created_by = $this->session->userdata('iduser');
                    $first_name = strip_tags($this->input->post('first_name'));
					$last_name = strip_tags($this->input->post('last_name'));
					$display_as = strip_tags($this->input->post('display_as'));
					$personal_page = prep_url($this->input->post('personal_page'));
					$google_plus = strip_tags($this->input->post('google_plus'));
					$facebook = strip_tags($this->input->post('facebook'));
					$twitter = strip_tags($this->input->post('twitter'));
					$linkedin = strip_tags($this->input->post('linkedin'));
					$about = $this->input->post('about');
					if(!empty($display_as))
					{
						$url = url_title($display_as,'dash');
					}
					else
					{
						$url = url_title($first_name.'-'.$last_name,'dash');
					}
                    $this->load->model('authors_model');
                    if($this->authors_model->insert(array('first_name'=>$first_name,'last_name'=>$last_name,'display_as'=>$display_as,'personal_page'=>$personal_page,'google_plus'=>$google_plus,'facebook'=>$facebook, 'twitter'=>$twitter, 'linkedin'=>$linkedin, 'about'=>$about, 'url'=>$url,'created_by'=>$created_by)))
                    {
						$this->cache->delete('articles_authors');
                        redirect(site_url('articles/authors'),'refresh');
                    }
            }
	}

	public function get_authors()
    {
        $authors = $this->cache->get('articles_authors');
        if(empty($authors))
        {
			$this->load->model('authors_model');
            $authors = $this->authors_model->get_all(NULL, 'first_name, last_name');
            if(!empty($authors))
            {
                $this->cache->write($authors,'articles_authors');
            }
        }
        if(!empty($authors))
        {
            return $authors;
        }
        else
        {
            return false;
        }

    }
	public function change_status($author,$status)
    {
        $int_newstatus = intval($status);
        $int_category = intval($author);
		$this->load->model('authors_model');
        if($this->authors_model->update(array('status'=>$int_newstatus),array('id'=>$int_category)))
        {
            $this->cache->delete('articles_authors');
            redirect(site_url('articles/authors'),'refresh');
        }
    }
}