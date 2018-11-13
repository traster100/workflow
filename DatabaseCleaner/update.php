<?php

require_once 'mysql.php';
require_once 'replacer.php';
$db = new Db;
$config = $db->getconfig();

//файл со словами
$words = file('words2.txt', FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if ($words == FALSE OR empty($words)) {
  exit('нет файла или он пустой' . N);
}

//удаляем пробелы и псевдопустые строки
foreach ($words as $k => &$v) {
  $v = trim($v);
  if (empty($v)) {
    unset($words[$k]);
  }
}

//сортируем слова (длинные выражения вначале, короткие вконце)
foreach ($words as $k1 => $v1) {
  $words2[$k1] = mb_strlen($v1, 'utf-8');
}

arsort($words2);

foreach ($words2 as $k3 => $v3) {
  $words3[] = $words[$k3];
}

$words = $words3;
$words = array_values(array_unique($words));
echo N . 'Всего слов: ' . count($words) . N;
echo '====================================================' . N . N;

//генерация запросов
$i = 0; // порядковый номер update-запроса
$j = 0; // порядковый номер слова

foreach ($words as $word) {

  //показывает текущее слово в обработке
  echo N . ' ----- ' . ++$j . '. "' . $word . '":' . N;

  //сначала экранируем указанные символы слешем. потом эти слеши еще раз экранируем. потом символ " отдельно экранируем одним слешем, она пересекается с кавычкой в которой REGEXP.
  $word1 = addcslashes($word, '\^$.[]|()*+?{},-!=<>:');
  $word1 = addcslashes($word1, '\\');
  $word1 = addcslashes($word1, '"');

  //проход по таблицам
  foreach ($config as $table => $fields) {

    //echo ' - ' . $table . N; // показывает каждую текущую таблицу в обработке

    //проход по полям таблиц
    foreach ($fields as $field) {
      $sql = 'SELECT `' . $field['field'] . '` FROM `' . $table . '` WHERE `' . $field['field'] . '` REGEXP "' . $word1 . '";';

      //выполнение запроса
      $query = mysqli_query($db->connect, $sql) or die(mysqli_errno() . ' ' . mysqli_error());
      while ($row = mysqli_fetch_assoc($query)) {

        //показывает только таблицу в обработке у которой есть успешный запрос
        static $printtable = 0;
        if ($printtable == 0) {
          echo N . ' - ' . $table . N;
          ++$printtable;
        }

        foreach ($row as $column => $oldvalue) {

          //генерация запросов
          $newvalue = Replaser::get_newvalue_text2($word, $oldvalue);
          $sql2 = 'UPDATE `' . $table . '` SET `' . $column . '`="' . addslashes($newvalue) . '" WHERE `' . $column . '`="' . addslashes($oldvalue) . '";';

          //выполнение запросов
          //echo++$i . ' запрос. '; // номер запроса
          mysqli_query($db->connect, $sql2) or die(mysqli_errno() . ' ' . mysqli_error());

          //кол-во обновленных рядов
          echo mysqli_affected_rows($db->connect) . ',';
        }
      }
    }
    $printtable = 0;
  }
  echo N;
}
echo N . N . 'Done' . N;