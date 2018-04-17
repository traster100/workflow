<?php
// подключать данный файл во всех других скриптах как: require_once '/home/user/folder/include_path.php';

header ("Content-Type: text/html; charset=utf-8");
echo '<link href="vendor/favicon.png" rel="icon" type="image/png">';

switch (php_sapi_name()) {
 case 'apache2handler' :
  define('N', '<br />');
  break;
 case 'cli' :
  define('N', "\n");
  break;
 default:
  exit ('не определен интерфейс');
}

echo N . '----------[ ' . date('d.m H:i') . ' ]----------' . N; //date('Y-m-d H:i:s:u');

error_reporting(E_ALL); // (E_ALL ^ E_DEPRECATED);
set_time_limit(0);
date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'en_US.utf-8');

define('GLOBAL_PATH', '/home/user/folder');

set_include_path(implode(PATH_SEPARATOR, array(
 get_include_path(), // значение include_path
 GLOBAL_PATH,
 GLOBAL_PATH . '/lib',
 GLOBAL_PATH . '/lib/ZendFramework/library',
 GLOBAL_PATH . '/scripts',
 GLOBAL_PATH . '/scripts/registrators/domains_name_generator',
)));

/*
 include_path не работает с вложенными папками.
"."  - текущий каталог.
".." - родительский каталог.
Установка в .htaccess: php_value include_path /home/user/folder
Установка в в php.ini: include_path ".:/home/user/folder"
Установка в коде:
ini_set_function (ini_set('include_path', '/home/user/folder'))
или
set_include_path_function (set_include_path('/home/user/folder'))
или
$dir=$_SERVER['DOCUMENT_ROOT'].'/home/user/folder';
include($dir.'file');
*/

define('BLOG_PATH', GLOBAL_PATH . '/scripts/registrators/blogs_wordpress_registrator');
