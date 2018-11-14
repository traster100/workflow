<?php

/*
Либа https://github.com/GoogleCloudPlatform/google-cloud-php-dialogflow
Зависимость композера "google/cloud-dialogflow": "v0.3.1"
Репоз composer require google/cloud-dialogflow
*/

require 'vendor/autoload.php';

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;

function DialogFlow2($text) {

  $sessionsClient = new SessionsClient([
    'credentials' => json_decode(file_get_contents('small-talk-NNN.json'), true),
  ]);

  $session = $sessionsClient->sessionName('small-talk-NNN', '123');

  $textInput = new TextInput();
  $textInput->setText($text);
  $textInput->setLanguageCode('ru-RU');

  $queryInput = new QueryInput();
  $queryInput->setText($textInput);

  $response = $sessionsClient->detectIntent($session, $queryInput);
  $queryResult = $response->getQueryResult();
  $intent = $queryResult->getIntent();

  if ($intent) {
    $fulfilmentText = $queryResult->getFulfillmentText();
    $sessionsClient->close();
    return $fulfilmentText;
  } else {
    $sessionsClient->close();
    return false;
  }
}


$text = Dialogflow2($message);