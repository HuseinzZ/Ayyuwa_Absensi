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

    public function delete($id)
    {
        return $this->db->delete('attendance', ['id' => $id]);
    }

    public function getTodayAll()
    {
        $today = date('Y-m-d');
        $query = $this->db->get_where('attendance', ['attendance_date' => $today]);

        return ($query) ? $query->result_array() : [];
    }

    public function getStatus($employee_id, $attendance_date)
    {
        $this->db->select('check_in, check_out, status_in, status_out');
        $this->db->from('attendance');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('attendance_date', $attendance_date);
        $query = $this->db->get();

        if (!$query || $query->num_rows() == 0) {
            // Belum ada record untuk hari ini, maka statusnya adalah ABSENT.
            return 'Absent';
        }

        $row = $query->row_array();

        if (!empty($row['check_out'])) {
            // Jika sudah Check-out, kembalikan status_out
            return $row['status_out']; // 'On Time' atau 'Left Early'
        } elseif (!empty($row['check_in'])) {
            // Jika sudah Check-in tapi belum Check-out, kembalikan status_in
            return $row['status_in']; // 'Present' atau 'Late'
        }

        // Seharusnya tidak tercapai, tapi untuk safety
        return 'Absent';
    }

    public function getAllWithUsers()
    {
        $this->db->select('attendance.*, users.name, users.username');
        $this->db->from('attendance');
        $this->db->join('users', 'users.employee_id = attendance.employee_id');
        $this->db->order_by('attendance.date', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getAllWithEmployee()
    {
        $this->db->select('attendance.*, employee.name as employee_name, employee.email');
        $this->db->from('attendance');
        $this->db->join('employee', 'employee.id = attendance.employee_id');
        $this->db->order_by('attendance.attendance_date', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where('attendance', ['id' => $id])->row_array();
    }

    public function getByIdWithEmployeeName($id)
    {
        $this->db->select('attendance.*, employee.name as employee_name');
        $this->db->from('attendance');
        $this->db->join('employee', 'employee.id = attendance.employee_id');
        $this->db->where('attendance.id', $id);
        return $this->db->get()->row_array();
    }

    public function getAttendanceReport($start_date, $end_date)
    {
        $this->db->select('a.*, e.name AS employee_name, p.name AS position_name');
        $this->db->from('attendance a');
        $this->db->join('employee e', 'a.employee_id = e.id');
        $this->db->join('position p', 'e.position_id = p.id', 'left');
        $this->db->where('a.attendance_date >=', $start_date);
        $this->db->where('a.attendance_date <=', $end_date);
        $this->db->order_by('a.attendance_date', 'ASC');
        $this->db->order_by('e.name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
