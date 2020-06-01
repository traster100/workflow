<?php

//парсинг веток форума на основе phpBB

require_once '/include.php';
require_once '/lib/simple_html_dom.php';
require_once '/lib/curl.php';
require_once '/lib/cleartext.php';

class PhpBB {

  public $domain;

  public function get_level1() {

    $page = Curl::getpage($this->domain);
    $html = new simple_html_dom();
    $html->load($page);

    $result = [];
    foreach ($html->find('a.forumtitle') as $v) {
      $result[] = [
        'name' => $v->plaintext,
        'fullurl' => $this->domain .
          preg_replace("~(^\.)~isu", '', htmlspecialchars_decode($v->href)),
        'url' =>
          $this->domain .
          preg_replace("~(^\.)~isu", '', $this->delete_get_param(htmlspecialchars_decode($v->href), '&sid')),
      ];
    }
    return $result;
  }

  public function get_level2($level1) {
    $result = [];
    foreach ($level1 as $v) {
      $page = Curl::getpage($v['url']);
      $html = new simple_html_dom();
      $html->load($page);

      foreach ($html->find('a.topictitle') as $v1) {
        $result[] = [
          'name' => $v1->plaintext,
          'fullurl' => $this->domain .
            preg_replace("~(^\.)~isu", '', htmlspecialchars_decode($v1->href)),
          'url' =>
            $this->domain .
            preg_replace("~(^\.)~isu", '', $this->delete_get_param(htmlspecialchars_decode($v1->href), '&sid')),
        ];
      }
    }
    return $result;
  }

  public function get_level3($level2) {
    $result = [];
    foreach ($level2 as $v) {
      $page = Curl::getpage($v['url']);
      $html = new simple_html_dom();
      $html->load($page);

      foreach ($html->find('div.post') as $v1) {
        $result[] = [
          'id' => $v1->id,
          'plaintext' => $v1->find('div.postbody div.content', 0)->plaintext,
          'innertext' => $v1->find('div.postbody div.content', 0)->innertext,
        ];
      }
    }
    return $result;
  }

  private function delete_get_param($url, $get) {
    return preg_replace("~(" . $get . "=\w+)~isu", '', $url);
  }
}

$phpbb = new PhpBB();
$phpbb->domain = 'http://domain.ru/phpBB3';

$level1 = $phpbb->get_level1();
//var_dump($level1);

$level1 = array_slice($level1, 0, 1);
//var_dump($level1);

$level2 = $phpbb->get_level2($level1);
//var_dump($level2);

$level3 = $phpbb->get_level3($level2);
//var_dump($level3);

foreach ($level3 as $v) {
  echo $v['id'] . ' <br>';
  echo $v['plaintext'] . ' <hr>';
}

//$text = $v3->innertext;
//$filter = new Filter();
//$text = $filter->filter_text($text);
//$text = strip_tags($text);
//$text = preg_replace("~(&quot;)~isu", ' ', $text);
//$text = preg_replace("~\s{1,}~isu", ' ', $text);
//$text = preg_replace("~[a-zA-Z0-9\-\.]+~isu", '', $text); // вырежет все английские строчки
//$text = trim($text);