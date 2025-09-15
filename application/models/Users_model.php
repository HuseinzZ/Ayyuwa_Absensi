<?php
class Users_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('users')->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function getByUsername($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }

    public function getByUsernameWithEmployeeData($username)
    {
        $this->db->select('users.*, employee.*, potition.id AS potition_id, potition.name AS potition_name');
        $this->db->from('users');
        $this->db->join('employee', 'users.employee_id = employee.id', 'inner');
        $this->db->join('potition', 'employee.potition_id = potition.id', 'left');
        $this->db->where('users.username', $username);
        return $this->db->get()->row_array();
    }

    public function getAllUsersWithEmployeeData()
    {
        $this->db->select('employee.id AS e_id, potition.id AS d_id, users.username AS u_username, employee.name AS e_name');
        $this->db->from('employee');
        $this->db->join('potition', 'employee.potition_id = potition.id', 'inner');
        $this->db->join('users', 'employee.id = users.employee_id', 'left');
        $this->db->order_by('employee.id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function insert($data)
    {
        return $this->db->insert('users', $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('users', $data, ['id' => $id]);
    }

    public function updateByUsername($username, $data)
    {
        return $this->db->update('users', $data, ['username' => $username]);
    }

    public function delete($id)
    {
        return $this->db->delete('users', ['id' => $id]);
    }

    public function deleteByUsername($username)
    {
        return $this->db->delete('users', ['username' => $username]);
    }
}
