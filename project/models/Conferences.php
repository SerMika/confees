<?php

namespace Project\Models;

use \Core\Model;
use PDOException;
//Класс модели для работы с таблицей Конференций.
class Conferences extends Model
{
    //Метод для вставки данных в БД. Обрабатывает некоторые "узкие" ситуации.
    public function insert($data)
    {
        $selectFull = self::$link->query("SELECT id, title, date_format(date, '%d.%m.%Y %H:%i') as date,
        latitude, longitude, country FROM conferences WHERE title='${data['title']}' and
        date='${data['date']}' and latitude=${data['latitude']} and longitude=${data['longitude']} and country='${data['country']}'");

        $selectFull->setFetchMode(\PDO::FETCH_ASSOC);

        if (!$selectFull->fetch()) {
            $selectWithoudAddress = self::$link->query("SELECT id, title, date_format(date, '%d.%m.%Y %H:%i') as date,
            latitude, longitude, country FROM conferences WHERE title='${data['title']}' and
            date='${data['date']}' and country='${data['country']}'");

            $selectWithoudAddress->setFetchMode(\PDO::FETCH_ASSOC);

            if (!$selectWithoudAddress->fetch()) {
                echo 1;
                $insert = self::$link->prepare("INSERT INTO conferences (title, date, latitude, longitude, country)
                values (:title, :date, :latitude, :longitude, :country)");
                $insert->execute($data);
            } else {
                echo 2;
                $update = self::$link->prepare("UPDATE conferences SET latitude=:latitude, longitude=:longitude
                WHERE title='${data['title']}' and date='${data['date']}' and country='${data['country']}'");

                $update->execute(['latitude' => $data["latitude"], 'longitude' => $data["longitude"]]);
            }
        }
    }
    //Метод для вставки данных в БД если не был указан адрес. Обрабатывает некоторые "узкие" ситуации.
    public function insertWithoutAddress($data)
    {
        $select = self::$link->query("SELECT id, title, date_format(date, '%d.%m.%Y %H:%i') as date,
        latitude, longitude, country FROM conferences WHERE title='${data['title']}' and
        date='${data['date']}' and country='${data['country']}'");

        $select->setFetchMode(\PDO::FETCH_ASSOC);

        if (!$select->fetch()) {
            $insert = self::$link->prepare("INSERT INTO conferences (title, date, country)
            values (:title, :date, :country)");
            $insert->execute($data);
        }
    }
    //Метод для изменения данных в БД.
    public function update($data, $withAddress, $id)
    {
        if(!$withAddress) {
            $data["latitude"] = null;
            $data["longitude"] = null;
        }

        $update = self::$link->prepare("UPDATE conferences 
                SET title=:title, date=:date, latitude=:latitude, longitude=:longitude, country=:country
                WHERE id=$id");
        $update->execute($data);
    }
    //Метод получения данных конкретной конфы из БД по id.
    public function getById($id, $formatDate)
    {
        if ($formatDate) {
            $result = self::$link->query("SELECT id, title, date_format(date, '%d.%m.%Y %H:%i') as date,
            latitude, longitude, country FROM conferences WHERE id=$id");
        } else {
            $result = self::$link->query("SELECT id, title, date_format(date, '%Y-%m-%d %H:%i') as date,
            latitude, longitude, country FROM conferences WHERE id=$id");
        }
        $result->setFetchMode(\PDO::FETCH_ASSOC);

        return $result;
    }
    //Метод получения данных для списка конференций из БД, которые подходят под "фильтр".
    public function getByPattern($pattern)
    {
        $result = self::$link->query("SELECT id, title, date_format(date, '%d.%m.%Y %H:%i') as date,
        latitude, longitude, country FROM conferences WHERE date > NOW() and title LIKE '%$pattern%'");
        
        $result->setFetchMode(\PDO::FETCH_ASSOC);

        return $result;
    }
    //Метод получения данных для списка всех конференций из БД.
    public function getAll()
    {
        $result = self::$link->query('SELECT id, title, date_format(date, "%d.%m.%Y %H:%i") as date,
        latitude, longitude, country FROM conferences WHERE date > NOW()');

        $result->setFetchMode(\PDO::FETCH_ASSOC);

        try {
            $sql = 'DELETE from conferences WHERE date < NOW()';
            $stdh = self::$link->prepare($sql);
            $stdh->execute();
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

        return $result;
    }
    //Метод удаления конкретной конференции по id.
    public function deleteById($id)
    {
        try {
            $sql = 'DELETE from conferences WHERE id=:id';
            $result = self::$link->prepare($sql);
            $result->bindValue(':id', $id);
            $result->execute();
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}
