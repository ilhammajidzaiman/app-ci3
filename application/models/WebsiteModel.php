<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WebsiteModel extends CI_Model
{
    public function index($limit, $start, $keyword = null)
    {
        if ($keyword) :
            $this->db->like('title', $keyword);
        endif;
        // 
        $this->db->select('*');
        $this->db->from('tbl_articles');
        $this->db->where('status', 1);
        $this->db->limit($limit, $start);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function pagination($keyword = null)
    {
        if ($keyword) :
            $this->db->like('title', $keyword);
        endif;
        $this->db->select('*');
        $this->db->from('tbl_articles');
        $this->db->where('status', 1);
        $query = $this->db->count_all_results();
        return $query;
    }

    public function update($id, $data)
    {
        $this->db->where('slug', $id);
        $this->db->update('tbl_articles', $data);
    }

    public function read($id)
    {
        $this->db->select('tbl_articles.*');
        $this->db->select('tbl_admin.name');
        $this->db->from('tbl_articles');
        $this->db->join('tbl_admin', 'tbl_admin.id = tbl_articles.id_admin');
        $this->db->where('slug', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function readMenus()
    {
        $id = 0;
        $this->db->select('*');
        $this->db->from('tbl_nav_menu');
        $this->db->where('id_menu', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function popular()
    {
        $this->db->select('*');
        $this->db->from('tbl_articles');
        $this->db->limit(7);
        $this->db->order_by('counter', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function new()
    {
        $this->db->select('*');
        $this->db->from('tbl_articles');
        $this->db->limit(7);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function readArticleCategory($id)
    {
        // $this->db->select('tbl_articles_postings.*');
        $this->db->select('tbl_articles_categorys.category');
        $this->db->from('tbl_articles_postings');
        $this->db->join('tbl_articles_categorys', 'tbl_articles_categorys.id = tbl_articles_postings.id_article_category', 'inner');
        $this->db->where('tbl_articles_postings.id_article', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
