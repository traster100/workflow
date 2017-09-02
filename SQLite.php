<?php

try {
 $db = new PDO ('sqlite:words.db');

// режим обработки ошибок. по умолчанию PDO::ERRMODE_SILENT
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// можно у каждого запроса указывать как $select->setFetchMode(PDO::FETCH_ASSOC);
 $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// чтобы при многопоточной записи процесс ждал 5 секунд своей очереди, а не сразу падал с  SQLITE_BUSY
 $db->setAttribute(PDO::ATTR_TIMEOUT, 5000);

// многопоточность. ускорение в 5 раз
 $db->query('PRAGMA journal_mode=WAL;');

//  включить поддержку foreign keys
 $db->query('PRAGMA foreign_keys = 1;');

} catch (PDOException $e) {
 exit ($e->getMessage());
}

//insert
$insert = $db->prepare("INSERT OR IGNORE INTO `en_to_ru` (`english`, `russian`) VALUES (:english, :russian)");

for ($i = 0; $i < 100000; $i++) {
 $insert->bindParam(':english', $i);
 $insert->bindParam(':russian', $i);
 $insert->execute();
}

//update
$update = $db->prepare("UPDATE OR IGNORE `en_to_ru` SET `english` = :english, `russian` = :russian WHERE `id` = :id");
$update->bindValue(':id', 772);
$update->bindValue(':english', 8888);
$update->bindValue(':russian', 9999);
$update->execute();

//delete
$delete = $db->prepare("DELETE FROM `en_to_ru` WHERE `id` = :id");
$delete->bindValue(':id', 772);
$delete->execute();

//select весь массив
$select = $db->prepare("SELECT * FROM `en_to_ru` WHERE `id` > :id");
$select->bindValue(':id', 772);
$select->execute();
$result = $select->fetchAll();
var_dump($result);

// select одно, как массив в общем массиве
$select = $db->prepare("SELECT * FROM `en_to_ru` WHERE `id` = :id");
$select->bindValue(':id', 800);
$select->execute();
$result = $select->fetchAll();
var_dump($result);

// select одно как один массив
$select = $db->prepare("SELECT * FROM `en_to_ru` WHERE `id` = :id");
$select->bindValue(':id', 800);
$select->execute();
$result = $select->fetch();
var_dump($result);

// select один столбец
$select = $db->prepare("SELECT `english` FROM `en_to_ru` WHERE `id` = :id");
$select->bindValue(':id', 800);
$select->execute();
$result = $select->fetchColumn();
var_dump($result);


/*
 * bindParam — Привязывает параметр запроса к переменной
 * bindColumn — Связывает столбец с PHP переменной
 * bindValue — Связывает параметр с заданным значением
 */