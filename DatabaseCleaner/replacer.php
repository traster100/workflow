<?php

require_once 'lib/simple_html_dom.php';

class Replaser {

//вырезает тег <a> в котором слово, если находит его, и все вокруг тега. Иначе вырезает просто слово
 static public function get_newvalue_text($word, $oldvalue) {

// экранирование слешем указанных символов, для preg-функций пхп
  $word = addcslashes($word, '~\^$.[]|()*+?{},-!=<>:');


// echo $word.N;
// var_dump( preg_replace('~(' . $word . ')~isu', '', $oldvalue) );
// exit('');

  $html = new simple_html_dom();
  $html->load($oldvalue);
  $items = $html->find('a');

  if (empty($items)) {
   return preg_replace('~(' . $word . ')~isu', '', $oldvalue); // селектор не найден, просто вырезаем слово
  }

  foreach ($items as $v) {
   if (preg_match('~' . $word . '~isu', $v->plaintext) == 1) {
    $v->outertext = ''; // удаляем теги в котором нашлось слово
   }
  }

  $result = $html->save();
  $html->clear();
  unset($html);

  return preg_replace('~(' . $word . ')~isu', '', $result); // дополнительно вырезаем вокруг тега
 }

}