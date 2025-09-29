<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function getDataForDashboard()
    {
        // Jumlah data employee
        $d['c_employee'] = $this->db->get('employee')->num_rows();

        // Jumlah data position (hati-hati: di DB tertulis "position")
        $d['c_position'] = $this->db->get('position')->num_rows();

        // Jumlah data users
        $d['c_users'] = $this->db->get('users')->num_rows();

        // Jumlah attendance hari ini
        $today_date = date('Y-m-d');
        $this->db->from('attendance');
        $this->db->where('attendance_date', $today_date);
        $d['c_attendance_today'] = $this->db->count_all_results();

        return $d;
    }

    public function getMonthlyAttendanceCount()
    {
        $year = date('Y');

        // Hitung jumlah kehadiran per bulan di tahun berjalan
        $this->db->select("MONTH(attendance_date) as month, COUNT(id) as total");
        $this->db->where("YEAR(attendance_date)", $year);
        $this->db->where("check_in IS NOT NULL");
        $this->db->group_by("MONTH(attendance_date)");
        $query = $this->db->get('attendance');

        // Inisialisasi hasil untuk 12 bulan dengan nilai 0
        $results = array_fill(1, 12, 0);

        foreach ($query->result_array() as $row) {
            $results[(int)$row['month']] = (int)$row['total'];
        }

        return array_values($results);
    }

    public function getAttendanceStatusCounts()
    {
        // Hitung jumlah kehadiran berdasarkan status_in (Present atau Late)
        $this->db->select("status_in, COUNT(id) as total");
        $this->db->where("check_in IS NOT NULL");
        $this->db->group_by("status_in");
        $query = $this->db->get('attendance');

        $present_late_counts = ['Present' => 0, 'Late' => 0];
        $total_all_attendance = 0;

        foreach ($query->result_array() as $row) {
            if (isset($present_late_counts[$row['status_in']])) {
                $present_late_counts[$row['status_in']] = (int)$row['total'];
            }
            $total_all_attendance += (int)$row['total'];
        }

        if ($total_all_attendance == 0) {
            $percentages = ['Present' => 0, 'Late' => 0];
        } else {
            $percentages = [
                'Present' => (int) round(($present_late_counts['Present'] / $total_all_attendance) * 100),
                'Late'    => (int) round(($present_late_counts['Late'] / $total_all_attendance) * 100)
            ];

            $total_percentage = $percentages['Present'] + $percentages['Late'];
            if ($total_percentage != 100) {
                $percentages['Present'] += (100 - $total_percentage);
            }
        }

        return [
            'counts'               => $present_late_counts,
            'percentages'          => $percentages,
            'total_all_attendance' => $total_all_attendance
        ];
    }
}
