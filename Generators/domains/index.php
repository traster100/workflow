<?php

# Генератор доменов
# php /home/u/phpDev/SEOproject/scripts/registrators/domains_name_generator/domains_name_generator.php
# Между словами  "-", "_", "and". - (этого нет в генераторе)
# платформа wordpress.com - только слитно или and

define('DOMAINSNAME_PATH', GLOBAL_PATH . '/scripts/registrators/domains_name_generator');

class Getdomain {

 public function domain_gen($theme_id) { # тематика
  $neutral = file(DOMAINSNAME_PATH . '/neutral', FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $theme = file(DOMAINSNAME_PATH . '/theme' . $theme_id, FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  $rands = array(
   trim($neutral[array_rand($neutral)]) . trim($theme[array_rand($theme)]), # нейтральное слово + слово
   trim($theme[array_rand($theme)]) . trim($neutral[array_rand($neutral)]), # слово + нейтральное слово
   trim($theme[array_rand($theme)]) . trim($theme[array_rand($theme)]), # слово + слово
  );
  return trim($rands[array_rand($rands)]);
 }

}

# Использование класса
#require_once '/home/u/phpDev/SEOproject/include_path.php'; # МЕНЯЕТСЯ
#$domains = new Getdomain();
#for ($i = 0; $i < 10; $i++) {
#    echo $domain = $domains->domain_gen(1).N;
#    file_put_contents('domains.txt', $domain, FILE_USE_INCLUDE_PATH | FILE_APPEND);
#}