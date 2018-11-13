<?php

require_once 'lib/simple_html_dom.php';

class Replaser {

  //вырезает тег <a> в котором слово, если находит его, и все вокруг тега. Иначе вырезает просто слово
  //$word - слово, $oldvalue - фраза откуда вырезать
  static public function get_newvalue_text($word, $oldvalue) {
    var_dump($word, $oldvalue);

    var_dump(
      preg_replace('~(' . $word . ')~isu', 'mydomain.com', $oldvalue)
    );

    exit;

    //экранирование слешем указанных символов, для preg-функций
    $word = addcslashes($word, '~\^$.[]|()*+?{},-!=<>:');

    //echo $word.N;
    //var_dump( preg_replace('~(' . $word . ')~isu', '', $oldvalue) );
    //exit('');

    $html = new simple_html_dom();
    $html->load($oldvalue);
    $items = $html->find('a');

    //селектор не найден, просто вырезаем слово
    if (empty($items)) {
      return preg_replace('~(' . $word . ')~isu', '', $oldvalue);
    }

    foreach ($items as $v) {
      if (preg_match('~' . $word . '~isu', $v->plaintext) == 1) {
        //удаляем теги в котором нашлось слово
        $v->outertext = '';
      }
    }

    $result = $html->save();
    $html->clear();
    unset($html);

    //дополнительно вырезаем вокруг тега
    return preg_replace('~(' . $word . ')~isu', '', $result);
  }

//тут только замена слова, на слово
  static public function get_newvalue_text2($word, $oldvalue) {

    //экранирование слешем указанных символов, для preg-функций
    $word = addcslashes($word, '~\^$.[]|()*+?{},-!=<>:');

    return preg_replace('~(' . $word . ')~isu', 'brpzakaz.com', $oldvalue);

  }

}