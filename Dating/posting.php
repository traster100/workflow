<?php

//отправка мессаги на профиля dating.ru


/*
запуск Selenium

"C:\Program Files\Java\jre1.8.0_161\bin\java.exe" -Dwebdriver.chrome.driver=C:\YD\domains\dating.loc\vendor\chromedriver.exe -jar "C:\YD\domains\dating.loc\vendor\selenium-server-standalone.jar"
*/


namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverKeys;

require_once 'C:/YD/domains/dating.loc/include.php';
require_once 'vendor/autoload.php';
require_once 'vendor/simple_html_dom.php';
require_once 'vendor/curl.php';
require_once 'vendor/db.php';

//параметры
$config = array(
  'im' => 'm', // кто я
  'search' => 'f', // кому пощу
);

echo '<pre>';
print_r($config);
echo '</pre>';

$sleep = rand(4, 6);
$db = new \Db();

//аккаунт, с которого постим
$account = $db->account_get($config['im']);
if (!$account) {
  exit ('кончились аккаунты');
}
echo 'аккаунт : ' . $account['id'] . ' : ' . $account['login'] . ' : ' . $account['password'] . N;

//стартуем браузер
$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome(), 5000);

//открываем урл логина
try {
  $driver->get('http://dating.ru/auth.php');
} catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit ('неудачный логин');
}
sleep($sleep);

//логин
try {
  $driver->findElement(WebDriverBy::id("field_auth_email"))->sendKeys($account['login']);
  $driver->findElement(WebDriverBy::id("field_auth_password"))->sendKeys($account['password']);
  $driver->findElement(WebDriverBy::id('button_auth_submit'))->click();
} catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit ('неудачный логин');
}
sleep($sleep);

//цикл по 100 акков за раз
for ($i = 0; $i < 100; $i++) {
  sleep($sleep);

  //профиль, кому постим
  $profile = $db->profile_get($account['id'], $config['search']);
  if (!$profile) {
    echo 'кончились профиля';
    break;
  }

  echo '<br>' . $profile['id'] . ' : ' . '<a target="_blank" href="' . $profile['url'] . '">' . $profile['url'] . '</a>' . ' : ';

  //открываем урл профиля
  try {
    $driver->get($profile['url']);
  } catch (\Exception $e) {
    echo $e->getMessage();
    continue;
  }
  sleep($sleep);

  //забираем html страницы
  try {
    $page = $driver->getPageSource();
  } catch (\Exception $e) {
    echo $e->getMessage();
    continue;
  }
  $html = new \simple_html_dom();
  $html->load($page);

  if (
    $html->find('body h1', 0)
    AND
    preg_match("~404 ошибка~isu", $html->find('body h1', 0)->plaintext) == 1
    AND
    preg_match("~Такой страницы не существует~isu", $html->find('body', 0)->plaintext) == 1
  ) {
    echo '404 ошибка';
    $db->profile_del($profile['id']);
    continue;
  }

  $html->clear();
  unset($html);

  //убрать все попапы
  for ($i1 = 0; $i1 < 10; $i1++) {
    try {
      $driver->getKeyboard()->sendKeys(WebDriverKeys::ESCAPE);
    } catch (\Exception $e) {
      continue;
    }
  }
  sleep($sleep);

  //забираем html страницы
  try {
    $page = $driver->getPageSource();
  } catch (\Exception $e) {
    echo $e->getMessage();
    continue;
  }
  $html = new \simple_html_dom();
  $html->load($page);

  //наличие кнопки 'Написать сообщение'
  $sel = '.tab_form .spaced a[href*=message]';
  if (
    $html->find($sel, 0)
    AND
    preg_match("~Написать сообщение~isu", $html->find($sel, 0)->plaintext) == 1
  ) {
    echo 'есть кнопка "Написать сообщение"';

    //урл чата
    $chat_popap = 'http://dating.ru' . $html->find($sel, 0)->href;

    //имя профиля
    $name = $html->find('title', 0)->plaintext;
    if (preg_match("~^(.+?),~isu", $name, $match) == 1) {
      $name = $match[1];
    }

  } else {
    echo 'нет кнопки "Написать сообщение"';
    continue;
  }

  $html->clear();
  unset($html);

  //открываем урл чата
  try {
    $driver->get($chat_popap);
  } catch (\Exception $e) {
    echo $e->getMessage();
    continue;
  }
  sleep($sleep);

  //забираем html страницы
  try {
    $page = $driver->getPageSource();
  } catch (\Exception $e) {
    echo $e->getMessage();
    continue;
  }
  $html = new \simple_html_dom();
  $html->load($page);

  $status = '';
  if ($status = $html->find('#center', 0)) {
    $status = $status->plaintext;
  }

  if (preg_match("~Для продолжения общения на сайте, Вам необходимо получить Real-статус~isu", $status) == 1) {
    echo 'просит реал-статус';
    break;
  }
  $html->clear();
  unset($html);

  //текст мессаги
  $text = $account['message'];
  $text = preg_replace("~(NNN)~isu", $name, $text);
  $texts = preg_split("~={10}~isu", $text);
  $message = trim($texts[array_rand($texts)]);

  //постим
  try {
    $driver->findElement(WebDriverBy::id("message"))->sendKeys($message);
    sleep($sleep);
    $driver->findElement(WebDriverBy::id('button_send_submit'))->click();
  } catch
  (\Exception $e) {
    echo $e->getMessage();
    echo 'попап не отправился';
    continue;
  }
  sleep($sleep);

  //признак отправки - пустой текст в поле мессаги
  for ($i2 = 0; $i2 <= 5; $i2++) {

    //забираем html страницы
    try {
      $page = $driver->getPageSource();
    } catch (\Exception $e) {
      echo $e->getMessage();
      continue;
    }
    $html = new \simple_html_dom();
    $html->load($page);

    $result = $html->find('#message', 0)->plaintext;
    //var_dump($result);

    if (empty(trim($result))) {
      $db->account_update($account['id']);
      $db->accounts_has_profiles_update($profile['id'], $account['id']);
      echo ' : ' . 'Сообщение отправлено';
      $html->clear();
      unset($html);
      break;
    }

    sleep($sleep);
    $html->clear();
    unset($html);
  }
}

$driver->quit();
echo '<hr>' . 'done';