<?php

define('FIOS_PATH', GLOBAL_PATH . '/scripts/registrators/fios_generator');

class Fiosgen {

# генератор потребного кол-ва ФИО
 public function fio_gen($par) {
  $name = file(FIOS_PATH . '/female/name', FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $surname = file(FIOS_PATH . '/female/surname', FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  for ($i = 0; $i < $par; $i++) {
   $fios[$i]['name'] = trim($name[array_rand($name)]);
   $fios[$i]['surname'] = trim($surname[array_rand($surname)]);
  }
  return $fios;
 }

# генератор логина по ФИО
 public function login_gen($par) {
  # фамилия + год рождения | фамилия + имя | фамилия + имя + год рождения
  $rands = array(
   rand(1960, 1990),
   strtolower(strtr($par['name'], $this->alfavit)),
   strtolower(strtr($par['name'], $this->alfavit)) . rand(1960, 1990)
  );
  return strtolower(strtr($par['surname'], $this->alfavit)) . trim($rands[array_rand($rands)]);
 }

# генератор пароля по ФИО
 public function password_gen($par) {
  # имя + фамилия
  $rands = array(
   strtolower(strtr($par['name'], $this->alfavit))
  );
  return trim($rands[array_rand($rands)]) . strtolower(strtr($par['surname'], $this->alfavit));
 }

# генератор пароля (тип 2)
 public function password_gen2() {
  $allsubbol = array_merge(range(0, 9), range('a', 'z'));
  $passw = '';
  for ($i = 0; $i < 10; $i++) {                   # кол-во символов пароля
   $passw .= $allsubbol[array_rand($allsubbol)]; # случайная строка вида xp3lnbg0we
  }
  return $passw;
 }

# генератор номера паспорта
 public function passport_gen() {
  $allsubbol = range(0, 9);
  $passpnum = '';
  for ($i = 0; $i < 6; $i++) { # кол-во чисел номера пасспорта
   $passpnum .= $allsubbol[array_rand($allsubbol)];
  }
  return '8805' . $passpnum;
 }

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

}