<?php
    abstract class Controller {
        public function model($model) {
            require_once(__DIR__ . '/models/' . $model . '.php');
            return new $model();
        }

        public function view($view, $data = array()) {
            if(file_exists(__DIR__ . '/views/' . $view . '.php')) {
                require_once(__DIR__ . '/views/' . $view . '.php');
            } else {
                die('View not found');
            }
        }

        public function index() {
            $this->view('error/404');
        }
    }