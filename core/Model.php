<?php

namespace Core;


class Model
{
    protected static $link;

    public function __construct()
    {
        //Создаем подключение к БД. Поле link сделано статическим,
        //чтобы при создании нового обьекта класса не создавалось новое подключение
        if (!self::$link) {
            try {
                $constant = 'constant';

                self::$link = new \PDO("{$constant('DB_SERVER')}:host={$constant('DB_HOST')};
                dbname={$constant('DB_NAME')};charset=utf8", DB_USER, DB_PASS);

                self::$link->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                echo "Ошибка подключения к БД.";
            }
        }
    }
}
