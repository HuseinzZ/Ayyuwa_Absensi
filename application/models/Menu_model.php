<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getMenuByRole($role_id)
    {
        $this->db->select('user_menu.id, user_menu.menu');
        $this->db->from('user_menu');
        $this->db->join('user_access', 'user_menu.id = user_access.menu_id');
        $this->db->where('user_access.role_id', $role_id);
        $this->db->order_by('user_access.menu_id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getSubMenuByMenuId($menuId)
    {
        $this->db->select('*');
        $this->db->from('user_submenu');
        $this->db->where('menu_id', $menuId);
        $this->db->where('is_active', 1);
        $this->db->order_by('title', 'ASC');
        return $this->db->get()->result_array();
    }
}
