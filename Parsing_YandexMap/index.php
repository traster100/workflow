<?php
// парсинг организаций с Яндекс-Карт по запросам типа "Москва магазины", со вставкой в базу

//exit (123);

require_once 'db.php';
require_once 'parse.php';

$date = new DateTime();
file_put_contents('log.txt', "\n" . $date->format('H:i:s') . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);

$db = new Db();
$parse = new Parse();

for ($i = 1; $i <= 12; $i++) {

// $city_and_type = $db->get_city_and_type();
// if (!$city_and_type) {
//  file_put_contents('log.txt', 'все города и типы объектов выбраны' . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);
//  exit('все города и типы объектов выбраны');
// }
//var_dump($city_and_type);

    $city_and_brand = $db->get_city_and_brand();
    if (!$city_and_brand) {
        file_put_contents('log.txt', 'все города и бренды объектов выбраны' . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);
        exit('все города и бренды объектов выбраны');
    }
//var_dump($city_and_brand);


// $phrase = $city_and_type['city_name'] . ' ' . $city_and_type['type_name'];
    $phrase = $city_and_brand['city_name'] . ' ' . $city_and_brand['brand_name'];

    $result = $parse->getdata($phrase);
    //var_dump($result);

    file_put_contents('log.txt', $phrase . ' | ', FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);

    if (is_null($result)) {
        file_put_contents('log.txt', 'нет результатов поиска' . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);
        exit('нет результатов поиска');
    }

    $db->insert_objects($result, $city_and_brand['city_id']);


// $db->insert_city_and_type(array('city_id' => $city_and_type['city_id'], 'type_id' => $city_and_type['type_id']));
    $db->insert_city_and_brand(array('city_id' => $city_and_brand['city_id'], 'brand_id' => $city_and_brand['brand_id']));

    echo 'запрос отработан';

    file_put_contents('log.txt', 'найдено ' . count($result) . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);

    sleep(2);
}

$date = new DateTime();
file_put_contents('log.txt', $date->format('H:i:s') . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);

file_put_contents('log.txt', "\n" . '================================================================================================' . "\n",
    FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);