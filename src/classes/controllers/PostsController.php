<?php
    class PostsController extends Controller {
        private $postModel;

        public function __construct() {
            $this->postModel = $this->model('post');
        }

        public function index($page = 1) {
            $posts = $this->postModel->getIndexPosts($page);

            $data = [
                'posts' => $posts
            ];  

            $this->render('posts/index', $data);
        }

        public function post($id, $page = 1) {

            $post = $this->postModel->getPostById($id);

            $data = [
                'post' => $post,
                'page' => $page
            ];
            
            $this->render('posts/post', $data);
        }
    }