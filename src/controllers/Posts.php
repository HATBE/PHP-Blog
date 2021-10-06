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

            $itemsPerPage = 10;

            $postsCount = $this->postModel->getPostsCount();
            $maxPage = ceil($postsCount / $itemsPerPage);
            $page = $page < 1 ? 1 : $page;
            
            $start = ($page * $itemsPerPage) - $itemsPerPage;
            
            $posts = $this->postModel->getAllPostsWithLimit($start, $itemsPerPage);

            $newestPostId = $this->postModel->getNewestPostId();

            $data = array(
                'posts' => $posts,
                'newestPostId' => $newestPostId,
                'postsCount' => $postsCount,
                'currentPage' => $page,
                'maxPage' => $maxPage
            );

            $this->view('index', $data);
        }

        public function post($id) {
            if($id === null || !is_numeric($id)) {
                $this->view('error/404');
                exit();
            }
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $post = $this->postModel->getPostById($id);

            if($post == null) {
                $this->view('error/404');
                exit();
            }
            
            $data = array(
                'post' => $post
            );

            $this->view('post', $data);
        }
    }