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

        public function post($id) {
            echo "The id is: $id";
        }
    }