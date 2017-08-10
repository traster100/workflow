<meta charset="utf-8">

<?php
//разбивка текста на блоки по 5 предложений

//$block = 5;
$block = 1;

if ($block == 5) {
    $postfix = '. по блокам';
} else {
    $postfix = '. по ролям';
}

echo '<h1>' . 'Название книги' . $postfix . '</h1>';
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
//удалим всем лишние пробелы
    $item = preg_replace("~\s{2,}~isu", ' ', $item);
    $item = trim($item);
    if (empty($item) or in_array($item, array('.', ',', '!', '?', '-'))) {
        unset($text[$k]);
    }
}

$text = array_chunk($text, $block, true);

$colors = array(
    '000000',
    'C0C0C0',
    '808080',
    '800000',
    'FF0000',
    '800080',
    'FF00FF',
    '008000',
    '00FF00',
    '808000',
    'FFFF00',
    '000080',
    '0000FF',
    '008080',
    '00FFFF',
);

$a = 1;
for ($i = 0; $i < count($text); $i++) {

//страницы от, до
//    if ($i >= 600 and $i < 700) {

//четные/нечетные страницы
//        if ($i % 2 == 0) {
//            continue;
//        }

//просто без цветов
    echo '<b>' . $i . '</b>' . '<br>';
    foreach ($text[$i] as $k => $item) {
        echo $item . ' ';
    }
    echo '<br>';

//просто рандомные цвета
//    echo '<b style="color: #' . $colors[array_rand($colors)] . '">' . $i . '</b>' . '<br>';
//    foreach ($text[$i] as $k => $item) {
//        echo $item . ' ';
//    }
//    echo '<br>';

//цвета по ролям
//    if ($a == 1) {
//        $a++;
//        echo '<b>' . $i . '</b>' . '<br>';
//        foreach ($text[$i] as $k => $item) {
//            echo $item . ' ';
//        }
//        echo '<br>';
//        continue;
//    }
//    if ($a == 2) {
//        $a = 1;
//        echo '<b>' . $i . '</b>' . '<br>';
//        foreach ($text[$i] as $k => $item) {
//            echo $item . ' ';
//        }
//        echo '<br>';
////            continue;
//    }
//        if ($a == 3) {
//            $a = 1;
//            echo '<b style="color: green;">' . $i . '</b>' . ': ';
//            foreach ($text[$i] as $k => $item) {
//                echo $item . ' ';
//            }
//            echo '<br>';
//        }

//        echo $i . '<br>';
//        echo '<b>' . $i . ': ' . '</b>';
//        foreach ($text[$i] as $k => $item) {
//            echo $item . ' ';
//        }
//        echo '<br>';
//    }
}
