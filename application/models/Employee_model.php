<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_model extends CI_Model
{
    public function getAll()
    {
        $this->db->select('employee.*, potition.name as potition_name');
        $this->db->from('employee');
        $this->db->join('potition', 'potition.id = employee.potition_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getById($id)
    {
        $this->db->select('employee.*, potition.name as potition_name');
        $this->db->from('employee');
        $this->db->join('potition', 'potition.id = employee.potition_id', 'left');
        $this->db->where('employee.id', $id);
        return $this->db->get()->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('employee', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('employee', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('employee');
    }
}
