<?php

    require_once(__DIR__ . '/../Controller.php');

    class Users extends Controller {

        private $userModel;

        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function login() {
            $this->view('login');
        }

    }