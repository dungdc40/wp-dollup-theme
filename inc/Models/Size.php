<?php
namespace Du\Models;

class Size extends Base
{
    public function getAll() {
        $sql = "SELECT * FROM size";
        return $this->db->get_results($sql);
    }
}