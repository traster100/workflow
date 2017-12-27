<?php

define('HOSTNAME', 'localhost');
define('DATABASE', '1000developers');
define('USERNAME', 'mysql');
define('PASSWORD', 'mysql');

class Db {

    public function __construct() {
        try {
            $this->db = new PDO ('mysql:host=' . HOSTNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit ($e->getMessage());
        }
    }


    public function select_subcategories() {
        $sql = "SELECT * FROM `subcategories` WHERE `id` = 142";
        return $this->db->query($sql)->fetchAll();
    }

    public function select_city($name) {
        $select = $this->db->prepare("SELECT * FROM `cities` WHERE `name` = :name");
        $select->execute([
            'name' => $name
        ]);
        return $select->fetch();
    }

    public function select_user($name) {
        $select = $this->db->prepare("SELECT * FROM `users` WHERE `name` = :name");
        $select->execute([
            'name' => $name
        ]);
        return $select->fetch();
    }

    public function insert_user($name) {
        $insert = $this->db->prepare("INSERT INTO `users` (`name`) VALUES (:name)");
        $insert->execute([
            'name' => $name,
        ]);
        return $this->db->lastInsertId();
    }

    public function insert_project($project) {

//получили поля
        $keys = array_keys($project);

//поля обернули в кавычки ``
        $keys_1 = [];
        foreach ($keys as $v) {
            $keys_1[] = '`' . $v . '`';
        }
//склеили в строку
        $keys_1 = implode(', ', $keys_1);


//поля обернули в двоеточия :
        $keys_2 = [];
        foreach ($keys as $v) {
            $keys_2[] = ':' . $v;
        }
// склеили в строку
        $keys_2 = implode(', ', $keys_2);

//сформировать строку
        $sql = 'INSERT INTO `projects` (' . $keys_1 . ') VALUES (' . $keys_2 . ')';
        $insert = $this->db->prepare($sql);

        $insert->execute(
            $project
        );
        return $this->db->lastInsertId();
    }

    public function insert_projects_has_subcategories($projects_id, $subcategories_id) {
        $insert = $this->db->prepare("INSERT INTO `projects_has_subcategories` (`projects_id`, `subcategories_id`) VALUES (:projects_id, :subcategories_id)");
        $insert->execute([
            'projects_id' => $projects_id,
            'subcategories_id' => $subcategories_id,
        ]);
    }
}