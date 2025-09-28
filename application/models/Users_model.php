<?php
class Users_model extends CI_Model
{
    public function getAll()
    {
        // Metode ini mengambil semua data pengguna dari tabel 'users'.
        return $this->db->get('users')->result_array();
    }

    public function getById($id)
    {
        // Metode ini mengambil data pengguna tunggal berdasarkan ID pengguna (users.id).
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function getByUsername($username)
    {
        // Metode ini mengambil data pengguna tunggal berdasarkan username.
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }

    public function getByUsernameWithEmployeeData($username)
    {
        // Metode ini mengambil data pengguna berdasarkan username, digabung dengan data karyawan dan posisi terkait (untuk tampilan profil/akun).
        $this->db->select('users.*, employee.*, position.id AS position_id, position.name AS position_name');
        $this->db->from('users');
        $this->db->join('employee', 'users.employee_id = employee.id', 'inner');
        $this->db->join('position', 'employee.position_id = position.id', 'left');
        $this->db->where('users.username', $username);
        return $this->db->get()->row_array();
    }

    public function getAllUsersWithEmployeeData()
    {
        // Metode ini mengambil daftar semua karyawan, digabungkan dengan posisi dan username mereka (untuk manajemen master pengguna).
        $this->db->select('employee.id AS e_id, position.id AS d_id, users.username AS u_username, employee.name AS e_name');
        $this->db->from('employee');
        $this->db->join('position', 'employee.position_id = position.id', 'inner');
        $this->db->join('users', 'employee.id = users.employee_id', 'left');
        $this->db->order_by('employee.id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function insert($data)
    {
        // Metode ini digunakan untuk memasukkan data pengguna baru ke tabel 'users'.
        return $this->db->insert('users', $data);
    }

    public function update($id, $data)
    {
        // Metode ini digunakan untuk memperbarui data pengguna berdasarkan ID pengguna (users.id).
        return $this->db->update('users', $data, ['id' => $id]);
    }

    public function updateByUsername($username, $data)
    {
        // Metode ini digunakan untuk memperbarui data pengguna berdasarkan username.
        return $this->db->update('users', $data, ['username' => $username]);
    }

    public function delete($id)
    {
        // Metode ini digunakan untuk menghapus data pengguna berdasarkan ID pengguna (users.id).
        return $this->db->delete('users', ['id' => $id]);
    }

    public function deleteByUsername($username)
    {
        // Metode ini digunakan untuk menghapus data pengguna berdasarkan username.
        return $this->db->delete('users', ['username' => $username]);
    }

    public function getEmployees()
    {
        // Metode ini mengambil daftar semua karyawan (yaitu pengguna dengan role_id = 2) untuk mengisi dropdown filter.
        $this->db->select('employee.id, employee.name');
        $this->db->from('employee');
        $this->db->join('users', 'employee.id = users.employee_id', 'inner');
        $this->db->where('users.role_id', 2); // Hanya karyawan (role_id 2)
        $this->db->order_by('employee.name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getEmployeeDataById($employee_id)
    {
        // Metode ini mengambil nama karyawan tunggal berdasarkan ID Karyawan (employee.id).
        return $this->db->get_where('employee', ['id' => $employee_id])->row_array();
    }
}
