<?php

/*
 * Бот вконтакте

- создал сообщество https://vk.com/clubXXX
- управление->работа с api->создать ключ XXX
- управление->работа с api->каллбак апи: адрес сервера http://XX.XX.XX.XX/index.php, секретный ключ XXX
 */

class VkApi {

  /**
   * @var string Ключ доступа сообщества
   */
  private $token = 'TOKEN';

  /**
   * @var string Используемая версия API
   */
  private $version = '5.89';

  /**
   * @var string Адрес обращения к API
   */
  private $method = 'https://api.vk.com/method/';

  /**
   * @var Тип события о подтверждении сервера
   */
  private $confirmation = 'confirmation';

  /**
   * @var string Строка, которую должен вернуть сервер
   */
  private $secret = 'SECRET';

  /**
   * @var string Тип события о новом сообщении
   */
  private $message_new = 'message_new';

  /**
   * Основной метод отправки сообщений
   * @param $method
   * @param $params
   * @return mixed
   * @throws Exception
   */
  private function api($method, $params) {
    $params['access_token'] = $this->token;
    $params['v'] = $this->version;
    $query = http_build_query($params);
    $url = $this->method . $method . '?' . $query;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    $error = curl_error($curl);
    if ($error) {
      error_log($error);
      throw new Exception("Failed {$method} request");
    }
    curl_close($curl);
    $response = json_decode($json, true);
    if (!$response || !isset($response['response'])) {
      error_log($json);
      throw new Exception("Invalid response for {$method} request");
    }
    return $response['response'];
  }

  /**
   * Отправка сообщений
   * @param $peer_id
   * @param $message
   */
  public function send_message($peer_id, $message) {
    $this->api('messages.send', [
      'peer_id' => $peer_id,
      'message' => $message,
    ]);
  }

  public function querymanager($type) {

    switch ($type) {
      case $this->confirmation:
        echo($this->secret);
        break;

      case $this->message_new:
        return true;
        break;
    }
  }

}