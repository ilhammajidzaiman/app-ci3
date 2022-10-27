<?php

function helper_auth()
{

    $ci = get_instance();
    $session_id = $ci->session->userdata('id_app');
    if (!$session_id) :
        redirect('auth');
    else :
        $controller = $ci->uri->segment(1);
        $query_menu = $ci->db->get_where('tbl_admin_menu', ['controller' => $controller])->row_array();
        $menu_id = $query_menu['id'];
        $admin_akses = $ci->db->get_where('tbl_admin_access', [
            'id_admin' => $session_id,
            'id_admin_menu' => $menu_id
        ]);
        // 
        // tidak boleh akses menu lain
        if ($admin_akses->num_rows() < 1) :
            redirect('dashboard');
        // redirect('acces-block');
        endif;
    endif;
}
