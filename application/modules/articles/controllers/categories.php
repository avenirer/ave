<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MX_Controller {
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
        $data['categories'] = $this->get_categories();
        $this->load->view('categories_homepage_view',$data);
    }
    public function add_category($int_parent = '0')
    {
        $int_parent = intval($int_parent);
        $data['parent'] = $int_parent;
        $data['categories'] = $this->get_categories();
        $this->load->view('categories_add_view',$data);
    }
    public function edit_category($id_category)
    {
        $int_category = intval($id_category);
        if(!empty($int_category))
        {
			$this->load->model('categories_model');
            $category = $this->categories_model->get(array('id'=>$int_category));
            $data['editcategory']=$category;
            $data['categories']=$this->get_categories();
            $this->load->view('categories_edit_view',$data);
        }
    }
    public function add_category_submit()
    {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('category','Category name','trim|required');
        $this->form_validation->set_rules('parent','Parent category','trim|is_natural|required');
        if($this->form_validation->run()===FALSE)
        {
            $data['categories'] = $this->get_categories();
            $this->load->view('categories_add_view',$data);
        }
        else
        {
            $str_category = htmlentities($this->input->post('category'));
            $int_parent = intval($this->input->post('parent'));
            $created_by = $this->session->userdata('iduser');
			$this->load->model('categories_model');
            if($this->categories_model->insert(array('id_parent'=>$int_parent,'category'=>$str_category,'created_by'=>$created_by)))
            {
                $this->cache->delete('articles_categories');
                redirect(site_url('articles/categories'),'refresh');
            }
        }
    }
    public function edit_category_submit()
    {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('category','Category name','trim|required');
        $this->form_validation->set_rules('parent','Parent category','trim|is_natural|required');
        $this->form_validation->set_rules('id','Category ID','trim|is_natural_no_zero|required');
        if($this->form_validation->run()===FALSE)
        {
			$this->load->model('categories_model');
            $category = $this->categories_model->get(array('id'=>$this->input->post('id')));
            $data['editcategory']=$category;
            $data['categories'] = $this->get_categories();
            $this->load->view('categories_edit_view',$data);
        }
        else
        {
            $str_category = htmlentities($this->input->post('category'));
            $int_parent = intval($this->input->post('parent'));
            $int_id_category = intval($this->input->post('id'));
            $timestamp = date('Y-m-d H:i:s');
            $edited_by = $this->session->userdata('iduser');
			$this->load->model('categories_model');
            if($this->categories_model->update(array('id_parent'=>$int_parent,'category'=>$str_category,'edited_at'=>$timestamp,'edited_by'=>$edited_by),array('id'=>$int_id_category)))
            {
                $this->cache->delete('articles_categories');
                redirect(site_url('articles/categories'),'refresh');
            }
        }
    }
    public function change_status($category,$status)
    {
        $int_newstatus = intval($status);
        $int_category = intval($category);
		$this->load->model('categories_model');
        if($this->categories_model->update(array('status'=>$int_newstatus),array('id'=>$int_category)))
        {
            $this->cache->delete('articles_categories');
            redirect(site_url('articles/categories'),'refresh');
        }
    }
    public function get_categories()
    {
        $categories = $this->cache->get('articles_categories');
        if(empty($categories))
        {
			$this->load->model('categories_model');
            $categories = $this->categories_model->get_all(NULL, 'category');
            if(!empty($categories))
            {
                $this->cache->write($categories,'articles_categories');
            }
        }
        if(!empty($categories))
        {
            return $categories;
        }
        else
        {
            return false;
        }

    }
}