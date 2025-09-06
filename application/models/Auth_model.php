<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function getUserByUsername($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }
}
