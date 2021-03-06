<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model
{
    public function __construct() {
    parent::__construct();
	$this->load->library('subquery');
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
  public function get_group($where_arr)
  {
  	$this->db->where($where_arr);
	$this->db->order_by('name','asc');
  	$query = $this->db->get('groups');
	if($query->num_rows()==1)
	{
		return $query->row();
	}
	else
	{
		return FALSE;
	}
  }
	public function add_group($cols)
	{
		$this->db->limit(1);
		$this->db->insert('groups',$cols);
		if($this->db->affected_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function update_group($cols,$where_arr)
	{
		$this->db->where($where_arr);
		$this->db->limit(1);
		$this->db->update('groups',$cols);
		if($this->db->affected_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function delete_group($where_arr)
	{
		if($this->db->delete('groups',$where_arr) && $this->db->delete('users_groups',$where_arr))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function get_users($where_arr = null)
	{
		if(!empty($where_arr))
		{
			$this->db->where($where_arr);
		}
		$this->db->join('user_details','users.idusers=user_details.idusers','left');
		$this->db->join('users_groups','users.idusers=users_groups.idusers');
		$this->db->join('groups','users_groups.idgroups = groups.idgroups');
		$this->db->order_by('user_details.first_name');
		$this->db->select('users.idusers,users.email,users.status,users.last_login,user_details.first_name,user_details.last_name, groups.name as namegroups, groups.idgroups');
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
	public function get_users_nogroup()
	{
		$this->db->join('users_groups','users.idusers=users_groups.idusers','left');
		$this->db->where('users_groups.idusers',NULL);
		$this->db->join('user_details','users.idusers=user_details.idusers','left');
		$this->db->join('groups','users_groups.idgroups = groups.idgroups','left');
		$this->db->order_by('user_details.first_name');
		$this->db->select('users.idusers,users.email,users.status,users.last_login,user_details.first_name,user_details.last_name, groups.name as namegroups, groups.idgroups');
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
          return false;
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
  public function add_user($cols)
  {
  	$this->db->limit(1);
	$q = $this->db->insert('users',$cols);
	if($this->db->affected_rows()==1)
	{
		return $this->db->insert_id();
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
  public function add_user_details($cols)
  {
  	$this->db->limit(1);
	$q = $this->db->insert('user_details',$cols);
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
	if(!empty($groups))
	{
		foreach($groups as $group)
		{
			$this->db->where($where_arr);
			$this->db->insert('users_groups',array('idusers'=>$where_arr['idusers'],'idgroups'=>$group));
		}
	}
	return true;
  }
  public function delete_user($where_arr)
  {
  	$this->db->where($where_arr);
	$this->db->limit(1);
	$this->db->delete('users');
	if($this->db->affected_rows()>0)
	{
		return true;
	}
	else
	{
		return false;
	}
  }
  public function delete_user_details($where_arr)
  {
  	$this->db->where($where_arr);
	$this->db->limit(1);
	$this->db->delete('user_details');
	if($this->db->affected_rows()>0)
	{
		return true;
	}
	else
	{
		return false;
	}
  }
  public function delete_user_groups($where_arr)
  {
  	$this->db->where($where_arr);
	$this->db->limit(1);
	$this->db->delete('users_groups');
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
