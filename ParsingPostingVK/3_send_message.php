<?php
//отправка мессаги юзеру

namespace Facebook\WebDriver;

echo '<html><head><title>3_send_message</title><head><html>';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverKeys;

require_once 'vendor/autoload.php';
require_once 'vendor/simple_html_dom.php';
require_once 'vendor/curl.php';
require_once 'vendor/db.php';

function __debug($id, $profile, $status) {
 file_put_contents('3_send_message.log', $id . ' : ' . $profile . ' : ' . $status . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);
}

$sleep = 5;
$db = new \Db();
echo date('H:i:s') . '<br><br>';


for ($i = 0; $i < 200; $i++) {

//стартуем браузер
 $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome(), 5000);

//аккаунт с которого постим
 $account = $db->account_get();
//профиль кому постим
 $profile = $db->profile_get();

//тестовый аккаунт
//$profile['url'] = 'https://vk.com/traster100';
//$profile['id'] = 000;

//текст
 $address = 'Москва, 21 августа, 13-00, встреча';
 $text = file_get_contents('messages.txt', FILE_USE_INCLUDE_PATH);
 $text = preg_replace("~(NNN)~isu", $address, $text);
 $texts = preg_split("~={10}~isu", $text);
 $message = trim($texts[array_rand($texts)]);

 if (!$account OR !$profile) {
  $driver->quit();
  exit ('кончились аккаунты или профиля');
 }

 echo '<hr>' . $i . '<br>';
 echo 'аккаунт : ' . $account['id'] . ' : ' . $account['login'] . ' : ' . $account['password'] . '<br>';
 echo 'профиль : ' . $profile['id'] . ' : ' . '<a target="_blank" href="' . $profile['url'] . '">' . $profile['url'] . '</a>' . '<br>';
//    print_r($account);
//    print_r($profile);

//открываем урл
 try {
  $driver->get($profile['url']);
 } catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  continue;
 }
 sleep($sleep);

//логин
 try {
  $driver->findElement(WebDriverBy::id("quick_email"))->sendKeys($account['login']);
  $driver->findElement(WebDriverBy::id("quick_pass"))->sendKeys($account['password']);
  $driver->findElement(WebDriverBy::id('quick_login_button'))->click();
//        $driver->findElement(WebDriverBy::id("index_email"))->sendKeys($account['login']);
//        $driver->findElement(WebDriverBy::id("index_pass"))->sendKeys($account['password']);
//        $driver->findElement(WebDriverBy::id('index_login_button'))->click();
 } catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  continue;
 }
 sleep($sleep);


//убрать все попапы
 for ($i1 = 0; $i1 < 10; $i1++) {
  try {
   $driver->getKeyboard()->sendKeys(WebDriverKeys::ESCAPE);
  } catch (\Exception $e) {
   continue;
  }
 }

//забираем html страницы
 try {
  $page = $driver->getPageSource();
 } catch (\Exception $e) {
  echo $e->getMessage();
  $driver->quit();
  continue;
 }
 $html = new \simple_html_dom();
 $html->load($page);

//аккаунт забанен
 $sel1 = 'div.login_blocked_centered';
 $sel2 = '#message';
 if (
  (
   $html->find($sel1, 0)
   AND
   preg_match("~Эта страница была заморожена за рассылку от Вашего лица таких~isu", $html->find($sel1, 0)->plaintext) == 1
  )
  OR
  (
   $html->find($sel2, 0)
   AND
   preg_match("~Не удается войти~isu", $html->find($sel2, 0)->plaintext) == 1
  )
 ) {
  $db->account_ban($account['id']);
  __debug($account['id'], '', 'аккаунт забанен');
  echo 'аккаунт забанен';
  $driver->quit();
  continue;
 }

//0-не отправлялось
//1-забанен
//2-удален
//3-мертвый по времени
//4-нет кнопки отправить сообщение
//5-отправлено сообщение

//профиль забанен
 $sel = '.profile_blocked';
 if (
  $html->find($sel, 0)
  AND
  preg_match("~Мы обнаружили на странице(.*?)подозрительную активность~isu", $html->find($sel, 0)->plaintext) == 1
 ) {
  $db->profile_update($profile['id'], 1);
  __debug($profile['id'], $profile['url'], 1);
  echo 'профиль забанен';
  $driver->quit();
  continue;
 }

//профиль удален
 $sel1 = '.profile_deleted';
 $sel2 = '.profile_deleted_text';
 $sel3 = 'div.message_page div.body';
 if (
  (
   $html->find($sel1, 0)
   AND
   preg_match("~Страница удалена~isu", $html->find($sel1, 0)->plaintext) == 1
   AND
   $html->find($sel2, 0)
   AND
   preg_match("~Страница пользователя удалена~isu", $html->find($sel2, 0)->plaintext) == 1
  )
  OR
  (
   $html->find($sel3, 0)
   AND
   preg_match("~Страница удалена либо ещё не создана~isu", $html->find($sel3, 0)->plaintext) == 1
  )
 ) {
  $db->profile_update($profile['id'], 2);
  __debug($profile['id'], $profile['url'], 2);
  echo 'профиль удален';
  $driver->quit();
  continue;
 }

//наличие кнопки 'Написать сообщение'
 $sel = '.profile_btn_cut_left';
 if (
  $html->find($sel, 0)
  AND
  preg_match("~Написать сообщение~isu", $html->find($sel, 0)->plaintext) == 1
 ) {
  echo 'есть кнопка "Написать сообщение".';
 } else {
  $db->profile_update($profile['id'], 4);
  __debug($profile['id'], $profile['url'], 4);
  echo 'нет кнопки "Написать сообщение".';
  $driver->quit();
  continue;
 }


//постим
 try {
//клик на кнопке Написать сообщение
  $driver->findElement(WebDriverBy::cssSelector($sel))->click();
  sleep($sleep);
  $driver->findElement(WebDriverBy::id("mail_box_editable"))->sendKeys($message);
  sleep($sleep);
  $driver->findElement(WebDriverBy::id('mail_box_send'))->click();
 } catch
 (\Exception $e) {
  echo $e->getMessage();
  __debug($profile['id'], $profile['url'], 'попап не отправился');
  echo 'попап не отправился';
  $driver->quit();
  continue;
 }

//ловим попап "Сообщение отправлено"
 for ($i2 = 0; $i2 <= 20; $i2++) {
//забираем html страницы
  try {
   $page = $driver->getPageSource();
  } catch (\Exception $e) {
   echo $e->getMessage();
   continue;
  }
  $html = new \simple_html_dom();
  $html->load($page);

//панелька "Сообщение отправлено"
  $result = $html->find('div.top_result_baloon div.top_result_header', 0)->plaintext;
  var_dump($result);

  if (preg_match("~Сообщение отправлено~isu", $result) == 1) {
   $db->account_update($account['id']);
   $db->profile_update($profile['id'], 5);
   __debug($profile['id'], $profile['url'], 5);
   $driver->quit();
   break;
  }

  usleep(100000); // 0.1 секунды
  $html->clear();
  unset($html);
 }

}

//$driver->quit();