<?php

/*
 * Бот телеграм

- в телеге идем сюда @BotFather
- далее команды /start, /newbot выбираем имя "MyNameBot" и урл "MyNameBot"
- урл бота http://t.me/MyNameBot
- получили токен XXX:XXX
- кинули в консоль хостинга чтобы увидеть id чатов кто писал https://api.telegram.org/botXXX:XXX/getUpdates
- получили структуру сообщения
{
   "ok":true,
   "result":[
      {
         "update_id":XXX,
         "message":{
            "message_id":1,
            "from":{
               "id":XXX,
               "is_bot":false,
               "first_name":"Тратата",
               "language_code":"ru"
            },
            "chat":{
               "id":XXX,
               "first_name":"Тратата",
               "type":"private"
            },
            "date":1572965904,
            "text":"текст"
         }
      },
   ]
}
 */


class TelegramApi {

  public function send_message($method, $data) {

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . 'TOKEN' . '/' . $method);

    curl_setopt($curl, CURLOPT_POST, true);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
  }
}