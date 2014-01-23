<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends MX_Controller {
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
		$articles = $this->cache->get('articles_list_articles');
		if(empty($articles))
		{
			$this->load->model('articles_model');
			$articles = $this->articles_model->list_articles();
			if(!empty($articles))
			{
				$this->cache->write($articles, 'articles_list_articles');
			}
		}
		$data['articles'] = $articles;
		$this->load->view('articles_homepage_view',$data);
	}
	public function add_article()
	{
		$data['categories'] = Modules::run('articles/categories/get_categories');
		$data['authors'] = Modules::run('articles/authors/get_authors');
		$this->load->view('articles_add_view',$data);
	}
	public function edit_article($idarticle)
	{
		$idarticle = intval($idarticle);
		if(!empty($idarticle))
		{
			$this->load->model('articles_model');
			$data['editarticle'] = $this->articles_model->get(array('id'=>$idarticle));
			$data['categories'] = Modules::run('articles/categories/get_categories');
			$data['authors'] = Modules::run('articles/authors/get_authors');
			$this->load->view('articles_edit_view',$data);
		}
	}
	public function add_article_submit()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('author','Author','trim|is_natural');
		$this->form_validation->set_rules('url','URL','trim|is_unique(articles.url)');
		$this->form_validation->set_rules('page_title','Page title','trim');
		$this->form_validation->set_rules('category','Category','trim|is_natural|required');
		$this->form_validation->set_rules('teaser','Teaser','trim|required');
		$this->form_validation->set_rules('description','Description','trim');
		$this->form_validation->set_rules('body','Body','trim|required');
		$this->form_validation->set_rules('keywords','Keywords','trim|required');
		if($this->form_validation->run()===FALSE)
		{
			$data['categories'] = Modules::run('articles/categories/get_categories');
			$data['authors'] = Modules::run('articles/authors/get_authors');
			$this->load->view('articles_add_view',$data);
		}
		else
		{
			$created_by = $this->session->userdata('iduser');
			$title = strip_tags($this->input->post('title'));

			$url = $this->input->post('url');
			if(!empty($url))
			{
				$url = url_title($url,'dash');
			}
			else
			{
				$url = url_title($title,'dash');
			}
			$page_title = strip_tags($this->input->post('page_title'));
			if(empty($page_title))
			{
				$page_title = $title;
			}
			$category = intval($this->input->post('category'));
			$teaser = $this->input->post('teaser');
			$description = strip_tags($this->input->post('description'));
			if(empty($description))
			{
				$description = strip_tags($teaser);
			}
			$body = $this->input->post('body');
			$keywords = strip_tags($this->input->post('keywords'));
			$this->load->model('articles_model');
			if($this->articles_model->insert(array('id_category'=>$category,'title'=>$title,'title_tag'=>$page_title,'teaser'=>$teaser,'description'=>$description,'body'=>$body,'keywords'=>$keywords,'url'=>$url,'created_by'=>$created_by)))
			{
				redirect('articles','refresh');
			}
		}
	}

	public function edit_article_submit()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('author','Author','trim|is_natural');
		$this->form_validation->set_rules('url','URL','trim|is_unique(articles.url)|required');
		$this->form_validation->set_rules('page_title','Page title','trim');
		$this->form_validation->set_rules('category','Category','trim|is_natural|required');
		$this->form_validation->set_rules('teaser','Teaser','trim|required');
		$this->form_validation->set_rules('description','Description','trim');
		$this->form_validation->set_rules('body','Body','trim|required');
		$this->form_validation->set_rules('keywords','Keywords','trim|required');
		$this->form_validation->set_rules('idarticle','ID','trim|is_natural|required');
		if($this->form_validation->run()===FALSE)
		{
			$this->load->model('articles_model');
			$data['editarticle'] = $this->articles_model->get(array('id'=>$this->input->post('idarticle')));
			$data['categories'] = Modules::run('articles/categories/get_categories');
			$data['authors'] = Modules::run('articles/authors/get_authors');
			$this->load->view('articles_edit_view',$data);
		}
		else
		{
			$id_article = intval($this->input->post('idarticle'));
			$title = strip_tags($this->input->post('title'));
			$url = $this->input->post('url');
			$page_title = strip_tags($this->input->post('page_title'));
			if(empty($page_title))
			{
				$page_title = $title;
			}
			$category = intval($this->input->post('category'));
			$teaser = $this->input->post('teaser');
			$description = strip_tags($this->input->post('description'));
			if(empty($description))
			{
				$description = strip_tags($teaser);
			}
			$body = $this->input->post('body');
			$keywords = strip_tags($this->input->post('keywords'));
			$timestamp = date('Y-m-d H:i:s');
            $edited_by = $this->session->userdata('iduser');
			$this->load->model('articles_model');
			if($this->articles_model->update(array('id_category'=>$category,'title'=>$title,'title_tag'=>$page_title,'teaser'=>$teaser,'description'=>$description,'body'=>$body,'keywords'=>$keywords,'url'=>$url,'edited_by'=>$edited_by,'edited_at'=>$timestamp), array('id'=>$id_article)))
			{
				$this->cache->delete('articles_list_articles');
				redirect(site_url('articles'),'refresh');
			}
		}
	}

	public function change_status($article,$status)
    {
        $int_newstatus = intval($status);
        $int_category = intval($article);
		$this->load->model('articles_model');
        if($this->articles_model->update(array('status'=>$int_newstatus),array('id'=>$int_category)))
        {
            $this->cache->delete('articles_list_articles');
            redirect(site_url('articles'),'refresh');
        }
    }
}