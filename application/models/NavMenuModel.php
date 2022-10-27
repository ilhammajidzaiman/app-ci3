<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NavMenuModel extends CI_Model
{

    public function index()
    {
        $id = 0;
        $this->db->select('*');
        $this->db->from('tbl_nav_menu');
        $this->db->where('id_menu', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function read($id)
    {
        $this->db->select('tbl_nav_menu.*');
        $this->db->from('tbl_nav_menu');
        $this->db->where('slug', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function create($data)
    {
        $this->db->insert('tbl_nav_menu', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('slug', $id);
        $this->db->update('tbl_nav_menu', $data);
    }

    public function delete($id)
    {
        $this->db->where('slug', $id);
        $this->db->delete('tbl_nav_menu');
    }

    // ##################################################
    // ##################################################
    // ##################################################

    public function readSubMenu($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_nav_menu');
        $this->db->where('id_menu', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result_array();
    }
}
