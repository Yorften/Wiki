<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Search extends Controller
{
    public function getwikis()
    {
        $wiki = $this->model('WikiDAO');
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($data['search']);
    }

    public function getcategories()
    {
        $wiki = $this->model('WikiDAO');
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($data['search']);
    }

    public function gettags()
    {
        $wiki = $this->model('WikiTagDAO');
        $data = json_decode(file_get_contents("php://input"), true);

        echo json_encode($data['search']);
    }
}
