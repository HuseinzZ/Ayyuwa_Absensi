<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Attendance_model');
        $this->load->model('Users_model');
        $this->load->model('Menu_model');
    }

    public function index()
    {
        $username = $this->session->userdata('username');
        $user     = $this->Users_model->getByUsernameWithEmployeeData($username);
        $today    = date('Y-m-d');

        $d['attendance'] = $this->Attendance_model->getByEmployeeAndDate($user['employee_id'], $today);
        $d['status']     = $this->Attendance_model->getStatus($user['employee_id'], $today);
        $d['account']    = $user;
        $d['title']      = 'Attendance';
        $role_id   = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        $this->load->view('templates/header', $d);
        $this->load->view('templates/sidebar', $d);
        $this->load->view('templates/topbar');
        $this->load->view('attendance/index', $d);
        $this->load->view('templates/footer');
    }

    public function do_attendance()
    {
        $username   = $this->session->userdata('username');
        $user       = $this->Users_model->getByUsernameWithEmployeeData($username);
        $today       = date('Y-m-d');
        $attendance  = $this->Attendance_model->getByEmployeeAndDate($user['employee_id'], $today);
        $currentTime = date('H:i:s');

        // Aturan jam kerja
        $minCheckin   = "07:00:00"; // minimal bisa check-in
        $workStart    = "08:00:00"; // jam kerja resmi
        $maxCheckin   = "09:00:00"; // lewat jam ini tidak bisa check-in
        $minCheckout  = "16:30:00"; // minimal bisa check-out
        $workEnd      = "17:00:00"; // jam pulang resmi
        $maxCheckout  = "18:00:00"; // lewat jam ini check-out ditutup

        if (!$attendance) {
            // === Check-in ===
            if ($currentTime < $minCheckin) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">Check-in only opens at ' . $minCheckin . '</div>'
                );
                redirect('attendance');
                return;
            }

            if ($currentTime > $maxCheckin) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">You cannot check-in after ' . $maxCheckin . '</div>'
                );
                redirect('attendance');
                return;
            }

            // Tentukan status hadir / telat
            $status_in = ($currentTime > $workStart) ? 'Late' : 'Present';

            $data = [
                'employee_id' => $user['employee_id'],
                'attendance_date' => $today,
                'check_in'    => $currentTime,
                'status_in'   => $status_in,
                'latitude'    => $this->input->post('latitude'),
                'longitude'   => $this->input->post('longitude'),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            $this->Attendance_model->insert($data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">Check-in successful at ' . $currentTime . ' | Status: ' . $status_in . '</div>'
            );
        } elseif (!$attendance['check_out']) {
            // === Check-out ===
            if ($currentTime < $minCheckout) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">Check-out only opens at ' . $minCheckout . '</div>'
                );
                redirect('attendance');
                return;
            }

            if ($currentTime > $maxCheckout) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">You cannot check-out after ' . $maxCheckout . '</div>'
                );
                redirect('attendance');
                return;
            }

            $status_out = ($currentTime >= $workEnd) ? 'On Time' : 'Left Early';

            $data = [
                'check_out'  => $currentTime,
                'status_out' => $status_out,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->Attendance_model->update($attendance['id'], $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">Check-out successful at ' . $currentTime . ' | Status: ' . $status_out . '</div>'
            );
        } else {
            // Sudah check-in & check-out
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning">You have already checked in and out today.</div>'
            );
        }

        redirect('attendance');
    }
}
