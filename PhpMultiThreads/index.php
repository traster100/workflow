<?php
 
//многопоточность на файле
//поле objects.lock_object TIMESTAMP без галки NOT NULL и значений по-умолчанию
 
require_once 'LockFile.php';
 
//0. разлок ошибочно неразлоченных объектов в бд, которым больше N минут
"UPDATE `objects` SET `lock_object`=NULL WHERE NOW()>(TIMESTAMP(`objects`.`lock_object`)+INTERVAL 20 MINUTE)"; // 3 DAY, 3 HOUR
 
//1. лок лок-файла на запись
$lockfile = new LockFile ('object.lock');
$lockfile -> lock ();
 
//2. забор одного неотработанного объекта из бд
$id = "SELECT * FROM `objects` WHERE `objects`.`lock_object` IS NULL AND `objects`.`onoff`='0' ORDER BY RAND() LIMIT 1";
 
//3. лок этого объекта в бд
"UPDATE `objects` SET `lock_object`=NOW() WHERE `id`=$id";
 
//4. разлок лок-файла
$lockfile -> unlock ();
unset ($lockfile);
 
//5. полезная работа с объектом
echo $id;
 
//6. установка флага отработанному объекта
"UPDATE `objects` SET `onoff`='1' WHERE `id`=$id";
 
//7. разлок объекта в бд
"UPDATE `objects` SET `lock_object`=NULL WHERE `id`=$id";