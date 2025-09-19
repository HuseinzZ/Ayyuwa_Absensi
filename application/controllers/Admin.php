<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        // is_weekends();
        is_logged_in();
        // is_checked_in();
        // is_checked_out();
        $this->load->library('form_validation');
        $this->load->model('Users_model');
        $this->load->model('Dashboard_model');
        $this->load->model('Menu_model');
    }

    // Dashboard
    public function index()
    {
        // Dashboard
        $d['title'] = 'Dashboard';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['display'] = $this->Dashboard_model->getDataForDashboard();
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }
        $this->load->view('templates/dashboard_header', $d);
        $this->load->view('templates/sidebar', $d);
        $this->load->view('templates/topbar');
        $this->load->view('admin/index', $d);
        $this->load->view('templates/dashboard_footer');
    }
}
