<?php

require 'vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleApi {

  public function translate($phrase, $from = 'ru', $to = 'en') {
    $phrase = (string)$phrase;
    $GoogleTranslate = new GoogleTranslate();
    $GoogleTranslate->setSource($from);
    $GoogleTranslate->setTarget($to);
    return $GoogleTranslate->translate($phrase);
  }

}