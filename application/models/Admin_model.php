<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getAdmin($username)
    {
        $this->db->select('e.id, e.name, e.gender, e.potition_id AS potition, 
                       e.image, e.birth_date, e.hire_date,
                       u.username, u.role_id');
        $this->db->from('users u');
        $this->db->join('employee e', 'u.employee_id = e.id');
        $this->db->where('u.username', $username);
        return $this->db->get()->row_array();
    }
}
