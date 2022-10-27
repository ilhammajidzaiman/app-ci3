<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PostingModel extends CI_Model
{
    public function index($limit, $start, $id = null, $level = null, $keyword = null)
    {
        if ($level == 2) :
            $this->db->where('id_admin', $id);
        endif;
        if ($keyword) :
            $this->db->like('title', $keyword);
        endif;
        // 
        $this->db->select('*');
        $this->db->from('tbl_articles');
        $this->db->limit($limit, $start);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function pagination($id = null, $level = null, $keyword = null)
    {
        if ($level == 2) :
            $this->db->where('id_admin', $id);
        endif;

        if ($keyword) :
            $this->db->like('title', $keyword);
        endif;
        $this->db->from('tbl_articles');
        $query = $this->db->count_all_results();
        return $query;
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

    public function create($data)
    {
        $this->db->insert('tbl_articles', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('slug', $id);
        $this->db->update('tbl_articles', $data);
    }

    public function delete($id)
    {
        $this->db->where('slug', $id);
        $this->db->delete('tbl_articles');
    }

    // ##################################################
    // ##################################################
    // ##################################################

    public function readCategorys()
    {
        $this->db->select('*');
        $this->db->from('tbl_articles_categorys');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function readCategory($id, $id1)
    {
        $this->db->select('*');
        $this->db->from('tbl_articles_postings');
        $this->db->where('id_article', $id);
        $this->db->where('id_article_category', $id1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function readArticleCategory($id)
    {
        $this->db->select('tbl_articles_postings.*');
        $this->db->select('tbl_articles_categorys.category');
        $this->db->from('tbl_articles_postings');
        $this->db->join('tbl_articles_categorys', 'tbl_articles_categorys.id = tbl_articles_postings.id_article_category', 'inner');
        $this->db->where('tbl_articles_postings.id_article', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function createCategory($data)
    {
        $this->db->insert_batch('tbl_articles_postings', $data);
    }

    public function deleteCategory($id)
    {
        $this->db->where('id_article', $id);
        $this->db->delete('tbl_articles_postings');
    }
}
