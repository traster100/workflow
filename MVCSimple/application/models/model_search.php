<?php

class Model_Search extends Model {

//все страны
    public function countries_all() {
        $sql = "SELECT * FROM `countries`";
        return $this->db->query($sql)->fetchAll();
    }

//все города по стране
    public function cities_all($countries_id) {
        $sql = "SELECT * FROM `cities` WHERE `countries_id` = " . $countries_id;
        return $this->db->query($sql)->fetchAll();
    }

//все категории
    public function categories_all() {
        $sql = "SELECT * FROM `categories`";
        return $this->db->query($sql)->fetchAll();
    }

//все субкатегории по категории
    public function subcategories_all($parent_id) {
        $sql = "SELECT * FROM `categories` WHERE `parent_id` = " . $parent_id;
        return $this->db->query($sql)->fetchAll();
    }

//все вакансии
    public function vacancies_all($where) {
//  var_dump($where);

        if (empty($where['start'])) {
            $start = 0;
        } else {
            $start = $where['start'];
        }

        $offset = 3;

        unset($where['start']);

        if (empty($where['type'])) {
            $where['type'] = 0;
        }

//  если не выбрана субкатегория
        if ($where['subcategories_id'] != 0) {
            $where['categories_id'] = $where['subcategories_id'];
        }
        unset($where['subcategories_id']);

//  если не выбрана категория
        if ($where['categories_id'] == 0) {
            unset($where['categories_id']);
        }

// если не выбран город
        if ($where['cities_id'] == 0) {
            unset($where['cities_id']);
        }

        // если не выбрана страна
        if ($where['countries_id'] == 0) {
            unset($where['countries_id']);
        }

//  var_dump($where);

        $result = array();
        foreach ($where as $k => $v) {
            $result[] = '`' . $k . '`' . '=' . '"' . $v . '"';
        }

        $result = implode('and', $result);

        $table = '`vacancies`';
        if ($where['type'] == 3) {
            $table = '`users`';
        }

        $sql = "SELECT * FROM " . $table . " WHERE " . $result . ' LIMIT ' . $start . ', ' . $offset;

        var_dump($sql);

        return $this->db->query($sql)->fetchAll();
    }
}
