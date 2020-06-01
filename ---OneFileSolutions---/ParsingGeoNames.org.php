<?php

//парсинг стран и городов с сервиса geonames.org

//страны http://www.geonames.org/countries/
//города http://www.geonames.org/search.html?q=&country=AF&startRow=0

//база данных
define('HOSTNAME', 'localhost');
define('DATABASE', '');
define('USERNAME', '');
define('PASSWORD', '');

class Db {

  public function __construct() {
    try {
      $this->db = new PDO ('mysql:host=' . HOSTNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      exit ($e->getMessage());
    }
  }

  // выборка id страны, по названию страны
  public function select_countries_id($name) {
    $select = $this->db->prepare("SELECT `id` FROM `countries` WHERE `name` = :name");
    $select->execute([
      'name' => ($name)
    ]);
    $result = $select->fetch();
    return $result['id'];
  }

  // вставка города
  public function insert_city($name, $countries_id) {
    $insert = $this->db->prepare(
      "INSERT INTO `cities` (`name`, `countries_id` ) VALUES (:name, :countries_id)"
    );
    $insert->execute([
      'name' => $name,
      'countries_id' => $countries_id,
    ]);

    return $this->db->lastInsertId();
  }

}

//-------------------------------------------------

$db = new Db();

error_reporting(E_ALL ^ E_DEPRECATED);
set_time_limit(0);
date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'en_US.utf-8');

require_once 'simple_html_dom.php';
require_once 'Curl.php';

//-------------------------------------------------

//парсим страницу страны чтобы с селекта собрать все страны
$page = Curl::getpage('http://www.geonames.org/search.html?q=&country=RU');
$html = new simple_html_dom();
$html->load($page);

//собираем названия стран, и их коды вида [FR]
$countries = [];
foreach ($html->find('select option') as $v1) {

  $shortname = trim($v1->value);
  $name = trim($v1->innertext);
  if (empty($shortname) or empty($name)) {
    continue;
  }

  $countries[$name] = [
    'name' => $name,
    'shortname' => $shortname,
  ];

}

$html->clear();
unset($html);

//-------------------------------------------------

//$countries = array_slice($countries, 0, 1); // 1 страна для отладки
echo '<pre>';
print_r($countries);
echo '</pre>';

//собираем города, со страниц всех стран
foreach ($countries as $k1 => $country) {

  //все города одной страны
  $all_cities_in_country = [];

  //парсим страницу страны, с пагинацией
  for ($i = 0; $i <= 200; $i = $i + 50) {

    //задержка рандомная
    sleep(rand(2, 4));

    //получаем страницу
    $page = Curl::getpage('http://www.geonames.org/search.html?q=&country=' . $country['shortname'] . '&startRow=' . $i);
    $html = new simple_html_dom();
    $html->load($page);

    //проходим строки tr
    foreach ($html->find('table.restable tr') as $v1) {

      //проходим ряды td
      foreach ($v1->find('td') as $k2 => $v2) {

        //порядковый номер столбца в таблице которую парсим. 0,1,2,3,4,5
        if ($k2 == 1) {
          $city = trim($v2->find('a', 0)->innertext);

          //в списке городов зачем-то есть название страны. ее удаляем
          if ($city == $country['name'] or empty($city)) {
            continue;
          }

          $all_cities_in_country[$k1][$city] = $city;

        }

      }

    }

    $html->clear();
    unset($html);

  }

  echo '<pre>';
  print_r($all_cities_in_country);
  echo '</pre>';

  //вставка в базу. $k3 - страна, $v4 - город
  foreach ($all_cities_in_country as $k3 => $v3) {

    foreach ($v3 as $k4 => $v4) {
      $countries_id = $db->select_countries_id($k3);
      $db->insert_city($v4, $countries_id);
    }

  }

}