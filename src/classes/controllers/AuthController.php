<?php
    class AuthController extends Controller {
        private $authmodel;
        
        public function __construct() {
            $this->authModel = $this->model('Auth');
        }
        public function index() {
            $this->login();
        }

        public function login() {
            if(isset($_SESSION['loggedIn'])) {
                Linker::link('index', 'index');
                exit();
            }

            $msg = null;
            $username = '';
            $password = '';

            if(isset($_POST['submitInput'])) {
                if(empty($_POST['usernameInput'])) {
                    $msg[] = "Field username is empty.";
                } else {
                    $username = $_POST['usernameInput'];
                }
                if(empty($_POST['passwordInput'])) {
                    $msg[] = "Field password is empty.";
                } else {
                    $password = $_POST['passwordInput'];
                }
                if($msg == null) {
                    $login = $this->authModel->login($username, $password);
                    if($login !== false) {
                        $_SESSION['loggedIn'] = $login;
                        header('Location: ' . Linker::link('index', 'index'));
                        exit();
                    } else {
                        $msg[] = "Login failed, password or username incorrect.";
                    }
                }
            }

            $data = array(
                'username' => $username,
                'msg' => $msg
            );

            $this->render('auth/login', $data);
        }

        public function logout() {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . Linker::link('index', 'index'));
                exit();
            }
            session_destroy();
            header('Location: ' . Linker::link('index', 'index'));
        }
    }