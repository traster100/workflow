<?php

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