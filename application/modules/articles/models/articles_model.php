<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Articles_model extends MY_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->table ='articles';
	}
	public function list_articles($where_arr = NULL)
	{
		if(!empty($where_arr))
		{
			$this->db->where($where_arr);
		}
		$this->db->join('authors','articles.id_author = authors.id','left');
		$this->db->join('categories','articles.id_category = categories.id','left');
		$this->db->order_by('articles.id','desc');
		$this->db->select('articles.id as article_id, articles.title as article_title, articles.created_by, articles.created_at, articles.edited_by, articles.edited_at, articles.status, authors.id as author_id, authors.first_name as author_first_name, authors.last_name as author_last_name, authors.display_as as author_display, categories.id as category_id, categories.category as category');
		$q = $this->db->get('articles');
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		else
		{
			return false;
		}
	}
}
