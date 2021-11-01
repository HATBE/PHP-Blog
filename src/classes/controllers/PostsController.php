<?php
    class PostsController extends Controller {
        private $postModel;

        public function __construct() {
            $this->postModel = $this->model('post');
        }

        public function index($page = 1) {
            $posts = $this->postModel->getPostsLimit($page);

            $data = [
                'posts' => $posts
            ];  

            $this->render('posts/index', $data);
        }

        public function post($id, $page = 1) {

            $post = $this->postModel->getPostByIdMd($id);

            $data = [
                'post' => $post,
                'page' => $page
            ];
            
            $this->render('posts/post', $data);
        }


        public function create() {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }

            $errors = null;
            $title = '';
            $body = '';

            if(isset($_POST['submitInput'])) {
                if(empty($_POST['titleInput'])) {
                    $errors[] = "Field Title is empty.";
                } else {
                    $title = $_POST['titleInput'];
                }
                if(empty($_POST['bodyInput'])) {
                    $errors[] = "Field Text is empty.";
                } else {
                    $body = $_POST['bodyInput'];
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
                'errors' => $errors,
                'actionName' => 'Create',
                'backPath' => 'posts/index/',
            );

            $this->render('posts/create', $data);
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

            if(isset($_POST['submitInput'])) {
                if(empty($_POST['titleInput'])) {
                    $errors[] = "Field Title is empty.";
                } else {
                    $title = $_POST['titleInput'];
                }
                if(empty($_POST['bodyInput'])) {
                    $errors[] = "Field Text is empty.";
                } else {
                    $body = $_POST['bodyInput'];
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
                'id' => $post->pid,
                'actionName' => 'Edit'
            );

            $this->render('posts/edit', $data);  
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

            if(!$this->postModel->existsId($id)) {
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

            $this->render('posts/delete', $data); 
        }
    }