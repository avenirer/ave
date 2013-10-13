<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends MY_Model
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
  public function get_users()
  {
      $this->db->join('user_details','users.idusers=user_details.idusers','left');
      $this->db->order_by('user_details.first_name');
      $this->db->select('users.idusers,users.email,users.status,user_details.first_name,users.last_login,user_details.last_name');
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
}
