<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
        $this->load->library('form_validation');
        $this->load->model('Users_model');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            switch ($this->session->userdata('role_id')) {
                case 1:
                    redirect('admin');
                    break;
                case 2:
                    redirect('profile');
                    break;
            }
        }

        $d['title'] = 'Login';

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $d);
            $this->load->view('auth/index');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        // Panggil model
        $user = $this->Users_model->getByUsername($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role_id'  => $user['role_id']
                ];
                $this->session->set_userdata($data);

                switch ($user['role_id']) {
                    case 1:
                        redirect('admin');
                        break;
                    case 2:
                        redirect('profile');
                        break;
                    default:
                        redirect('auth/blocked');
                        break;
                }
            } else {
                $this->session->set_flashdata('error', 'Wrong password!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'Username not found!');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(['username', 'role_id']);
        $this->session->set_flashdata('success', 'You have been logged out!');
        redirect('auth');
    }

    public function blocked()
    {
        $d['title'] = 'Access Blocked';
        $this->load->view('auth/blocked', $d);
    }
}
