<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfilModel extends CI_Model
{

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_admin', $data);
    }
}
