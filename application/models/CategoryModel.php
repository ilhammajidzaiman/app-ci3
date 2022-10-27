<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryModel extends CI_Model
{
    public function index($limit, $start, $keyword = null)
    {
        if ($keyword) :
            $this->db->or_like('category', $keyword);
        endif;
        // 
        $this->db->select('*');
        $this->db->from('tbl_articles_categorys');
        $this->db->limit($limit, $start);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function pagination($keyword = null)
    {
        if ($keyword) :
            $this->db->or_like('category', $keyword);
        endif;
        $this->db->select('*');
        $this->db->from('tbl_articles_categorys');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function read($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_articles_categorys');
        $this->db->where('slug', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function create($data)
    {
        $this->db->insert('tbl_articles_categorys', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('slug', $id);
        $this->db->update('tbl_articles_categorys', $data);
    }

    public function delete($id)
    {
        $this->db->where('slug', $id);
        $this->db->delete('tbl_articles_categorys');
    }
}
