<?php
namespace Du\Models;

class Base
{
    public $db = null;
    public function __construct() {
        $this->db = new \wpdb(BE_DB_USER, BE_DB_PASSWORD, BE_DB_NAME, BE_DB_HOST);
    }
}