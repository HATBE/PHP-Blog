<?php
    class AuthController extends Controller {
        private $authmodel;
        private $userModel;
        
        public function __construct() {
            $this->authModel = $this->model('Auth');
            $this->userModel = $this->model('User');
        }
        
        public function index() {
            $this->login();
        }

        public function register() {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
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
                if($this->userModel->existsUname($username)) {
                    $msg[] = 'User already exists';
                }
                if($msg == null) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $username = htmlentities($username, ENT_QUOTES, 'utf-8');
                    $username = trim($username);
                    $username = str_replace(' ', '', $username);

                    $this->authModel->register($username, $password);
                    header('Location: ' . ROOT_PATH . 'users/users');
                }
            }

            $data = array(
                'username' => $username,
                'msg' => $msg,
                'backPath' => 'users/users',
                'actionName' => 'Register'
            );

            $this->render('auth/register', $data);

        }

        public function login() {
            if(isset($_SESSION['loggedIn'])) {
                header('Location: /index/index');
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
                        header('Location: /index/index');
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