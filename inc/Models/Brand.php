<?php
namespace Du\Models;

class Brand extends Base
{
    public function getAll() {
        $sql = "SELECT * FROM brand";
        return $this->db->get_results($sql);
    }
}