<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
    // Fungsi ini untuk mendapatkan RINCIAN harian (jika masih diperlukan)
    public function getAttendanceReport($start_date, $end_date, $employee_id = null)
    {
        $this->db->select('a.*, e.name AS employee_name, p.name AS potition_name');
        $this->db->from('attendance a');
        $this->db->join('employee e', 'a.employee_id = e.id');
        $this->db->join('potition p', 'e.potition_id = p.id', 'left');
        $this->db->where('a.attendance_date >=', $start_date);
        $this->db->where('a.attendance_date <=', $end_date);

        if (!empty($employee_id) && $employee_id !== 'all') {
            $this->db->where('a.employee_id', $employee_id);
        }

        $this->db->order_by('a.attendance_date', 'ASC');
        $this->db->order_by('e.name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // FUNGSI UTAMA UNTUK RINGKASAN TOTAL KEHADIRAN
    public function getAttendanceSummary($start_date, $end_date, $employee_id = null)
    {
        $this->db->select('e.id AS employee_id, e.name AS employee_name, p.name AS potition_name, COUNT(a.id) AS total_hadir');
        $this->db->from('employee e');

        // JOIN dengan attendance dan filter berdasarkan rentang tanggal
        // LEFT JOIN memastikan semua karyawan muncul, bahkan jika total_hadir = 0
        $this->db->join(
            'attendance a',
            'a.employee_id = e.id AND a.attendance_date >= "' . $start_date . '" AND a.attendance_date <= "' . $end_date . '"',
            'left'
        );

        // Filter karyawan spesifik (jika bukan 'all')
        if (!empty($employee_id) && $employee_id !== 'all') {
            $this->db->where('e.id', $employee_id);
        }

        $this->db->join('potition p', 'e.potition_id = p.id', 'left');

        $this->db->group_by('e.id, e.name, p.name, p.id');
        $this->db->order_by('e.name', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }
}
