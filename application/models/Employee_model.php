<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_model extends CI_Model
{
    public function getAll()
    {
        // Mengambil semua data karyawan beserta nama posisi (position).
        $this->db->select('employee.*, position.name AS position_name');
        $this->db->from('employee');
        $this->db->join('position', 'position.id = employee.position_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getById($id)
    {
        // Mengambil data karyawan berdasarkan ID beserta nama posisi.
        $this->db->select('employee.*, position.name AS position_name');
        $this->db->from('employee');
        $this->db->join('position', 'position.id = employee.position_id', 'left');
        $this->db->where('employee.id', $id);
        return $this->db->get()->row_array();
    }

    public function insert($data)
    {
        // Menambahkan data karyawan baru.
        return $this->db->insert('employee', $data);
    }

    public function update($id, $data)
    {
        // Memperbarui data karyawan berdasarkan ID.
        $this->db->where('id', $id);
        return $this->db->update('employee', $data);
    }

    public function delete($id)
    {
        // Menghapus data karyawan berdasarkan ID.
        $this->db->where('id', $id);
        return $this->db->delete('employee');
    }

    public function deleteWithUser($id)
    {
        // Menghapus data karyawan beserta data user yang terhubung.
        $this->db->delete('users', ['employee_id' => $id]);
        return $this->db->delete('employee', ['id' => $id]);
    }

    public function getByEmail($email)
    {
        // Mengambil data karyawan berdasarkan email.
        return $this->db->get_where('employee', ['email' => $email])->row_array();
    }
}
