<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    public function index($limit, $start, $keyword = null)
    {
        if ($keyword) :
            $this->db->or_like('email', $keyword);
            $this->db->or_like('name', $keyword);
        endif;
        // 
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->limit($limit, $start);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function pagination($keyword = null)
    {
        if ($keyword) :
            $this->db->or_like('email', $keyword);
            $this->db->or_like('name', $keyword);
        endif;
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function read($id)
    {
        $this->db->select('tbl_admin.*');
        $this->db->select('tbl_admin_level.level');
        $this->db->from('tbl_admin');
        $this->db->join('tbl_admin_level', 'tbl_admin_level.id = tbl_admin.id_level', 'inner');
        $this->db->where('tbl_admin.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function readEmail($id)
    {
        $this->db->select('tbl_admin.*');
        $this->db->select('tbl_admin_level.level');
        $this->db->from('tbl_admin');
        $this->db->join('tbl_admin_level', 'tbl_admin_level.id = tbl_admin.id_level', 'inner');
        $this->db->where('tbl_admin.email', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function create($data)
    {
        $this->db->insert('tbl_admin', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_admin', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_admin');
    }

    // ##################################################
    // ##################################################
    // ##################################################

    public function createAccess($data)
    {
        $this->db->insert_batch('tbl_admin_access', $data);
    }

    public function deleteAccess($id)
    {
        $this->db->where('id_admin', $id);
        $this->db->delete('tbl_admin_access');
    }

    public function adminMenu()
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_menu');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function adminAccess($id_admin, $id_admin_menu)
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_access');
        $this->db->where('id_admin', $id_admin);
        $this->db->where('id_admin_menu', $id_admin_menu);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function adminLevel()
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_level');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
}
