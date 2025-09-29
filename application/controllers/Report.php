<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
        $this->load->library('form_validation');
        $this->load->model('Users_model');
        $this->load->model('Menu_model');
        $this->load->model('Report_model');
        $this->load->model('Employee_model');
    }

    public function index()
    {
        $d['title'] = 'Print Report';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        $d['all_employees'] = $this->Users_model->getEmployees();
        $d['summary_data'] = null;
        $d['start_date'] = '';
        $d['end_date'] = '';
        $d['selected_employee_id'] = 'all';

        $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim');
        $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');
        $this->form_validation->set_rules('employee_id', 'Employee', 'required');

        if ($this->form_validation->run() == TRUE) {
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $employee_id = $this->input->post('employee_id');

            $d['summary_data'] = $this->Report_model->getAttendanceSummary($start_date, $end_date, $employee_id);
            $d['start_date'] = $start_date;
            $d['end_date'] = $end_date;
            $d['selected_employee_id'] = $employee_id;
        }

        $this->load->view('templates/table_header', $d);
        $this->load->view('templates/sidebar', $d);
        $this->load->view('templates/topbar');
        $this->load->view('report/index', $d);
        $this->load->view('templates/table_footer');
    }

    public function print_report()
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $employee_id = $this->input->get('employee_id');

        if (!$start_date || !$end_date) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Please specify a valid date range.</div>');
            redirect('report');
        }

        $d['summary_data'] = $this->Report_model->getAttendanceSummary($start_date, $end_date, $employee_id);
        $d['selected_employee_name'] = 'Semua Karyawan';

        if (!empty($employee_id) && $employee_id !== 'all') {
            $employee_data = $this->Users_model->getEmployeeDataById($employee_id);
            if ($employee_data) {
                $d['selected_employee_name'] = $employee_data['name'];
            }
        }

        $d['start_date'] = $start_date;
        $d['end_date'] = $end_date;
        $d['title'] = 'Attendance Report';
        $this->load->view('report/print_attendance', $d);
    }
}
