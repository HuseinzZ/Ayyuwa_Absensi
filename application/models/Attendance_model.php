<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance_model extends CI_Model
{
    public function getByEmployeeAndDate($employee_id, $attendance_date)
    {
        $query = $this->db->get_where('attendance', [
            'employee_id'      => $employee_id,
            'attendance_date'  => $attendance_date
        ]);

        return ($query && $query->num_rows() > 0) ? $query->row_array() : null;
    }

    public function insert($data)
    {
        return $this->db->insert('attendance', $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('attendance', $data, ['id' => $id]);
    }

    public function getTodayAll()
    {
        $today = date('Y-m-d');
        $query = $this->db->get_where('attendance', ['attendance_date' => $today]);

        return ($query) ? $query->result_array() : [];
    }

    public function getStatus($employee_id, $attendance_date)
    {
        $this->db->select('status_in, status_out');
        $this->db->from('attendance');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('attendance_date', $attendance_date);
        $query = $this->db->get();

        if (!$query || $query->num_rows() == 0) {
            return 'Not Checked In';
        }

        $row = $query->row_array();
        if (!$row['status_in']) {
            return 'Not Checked In';
        } elseif ($row['status_in'] == 'Late') {
            return 'Late';
        } elseif ($row['status_out']) {
            return $row['status_out'];
        } else {
            return $row['status_in'];
        }
    }

    public function getByEmployee($employee_id)
    {
        $this->db->order_by('attendance_date', 'DESC');
        return $this->db->get_where('attendance', ['employee_id' => $employee_id])->result_array();
    }
}
