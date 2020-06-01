<?php

require_once 'vendor/autoload.php';
require_once 'HTTP/Request2.php';
$domain = 'domain.ru';

//require_once 'HTTP/Request2.php';
//require_once 'HTTP/Request2/CookieJar.php';
//require_once 'HTTP/Request2/MultipartBody.php';
//use HTTP_Request2;


//Получение списка доменов
$request = new HTTP_Request2('https://pddimp.yandex.ru/api2/admin/domain/domains?on_page=20', HTTP_Request2::METHOD_GET);
$request->setHeader(array('PddToken' => 'token123'));
$responce = $request->send();
$headers = $responce->getHeader();
$body = json_decode($responce->getBody());

//var_dump($headers);
var_dump('Получение списка доменов');
var_dump($body);


//Подключить домен
$request = new HTTP_Request2('https://pddimp.yandex.ru/api2/admin/domain/register', HTTP_Request2::METHOD_POST);
$request->setHeader(array('PddToken' => 'token123'));
$request->setBody('domain=' . $domain);
$responce = $request->send();
$headers = $responce->getHeader();
$body = json_decode($responce->getBody());

//var_dump($headers);
var_dump('Подключить домен');
var_dump($body);


//Получить статус подключения домена
$request = new HTTP_Request2('https://pddimp.yandex.ru/api2/admin/domain/registration_status?domain=' . $domain, HTTP_Request2::METHOD_GET);
$request->setHeader(array('PddToken' => 'token123'));
$responce = $request->send();
$headers = $responce->getHeader();
$body = json_decode($responce->getBody());

//var_dump($headers);
var_dump('Получить статус подключения домена');
var_dump($body);


//Получить настройки домена
$request = new HTTP_Request2('https://pddimp.yandex.ru/api2/admin/domain/details?domain=' . $domain, HTTP_Request2::METHOD_GET);
$request->setHeader(array('PddToken' => 'token123'));
$responce = $request->send();
$headers = $responce->getHeader();
$body = json_decode($responce->getBody());

//var_dump($headers);
var_dump('Получить настройки домена');
var_dump($body);


//Удалить домен
//$request = new HTTP_Request2('https://pddimp.yandex.ru/api2/admin/domain/delete', HTTP_Request2::METHOD_POST);
//$request->setHeader(array('PddToken' => 'token123'));
//$request->setBody('domain=' . $domain);
//$responce = $request->send();
//$headers = $responce->getHeader();
//$body = json_decode($responce->getBody());
//
//var_dump($headers);
//var_dump('Удалить домен');
//var_dump($body);


//Получить DNS-записи домена
$request = new HTTP_Request2('https://pddimp.yandex.ru/api2/admin/dns/list?domain=' . $domain, HTTP_Request2::METHOD_GET);
$request->setHeader(array('PddToken' => 'token123'));
$responce = $request->send();
$headers = $responce->getHeader();
$body = json_decode($responce->getBody());

//var_dump($headers);
var_dump('Получить DNS-записи домена');
var_dump($body);


//Добавить DNS-запись
$types = array('SRV', 'TXT', 'NS', 'MX', 'SOA', 'A', 'AAAA', 'CNAME');
$request = new HTTP_Request2('https://pddimp.yandex.ru/api2/admin/dns/add', HTTP_Request2::METHOD_POST);
$request->setHeader(array('PddToken' => 'token123'));
$request->setBody('domain=' . $domain . '&type=' . $types[5] . '&content=127.0.0.1');
$responce = $request->send();
$headers = $responce->getHeader();
$body = json_decode($responce->getBody());

//var_dump($headers);
var_dump('Добавить DNS-запись');
var_dump($body);


//Редактировать DNS-запись
$types = array('SRV', 'TXT', 'NS', 'MX', 'SOA', 'A', 'AAAA', 'CNAME');
$request = new HTTP_Request2('https://pddimp.yandex.ru/api2/admin/dns/edit', HTTP_Request2::METHOD_POST);
$request->setHeader(array('PddToken' => 'token123'));
$request->setBody('domain=' . $domain . '&type=' . $types[5] . '&record_id=33767611&content=127.0.0.2');
$responce = $request->send();
$headers = $responce->getHeader();
$body = json_decode($responce->getBody());

//var_dump($headers);
var_dump('Редактировать DNS-запись');
var_dump($body);


//Удалить DNS-запись
$types = array('SRV', 'TXT', 'NS', 'MX', 'SOA', 'A', 'AAAA', 'CNAME');
$request = new HTTP_Request2('https://pddimp.yandex.ru/api2/admin/dns/del', HTTP_Request2::METHOD_POST);
$request->setHeader(array('PddToken' => 'token123'));
$request->setBody('domain=' . $domain . '&record_id=33767611');
$responce = $request->send();
$headers = $responce->getHeader();
$body = json_decode($responce->getBody());

//var_dump($headers);
var_dump('Удалить DNS-запись');
var_dump($body);