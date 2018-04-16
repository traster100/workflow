<?php
//забирает список тех, кто подписан на акк, и список тех, на кого подписан акк. и удаляет невзаимных фолловеров

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
    'url' => 'https://www.instagram.com/user/',

//нужное кол-во отписок за раз
    'items' => 1000,

//кол-во подписок и подписчиков. для контроля что скрипт полностью забрал оба списка. ставим цифры на 10 меньше
    'followers' => 5149, // подписчиков
    'following' => 6213, // Подписки
);

//стартуем браузер
$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome(), 5000);

//задержка между действиями
$sleep = 1;

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
sleep($sleep);

$links = [];
foreach (
    array(
        'following' => 'a._s53mj[href="/user/following/"]',
        'followers' => 'a._s53mj[href="/user/followers/"]',
    ) as $k => $v) {

//открываем урл акка
    try {
        $driver->get($config['url']);
    } catch (\Exception $e) {
        echo $e->getMessage();
        $driver->quit();
        exit ('не открылся урл акка');
    }
    sleep($sleep);

//клик по кнопке "N подписчиков" или "Подписки N"
    try {
        $driver->findElement(WebDriverBy::cssSelector($v))->click();
    } catch (\Exception $e) {
        echo $e->getMessage();
        $driver->quit();
        exit ('не сработал клик по кнопке "N подписчиков" или "Подписки N"');
    }
    sleep($sleep);

//кликаем по телу списка
    try {
        $driver->findElement(WebDriverBy::cssSelector('div._4gt3b'))->click();
        $driver->findElement(WebDriverBy::cssSelector('div._4gt3b'))->click();
    } catch (\Exception $e) {
        echo $e->getMessage();
        $driver->quit();
        exit ('не сработал клик по телу списка');
    }
    sleep($sleep);

//мотаем вниз список на N скролов
    for ($i = 0; $i < 10000; $i++) {
        try {
            $driver->getKeyboard()->sendKeys(WebDriverKeys::PAGE_DOWN);
        } catch (\Exception $e) {
            continue;
        }
// паузы при пролистывании	
        //if (in_array($i, range(0, 10000, 500))) {sleep($sleep);}
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

//списки
    foreach ($html1->find('a._4zhc5') as $v1) {
        $links[$k][] = 'https://www.instagram.com' . $v1->href;
    }

    $html1->clear();
    unset($html1);

//убрать все попапы
    for ($i = 0; $i < $config['esc']; $i++) {
        try {
            $driver->getKeyboard()->sendKeys(WebDriverKeys::ESCAPE);
        } catch (\Exception $e) {
            continue;
        }
    }

    sleep($sleep);
}

//обрабатываем списки
//========================================================================
echo 'установлено. config[following]: ' . $config['following'] . N;
echo 'установлено. config[followers]: ' . $config['followers'] . N;

$following = $links['following'];
$followers = $links['followers'];

echo 'фактически. following: ' . count($following) . N;
echo 'фактически. followers: ' . count($followers) . N;

if (count($following) > $config['following'] and count($followers) > $config['followers']) {
    echo 'списки забрались полные' . N;
} else {
    echo 'списки забрались не полные' . N;
    $driver->quit();
    exit;
}

//проходим список на кого подписались, и ищем в списке кто подписался обратно, если есть то удаляем
$for_unsuncribe = [];
foreach ($following as $k => $v) {
    if (!in_array($v, $followers)) {
        $for_unsuncribe[] = $v;
    }
}

// весь список для отписок
echo 'total ' . count($for_unsuncribe);
echo 'all list <pre>';
foreach ($for_unsuncribe as $v123) {
    echo $v123 . ' <br>';
}
echo '</pre>';


//перемешаем массив, и возьмем первые N профилей для отписки
shuffle($for_unsuncribe);
$for_unsuncribe = array_slice($for_unsuncribe, 0, $config['items']);
echo 'сколько надо отписать: ' . count($for_unsuncribe) . N . N;
//========================================================================

//отписываемся
foreach ($for_unsuncribe as $v3) {

//открываем урл фоловера
    try {
        $driver->get($v3);
        echo "<a target='_blank' href='" . $v3 . "'>" . $v3 . "</a>";
    } catch (\Exception $e) {
        echo $e->getMessage();
        echo 'не открылся урл фоловера';
        continue;
    }
    sleep($sleep);

    for ($i = 0; $i < 3; $i++) {

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
        $button = $html2->find('button._ah57t', 0)->plaintext; // кнопка отписки
        $html2->clear();
        unset($html2);

//отписываемся
        if ($button == 'Подписки') {
            try {
                $driver->findElement(WebDriverBy::cssSelector('button._ah57t'))->click();
                sleep($sleep);
            } catch (\Exception $e) {
                echo $e->getMessage();
                echo 'не сработал клик по кнопке "Подписки"';
                continue;
            }
        }
        sleep($sleep);

//проверка что отписка произошла
        if ($button == 'Подписаться') {
            echo ' : кнопка "Подписаться" появилась';
            echo ' : отписка';
            $db->instagram_insert($v3);
            break;
        }
    }

    echo N;

}

$driver->quit();
echo '<hr>' . 'done';