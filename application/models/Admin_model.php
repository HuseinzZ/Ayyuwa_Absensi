<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getAdmin($username)
    {
        $account = $this->db->get_where('users', ['username' => $username])->row_array();
        $e_id = $account['employee_id'];
        $query = "SELECT  employee.id AS `id`,
                      employee.name AS `name`,
                      employee.gender AS `gender`,   
                      employee.shift_id AS `shift`,
                      employee.image AS `image`,
                      employee.birth_date AS `birth_date`,
                      employee.hire_date AS `hire_date`
                FROM  employee
               WHERE `employee`.`id` = '$e_id'";
        return $this->db->query($query)->row_array();
    }
    public function getDataForDashboard()
    {
        // menampilkan data dari tabel shift
        $d['shift'] = $this->db->get('shift')->result_array();
        // menampilkan jumlah data dari tabel shift
        $d['c_shift'] = $this->db->get('shift')->num_rows();

        // $d['location'] = $this->db->get('location')->result_array();
        // $d['c_location'] = $this->db->get('location')->num_rows();

        // menampilkan data dari tabel employee
        $d['employee'] = $this->db->get('employee')->result_array();
        // menampilkan jumlah data dari tabel employee
        $d['c_employee'] = $this->db->get('employee')->num_rows();

        $d['potition'] = $this->db->get('potition')->result_array();
        $d['c_potition'] = $this->db->get('potition')->num_rows();

        // menampilkan data tabel users
        $d['users'] = $this->db->get('users')->result_array();
        // menampilkan jumlah data tabel users
        $d['c_users'] = $this->db->get('users')->num_rows();

        return $d;
    }

    public function getPotition()
    {
        $query = "SELECT  potition.id AS p_id,
                      potition.name AS p_name,
                      COUNT(employee_department.employee_id) AS d_quantity
                FROM  potition
                JOIN  employee_potition
                  ON  potition.id = employee_department.potition_id
            GROUP BY  d_name
    ";
        return $this->db->query($query)->result_array();
    }

    public function getPotitionEmployee($d_id)
    {
        $query = "SELECT  employee_potition.employee_id AS e_id,
                      employee.name AS e_name,
                      employee.image AS e_image,
                      employee.hire_date AS e_hdate
                FROM  employee_potition
          INNER JOIN  employee
                  ON  employee_potition.employee_id = employee.id
               WHERE  employee_potition.department_id = '$p_id'
    ";
        return $this->db->query($query)->result_array();
    }

    // public function getEmployeeStatsbyCurrent($e_id)
    // {
    //     $year = date('Y', time());
    //     $month = date('m', time());
    //     $query = "SELECT  in_time AS `date`,
    //                   out_time AS `out_time`,
    //                   shift_id AS `shift`,
    //                   in_status AS `status`,
    //                   lack_of AS `lack_of`
    //             FROM  attendance
    //             WHERE  employee_id = $e_id
    //               AND  YEAR(FROM_UNIXTIME(in_time)) = $year
    //               AND  MONTH(FROM_UNIXTIME(in_time)) = $month
    //         ORDER BY  `date` ASC";

    //     return $this->db->query($query)->result_array();
    // }
}
