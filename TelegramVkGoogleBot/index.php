<?php

require 'VkApi.php';
require 'GoogleApi.php';
require 'TelegramApi.php';

$event = json_decode(file_get_contents('php://input'), true);

$VkApi = new VkApi();

if ($VkApi->querymanager($event['type'])) {

  //объект сообщения
  $object = $event['object'];

  //понять, сообщение от лички, или от чата
  if (!empty($object['user_id'])) {
    $message = $object['body'];
    $to = $object['user_id'];

  } elseif (!empty($object['peer_id'])) {
    $message = $object['text'];
    $to = $object['peer_id'];
  } else {
    exit;
  }

  //переводим
  $GoogleApi = new GoogleApi();

  //сначала русскую мессагу на англ
  $ru_en = $GoogleApi->translate($message);

  //потом англ мессагу обратно на русский, для корректности!
  $en_ru = $GoogleApi->translate($ru_en, 'en', 'ru');

  //посылаем туда, откуда прилетело
  //$VkApi->send_message($to, $message);

  //посылаем всегда мне в личку вк
  //$VkApi->send_message($my_vk_chat_id, $message);

  echo('ok');

  //работа по Телеге
  $event = json_decode(file_get_contents('php://input'), true);
  $TelegramApi = new TelegramApi();

  $TelegramApi->send_message('sendMessage', [
    'chat_id' => $my_tg_chat_id,
    'text' => $en_ru . "\n\n" . $ru_en,]);

}