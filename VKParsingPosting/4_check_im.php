<?php

//проверка наличия личных сообщений

namespace Facebook\WebDriver;

echo '<html><head><title>4_check_im</title><head><html>';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverKeys;

require_once 'vendor/autoload.php';
require_once 'vendor/simple_html_dom.php';
require_once 'vendor/curl.php';
require_once 'vendor/db.php';

function __debug($id, $profile, $status) {
  echo $id . ' : ' . $profile . ' : ' . $status . '<br>';
}

//стартуем браузер
$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome(), 5000);
$sleep = 3;

$db = new \Db();
$accounts = $db->accounts_get();

echo date('H:i:s') . '<br><br>';
//echo '<pre>';
//print_r($accounts);
//echo '</pre>';

foreach ($accounts as $account) {

  //открываем урл
  try {
    $driver->get('https://vk.com');
  } catch (\Exception $e) {
    echo $e->getMessage();
    $driver->quit();
    exit;
  }
  sleep($sleep);

  //логин
  try {

    //$driver->findElement(WebDriverBy::id("quick_email"))->sendKeys($account['login']);
    //$driver->findElement(WebDriverBy::id("quick_pass"))->sendKeys($account['password']);
    //$driver->findElement(WebDriverBy::id('quick_login_button'))->click();

    $driver->findElement(WebDriverBy::id("index_email"))->sendKeys($account['login']);
    $driver->findElement(WebDriverBy::id("index_pass"))->sendKeys($account['password']);
    $driver->findElement(WebDriverBy::id('index_login_button'))->click();

  } catch (\Exception $e) {
    echo $e->getMessage();
    $driver->quit();
    exit;
  }
  sleep($sleep);

  //убрать все попапы
  for ($i = 0; $i < 10; $i++) {
    $driver->getKeyboard()->sendKeys(WebDriverKeys::ESCAPE);
  }

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

  //есть личные сообщения на акке
  if ($html->find('span.left_count_wrap span.left_count', 0)) {
    __debug($account['id'], $html->find('span.left_count_wrap span.left_count', 0)->plaintext, $account['login'] . ' : ' . $account['password']);
  }

  $driver->findElement(WebDriverBy::id('logout_link'))->click();
  sleep($sleep);

  $html->clear();
  unset($html);
}

$driver->quit();