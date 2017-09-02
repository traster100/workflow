<!--страница логина, логинимся получаем токен-->

<?php
$client_id = 123123;
$scope = 'offline,messages'
?>

<a href="https://oauth.vk.com/authorize?client_id=<?= $client_id; ?>&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=<?= $scope; ?>&response_type=token&v=5.67">Push
  the button</a>

<!--сам код-->
<?php

/*
ман https://habrahabr.ru/post/265563/
*/

$params = array(
 'access_token' => '123123',
 'v' => '5.67',
// 'user_id' => 123123, // id юзера
 'chat_id' => 123123, // id чата
);

function translate($v2, $lang_from = 'en', $lang_to = 'ru') {
 require_once 'curl.php';
 $v2 = urlencode($v2);
 $yandex_key = '123123';
 $url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=' . $yandex_key . '&text=' . $v2 . '&lang=' . $lang_from . '-' . $lang_to;
 $page = Curl::getpage($url);
 $page = json_decode($page, 1);
 // переведенное слово
 return $trans = mb_strtolower($page['text'][0], 'utf-8');
}

function google_links($word) {
 require_once 'simple_html_dom.php';
 $curl = curl_init();
 curl_setopt($curl, CURLOPT_URL, 'https://www.google.ru/search?q=' . $word);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $content = curl_exec($curl);
 curl_close($curl);
 $html = new simple_html_dom();
 $html->load($content);
 $result = array();
 foreach ($html->find('h3.r a') as $v1) {
  $href = $v1->href;
  $href = preg_replace("~(^\/url\?q=)~isu", '', $href);
  $result[] = array(
   'href' => $href,
  );
 }
 $html->clear();
 unset($html);
 return $result;
}

function send_message($params, $message) {
 $params['message'] = $message;
// message_id
 return file_get_contents(
  'https://api.vk.com/method/messages.send',
  false,
  stream_context_create(
   array(
    'http' => array(
     'method' => 'POST',
     'header' => 'Content-type: application/x-www-form-urlencoded',
     'content' => http_build_query($params)
    )
   )
  )
 );
}

function control($message) {
// мессаги от самого бота
 if ($message->from_id == 123123) {
  return false;
 }

 if ($message->read_state == 1 and $message->out == 1 and $message->from_id != 123123) {
  return false;
 }

 $file = '/vkchatbot/log.txt';
 $ids = file($file, FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

 if (in_array($message->id, $ids)) {
  return false;
 }

 $ids[] = $message->id;
 file_put_contents($file, implode("\n", $ids), FILE_USE_INCLUDE_PATH | LOCK_EX);
 return true;

}

// получение последних месаг в чате
// https://vk.com/dev/messages.getHistory
function history_message($params, $count) {
 $params['count'] = $count;
 $result = file_get_contents(
  'https://api.vk.com/method/messages.getHistory',
  false,
  stream_context_create(
   array(
    'http' => array(
     'method' => 'POST',
     'header' => 'Content-type: application/x-www-form-urlencoded',
     'content' => http_build_query($params)
    )
   )
  )
 );
 return json_decode($result);
}


$messages = history_message($params, 1);
print_r($messages);


foreach ($messages->response->items as $message) {

//ЕСЛИ МЕССАГА НЕ ЮЗЕРА, ИЛИ УЖЕ БЫЛА ОНА ПРИНЯТА
 if (!control($message)) {
  continue;
 }

//ПЕРЕВОД МЕССАГ БОЛЬШЕ 100 СИМВОЛОВ
 if (
  strlen($message->body) > 100
  and
  file_get_contents('/vkchatbot/status.txt', FILE_USE_INCLUDE_PATH) == 'on'
 ) {

  $text = translate($message->body, 'ru', 'en');
  send_message($params, ucfirst($text));

//ПЕРЕВОД СПИСКА СЛОВ
  $i_know_this_words = file('/vkchatbot/english_words.txt', FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  $words = explode(' ', $text);
  $words = array_unique($words);

  $result = array();
  foreach ($words as $word) {
   $word = preg_replace("~[^\w]~isu", '', $word);
   $word = trim($word);
   if (empty($word) or in_array($word, $i_know_this_words)) {
    continue;
   }
   $result[] = $word . ': ' . translate($word, 'en', 'ru');
  }
  send_message($params, implode(', ', $result));
 }

 if (preg_match("~^бот~isu", $message->body) == 0) {
  continue;
 }

 //СМЕНА СТАТУСА АВТОПЕРЕВОДА
 if (preg_match("~бот (on|off)~isu", $message->body, $match) == 1) {
  file_put_contents('/vkchatbot/status.txt', $match[1], FILE_USE_INCLUDE_PATH | LOCK_EX);
  send_message($params, 'сменил на ' . $match[1]);
 }

//БОТ ТЕСТ
 if (preg_match("~бот тест~isu", $message->body) == 1) {
  $text = '';
  foreach ($message as $k => $v) {
   $text .= $k . ': ' . $message->$k . "\n";
  }
  send_message($params, $text);
 }

//БОТ ХЕЛП
 if (preg_match("~бот хелп~isu", $message->body) == 1) {
  $text = '';
  foreach (
   array(
    'бот найди' => 'поиск в гугле',
    'бот слова' => '10 случайных слов',
    'бот переведи' => 'перевод фразы',
    'бот on | off' => 'статус автоперевода (' . file_get_contents('/vkchatbot/status.txt', FILE_USE_INCLUDE_PATH) . ')',
    'бот тест' => 'проверка работоспособности',
   ) as $k => $v) {
   $text .= $k . ': ' . $v . "\n";
  }
  send_message($params, $text);
 }

//БОТ СЛОВА
 if (preg_match("~бот слова~isu", $message->body) == 1) {
  $words = file('/vkchatbot/english_words.txt', FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $needwords = array_rand($words, 10);
  $text = '';
  foreach ($needwords as $word) {
   $text .= $words[$word] . ': ' . translate($words[$word]) . "\n";
  }
  send_message($params, $text);
 }

//БОТ ПЕРЕВЕДИ
 if (preg_match("~бот переведи~isu", $message->body) == 1 or preg_match("~^\.~isu", $message->body) == 1) {
  $text = preg_replace("~(^бот переведи)~isu", '', $message->body);
  $text = translate($text, 'ru', 'en');
  send_message($params, $text);
 }

//БОТ НАЙДИ
 if (preg_match("~бот найди~isu", $message->body) == 1) {
  $word = preg_replace("~(^бот найди)~isu", '', $message->body);
  $links = google_links(urlencode($word));
  $link = $links[0]['href'];
  $link = explode('&', $link);
  send_message($params, urldecode($link[0]));
 }

}