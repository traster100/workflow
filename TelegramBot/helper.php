<?php

// файл привязки аккаунта телеграм к магазину
// application/controllers/telegram.php

if (!defined('BASEPATH')) exit('No direct script access allowed');

define('TOKEN', '');

// поток данных из чата телеграм
function telegram_receive() {
 $content = file_get_contents("php://input");
 return json_decode($content, TRUE);
}

// отправка курлом данных в телеграм
function telegram_send($method, $data) {

 $curld = curl_init();

 curl_setopt($curld, CURLOPT_URL, "https://api.telegram.org/bot" . TOKEN . '/' . $method);
 curl_setopt($curld, CURLOPT_POST, true);
 curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
 curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

 $output = curl_exec($curld);
 curl_close($curld);

 return $output;
}

// стандартный набор кнопок
function telegram_reply_markup() {

 $buttons = [];

 $buttons[] = ['text' => 'Когда завоз', 'callback_data' => 'preanswers-0'];
 $buttons[] = ['text' => 'Как оплатить', 'callback_data' => 'howtopay'];

 return json_encode(
  [
   'inline_keyboard' => [
    $buttons
   ]
  ]);

}