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
        if(isLogged()){
            goToPage('home');
        }
        $this->view('login');
    }

    public function signup()
    {
        $this->view('signup');
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
        // $user = $this->model('user');
        // $user->logout();
    }

    public function notfound()
    {
        $this->view('404');
    }
}
