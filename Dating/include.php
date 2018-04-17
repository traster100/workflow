<?php
// подключать данный файл во всех других скриптах как require_once 'C:/YD/domains/dating.loc/include.php';

switch (php_sapi_name()) {
    case 'apache2handler' :
        define('N', '<br>');
        break;
    case 'cli' :
        define('N', "\n");
        break;
    default:
        exit('не определен интерфейс');
}

//header ("Content-Type: text/html; charset=utf-8");
echo '<link href="vendor/favicon.png" rel="icon" type="image/png">';
echo N . '------------------------------[ ' . date('d.m H:i') . ' ]------------------------------' . N . N;

error_reporting(E_ALL ^ E_DEPRECATED);
set_time_limit(0);
date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'en_US.utf-8');

define('GLOBAL_PATH', 'C:/YD/domains/dating.loc'); // МЕНЯЕТСЯ
set_include_path(
    implode(
        PATH_SEPARATOR, array(
            get_include_path(),
            GLOBAL_PATH,
            GLOBAL_PATH . '/lib',
        )
    )
);