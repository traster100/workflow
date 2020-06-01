<?php

//подписка на фоловеров, у донора инстаграм, и простановка лайков

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverKeys;

require_once 'C:/YD/domains/dating.loc/include.php';
require_once 'vendor/autoload.php';
require_once 'vendor/simple_html_dom.php';
require_once 'vendor/curl.php';
require_once 'vendor/db.php';

$db = new \Db();

//настройки
$config = array(
  'esc' => 3, // кол-во нажатий Esc для убирания попапов

  'user' => '',
  'pass' => '',

  'url' => 'https://www.instagram.com/NNN/', // донор фоловеров
  'items' => 700, // нужное кол-во фоловеров из списка фоловеров
);

//стартуем браузер
$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome(), 5000);

//задержка между действиями
$sleep = 3;

//открываем урл логина
try {
  $driver->get('https://www.instagram.com/accounts/login/');
} catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit ('не открылся урл логина');
}
sleep($sleep);

//логин
try {
  $driver->findElement(WebDriverBy::cssSelector("input[name=username]"))->sendKeys($config['user']);
  $driver->findElement(WebDriverBy::cssSelector("input[name=password]"))->sendKeys($config['pass']);
  $driver->findElement(WebDriverBy::cssSelector('button._ah57t'))->click();
} catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit ('неудачный логин');
}
sleep($sleep);

//убрать все попапы
for ($i = 0; $i < $config['esc']; $i++) {
  try {
    $driver->getKeyboard()->sendKeys(WebDriverKeys::ESCAPE);
  } catch (\Exception $e) {
    continue;
  }
}

//открываем урл донора
try {
  $driver->get($config['url']);
} catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit ('не открылся урл донора');
}
sleep($sleep);

//клик по кнопке "Показать фолловеров"
try {
  $driver->findElement(WebDriverBy::cssSelector('a._s53mj'))->click();
} catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit ('не сработал клик по кнопке "Показать фоловеров"');
}
sleep($sleep);

//кликаем по списку фоловеров
try {
  $driver->findElement(WebDriverBy::cssSelector('div._4gt3b'))->click();
} catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit ('не сработал клик по списку фоловеров');
}
sleep($sleep);

//мотаем вниз список на 5000 скролов
for ($i = 0; $i < 5000; $i++) {
  try {
    $driver->getKeyboard()->sendKeys(WebDriverKeys::PAGE_DOWN);
  } catch (\Exception $e) {
    continue;
  }
  // паузы при пролистывании
  //if (in_array($i, range(0, 3000, 300))) {sleep($sleep);}
}
sleep($sleep);

//забираем html страницы
try {
  $page = $driver->getPageSource();
} catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  exit ('неудачный забор страницы');
}
$html1 = new \simple_html_dom();
$html1->load($page);

//список фоловеров донора
$links = [];
foreach ($html1->find('a._4zhc5') as $v1) {
  $link = 'https://www.instagram.com' . $v1->href;

  if ($db->instagram_check($link)) {
    echo "<a target='_blank' href='" . $link . "'>" . $link . "</a>" . ' есть в базе' . N;
  } else {
    echo "<a target='_blank' href='" . $link . "'>" . $link . "</a>" . ' нет в базе' . N;
    $links[] = $link;
  }
}

$html1->clear();
unset($html1);

//перемешаем массив, и возьмем первые N фоловеров
shuffle($links);
$links = array_slice($links, 0, $config['items']);
echo 'Всего: ' . count($links) . N . N;

//открываем фолловеров в цикле
foreach ($links as $v2) {

  //открываем урл фоловера
  try {
    $driver->get($v2);
    echo "<a target='_blank' href='" . $v2 . "'>" . $v2 . "</a>";
  } catch (\Exception $e) {
    echo $e->getMessage();
    echo 'не открылся урл фоловера';
    continue;
  }
  sleep($sleep);

  //забираем html страницы
  try {
    $page = $driver->getPageSource();
  } catch (\Exception $e) {
    echo $e->getMessage();
    echo 'неудачный забор страницы';
    continue;
  }
  $html2 = new \simple_html_dom();
  $html2->load($page);

  //клик по кнопке "Подписаться"
  $button = $html2->find('button._ah57t', 0)->plaintext;
  if ($button == 'Подписаться') {
    try {
      $driver->findElement(WebDriverBy::cssSelector('button._ah57t'))->click();
      echo ' : подписка';
    } catch (\Exception $e) {
      echo $e->getMessage();
      echo 'не сработал клик по кнопке "Подписаться"';
      continue;
    }
    sleep($sleep);
  }

  //проход по фоткам фоловера
  foreach ($html2->find('a._8mlbc') as $k3 => $v3) {

    //лайкаем 1-2 фотки
    if ($k3 > rand(0, 1)) {
      break;
    }

    //клик по фотке
    try {
      $driver->findElement(WebDriverBy::cssSelector('a[href="' . $v3->href . '"]'))->click();
    } catch (\Exception $e) {
      echo $e->getMessage();
      echo 'не сработал клик по фотке';
      continue;
    }
    sleep($sleep);

    //забираем html страницы
    try {
      $page = $driver->getPageSource();
    } catch (\Exception $e) {
      echo $e->getMessage();
      echo 'неудачный забор страницы';
      continue;
    }
    $html3 = new \simple_html_dom();
    $html3->load($page);
    $heart = $html3->find('a._ebwb5 span', 0)->plaintext;

    //клик по сердечку
    if ($heart == 'Нравится') {
      try {
        $driver->findElement(WebDriverBy::cssSelector('a._ebwb5'))->click();
        echo ' : лайк';
      } catch (\Exception $e) {
        echo $e->getMessage();
        echo 'не сработал клик по сердечку';
        continue;
      }
      sleep($sleep);
    }

    $html3->clear();
    unset($html3);

    //Esc на фотке
    try {
      $driver->getKeyboard()->sendKeys(WebDriverKeys::ESCAPE);
    } catch (\Exception $e) {
      echo $e->getMessage();
      echo 'не сработал Esc на фотке';
      continue;
    }
    sleep($sleep);

  }

  echo N;

  $html2->clear();
  unset($html2);
}

$driver->quit();
echo '<hr>' . 'done';