<?php
//парсинг групп в поиске, по ключевым словам

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverKeys;

echo '<html><head><title>1_search_groups</title><head><html>';

require_once 'vendor/autoload.php';
require_once 'vendor/simple_html_dom.php';
require_once 'vendor/curl.php';

//стартуем браузер
$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome(), 5000);
$sleep = 3;

//формируем запросы
$queries = array(
 'слово1',
 'слово2',
 'слово3',
);

//проходим все запросы
foreach ($queries as $q) {

//формируем урл
 $url = 'https://vk.com/search?c[q]=' . urlencode($q) . '&c[section]=communities';
 var_dump($url);

//открываем урл
 try {
  $driver->get($url);
 } catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit;
 }
 sleep($sleep);

//N скролов вниз
 for ($i = 0; $i < 2000; $i++) {
  $driver->getKeyboard()->sendKeys(WebDriverKeys::PAGE_DOWN);
 }
 sleep($sleep);

//забираем html страницы со списком групп
 try {
  $page = $driver->getPageSource();
 } catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit;
 }

//парсим группы (но тут нет id групп)
 $html = new \simple_html_dom();
 $html->load($page);

 $result1 = array(); // массив групп
 foreach ($html->find('div.groups_row') as $v1) {
  $result1[] = array(
   'href' => 'https://vk.com' . $v1->find('div.labeled a', 0)->href,
   'title' => $v1->find('div.labeled a', 0)->plaintext,
  );
 }
 $html->clear();
 unset($html);
//var_dump($result1);


//заходим в каждую группу, и дергаем ее id
 $result2 = array();
 foreach ($result1 as $v2) {

//открываем урл группы
  try {
   $driver->get($v2['href']);
  } catch (\Exception $e) {
   echo $e->getMessage();
   $driver->quit();
   exit;
  }
  sleep($sleep);

//забираем html страницы
  try {
   $page = $driver->getPageSource();
  } catch (\Exception $e) {
   echo $e->getMessage();
   $driver->quit();
   exit;
  }

  $html = new \simple_html_dom();
  $html->load($page);

//если нет блока "Участники" значит участников 0, группу пропускаем
  $id = $html->find('.people_module a', 0)->href;
  if (empty($id)) {
   continue;
  }

//вытаскиваем из ссылки "Участники" id группы
  if (preg_match("~=(\d*)$~isu", $id, $match) == 1) {
   $id = $match[1];
  }

  $result2[] = array(
   'href' => $v2['href'],
   'title' => $v2['title'],
   'id' => $id,
  );

//отображаем для чтения в браузере
  echo
   $v2['title'] .
   ' : ' .
   "<a target='_blank' href='" . $v2['href'] . "'>" . $v2['href'] . "</a>" .
   ' : ' .
   "<a target='_blank' href='" . 'https://vk.com/club' . $id . "'>" . 'https://vk.com/club' . $id . "</a>" .
   '<br>';

  $html->clear();
  unset($html);
 }
//var_dump($result2);

//отдельно отображаем id групп, для забора в следующий файл, для парсинга профилей
 foreach ($result2 as $v3) {
  echo "'" . $v3['id'] . "'," . '<br>';
 }

}

$driver->quit();