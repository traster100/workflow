<?php

define('HOSTNAME', 'localhost');
define('DATABASE', 'map');
define('USERNAME', 'mysql');
define('PASSWORD', 'mysql');

class Db {

    public function __construct() {
        try {
            $this->db = new PDO ('mysql:host=' . HOSTNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // режим обработки ошибок. по умолчанию PDO::ERRMODE_SILENT

            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // можно у каждого запроса указывать как $select->setFetchMode(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            exit ($e->getMessage());
        }
    }

    public function get_city_and_type() {
        $sql = "SELECT
`city`.`id` as `city_id`, `city`.`name` as `city_name`, `type`.`id` as `type_id`, `type`.`name` as `type_name`
FROM
 `city`, `type`
WHERE
NOT EXISTS (
   SELECT * FROM `city_has_type` WHERE `city_has_type`.`city_id` = `city`.`id` AND `city_has_type`.`type_id` = `type`.`id`
)
LIMIT 1";

        return $this->db->query($sql)->fetch();

    }

    public function get_city_and_brand() {
        $sql = "SELECT
`city`.`id` as `city_id`, `city`.`name` as `city_name`, `brand`.`id` as `brand_id`, `brand`.`name` as `brand_name`
FROM
 `city`, `brand`
WHERE
NOT EXISTS (
   SELECT * FROM `city_has_brand` WHERE `city_has_brand`.`city_id` = `city`.`id` AND `city_has_brand`.`brand_id` = `brand`.`id`
)
LIMIT 1";

        return $this->db->query($sql)->fetch();

    }


    public function insert_objects($result, $city_id) {
        foreach ($result as $v) {
            $v['city_id'] = $city_id;
            $insert = $this->db->prepare("INSERT IGNORE INTO `object` (`place_id`,`name`,`address`, `url`, `category`,`phone`,`schedule`,`description`,`latitude`,`longitude`, `city_id`) VALUES (:place_id,:name,:address,:url,:category,:phone,:schedule,:description,:latitude,:longitude,:city_id)");
            $insert->execute($v);
        }
    }

    public function insert_city_and_type($city_and_type) {
        $insert = $this->db->prepare("INSERT IGNORE INTO `city_has_type` (`city_id`,`type_id`) VALUES (:city_id,:type_id)");
        $insert->execute($city_and_type);
    }

    public function insert_city_and_brand($city_and_brand) {
        $insert = $this->db->prepare("INSERT IGNORE INTO `city_has_brand` (`city_id`,`brand_id`) VALUES (:city_id,:brand_id)");
        $insert->execute($city_and_brand);
    }


}