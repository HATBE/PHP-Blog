<?php

    require_once(__DIR__ . '/../Controller.php');

    class Posts extends Controller {

        private $postModel;

        public function __construct() {
            $this->postModel = $this->model('Post');
        }

        public function index($page = 1) {
            $page = $page === null || !is_numeric($page) ? 1 : $page;
            $page = filter_var($page, FILTER_SANITIZE_NUMBER_INT);

            $itemsPerPage = 5;

            $postsCount = $this->postModel->getPostsCount();
            $maxPage = ceil($postsCount / $itemsPerPage);
            $page = $page < 1 ? 1 : $page;
            
            $start = ($page * $itemsPerPage) - $itemsPerPage;
            
            $posts = $this->postModel->getAllPostsWithLimit($start, $itemsPerPage);
            $newestPostId = $this->postModel->getNewestPostId();

            $postsData = array();
            if($posts == null) {
                $postsData = null;
            } else {
                foreach($posts as $post) {
                    $tpost = array();
                    $tpost['id'] = $post->id;
                    $tpost['title'] = $post->title;
                    $tpost['body'] = strlen($post->body) > 400 ? substr($post->body, 0, 400) . '...' : $post->body;
                    $tpost['date'] = date('m/d/y H:i', strtotime($post->date));
                    $tpost['username'] = $post->username;
                    array_push($postsData, $tpost);
                }
            }

            $data = array(
                'view' => true,
                'postsData' => $postsData,
                'newestPostId' => $newestPostId,
                'postsCount' => $postsCount,
                'currentPage' => $page,
                'maxPage' => $maxPage
            );

            $this->view('index', $data);
        }

        public function post($id, $oldPageIndex = 1) {
            if($id === null || !is_numeric($id)) {
                $post = null;
            }
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $post = $this->postModel->getPostById($id);
            $newestPostId = $this->postModel->getNewestPostId();

            if($post == null) {
                 $postData = null;
            } else {            
                $postData = array();
                $postData['id'] = $post->id;
                $postData['title'] = $post->title;
                $postData['body'] = nl2br($post->body);
                $postData['date'] = date('m/d/y H:i', strtotime($post->date));
                $postData['username'] = $post->username;
            }

            $data = array(
                'view' => false,
                'newestPostId' => $newestPostId,
                'post' => $postData,
                'oldPageIndex' => $oldPageIndex
            );

            $this->view('post', $data);
        }

        public function create() {

            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }

            $errors = null;
            $title = '';
            $body = '';

            if(isset($_POST['submit'])) {
                if(empty($_POST['title'])) {
                    $errors[] = "Field Title is empty.";
                } else {
                    $title = $_POST['title'];
                }
                if(empty($_POST['body'])) {
                    $errors[] = "Field Text is empty.";
                } else {
                    $body = $_POST['body'];
                }
                if($errors == null) {
                    $userId = $_SESSION['loggedIn'];
                    $title = htmlentities($title, ENT_QUOTES, "UTF-8");
                    $body = htmlentities($body, ENT_QUOTES, "UTF-8");
                    
                    $id = $this->postModel->create($title, $body, $userId);
                    header('Location: ' . ROOT_PATH . 'posts/post/' . $id);
                    exit();
                }
            }

            $data = array(
                'title' => $title,
                'body' => $body,
                'errors' => $errors
            );

            $this->view('create', $data);
        }

        public function edit($id) {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }
            if($id === null || !is_numeric($id)) {
                header('Location: ' . ROOT_PATH);
                exit();
            }
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $errors = null;
            $title = '';
            $body = '';

            $post = $this->postModel->getPostById($id);

            if($post == null) {
                header('Location: ' . ROOT_PATH);
                exit();
            }

            if(isset($_POST['submit'])) {
                if(empty($_POST['title'])) {
                    $errors[] = "Field Title is empty.";
                } else {
                    $title = $_POST['title'];
                }
                if(empty($_POST['body'])) {
                    $errors[] = "Field Text is empty.";
                } else {
                    $body = $_POST['body'];
                }
                if($errors == null) {
                    $title = htmlentities($title, ENT_QUOTES, "UTF-8");
                    $body = htmlentities($body, ENT_QUOTES, "UTF-8");
                    $this->postModel->update($title, $body, $id);
                    header('Location: ' . ROOT_PATH . 'posts/post/' . $id);
                    exit();
                }
            }

            $data = array(
                'errors' => $errors,
                'title' => $post->title,
                'body' => $post->body,
                'id' => $post->id
            );  

            $this->view('edit', $data);
        }

        public function delete($id) {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }
            if($id === null || !is_numeric($id)) {
                header('Location: ' . ROOT_PATH);
                exit();
            }
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            if(!$this->postModel->exists($id)) {
                header('Location: ' . ROOT_PATH);
                exit();
            }

            if(isset($_POST['sure'])) {
                $this->postModel->delete($id);
                header('Location: ' . ROOT_PATH);
            }

            $data = array(
                'id' => $id
            );  

            $this->view('delete', $data);
        }
    }