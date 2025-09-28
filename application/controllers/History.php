<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
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
        $this->load->model('History_model');
    }

    public function index()
    {
        $username = $this->session->userdata('username');
        $user     = $this->Users_model->getByUsernameWithEmployeeData($username);

        $d['account']    = $user;
        $d['title']      = 'Attendance History';
        $d['history']    = $this->History_model->getByEmployee($user['employee_id']);
        $role_id   = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        $this->load->view('templates/table_header', $d);
        $this->load->view('templates/sidebar', $d);
        $this->load->view('templates/topbar');
        $this->load->view('history/index', $d);
        $this->load->view('templates/table_footer');
    }
}
