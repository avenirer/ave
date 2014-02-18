<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photos_model extends MY_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->table ='photos';
	}
	public function insert_into_table($cols,$id_field,$id,$table)
	{
		$this->db->where($id_field, $id);
		$this->db->update($table, $cols);
		if($this->db->affected_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function get_main_photo($table,$id_field,$id)
	{
		$this->db->where(array($id_field=>$id));
		$this->db->select('photo, photo_extension');
		$this->db->limit(1);
		return $this->db->get($table)->row();
	}
	public function delete_main_photo($table,$id_field,$id)
	{
		$this->db->where(array($id_field=>$id));
		$this->db->limit(1);
		$this->db->update($table,array('photo'=>'', 'photo_extension'=>''));
		if($this->db->affected_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
