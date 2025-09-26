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

        // Load model
        $this->load->library('form_validation');
        $this->load->model('Attendance_model');
        $this->load->model('Employee_model');
        $this->load->model('Potition_model');
        $this->load->model('Users_model');
        $this->load->model('Menu_model');
    }

    // Master employee
    public function index()
    {
        $d['title'] = 'Employee';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['employee'] = $this->Employee_model->getAll();
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        $this->load->view('templates/table_header', $d);
        $this->load->view('templates/sidebar', $d);
        $this->load->view('templates/topbar');
        $this->load->view('master/employee/index', $d);
        $this->load->view('templates/table_footer');
    }

    // Add employee
    public function a_employee()
    {
        $d['title'] = 'Add Employee';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['potitions'] = $this->Potition_model->getAll();
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        // Aturan validasi
        $this->form_validation->set_rules('emp_name', 'Employee Name', 'required|trim');
        $this->form_validation->set_rules('emp_email', 'Email', 'required|trim|valid_email|is_unique[employee.email]');
        $this->form_validation->set_rules('emp_gender', 'Gender', 'required');
        $this->form_validation->set_rules('emp_potition_id', 'Potition', 'required');
        $this->form_validation->set_rules('emp_birth_date', 'Birth Date', 'required');
        $this->form_validation->set_rules('emp_hire_date', 'Hire Date', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/table_header', $d);
            $this->load->view('templates/sidebar', $d);
            $this->load->view('templates/topbar');
            $this->load->view('master/employee/a_employee', $d);
            $this->load->view('templates/table_footer');
        } else {
            $data = [
                'id'          => $this->input->post('emp_id', true),
                'name'        => $this->input->post('emp_name', true),
                'email'       => $this->input->post('emp_email', true),
                'gender'      => $this->input->post('emp_gender', true),
                'potition_id' => $this->input->post('emp_potition_id', true),
                'birth_date'  => $this->input->post('emp_birth_date', true),
                'hire_date'   => $this->input->post('emp_hire_date', true),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'image'       => 'default.jpg'
            ];

            // Upload image
            $upload_image = $_FILES['emp_image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/profile/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('emp_image')) {
                    $new_image = $this->upload->data('file_name');
                    $data['image'] = $new_image;
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
                    redirect('master/a_employee');
                }
            }

            $this->Employee_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Employee added successfully!</div>');
            redirect('master/index');
        }
    }

    // Email unique
    public function email_unique($email, $id)
    {
        $employee = $this->Employee_model->getByEmail($email);
        if ($employee && $employee['id'] != $id) {
            $this->form_validation->set_message('email_unique', 'Email already in use!');
            return false;
        }
        return true;
    }

    // Edit employee
    public function e_employee($id)
    {
        $d['title'] = 'Edit Employee';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['employee'] = $this->Employee_model->getById($id);
        $d['potitions'] = $this->Potition_model->getAll();
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        // Aturan validasi
        $this->form_validation->set_rules('emp_name', 'Employee Name', 'required|trim');
        $this->form_validation->set_rules('emp_email', 'Email', 'required|trim|valid_email|callback_email_unique[' . $id . ']');
        $this->form_validation->set_rules('emp_gender', 'Gender', 'required');
        $this->form_validation->set_rules('emp_potition_id', 'Potition', 'required');
        $this->form_validation->set_rules('emp_birth_date', 'Date of Birth', 'required');
        $this->form_validation->set_rules('emp_hire_date', 'Hire Date', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/table_header', $d);
            $this->load->view('templates/sidebar', $d);
            $this->load->view('templates/topbar');
            $this->load->view('master/employee/e_employee', $d);
            $this->load->view('templates/table_footer');
        } else {
            $data = [
                'name'        => $this->input->post('emp_name', true),
                'email'       => $this->input->post('emp_email', true),
                'gender'      => $this->input->post('emp_gender', true),
                'potition_id' => $this->input->post('emp_potition_id', true),
                'birth_date'  => $this->input->post('emp_birth_date', true),
                'hire_date'   => $this->input->post('emp_hire_date', true),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            // Upload image baru
            $upload_image = $_FILES['emp_image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/profile/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('emp_image')) {
                    // Hapus gambar lama
                    $old_image = $d['employee']['image'];
                    if ($old_image && $old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $data['image'] = $new_image;
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->Employee_model->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Employee updated successfully!</div>');
            redirect('master/index');
        }
    }

    // Delete employee
    public function d_employee($id)
    {
        $employee_data = $this->Employee_model->getById($id);
        if ($employee_data['image'] != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $employee_data['image']);
        }

        $this->Employee_model->deleteWithUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Employee deleted successfully!</div>');
        redirect('master/index');
    }

    // Master potition
    public function potition()
    {
        $d['title'] = 'Potition';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['potition'] = $this->Potition_model->getAll();
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        $this->load->view('templates/table_header', $d);
        $this->load->view('templates/sidebar', $d);
        $this->load->view('templates/topbar');
        $this->load->view('master/potition/index', $d);
        $this->load->view('templates/table_footer');
    }

    // Add potition
    public function a_potition()
    {
        $d['title'] = 'Add Potition';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        // aturan validasi
        $this->form_validation->set_rules('p_id', 'Potition ID', 'required|trim|alpha_numeric|max_length[3]');
        $this->form_validation->set_rules('p_name', 'Potition Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/table_header', $d);
            $this->load->view('templates/sidebar', $d);
            $this->load->view('templates/topbar');
            $this->load->view('master/potition/a_potition', $d);
            $this->load->view('templates/table_footer');
        } else {
            $data = [
                'id' => $this->input->post('p_id', true),
                'name' => $this->input->post('p_name', true)
            ];

            $exists = $this->Potition_model->getById($data['id']);
            if ($exists) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">ID already in use!</div>');
                redirect('master/a_potition');
            } else {
                $this->Potition_model->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Position added successfully!</div>');
                redirect('master/potition');
            }
        }
    }

    // Edit potition
    public function e_potition($id)
    {
        $d['title'] = 'Edit Potition';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['old_potition'] = $this->Potition_model->getById($id);
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        $this->form_validation->set_rules('p_name', 'Potition Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/table_header', $d);
            $this->load->view('templates/sidebar', $d);
            $this->load->view('templates/topbar');
            $this->load->view('master/potition/e_potition', $d);
            $this->load->view('templates/table_footer');
        } else {
            $data = ['name' => $this->input->post('p_name', true)];
            $this->Potition_model->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Position updated successfully!</div>');
            redirect('master/potition');
        }
    }

    // Delete potition
    public function d_potition($id)
    {
        $this->Potition_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Position deleted successfully!</div>');
        redirect('master/potition');
    }

    // Master users
    public function users()
    {
        $d['title'] = 'Users';
        $d['data'] = $this->Users_model->getAllUsersWithEmployeeData();
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        $this->load->view('templates/table_header', $d);
        $this->load->view('templates/sidebar', $d);
        $this->load->view('templates/topbar');
        $this->load->view('master/users/index', $d);
        $this->load->view('templates/table_footer');
    }

    // Add users
    public function a_users($id, $potition_id)
    {
        $d['title'] = 'Create Account';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['employee_id'] = $id;
        $d['potition_id'] = $potition_id;
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        // aturan validasi
        $this->form_validation->set_rules('u_password', 'Password', 'required|trim|min_length[8]|matches[u_password2]');
        $this->form_validation->set_rules('u_password2', 'Repeat Password', 'required|trim|matches[u_password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/table_header', $d);
            $this->load->view('templates/sidebar', $d);
            $this->load->view('templates/topbar');
            $this->load->view('master/users/a_users', $d);
            $this->load->view('templates/table_footer');
        } else {
            $username_auto = strtolower($potition_id) . str_pad($id, 3, '0', STR_PAD_LEFT);

            $data = [
                'username'      => $username_auto,
                'password'      => password_hash($this->input->post('u_password'), PASSWORD_DEFAULT),
                'employee_id'   => $id,
                'role_id'       => ($potition_id === 'CEO') ? 1 : 2,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            $existing_user = $this->Users_model->getByUsername($username_auto);
            if ($existing_user) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Username already exists.</div>');
                redirect('master/users');
            }

            $this->Users_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">User added successfully!</div>');
            redirect('master/users');
        }
    }

    // Edit users
    public function e_users($username)
    {
        $d['title'] = 'Edit Account';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['user'] = $this->Users_model->getByUsername($username);
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        // aturan validasi
        $this->form_validation->set_rules('u_password', 'Password', 'required|trim|min_length[8]|matches[u_password2]');
        $this->form_validation->set_rules('u_password2', 'Repeat Password', 'required|trim|matches[u_password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/table_header', $d);
            $this->load->view('templates/sidebar', $d);
            $this->load->view('templates/topbar');
            $this->load->view('master/users/e_users', $d);
            $this->load->view('templates/table_footer');
        } else {
            $data = [
                'password'   => password_hash($this->input->post('u_password'), PASSWORD_DEFAULT),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->Users_model->updateByUsername($username, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">User updated successfully!</div>');
            redirect('master/users');
        }
    }

    // Delete users
    public function d_users($username)
    {
        $this->Users_model->deleteByUsername($username);
        $this->session->set_flashdata('message', '<div class="alert alert-success">User deleted successfully!</div>');
        redirect('master/users');
    }

    // Master attendance
    public function attendance()
    {
        $d['title']   = 'Attendance';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['attendance'] = $this->Attendance_model->getAllWithEmployee(); // tampilkan semua absen
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        $this->load->view('templates/table_header', $d);
        $this->load->view('templates/sidebar', $d);
        $this->load->view('templates/topbar');
        $this->load->view('master/attendance/index', $d);
        $this->load->view('templates/table_footer');
    }

    // Add attendance
    public function a_attendance()
    {
        $d['title']   = 'Add Attendance';
        $d['account'] = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['employees'] = $this->Users_model->getEmployees();
        $role_id = $this->session->userdata('role_id');
        $d['menu'] = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus'] = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        $this->form_validation->set_rules('employee_id', 'Employee', 'required');
        $this->form_validation->set_rules('attendance_date', 'Attendance Date', 'required');
        $this->form_validation->set_rules('check_in', 'Check-in', 'required');
        $this->form_validation->set_rules('status_in', 'Status In', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/table_header', $d);
            $this->load->view('templates/sidebar', $d);
            $this->load->view('templates/topbar');
            $this->load->view('master/attendance/a_attendance', $d);
            $this->load->view('templates/table_footer');
        } else {
            $data = [
                'employee_id' => $this->input->post('employee_id'),
                'attendance_date'        => $this->input->post('attendance_date'),
                'check_in'    => $this->input->post('check_in'),
                'status_in'   => $this->input->post('status_in'),
                'check_out'   => $this->input->post('check_out'),
                'status_out'  => $this->input->post('status_out'),
                'latitude'    => $this->input->post('latitude'),
                'longitude'   => $this->input->post('longitude'),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];
            $this->Attendance_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Attendance added successfully!</div>');
            redirect('master/attendance');
        }
    }

    // Edit attendance
    public function e_attendance($id)
    {
        $d['title']      = 'Edit Attendance';
        $d['account']    = $this->Users_model->getByUsernameWithEmployeeData($this->session->userdata('username'));
        $d['attendance'] = $this->Attendance_model->getByIdWithEmployeeName($id);
        $d['employees']  = $this->Employee_model->getAll();
        $role_id = $this->session->userdata('role_id');
        $d['menu']       = $this->Menu_model->getMenuByRole($role_id);
        $d['submenus']   = [];
        foreach ($d['menu'] as $mn) {
            $d['submenus'][$mn['id']] = $this->Menu_model->getSubMenuByMenuId($mn['id']);
        }

        if ($this->input->post()) {
            $data = [
                'employee_id'   => $this->input->post('employee_id'), // Tambahkan ini
                'attendance_date' => $this->input->post('attendance_date'), // Ganti 'date'
                'check_in'      => $this->input->post('check_in'),
                'status_in'     => $this->input->post('status_in'),
                'check_out'     => $this->input->post('check_out'),
                'status_out'    => $this->input->post('status_out'),
                'latitude'      => $this->input->post('latitude'),
                'longitude'     => $this->input->post('longitude'),
                'updated_at'    => date('Y-m-d H:i:s')
            ];
            $this->Attendance_model->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Attendance updated successfully!</div>');
            redirect('master/attendance');
        }

        $this->load->view('templates/table_header', $d);
        $this->load->view('templates/sidebar', $d);
        $this->load->view('templates/topbar');
        $this->load->view('master/attendance/e_attendance', $d);
        $this->load->view('templates/table_footer');
    }

    // Delete attendance
    public function d_attendance($id)
    {
        $this->Attendance_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Attendance deleted successfully!</div>');
        redirect('master/attendance');
    }
}
