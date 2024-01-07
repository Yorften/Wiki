<?php

class Controller
{
    protected function model($model)
    {
        require_once(__DIR__ . '/../models/' . $model . '.php');
        return new $model();
    }

    protected function view($view, $data = [])
    {
        require_once (__DIR__ . '/../views/' . $view . '_view.php');
    }
}
