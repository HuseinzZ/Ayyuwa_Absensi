<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function getDataForDashboard()
    {
        // // menampilkan data dari tabel shift
        // $d['shift'] = $this->db->get('shift')->result_array();
        // // menampilkan jumlah data dari tabel shift
        // $d['c_shift'] = $this->db->get('shift')->num_rows();

        // $d['location'] = $this->db->get('location')->result_array();
        // $d['c_location'] = $this->db->get('location')->num_rows();

        // menampilkan data dari tabel employee
        $d['employee'] = $this->db->get('employee')->result_array();
        // menampilkan jumlah data dari tabel employee
        $d['c_employee'] = $this->db->get('employee')->num_rows();

        // $d['potition'] = $this->db->get('potition')->result_array();
        // $d['c_potition'] = $this->db->get('potition')->num_rows();

        // menampilkan data tabel users
        $d['users'] = $this->db->get('users')->result_array();
        // menampilkan jumlah data tabel users
        $d['c_users'] = $this->db->get('users')->num_rows();

        return $d;
    }
}
