<?php

header('Content-Type: text/html; charset=utf-8');
set_time_limit(0);
define('N', "\n");
define('BR', '<br />');
define('DEBUGCONFIG', FALSE); // показывать конфигурацию в консоли, или нет

/* Настройки сервера */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'u');
define('DB', 'metaltrade_info'); // admin_stalevar

class Db {

 public function __construct() {
//коннект
  $this->connect = mysql_connect(HOST, USER, PASS) or die(mysql_errno() . ' ' . mysql_error());
  mysql_query('SET NAMES utf8');

//выбор бд
  $sql = 'USE ' . DB;
  $query = mysql_query($sql, $this->connect) or die(mysql_errno() . ' ' . mysql_error());
 }

 public function getconfig() {

  /* Настройки конфигурации */
  $tables_allow = array(); // Разрешенные таблицы (остальные будут Запрещены). если пусто то Разрешены все.
  $tables_deny = array();  // Запрещенные таблицы (остальные будут Разрешены). если пусто то Разрешены все.

  $fields_name_allow = array(); // Разрешенные поля (остальные будут Запрещены). если пусто то Разрешены все.
  $fields_name_deny = array();  // Запрещенные поля (остальные будут Разрешены). если пусто то Разрешены все.

  $fields_type_allow = array('varchar', 'text'); // Разрешенные типы полей (остальные будут Запрещены). если пусто то Разрешены все.
  $fields_type_deny = array();  // Запрещенные типы полей (остальные будут Разрешены). если пусто то Разрешены все.
//выборка всех таблиц бд
  $sql = 'SHOW TABLES FROM ' . '`' . DB . '`';
  $query = mysql_query($sql, $this->connect) or die(mysql_errno() . ' ' . mysql_error());
  while ($row = mysql_fetch_assoc($query)) {
   $tables[] = $row;
  }
  if (empty($tables)) {
   exit('нет таблиц в бд');
  }

  foreach ($tables as $v) {
   foreach ($v as &$v1) {
//отсечка на Разрешенные таблицы
    if (!empty($tables_allow)) {
     if (!in_array($v1, $tables_allow)) {
      continue;
     }
    }
//отсечка на Запрещенные таблицы
    if (!empty($tables_deny)) {
     if (in_array($v1, $tables_deny)) {
      continue;
     }
    }

    $a[] = $v1;
   }
  }


//выборка всех столбцов всех таблиц бд
  foreach ($a as $table) {
   $sql = 'SHOW COLUMNS FROM ' . '`' . $table . '`';
   $query = mysql_query($sql, $this->connect) or die(mysql_errno() . ' ' . mysql_error());
   while ($row = mysql_fetch_assoc($query)) {

//отсечка на Разрешенные поля
    if (!empty($fields_name_allow)) {
     if (!in_array($row['Field'], $fields_name_allow)) {
      continue;
     }
    }
//отсечка на Запрещенные поля
    if (!empty($fields_name_deny)) {
     if (in_array($row['Field'], $fields_name_deny)) {
      continue;
     }
    }
//отсечка на Разрешенные типы полей
    if (!empty($fields_type_allow)) {
     $aaa = FALSE;
     foreach ($fields_type_allow as $v) {
      if (preg_match('~' . $v . '~is', $row['Type']) == 1) {
       $aaa = TRUE;
       break;
      }
     }
     if (!$aaa) {
      continue;
     }
    }
//отсечка на Запрещенные типы полей
    if (!empty($fields_type_deny)) {
     foreach ($fields_type_deny as $v) {
      if (preg_match('~' . $v . '~is', $row['Type']) == 1) {
       continue 2;
      }
     }
    }

    $b[$table][] = array('field' => $row['Field'], 'type' => $row['Type']);
   }
  }

  if (DEBUGCONFIG) {
   echo N . 'Настройки конфигурации:' . N;
   foreach ($b as $k => $v) {
    echo $k . ':' . N;
    foreach ($v as $v1) {
     echo ' ----- ' . $v1['field'] . ': ' . $v1['type'] . N;
    }
   }
  }

  return $b;
 }

}