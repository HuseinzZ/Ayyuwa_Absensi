<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History_model extends CI_Model
{
    // Fungsi untuk mengambil riwayat kehadiran berdasarkan employee_id
    public function getByEmployee($employee_id)
    {
        $this->db->order_by('attendance_date', 'DESC');
        return $this->db->get_where('attendance', ['employee_id' => $employee_id])->result_array();
    }
}
