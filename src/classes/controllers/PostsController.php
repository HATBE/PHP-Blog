<?php
    require_once(__DIR__ . '/../Controller.php');

    class PostsController extends Controller {
        public function index() {
            $this->render('posts/index');
        }

        public function post($id) {
            echo "The id is: $id";
        }
    }