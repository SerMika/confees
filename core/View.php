<?php

namespace Core;

class View
{
    /*
    Рендерим страницу с с помощью класса Page,
    в котором содержатся все нужные данные для рендеринга.
    Сначала рендерим контент, который после выводится через переменную content
    в шаблоне default.php.
    */
    public function render(Page $page)
    {
        return $this->renderLayout($page, $this->renderView($page));
    }
    //Рендер шаблона.
    private function renderLayout(Page $page, $content)
    {
        $layoutPath = ROOT . "/project/layouts/{$page->layout}.php";

        if (file_exists($layoutPath)) {
            ob_start();
            $title = $page->title;
            include $layoutPath;
            return ob_get_clean();
        }
    }
    //Рендер контента с помощью файлов представлений из папки views.
    private function renderView(Page $page)
    {
        $viewPath = ROOT . "/project/views/{$page->view}.php";

        if (file_exists($viewPath)) {
            ob_start();
            $data = $page->data;
            //extract($data);
            include $viewPath;
            return ob_get_clean();
        }
    }
}
