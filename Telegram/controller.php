<?php

// привязываем через метод SetWebhook бота к нашему файлу-обработчику.
// https://api.telegram.org/NNN:MMM/setWebhook?url=URL

if (!defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);

class Telegram extends CI_Controller {

 public function __construct() {
  parent::__construct();
  $this->load->helper('telegram');
 }

 public function index() {

//поток из чата
  $content = telegram_receive();


//ОТЛАДКА ВОПРОСОВ НА ЛЕТУ

//1. если послана мессага от юзера
  if (isset($content['message'])) {
   $telegram_profile = 'https://t.me/' . $content['message']['chat']['username'];
  }

  $parameters =
   array(
    'chat_id' => MMM, // мессага летит на акк клиента
//   'chat_id' => MMM, // мой
   'text' => 'Юзером, с профилем ' . $telegram_profile . ' и номером чата ' . $content['message']['chat']['id'] . ' задал вопрос: ' . $content['message']['text'],
  );
  telegram_send('sendMessage', $parameters);


//2. если отвечает клиент
  if ($content['message']['chat']['id'] == NNN) {

//если спереди указан номер
   if (preg_match("~(^(\d+))~isu", $content['message']['text'], $match) == 1) {
    $profile_id = $match['1'];
    $parameters =
     array(
      'chat_id' => $profile_id,
      'text' => 'Клиент ответил юзеру ' . $profile_id,
     );
    telegram_send('sendMessage', $parameters);
   }

  }

// /ОТЛАДКА ВОПРОСОВ НА ЛЕТУ


//вбита строковая команда, типа /start
  if (isset($content['message'])) {

   $options = [
    'chat_id' => $content['message']['chat']['id'],
    'first_name' => $content['message']['chat']['first_name'],
    'last_name' => $content['message']['chat']['last_name'],
    'username' => $content['message']['chat']['username'],
    'command' => $content['message']['text'],
   ];

   $this->handle_command($options);

  }

  // вбита кнопка
  if (isset($content['callback_query'])) {

   $options = [
    'chat_id' => $content['callback_query']['message']['chat']['id'],
    'first_name' => $content['callback_query']['message']['chat']['first_name'],
    'last_name' => $content['callback_query']['message']['chat']['last_name'],
    'username' => $content['callback_query']['message']['chat']['username'],
    'button' => $content['callback_query']['data'],
   ];


   $this->handle_button($options);
  }

 }

// обработка команд
 private function handle_command($options) {

  switch ($options['command']) {

// /start
   case '/start':
    $link_for_bind = "URL" . $options['chat_id'];
    $parameters =
     array(
      'chat_id' => $options['chat_id'],
      'text' => 'Привет, я бот магазина. Если не были привязаны к магазину, то сначала привяжите Телеграм к Магазину. Залогиньтесь в магазин, потом пройдите по этой ссылке ' . $link_for_bind . '. Или сразу переходите к меню команд /menu',
     );
    telegram_send('sendMessage', $parameters);
    break;

// /menu
   case '/menu':
    $parameters =
     array(
      'chat_id' => $options['chat_id'],
      'text' => 'Меню команд',
      'reply_markup' => telegram_reply_markup(),
     );
    telegram_send('sendMessage', $parameters);
    break;
  }

 }

// обработка кнопок
 private function handle_button($options) {

  switch ($options['button']) {

   case 'preanswers-0':
    $preanswers = $this->model_preanswers->rows(['id' => 0]);
    $parameters =
     array(
      'chat_id' => $options['chat_id'],
      'text' => $preanswers[0]->text,
      'reply_markup' => telegram_reply_markup(),
     );
    telegram_send('sendMessage', $parameters);
    break;

   case 'howtopay':
    $preanswers = $this->model_preanswers->rows(['id' => 51]);
    $parameters =
     array(
      'chat_id' => $options['chat_id'],
      'text' => $preanswers[0]->text,
      'reply_markup' => telegram_reply_markup(),
     );
    telegram_send('sendMessage', $parameters);
    break;


  }
 }

// привязка телеграма. вставка номера чата телеграмма, в таблицу юзеров
 public function bind($telegram_chat_id) {

//если чел залогинен
  if ($this->user->item('id') and $telegram_chat_id) {

//   пишем ид чата телеграм в таблицу
   $this->db
    ->where('id', $this->user->item('id'))
    ->update('users', ['telegram_chat_id' => $telegram_chat_id]
    );

//   получаем юзера
   $user = $this->model_user->get_info($this->user->item('id'));

   $text = $user->family . ' ' . $user->name . ' ' . $user->patronym . ', привязка телеграма к магазину произведена';

   $parameters =
    array(
     'chat_id' => $telegram_chat_id,
     'text' => $text,
     'reply_markup' => telegram_reply_markup(),
    );

   telegram_send('sendMessage', $parameters);
   echo '<h1>' . $text . '</h1>';

  } else {

   $parameters =
    array(
     'chat_id' => $telegram_chat_id,
     'text' => 'Привязка не произведена. Залогиньтесь в магазин ' . site_url('user/login') . ' и снова кликните /start',
    );

   telegram_send('sendMessage', $parameters);

   echo '<h1>Привязка не произведена. Залогиньтесь в магазин ' . "<a href='" . site_url('user/login') . "'>" . site_url('user/login') . "</a>" . '</h1>';
  }


 }
}