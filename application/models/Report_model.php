<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
    // Fungsi ini untuk mendapatkan RINCIAN harian kehadiran karyawan
    public function getAttendanceReport($start_date, $end_date, $employee_id = null)
    {
        // Ambil data attendance dengan informasi karyawan dan posisi
        $this->db->select('a.*, e.name AS employee_name, p.name AS position_name');
        $this->db->from('attendance a');
        $this->db->join('employee e', 'a.employee_id = e.id');
        $this->db->join('position p', 'e.position_id = p.id', 'left');

        // Filter berdasarkan rentang tanggal
        $this->db->where('a.attendance_date >=', $start_date);
        $this->db->where('a.attendance_date <=', $end_date);

        // Jika employee_id diisi dan bukan "all", filter sesuai ID karyawan
        if (!empty($employee_id) && $employee_id !== 'all') {
            $this->db->where('a.employee_id', $employee_id);
        }

        // Urutkan berdasarkan tanggal dan nama karyawan
        $this->db->order_by('a.attendance_date', 'ASC');
        $this->db->order_by('e.name', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    // Fungsi utama untuk mendapatkan RINGKASAN total kehadiran karyawan
    public function getAttendanceSummary($start_date, $end_date, $employee_id = null)
    {
        // Ambil data karyawan dengan posisi dan jumlah kehadiran (total_hadir)
        $this->db->select('e.id AS employee_id, e.name AS employee_name, p.name AS position_name, COUNT(a.id) AS total_hadir');
        $this->db->from('employee e');

        // JOIN dengan attendance menggunakan rentang tanggal
        // LEFT JOIN digunakan supaya karyawan tetap muncul meskipun tidak hadir (total_hadir = 0)
        $this->db->join(
            'attendance a',
            'a.employee_id = e.id AND a.attendance_date >= "' . $start_date . '" AND a.attendance_date <= "' . $end_date . '"',
            'left'
        );

        // Filter karyawan tertentu jika employee_id diberikan dan bukan "all"
        if (!empty($employee_id) && $employee_id !== 'all') {
            $this->db->where('e.id', $employee_id);
        }

        // JOIN ke tabel position untuk ambil nama posisi
        $this->db->join('position p', 'e.position_id = p.id', 'left');

        // Grouping supaya total_hadir dihitung per karyawan
        $this->db->group_by('e.id, e.name, p.name, p.id');

        // Urutkan hasil berdasarkan nama karyawan
        $this->db->order_by('e.name', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }
}
