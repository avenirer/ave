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
}
