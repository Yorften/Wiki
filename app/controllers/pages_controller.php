<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Pages extends Controller
{
    public function home()
    {
        $wikis = [];
        $categories = [];
        $wiki = $this->model('WikiDAO');
        $category = $this->model('CategoryDAO');

        $wikis = $wiki->getLatestWikis();
        $categories = $category->getLatestCategories();

        $data = [
            'wikis' => $wikis,
            'categories' => $categories,
        ];
        $this->view('home', $data);
    }




    public function wiki($param)
    {
        $wiki = $this->model('WikiDAO');
        $tag = $this->model('WikiTagDAO');
        $result = $wiki->checkWiki('wikiId', $param);
        if (!$result) {
            goToPage('notfound');
        }
        if ($wiki->isArchived($param)) {
            goToPage('notfound');
        }
        $wikiTags = $tag->getWikiTags($param);
        $wikiDetails = $wiki->getWikiDetails($param);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['archive'])) {
                $wiki->getWiki()->setId($param);
                $result = $wiki->archiveWiki($wiki->getWiki());
                if($result == 1){
                    goToPage('home');
                }
            }
        }

        $data = [
            'wikiDetails' => $wikiDetails,
            'wikiTags' => $wikiTags,
        ];

        $this->view('wiki', $data);
    }




    public function create()
    {
        if (!isLogged()) {
            goToPage('login');
        }
        $msg = [];
        $tag = $this->model('TagDAO');
        $category = $this->model('CategoryDAO');
        $wiki = $this->model('WikiDAO');

        $categories = $category->getAllCategories();
        $tags = $tag->getAllTags();

        $data = [
            'categories' => $categories,
            'tags' => $tags,
        ];
        $this->view('createwiki', $data);
    }

    public function addWiki()
    {
        // if (!isAuthor()) {
        //     goToPage('notfound');
        // }
        $wiki = $this->model('WikiDAO');
        $wikiTags = $this->model('WikiTagDAO');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_FILES['image'])) {
                $uploadedFile = $_FILES['image'];
                $name = $uploadedFile['name'];
                $size = $uploadedFile['size'];
                $tmp_name = $uploadedFile['tmp_name'];
                $error = $uploadedFile['error'];

                $imgName = uploadWikiImage($name, $tmp_name, $size, $error);
                if (is_int($imgName)) {
                    switch ($imgName) {
                        case 1:
                            echo 'Sorry your file is too large. (max 4mb)';
                            break;
                        case 2:
                            echo 'Unsupported format. (jpg, jpeg, png, webp)';
                            break;
                        default:
                            echo 'Unkown error occured';
                            break;
                    }
                }
            } else $imgName = null;

            $data = json_decode($_POST['json_data'], true);
            if ($data['tags'][0] == null) {
                array_shift($data['tags']);
            }

            $tags = [];
            foreach ($data['tags'] as $tag) {
                array_push($tags, intval($tag));
            }


            $wiki->getWiki()->getAuthor()->setId($_SESSION['userId']);
            $wiki->getWiki()->getCategory()->setId($data['category']);
            $wiki->getWiki()->setName($data['title']);
            $wiki->getWiki()->setDesc($data['desc']);
            $wiki->getWiki()->setImage($imgName);
            $wiki->getWiki()->setContent($data['content']);

            $wikiId = $wiki->addWiki($wiki->getWiki());
            if (!is_int($wikiId)) {
                echo $wikiId;
                exit;
            }
            if ($wikiTags->setWikiTags($tags, $wikiId)) {
                echo $wikiId;
                exit;
            }
        }
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
        $result = '';
        $wiki = $this->model('WikiDAO');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['restore'])) {
                $result = processForm($_POST['csrf_token']);
                if (!$result) {
                    $msg[] = "Error 0x0000CSRF";
                } else {
                    $wiki->getWiki()->setId($_POST['wikiId']);
                    $result = $wiki->restoreWiki($wiki->getWiki());
                }
            }
            if (isset($_POST['archive'])) {
                $result = processForm($_POST['csrf_token']);
                if (!$result) {
                    $msg[] = "Error 0x0000CSRF";
                } else {
                    $wiki->getWiki()->setId($_POST['wikiId']);
                    $result = $wiki->archiveWiki($wiki->getWiki());
                }
            }
        }

        $wikis = $wiki->getAllWikis();

        $data = [
            'msg' => $result,
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
