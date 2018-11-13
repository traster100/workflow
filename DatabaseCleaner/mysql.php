<?php

header('Content-Type: text/html; charset=utf-8');
set_time_limit(0);
define('N', "\n");
define('BR', '<br>');

//показывать конфигурацию в консоли, или нет
define('DEBUGCONFIG', FALSE);

//Настройки сервера
define('HOST', '');
define('DB', '');
define('USER', '');
define('PASS', '');


class Db {

  public function __construct() {

    //коннект
    $this->connect = mysqli_connect(HOST, USER, PASS) or die(mysqli_errno() . ' ' . mysqli_error());
    mysqli_query($this->connect, 'SET NAMES utf8');

    //выбор бд
    $sql = 'USE ' . DB;
    $query = mysqli_query($this->connect, $sql) or die(mysqli_errno() . ' ' . mysqli_error());
  }

  public function getconfig() {

    //Разрешенные таблицы (остальные будут Запрещены). если пусто то Разрешены все
    $tables_allow = [
      'table1',
      'table2',
    ];

    //Запрещенные таблицы (остальные будут Разрешены). если пусто то Разрешены все
    $tables_deny = [];

    //Разрешенные поля (остальные будут Запрещены). если пусто то Разрешены все
    $fields_name_allow = [];

    //Запрещенные поля (остальные будут Разрешены). если пусто то Разрешены все
    $fields_name_deny = [];

    //Разрешенные типы полей (остальные будут Запрещены). если пусто то Разрешены все
    $fields_type_allow = ['varchar', 'text'];

    //Запрещенные типы полей (остальные будут Разрешены). если пусто то Разрешены все
    $fields_type_deny = [];

    //выборка всех таблиц бд
    $sql = 'SHOW TABLES FROM ' . '`' . DB . '`';
    $query = mysqli_query($this->connect, $sql) or die(mysqli_errno() . ' ' . mysqli_error());
    while ($row = mysqli_fetch_assoc($query)) {
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
      $query = mysqli_query($this->connect, $sql) or die(mysqli_errno() . ' ' . mysqli_error());
      while ($row = mysqli_fetch_assoc($query)) {

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

        $b[$table][] = [
          'field' => $row['Field'],
          'type' => $row['Type']
        ];
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