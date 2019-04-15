<?php

/**
 * Class Emails
 * требует composer hbattat/verifyemail
 *
 * файл на основе ФИО генерит разные комбинации мыл, всевозможных вариантов
 * потом аттачит к ним нужные домены
 * потом проверяет какие мыла существуют
 */

class Emails {

  private $alfavit = array(
    "а" => "a",
    "б" => "b",
    "в" => "v",
    "г" => "g",
    "д" => "d",
    "е" => "e",
    "ё" => "yo",
    "ж" => "j",
    "з" => "z",
    "и" => "i",
    "й" => "i",
    "к" => "k",
    "л" => "l",
    "м" => "m",
    "н" => "n",
    "о" => "o",
    "п" => "p",
    "р" => "r",
    "с" => "s",
    "т" => "t",
    "у" => "y",
    "ф" => "f",
    "х" => "h",
    "ц" => "c",
    "ч" => "ch",
    "ш" => "sh",
    "щ" => "sh",
    "ы" => "i",
    "э" => "e",
    "ю" => "u",
    "я" => "ya",
    "А" => "A",
    "Б" => "B",
    "В" => "V",
    "Г" => "G",
    "Д" => "D",
    "Е" => "E",
    "Ё" => "Yo",
    "Ж" => "J",
    "З" => "Z",
    "И" => "I",
    "Й" => "I",
    "К" => "K",
    "Л" => "L",
    "М" => "M",
    "Н" => "N",
    "О" => "O",
    "П" => "P",
    "Р" => "R",
    "С" => "S",
    "Т" => "T",
    "У" => "Y",
    "Ф" => "F",
    "Х" => "H",
    "Ц" => "C",
    "Ч" => "Ch",
    "Ш" => "Sh",
    "Щ" => "Sh",
    "Ы" => "I",
    "Э" => "E",
    "Ю" => "U",
    "Я" => "Ya",
    "ь" => "",
    "Ь" => "",
    "ъ" => "",
    "Ъ" => ""
  );


//имя
//фамилия
//отчество
  public function generate($name, $surname, $patronymic, $domain) {
    $name = strtolower(strtr($name, $this->alfavit));
    $surname = strtolower(strtr($surname, $this->alfavit));
    $patronymic = strtolower(strtr($patronymic, $this->alfavit));

    $variants = array(
      $name,
      $surname,

      $name . '.' . $surname,
      $surname . '.' . $name,

      substr($name, 0, 1) . '.' . $surname,
      $name . '.' . substr($surname, 0, 1),

      substr($surname, 0, 1) . '.' . $name,
      $surname . '.' . substr($name, 0, 1),

      'marketing' . '.' . $surname,
      'marketing' . '.' . $name,

      $name . '.' . 'marketing',
      $surname . '.' . 'marketing',

      substr($name, 0, 1) . '.' . $surname . '.' . 'marketing',
      $name . '.' . substr($surname, 0, 1) . '.' . 'marketing',

      substr($surname, 0, 1) . '.' . $name . '.' . 'marketing',
      $surname . '.' . substr($name, 0, 1) . '.' . 'marketing',

      'marketing' . '.' . substr($name, 0, 1) . '.' . $surname,
      'marketing' . '.' . $name . '.' . substr($surname, 0, 1),

      'marketing' . '.' . substr($surname, 0, 1) . '.' . $name,
      'marketing' . '.' . $surname . '.' . substr($name, 0, 1),

    );

    foreach ($variants as &$variant) {
      $variant = $variant . '@' . $domain;
    }

    return $variants;

  }


}

$a = new Emails();

$fios = array(
  array('Иван', 'Иванов', 'Иванович', 'eldorado.ru'),
  array('Петр', 'Петров', 'Петрович', 'tehnosila.ru'),
  array('Сидр', 'Сидоров', 'Сидорович', 'mvideo.ru'),
);

$result = array();
foreach ($fios as $fio) {
  $result[] = $a->generate($fio[0], $fio[1], $fio[2], $fio[3]);
}

//https://github.com/hbattat/verifyEmail
include 'src/VerifyEmail.php';


foreach ($result as $v1) {
  foreach ($v1 as $v2) {
    $v2 = 'NNN@gmail.com';
    echo $v2 . ' <br>';

    $ve = new hbattat\VerifyEmail($v2, 'NNN@gmail.com');
    var_dump($ve->verify());
    echo '<pre>';
    print_r($ve->get_debug());

    exit;

  }
  echo ' <br>';
}


