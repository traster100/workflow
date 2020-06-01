<?php

//парсер профилей с dating.ru
//C:\YD\soft\OpenServer\modules\php\PHP-7.1\php.exe C:\YD\domains\dating.loc\dating_parser.php

require_once 'C:/YD/domains/dating.loc/include.php';
require_once 'vendor/simple_html_dom.php';
require_once 'vendor/curl.php';
require_once 'vendor/db.php';

//параметры
$config = [
  'im' => 'm', //кто я
  'search' => 'f', //кого ищу
  'age_start' => 20, //от N лет
  'age_end' => 30, //до N лет
];

echo '<pre>';
print_r($config);
echo '</pre>';

$db = new \Db();

for ($i = 0; $i < 40784; $i = $i + 10) {

  //урл
  $url1 = 'http://dating.ru/search.php?' .

    //пагинация
    'offset=' . $i .

    '&ext_params[users][iam]=' . strtoupper($config['im']) .
    '&ext_params[users][lookfor]=' . strtoupper($config['search']) .
    '&ext_params[users][age][from]=' . $config['age_start'] .
    '&ext_params[users][age][to]=' . $config['age_end'] .

    //Москва - 101_6675_101
    '&ext_params[users][city]=101_6675_101' .

    //с фоткой на сайте
    '&ext_params[users][photo]=on' .

    //сейчас на сайте
    '&ext_params[users][online]=on';

  echo $url1 . N . N;

  //получаем страницу
  if (!$page1 = Curl::getpage($url1)) {
    continue;
  }
  $html1 = new simple_html_dom();
  $html1->load($page1);

  //парсим профиля
  $profiles = [];
  foreach ($html1->find('table.form_data > tr > td') as $v1) {

    if (is_null($v1->find('a', 0))) {
      continue;
    }

    $href = $v1->find('a', 0)->href;
    if (preg_match("~^/(.+?)/~isu", $href, $match) == 1) {
      $url2 = 'http://dating.ru' . $match[0];

      $profiles[$url2] = array(
        'url' => $url2,
        'sex' => $config['search'],
      );

    }
  }

  //вставляем в базу
  foreach ($profiles as $profile) {
    $db->profile_insert($profile);
    echo '<a target="_blank" href="' . $profile['url'] . '">' . $profile['url'] . '</a>' . N;
  }
  echo '<hr>';

  //если профилей нет то выброс
  if (empty($profiles)) {
    break;
  }

  $html1->clear();
  unset($html1);
}

echo 'done';