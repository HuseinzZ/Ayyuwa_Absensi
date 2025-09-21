<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata['username']) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata['role_id'];
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];
        $userAccess = $ci->db->get_where('user_access', ['role_id' => $role_id, 'menu_id' => $menu_id]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

// function is_weekends()
// {
//     date_default_timezone_set('Asia/Jakarta');
//     $today = date('l', time());
//     $weekends = ['Saturday', 'Sunday'];
//     if (in_array($today, $weekends)) {
//         return true;
//     } else {
//         return false;
//     }
// }
