<?php

//библиотека времени Carbon https://carbon.nesbot.com/docs

require 'vendor/autoload.php';

use Carbon\Carbon;

Carbon::setLocale('ru');

function myCarbonDateHuman($date) {

  $days = [
    1 => 'в понедельник',
    2 => 'во вторник',
    3 => 'в среду',
    4 => 'в четверг',
    5 => 'в пятницу',
    6 => 'в субботу',
    7 => 'в воскресенье',
  ];

  if (Carbon::parse($date->format('d-m-Y H:i:s'))->diffInMinutes() == 1) {
    return 'минуту назад';

  } elseif (Carbon::parse($date->format('d-m-Y H:i:s'))->diffInHours() == 1) {
    return 'час назад';

  } elseif (Carbon::parse($date->format('d-m-Y H:i:s'))->diffInDays() == 1) {
    return 'Вчера в ' . $date->format('H:i');

  } elseif (Carbon::parse($date->format('d-m-Y H:i:s'))->diffInDays() == 2) {
    return 'Позавчера в ' . $date->format('H:i');

  } elseif (Carbon::parse($date->format('d-m-Y H:i:s'))->diffInWeeks() == 1) {
    return 'На прошлой неделе ' . $days[$date->format('N')] . ' в ' . $date->format('H:i');

  } elseif (Carbon::parse($date->format('d-m-Y H:i:s'))->diffInWeeks() == 2) {
    return 'На позапрошлой неделе ' . $days[$date->format('N')] . ' в ' . $date->format('H:i');

  } elseif (Carbon::parse($date->format('d-m-Y H:i:s'))->diffInMonths() == 1) {
    return 'В прошлом месяце';

  } elseif (Carbon::parse($date->format('d-m-Y H:i:s'))->diffInYears() == 1) {
    return 'В прошлом году';

  } elseif (Carbon::parse($date->format('d-m-Y H:i:s'))->diffInYears() == 2) {
    return 'В позапрошлом году';

  } else {
    return Carbon::parse($date->format('d-m-Y H:i:s'))->diffForHumans();

  }
}

echo '<h3>интервал до часа</h3>';

for ($i = 1; $i <= 60; $i++) {
  $date = new DateTime('-' . $i . ' minute');
  echo $date->format('d-m-Y H:i:s') .
    ' (' . myCarbonDateHuman($date) . ')' .
    '<br>';
}

echo '<hr>';

echo '<h3>интервал до суток</h3>';

for ($i = 1; $i <= 24; $i++) {
  $date = new DateTime('-' . $i . ' hour');
  echo $date->format('d-m-Y H:i:s') .
    ' (' . myCarbonDateHuman($date) . ')' .
    '<br>';
}

echo '<hr>';

echo '<h3>интервал до месяца</h3>';

for ($i = 1; $i <= 30; $i++) {
  $date = new DateTime('-' . $i . ' days');
  echo $date->format('d-m-Y H:i:s') .
    ' (' . myCarbonDateHuman($date) . ')' .
    '<br>';
}

echo '<hr>';

echo '<h3>интервал до года</h3>';

for ($i = 1; $i <= 12; $i++) {
  $date = new DateTime('-' . $i . ' month');
  echo $date->format('d-m-Y H:i:s') .
    ' (' . myCarbonDateHuman($date) . ')' .
    '<br>';
}

echo '<hr>';

echo '<h3>интервал до N лет</h3>';

for ($i = 1; $i <= 12; $i++) {
  $date = new DateTime('-' . $i . ' year');
  echo $date->format('d-m-Y H:i:s') .
    ' (' . myCarbonDateHuman($date) . ')' .
    '<br>';
}