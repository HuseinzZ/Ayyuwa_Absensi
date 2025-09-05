<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
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
        // $this->load->model('Public_model');
        $this->load->model('Admin_model');
    }
    public function index()
    {
        // Department Data
        $d['title'] = 'Potition';
        $d['potition'] = $this->db->get('potition')->result_array();
        $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);

        $this->load->view('templates/table_header', $d);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('master/potition/index', $d); // Department Page
        $this->load->view('templates/table_footer');
    }
    public function a_potition()
    {
        // Add Department
        $d['title'] = 'Potition';
        $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
        // Form Validation
        $this->form_validation->set_rules('d_id', 'Potition ID', 'required|trim|exact_length[3]|alpha');
        $this->form_validation->set_rules('d_name', 'Potition Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $d);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('master/department/a_dept', $d); // Add Department Page
            $this->load->view('templates/footer');
            // } else {
            //     $this->_addPotition();
            // }
        }
    }

    // private function _addPotition()
    // {
    //     $data = [
    //         'id' => $this->input->post('d_id'),
    //         'name' => $this->input->post('d_name')
    //     ];

    //     $checkId = $this->db->get_where('department', ['id' => $data['id']])->num_rows();
    //     if ($checkId > 0) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //   Failed to add, ID used!</div>');
    //     } else {
    //         $this->db->insert('department', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //     Successfully added a new department!</div>');
    //     }
    //     redirect('master');
    // }

    // public function e_dept($d_id)
    // {
    //     // Edit Department
    //     $d['title'] = 'Department';
    //     $d['d_old'] = $this->db->get_where('department', ['id' => $d_id])->row_array();
    //     $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    //     // Form Validation
    //     $this->form_validation->set_rules('d_name', 'Department Name', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $d);
    //         $this->load->view('templates/sidebar');
    //         $this->load->view('templates/topbar');
    //         $this->load->view('master/department/e_dept', $d); // Edit Department Page
    //         $this->load->view('templates/footer');
    //     } else {
    //         $name = $this->input->post('d_name');
    //         $this->_editDept($d_id, $name);
    //     }
    // }
    // private function _editDept($d_id, $name)
    // {
    //     $data = ['name' => $name];
    //     $this->db->update('department', $data, ['id' => $d_id]);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //     Successfully edited a department!</div>');
    //     redirect('master');
    // }
    // public function d_dept($d_id)
    // {
    //     $this->db->delete('department', ['id' => $d_id]);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //     Successfully deleted a department!</div>');
    //     redirect('master');
    // }
    // // End of department
}
