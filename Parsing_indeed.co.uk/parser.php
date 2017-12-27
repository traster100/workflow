<?php

//ЧТО СДЕЛАТЬ. все глаголы такие в комментах

error_reporting(E_ALL ^ E_DEPRECATED);
set_time_limit(0);
date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'en_US.utf-8');

require_once 'curl.php';
require_once 'simple_html_dom.php';
require_once 'db.php';

$db = new Db();

//получить subcategories из базы
$subcategories = $db->select_subcategories();

//FIXME отладить
//$subcategories = array_slice($subcategories, 0, 2);
//var_dump($subcategories);

//пройти по категориям
foreach ($subcategories as $subcategory) {

    echo '<pre>';
    print_r($subcategory);
    echo '</pre>';

//пройти по страницам. первые 100
    for ($i = 0; $i <= 10 * 100; $i = $i + 10) {

//FIXME отладить
//  for ($i = 0; $i <= 10 * 1; $i = $i + 10) {

//урл
        $url = 'https://www.indeed.co.uk/jobs?q=' .
            urlencode($subcategory['name']) .
            '&start=' .
            $i;
        var_dump($url);

//получить страницу
        $page = Curl::getpage($url);
        $html = new simple_html_dom();
        $html->load($page['content']);

//найти вакансии
        foreach ($html->find('td#resultsCol div.result') as $v) {

            $user = trim($v->find('span.company', 0)->plaintext);
            $city = trim($v->find('span.location', 0)->plaintext);
            $salary = get_salary(trim($v->find('td.snip span.no-wrap', 0)->plaintext));

//проверить город на наличие в базе, если есть то получить cities_id, или вставить без города и страны
            $city_exists = $db->select_city($city);

            if ($city_exists) {
                $countries_id = $city_exists['countries_id'];
                $cities_id = $city_exists['id'];
            } else {
                $countries_id = NULL;
                $cities_id = NULL;
            }

//проверить юзера на наличие в базе, если есть то получить users_id, или вставить нового
            $user_exists = $db->select_user($user);

            if ($user_exists) {
                $users_id = $user_exists['id'];
            } else {
                $users_id = $db->insert_user($user);
            }

//определить валюту. пока рассмотреть две
            if ($salary['salary_currency'] == '£') {
                $currencies_id = 2;
            } else if ($salary['salary_currency'] == '$') {
                $currencies_id = 1;
            } else {
//применить по умолчанию. хотя валюты могут быть и другие. а мы туда выставим доллар
                $currencies_id = 1;
            }

            $project = [
                'users_id' => $users_id,
                'countries_id' => $countries_id,
                'cities_id' => $cities_id,
                'currencies_id' => $currencies_id,
                'name' => trim($v->find('h2 a.turnstileLink', 0)->plaintext),
                'description' => trim($v->find('td.snip span.summary', 0)->plaintext),
                'salary_by_fix' => $salary['salary_by_fix'],
                // делим зарплату в день, на 8 часов и потом умножаем на 160 часов
                'salary_by_hour' => intval(($salary['salary_by_hour'] / 8) * 160),
                'visible' => '1',
                'type' => '2',
                'url' => 'https://www.indeed.co.uk' . trim($v->find('h2 a.turnstileLink', 0)->href),
            ];

            echo '<pre>';
            print_r($project);
            echo '</pre>';

//вставить вакансию в projects
            $projects_id = $db->insert_project($project);

//вставить id проекта и категорию в projects_has_subcategories
            $db->insert_projects_has_subcategories($projects_id, $subcategory['id']);

        }

        unset($html);

    }

}

function get_salary($v) {

    $salary = [
        'salary_by_fix' => 0, // за год
        'salary_by_hour' => 0, // за месяц
        'salary_currency' => '', // валюта
    ];

    $regexp_currency = '(?<regexp_currency>\\$|£)';
    $regexp_salary = '(?<regexp_salary>.+?)';

//если year
    if (preg_match("~a year~isu", $v) == 1) {

//если £28,000 - £30,000 a year
        if (preg_match("~\-~isu", $v) == 1) {

            if (preg_match("~^" . $regexp_currency . $regexp_salary . "\s~isu", $v, $match) == 1) {
                $salary['salary_by_fix'] = str_replace(',', '', $match['regexp_salary']);
                $salary['salary_currency'] = $match['regexp_currency'];
            }

        } else {
//если £25,000 a year
            if (preg_match("~^" . $regexp_currency . $regexp_salary . "\s~isu", $v, $match) == 1) {
                $salary['salary_by_fix'] = str_replace(',', '', $match['regexp_salary']);
                $salary['salary_currency'] = $match['regexp_currency'];
            }
        }

    }


// если day
    if (preg_match("~a day~isu", $v) == 1) {

//если £120 - £150 a day
        if (preg_match("~\-~isu", $v) == 1) {

            if (preg_match("~^" . $regexp_currency . $regexp_salary . "\s~isu", $v, $match) == 1) {
                $salary['salary_by_hour'] = str_replace(',', '', $match['regexp_salary']);
                $salary['salary_currency'] = $match['regexp_currency'];
            }

        } else {
//если £500 a day
            if (preg_match("~^" . $regexp_currency . $regexp_salary . "\s~isu", $v, $match) == 1) {
                $salary['salary_by_hour'] = str_replace(',', '', $match['regexp_salary']);
                $salary['salary_currency'] = $match['regexp_currency'];
            }
        }

    }

    return $salary;
}