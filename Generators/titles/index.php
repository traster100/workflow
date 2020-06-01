<?php

//Генератор названий блогов

define('TITLENAME_PATH', GLOBAL_PATH . '/scripts/registrators/titles_name_generator');

class Gettitle {

  public function title_gen($theme_id, $lang) { //тематика, язык

    $neutral = file(TITLENAME_PATH . '/neutral', FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $theme = file(TITLENAME_PATH . '/theme' . $theme_id, FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $skellet = file(TITLENAME_PATH . '/skellet' . $theme_id, FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $skelett_rand = trim($skellet[array_rand($skellet)]);
    $title = '';

    for ($i = 0; $i < 10; $i++) { //прогоняем регулярки 10 раз (больше 10 замен одной маски не будет же. максиум 3-4 слова из одного массива в одном скелете), в каждом цикле заменяем одно значение. тогда соседние значения будут разными а не одинаковыми

      if (empty($title)) {
        $title = preg_replace("~(\[theme\])~is", trim($theme[array_rand($theme)]), $skelett_rand, 1);
        $title = preg_replace("~(\[neutral\])~is", trim($neutral[array_rand($neutral)]), $skelett_rand, 1);
      } else {
        $title = preg_replace("~(\[theme\])~is", trim($theme[array_rand($theme)]), $title, 1);
        $title = preg_replace("~(\[neutral\])~is", trim($neutral[array_rand($neutral)]), $title, 1);
      }
    }
    unset($i);
    return $title;
  }

}

# Использование класса
#require_once '/home/user/phpDev/SEOproject/include_path.php'; # МЕНЯЕТСЯ
#$titles = new Gettitle();
#for($i = 0; $i < 10; $i++) {
#    echo $title = $titles->title_gen(1).N;
#    file_put_contents('domains.txt', $domain, FILE_USE_INCLUDE_PATH | FILE_APPEND);
#}