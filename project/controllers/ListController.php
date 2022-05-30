<?php

namespace Project\Controllers;

use \Core\Controller;
use Project\Models\Conferences;
//Контроллер для взаимодействия со списком конференций, в частности для его отображения.
class ListController extends Controller
{
    //Метод отображения списка конференций. 
    //Также обрабатывает фильтрацию по тексту, если таковой был задан.
    public function show()
    {
        $this->title = 'Список конференций';
        if($_GET) {
            $pattern = $_GET["pattern"];
            $data = (new Conferences)->getByPattern($pattern);
            
            if ($data->rowCount() == 0) {
                return $this->render('list/notFoundByPattern', $data);
            }
        } else {
            $data = (new Conferences)->getAll();
        }

        return $this->render('list/show', $data);
    }
}
