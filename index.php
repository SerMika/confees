<?php

namespace Core;

error_reporting(E_ALL);
ini_set('display_errors', 'on');

define('ROOT', $_SERVER["DOCUMENT_ROOT"]);
define('BASE_URI', $_SERVER["HTTP_HOST"]);

//Кастомный автозагрузчик классов
spl_autoload_register(function ($class) {
    preg_match('#(.+)\\\\(.+?)$#', $class, $match);
    $nameSpace = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($match[1]));
    $className = $match[2];

    $path = ROOT . DIRECTORY_SEPARATOR . $nameSpace . DIRECTORY_SEPARATOR . $className . '.php';

    if (file_exists($path)) {
        require_once $path;

        if (class_exists($class, false)) {
            return true;
        } else {
            throw new \Exception("Класс $class не найден в файле $path. Проверьте правильность написания имени класса внутри указанного файла.");
        }
    } else {
        throw new \Exception("Для класса $class не найден файл $path. Проверьте наличие файла по указанному пути. Убедитесь, что пространство имен вашего класса совпадает с тем, которое пытается найти фреймворк для данного класса. Например, вы создаете класса модели, но забыли заюзать ее через use. В этом случае вы пытаетесь вызвать класс модели в пространстве имен контроллера, а такого файла нет.");
    }
});

//Подключаем переменные для подключения к БД
require_once ROOT . '/project/config/connection.php';

//Подключаем возможные пути
$routes = require ROOT . '/project/config/routes.php';
//Определяем какому пути соответствует данный URL и создаем обьект класса Track
$track = (new Router)->getTrack($routes, $_SERVER['REQUEST_URI']);
//С помощью полученного обьекта Track и класса Dispatcher определяем какому контроллеру и какому его методу передать управление
//Диспетчер вызывает метод классф контроллера, который возвращает обьект класса Page
$page  = (new Dispatcher)->getPage($track);
//Рендерим страницу с помощью класса View
echo (new View)->render($page);
