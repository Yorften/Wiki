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

    public function login()
    {
        if (isLogged()) {
            goToPage('home');
        }
        $data = [];
        $user = $this->model('UserDAO');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = processForm($_POST['csrf_token']);
            if (!$result) {
                $msg[] = "Error 0x0000CSRF";
            } else {
                $user->getUser()->setEmail($_POST['email']);
                $user->getUser()->setPassword($_POST['password']);
                $result = $user->login($user->getUser());
            }
            if ($result == 1) {
                goToPage('home');
            }elseif($result == 2){
                goToPage('dashboard');
            }
            $data = [
                'msg' => $result
            ];
        }
        $this->view('login', $data);
    }

    public function signup()
    {
        if (isLogged()) {
            goToPage('home');
        }
        $data = [];
        $user = $this->model('UserDAO');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = processForm($_POST['csrf_token']);
            if (!$result) {
                $msg[] = "Error 0x0000CSRF";
            } else {
                $user->getUser()->setName($_POST['username']);
                $user->getUser()->setEmail($_POST['email']);
                $user->getUser()->setPassword(hashPassword($_POST['password']));

                $result = $user->signup($user->getUser());
            }
            $data = [
                'msg' => $result
            ];
        }
        $this->view('signup', $data);
    }

    public function dashboard()
    {
        // if(!isAdmin()){
        //     goToPage('notfound');
        // }
        $this->view('admin/dashboard');
    }

    public function stats()
    {
        $this->view('admin/stats');
    }

    public function tags()
    {
        $this->view('admin/tags');
    }

    public function categories()
    {
        $this->view('admin/categories');
    }

    public function wikis()
    {
        $this->view('admin/wikis');
    }

    public function logout()
    {
        $user = $this->model('UserDAO');
        if($user->logout()){
            goToPage('login');
        }
    }

    public function notfound()
    {
        $this->view('404');
    }
}
