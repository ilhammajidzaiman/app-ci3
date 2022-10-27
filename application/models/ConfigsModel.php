<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ConfigsModel extends CI_Model
{
    public function index()
    {
        $id = '1';
        $this->db->select('*');
        $this->db->from('tbl_configs');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update($data)
    {
        $id = '1';
        $this->db->where('id', $id);
        $this->db->update('tbl_configs', $data);
    }

    public function read($id)
    {
        $id = '1';
        $this->db->select('*');
        $this->db->from('tbl_configs');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
}
