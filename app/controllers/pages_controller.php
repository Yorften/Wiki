<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Pages extends Controller
{
    public function home()
    {
        $this->view('home');
    }

    public function notfound()
    {
        $this->view('404');
    }
}
