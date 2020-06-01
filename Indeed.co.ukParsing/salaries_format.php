<?php

$salaries = [
  '£28,000 - £30,000 a year',
  '£25,000 a year',
  '£120 - £150 a day',
  '£500 a day',
];

foreach ($salaries as $v) {

  $salary = 0;

  //если year
  if (preg_match("~year~isu", $v) == 1) {

    //если £28,000 - £30,000 a year
    if (preg_match("~\-~isu", $v) == 1) {

      if (preg_match("~^£(.+?)\s~isu", $v, $match) == 1) {
        $salary = str_replace(',', '', $match[1]);
        var_dump($salary);
      }

    } else {
      //если £25,000 a year
      if (preg_match("~^£(.+?)\s~isu", $v, $match) == 1) {
        $salary = str_replace(',', '', $match[1]);
        var_dump($salary);
      }

    }
  }

  // если day
  if (preg_match("~day~isu", $v) == 1) {

    //если £120 - £150 a day
    if (preg_match("~\-~isu", $v) == 1) {

      if (preg_match("~^£(.+?)\s~isu", $v, $match) == 1) {
        $salary = str_replace(',', '', $match[1]);
        $salary = intval($salary / 8); // делим зарплату в день на 8 часов
        var_dump($salary);

      }
    } else {
      //если £500 a day
      if (preg_match("~^£(.+?)\s~isu", $v, $match) == 1) {
        $salary = str_replace(',', '', $match[1]);
        $salary = intval($salary / 8); // делим зарплату в день на 8 часов
        var_dump($salary);
      }
    }

  }

}