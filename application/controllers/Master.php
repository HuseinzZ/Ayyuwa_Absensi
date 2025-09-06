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
        $this->load->model('Potition_model');
    }

    public function index()
    {
        $d['title']    = 'Potition';
        $d['account']  = $this->Admin_model->getAdmin($this->session->userdata('username'));
        $d['potition'] = $this->Potition_model->getAll();

        $this->load->view('templates/table_header', $d);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('master/potition/index', $d);
        $this->load->view('templates/table_footer');
    }

    // // Tambah potition
    // public function add()
    // {
    //     $d['title']   = 'Add Potition';
    //     $d['account'] = $this->Admin_model->getAdmin($this->session->userdata('username'));

    //     $this->form_validation->set_rules('p_id', 'Potition ID', 'required|trim|alpha_numeric');
    //     $this->form_validation->set_rules('p_name', 'Potition Name', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/table_header', $d);
    //         $this->load->view('templates/sidebar');
    //         $this->load->view('templates/topbar');
    //         $this->load->view('master/potition/add', $d);
    //         $this->load->view('templates/table_footer');
    //     } else {
    //         $data = [
    //             'id'   => $this->input->post('p_id', true),
    //             'name' => $this->input->post('p_name', true)
    //         ];

    //         // Cek duplikat ID
    //         $exists = $this->Potition_model->getById($data['id']);
    //         if ($exists) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger">ID sudah digunakan!</div>');
    //         } else {
    //             $this->Potition_model->insert($data);
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Potition berhasil ditambahkan!</div>');
    //         }
    //         redirect('potition');
    //     }
    // }

    // // Edit potition
    // public function edit($id)
    // {
    //     $d['title']   = 'Edit Potition';
    //     $d['account'] = $this->Admin_model->getAdmin($this->session->userdata('username'));
    //     $d['potition'] = $this->Potition_model->getById($id);

    //     $this->form_validation->set_rules('p_name', 'Potition Name', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/table_header', $d);
    //         $this->load->view('templates/sidebar');
    //         $this->load->view('templates/topbar');
    //         $this->load->view('master/potition/edit', $d);
    //         $this->load->view('templates/table_footer');
    //     } else {
    //         $data = ['name' => $this->input->post('p_name', true)];
    //         $this->Potition_model->update($id, $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success">Potition berhasil diupdate!</div>');
    //         redirect('potition');
    //     }
    // }

    // // Hapus potition
    // public function delete($id)
    // {
    //     $this->Potition_model->delete($id);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success">Potition berhasil dihapus!</div>');
    //     redirect('potition');
    // }
}
