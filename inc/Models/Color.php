<?php
namespace Du\Models;

class Color extends Base
{
    public function getAll() {
        $sql = "SELECT * FROM color";
        return $this->db->get_results($sql);
    }
}