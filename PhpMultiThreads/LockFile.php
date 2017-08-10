<?php

# Блокировка файла
# php /home/user/folder/LockFile.php

/*
  LOCK_SH -1 на чтение
  LOCK_EX -2 на запись
  LOCK_UN -3 разблокировка
  LOCK_NB -4 используется со всеми тремя верхними. ставится когда не хочется ждать разблокировки(подвиснет) а хочется другую работу поделать и раз в секунду чекать статус.
  http://it-library.org/articles/?c=2&&a=733
 
  http://php.net/manual/en/function.fopen.php
 
  r  - только чтение.   указатель на начало.
  r+ - чтение и запись. указатель на начало.
  w  - только запись.   указатель на начало. очищает файл. если файла нет - создает.
  w+ - чтение и запись. указатель на начало. очищает файл. если файла нет - создает.
  a  - только запись.   указатель в конец.                 если файла нет - создает.
  a+ - чтение и запись. указатель в конец.                 если файла нет - создает.
  x  - создает файл и открывает для записи.          указатель на начало. если файл существует то выдаст варнинг.
  x+ - создает файл и открывает для чтения и записи. указатель на начало. если файл существует то выдаст варнинг.
  c  - только запись.   если файла нет - создает.    указатель на начало.
  c+ - чтение и запись. если файла нет - создает.    указатель на начало.
 */

class LockFile {

 public function __construct($path) {
  $this->file = fopen($path, "a"); # открываем файл на запись
 }

 public function lock() {
  flock($this->file, LOCK_EX);     # блокируем файл на запись
  #echo 'момент лока: '. date('H:i:s').N;
 }

 public function unlock() {
  flock($this->file, LOCK_UN);     # разблокировка файла
  #echo 'момент разлока: '. date('H:i:s').N;
 }

 public function __destruct() {
  fclose($this->file);
 }

}

# Использование
/*
  require_once '/home/user/folder/include_path.php'; # МЕНЯЕТСЯ
  $lockfile=new LockFile('/home/user/folder/posting.lock');
  $lockfile->lock();
  echo 'код';sleep(10);
  $lockfile->unlock();
  unset($lockfile);
 */
?>