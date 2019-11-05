<meta charset='utf-8'>
<title>Тренировка</title>

<?php

//разбивка текста на блоки по 5 предложений, или по ролям по 1 предложению
$block = 5;
//$block = 1;

if ($block == 5) {
  echo '<h1>По блокам</h1>';
} else {
  echo '<h1>По ролям</h1>';
}

$text = file_get_contents('book.txt', FILE_USE_INCLUDE_PATH);

//заменим все множественные символы на один
$text = preg_replace("~(\.{2,})~isu", '.', $text);
$text = preg_replace("~(\,{2,})~isu", ',', $text);
$text = preg_replace("~(\!{2,})~isu", '!', $text);
$text = preg_replace("~(\?{2,})~isu", '?', $text);
$text = preg_replace("~(\-{2,})~isu", '-', $text);
$text = preg_replace("~(_{2,})~isu", ' ', $text);

//заменим знаки где разбиваются предложения, на знак+NNN
$text = preg_replace("~(\.|\!|\?)~isu", '${1}' . 'NNN', $text);

//разобъем предложения в массив
$text = preg_split("~NNN~isu", $text);

//почистим каждое предложение
foreach ($text as $k => &$item) {
  //удалим лишние пробелы
  $item = preg_replace("~\s{2,}~isu", ' ', $item);
  $item = trim($item);
  if (empty($item) or in_array($item, array('.', ',', '!', '?', '-'))) {
    unset($text[$k]);
  }
}

$text = array_chunk($text, $block, true);

//колво предложений в тексте
$count_text = count($text);

for ($i = 0; $i < $count_text; $i++) {

  //пагинация (страницы от, до)
  //if ($i >= 600 and $i < 700) {

  //четные/нечетные страницы
  //if ($i % 2 == 0) {

  echo '<p><b>' . $i . '</b></p>';
  echo '<p>';
  foreach ($text[$i] as $k => $item) {
    echo $item . ' ';
  }
  echo '</p>';

}
