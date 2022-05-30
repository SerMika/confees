<?php

namespace Project\Controllers;

use \Core\Controller;
use Project\Models\Conferences;
//Контроллер для взаимодействия с конкретной конференцией
class ConfController extends Controller
{
    //Метод для обработки событий страницы создания.
    //Определяет события как для обычного запроса на отображение формы,
    //так и если эта форма была отправлена.
    public function create()
    {
        if($_POST) {
            if(!array_key_exists("addressIsSet", $_POST)) {
                (new Conferences) -> insertWithoutAddress($_POST);
            } else {
                unset($_POST["addressIsSet"]);
                (new Conferences)->insert($_POST);
            }
            $this->title = 'Список';
            header('Location: /list');
        }
        $this->title = 'Создать';

        return $this->render('conf/create');
    }
    //Метод для удаления конференции.
    public function delete()
    {
        if(isset($_POST['buttonDelete'])) {
            $id = $_POST['buttonDelete'];
            (new Conferences)->deleteById($id);
        }
        $this->title = 'Список конференций';
        header('Location: /list');
    }
    //Метод для отображения информации о конференции.
    public function show($params)
    {
        if(!isset($params["id"])) {
            $this->title = 'Ошибка';
            return $this->render('error/confWithoutId');
        }

        $id = $params["id"];
        $this->title = 'Информация';
        $formatDate = true;
        $data = (new Conferences)->getById($id, $formatDate);
        
        if($data->rowCount() > 0) {
            return $this->render('conf/show', $data);
        }
        $this->title = 'Не найдено';

        return $this->render('error/confNotFound');
    }
    //Метод для обработки действий страницы изменения информации.
    //Определяет события как для обычного запроса на отображение формы,
    //так и если эта форма была отправлена.
    public function change($params)
    {
        if ($_POST) {
            if (!array_key_exists("addressIsSet", $_POST)) {
                $withAddress = false;
            } else {
                $withAddress = true;
                unset($_POST["addressIsSet"]);
            }

            $id = $params["id"];
            (new Conferences)->update($_POST, $withAddress, $id);
            $this->title = 'Список';
            header("Location: /conf/show/${params['id']}");
        }

        if (!isset($params["id"])) {
            $this->title = 'Ошибка';
            return $this->render('error/confWithoutId');
        }

        $id = $params["id"];
        $this->title = 'Информация';
        $formatDate = false;
        $data = (new Conferences)->getById($id, $formatDate);

        if ($data->rowCount() > 0) {
            return $this->render('conf/change', $data);
        }
        $this->title = 'Не найдено';

        return $this->render('error/confNotFound');
    }
}
