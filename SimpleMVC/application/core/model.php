<?php

define('HOSTNAME', 'localhost');
define('DATABASE', 'SimpleMVC');
define('USERNAME', 'mysql');
define('PASSWORD', 'mysql');

class Model {

    public function __construct() {
        try {
            $this->db = new PDO ('mysql:host=' . HOSTNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit ($e->getMessage());
        }
    }

// метод выборки данных
    public function get_data() {
        // todo
    }
}