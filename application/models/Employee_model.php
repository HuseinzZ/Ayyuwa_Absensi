<?php
class Employee_model extends CI_Model
{
    public function getAll()
    {
        $this->db->select('employee.*, potition.name as potition_name');
        $this->db->from('employee');
        $this->db->join('potition', 'potition.id = employee.potition_id');
        return $this->db->get()->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where('employee', ['id' => $id])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('employee', $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('employee', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete('employee', ['id' => $id]);
    }
}
