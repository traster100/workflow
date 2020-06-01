<?php
/*
Класс-маршрутизатор для определения запрашиваемой страницы.
цепляет классы контроллеров и моделей;
создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/

class Route {

    static function start() {

// контроллер и метод по умолчанию
        $controller_name = 'Index';
        $action_name = 'index';

        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        $routes = explode('/', $uri);

// получаем имя контроллера
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }

// получаем имя метода
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

// добавляем префиксы
        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'action_' . $action_name;

// подцепляем файл модели
        $model_file = strtolower($model_name) . '.php';
        $model_path = "application/models/" . $model_file;

        if (DEBUG) {
            var_dump($model_name);
            var_dump($model_path);
        }

// модель с названием равным названию контроллера - подключать наверно не надо. модели подключать самому в контроллерах
        if (file_exists($model_path)) {
            require_once 'application/models/' . $model_file;
        }

// подцепляем файл контроллера
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "application/controllers/" . $controller_file;

        if (DEBUG) {
            var_dump($controller_name);
            var_dump($controller_path);
        }

        if (file_exists($controller_path)) {
            include "application/controllers/" . $controller_file;
        } else {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }

// создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
// вызываем метод
            $controller->$action();
        } else {
// здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }

    function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

}
