<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    public function login($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->where('email', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function profil($id)
    {
        $this->db->select('tbl_admin.*');
        $this->db->select('tbl_admin_level.level');
        $this->db->from('tbl_admin');
        $this->db->join('tbl_admin_level', 'tbl_admin_level.id = tbl_admin.id_level', 'inner');
        $this->db->where('tbl_admin.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function adminAccess($id)
    {
        $id2 = 2;
        $this->db->select('tbl_admin_menu.*');
        $this->db->from('tbl_admin_menu');
        $this->db->join('tbl_admin_access', 'tbl_admin_menu.id = tbl_admin_access.id_admin_menu', 'inner');
        $this->db->where('tbl_admin_access.id_admin', $id);
        $this->db->where_not_in('tbl_admin_menu.id', $id2);
        $this->db->order_by('tbl_admin_menu.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
