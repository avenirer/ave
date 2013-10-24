<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model
{
    public function __construct() {
    parent::__construct();
    $this->table ='users';
  }
  public function get_user_groups($where_arr)
  {
      $this->db->where($where_arr);
      $this->db->join('groups','users_groups.idgroups=groups.idgroups');
      $this->db->select('groups.idgroups,groups.name');
      $query = $this->db->get('users_groups');
      if($query->num_rows()>0)
      {
          foreach($query->result_array() as $row)
          {
              $data[] = $row;
          }
          return $data;
      }
      else
      {
          return FALSE;
      }
  }
  public function get_groups()
  {
  	$this->db->order_by('name','asc');
  	$query = $this->db->get('groups');
	if($query->num_rows()>0)
	{
		foreach($query->result() as $row)
		{
			$data[] = $row;
		}
		return $data;
	}
	else
	{
		return FALSE;
	}
  }
  public function get_users()
  {
      $this->db->join('user_details','users.idusers=user_details.idusers','left');
      $this->db->order_by('user_details.first_name');
      $this->db->select('users.idusers,users.email,users.status,users.last_login,user_details.first_name,user_details.last_name');
      $query = $this->db->get($this->table);
      if($query->num_rows()>0)
      {
          foreach($query->result() as $row)
          {
              $data[] = $row;
          }
          return $data;
      }
      else
      {
          return FALSE;
      }
  }
  public function get_user($where_arr)
  {
  	$this->db->join('user_details','users.idusers=user_details.idusers','left');
	$this->db->where($where_arr);
	$this->db->select('users.idusers, users.email,users.status,user_details.first_name,user_details.last_name');
	$this->db->limit(1);
	$query = $this->db->get('users');
	if($query->num_rows()>0)
	{
		return $query->row();
	}
	else
	{
		return false;
	}
  }
  public function update_user($newdata,$where_arr)
  {
  	$this->db->where($where_arr);
	$this->db->limit(1);
	$q = $this->db->update('users',$newdata);
	if($this->db->affected_rows()==1)
	{
		return true;
	}
	else
	{
		return false;
	}	
  }
  public function update_user_details($newdata,$where_arr)
  {
  	$this->db->where($where_arr);
	$this->db->limit(1);
	$q = $this->db->update('user_details',$newdata);
	if($this->db->affected_rows()==1)
	{
		return true;
	}
	else
	{
		return false;
	}	
  }
  public function update_user_groups($groups,$where_arr)
  {
  	$this->db->where($where_arr);
	$this->db->delete('users_groups');
	foreach($groups as $group)
	{
		$this->db->where($where_arr);
		$this->db->insert('users_groups',array('idusers'=>$where_arr['idusers'],'idgroups'=>$group));
	}
	return true;
  }
}
