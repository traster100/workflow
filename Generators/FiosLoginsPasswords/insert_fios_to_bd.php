<?php
# Добавление ФИО в бд, для реги мыл

require_once '/home/user/phpDev/SEOproject/include_path.php'; # МЕНЯЕТСЯ
define('REGISTRATORS_PATH', GLOBAL_PATH . '/scripts/registrators/');
require_once REGISTRATORS_PATH.'fios_generator/fios_generator.php';
require_once GLOBAL_PATH . '/scripts/database.php';

#=================================================================================
# генерация потребного кол-ва ФИО
$fiosgen = new Fiosgen();
$fios = $fiosgen->fio_gen(4896);
#=================================================================================
# запись потребного кол-ва ФИО в бд
$bd = new Database();
$bd->setfios($fios);
#=================================================================================
?>