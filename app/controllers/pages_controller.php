<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Pages extends Controller
{
    public function home()
    {
        $wiki = $this->model('WikiDAO');
        $category = $this->model('CategoryDAO');

        $wikis = $wiki->getLatestWikis();
        $categories = $category->getLatestCategories();

        $data = [
            'wikis' => $wikis,
            'categories' => $categories,
        ];
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
            } elseif ($result == 2) {
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
        if (!isAdmin()) {
            goToPage('notfound');
        }
        $this->view('admin/dashboard');
    }

    public function stats()
    {
        if (!isAdmin()) {
            goToPage('notfound');
        }
        $this->view('admin/stats');
    }

    public function tags()
    {
        if (!isAdmin()) {
            goToPage('notfound');
        }
        $data = [];
        $result = '';
        $tag = $this->model('TagDAO');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit'])) {
                $result = processForm($_POST['csrf_token']);
                if (!$result) {
                    $msg[] = "Error 0x0000CSRF";
                } else {
                    $tag->getTag()->setName($_POST['tag']);

                    $result = $tag->addTag($tag->getTag());
                }
            }
            if (isset($_POST['edit'])) {
                $result = processForm($_POST['csrf_token']);
                if (!$result) {
                    $msg[] = "Error 0x0000CSRF";
                } else {
                    $tag->getTag()->setName($_POST['tag']);
                    $tag->getTag()->setId($_POST['tagId']);

                    $result = $tag->updateTag($tag->getTag());
                }
            }
            if (isset($_POST['delete'])) {
                $result = processForm($_POST['csrf_token']);
                if (!$result) {
                    $msg[] = "Error 0x0000CSRF";
                } else {
                    $tag->getTag()->setId($_POST['tagId']);

                    $result = $tag->deleteTag($tag->getTag());
                }
            }
        }
        $tags = $tag->getAllTags();
        $data = [
            'msg' => $result,
            'tags' => $tags,
        ];
        $this->view('admin/tags', $data);
    }

    public function categories()
    {
        if (!isAdmin()) {
            goToPage('notfound');
        }
        $data = [];
        $result = '';
        $category = $this->model('CategoryDAO');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit'])) {
                $result = processForm($_POST['csrf_token']);
                if (!$result) {
                    $msg[] = "Error 0x0000CSRF";
                } else {
                    $category->getCategory()->setName($_POST['category']);

                    $result = $category->addCategory($category->getCategory());
                }
            }
            if (isset($_POST['edit'])) {
                $result = processForm($_POST['csrf_token']);
                if (!$result) {
                    $msg[] = "Error 0x0000CSRF";
                } else {
                    $category->getCategory()->setName($_POST['category']);
                    $category->getCategory()->setId($_POST['categoryId']);

                    $result = $category->updateCategory($category->getCategory());
                }
            }
            if (isset($_POST['delete'])) {
                $result = processForm($_POST['csrf_token']);
                if (!$result) {
                    $msg[] = "Error 0x0000CSRF";
                } else {
                    $category->getCategory()->setId($_POST['categoryId']);

                    $result = $category->deleteCategory($category->getCategory());
                }
            }
        }
        $categories = $category->getAllCategories();
        $data = [
            'msg' => $result,
            'categories' => $categories,
        ];
        $this->view('admin/categories', $data);
    }

    public function wikis()
    {
        if (!isAdmin()) {
            goToPage('notfound');
        }
        $wikis = [];
        $wiki = $this->model('WikiDAO');

        $data = [
            'wikis' => $wikis,
        ];

        $this->view('admin/wikis', $data);
    }

    public function logout()
    {
        $user = $this->model('UserDAO');
        if ($user->logout()) {
            goToPage('login');
        }
    }

    public function notfound()
    {
        $this->view('404');
    }
}
