<?php
    require_once(__DIR__ . '/../Controller.php');

    class Authentications extends Controller {

        private $authModel;
        private $userModel;

        public function __construct() {
            $this->authModel = $this->model('Authentication');
            $this->userModel = $this->model('User');
        }

        public function register() {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }

            $errors = null;
            $username = '';
            $password = '';

            if(isset($_POST['submit'])) {
                if(empty($_POST['username'])) {
                    $errors[] = "Field username is empty.";
                } else {
                    $username = $_POST['username'];
                }
                if(empty($_POST['password'])) {
                    $errors[] = "Field password is empty.";
                } else {
                    $password = $_POST['password'];
                }
                if($this->userModel->existsUname($username)) {
                    $errors[] = 'User already exists';
                }
                if($errors == null) {
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
                'errors' => $errors,
                'backPath' => 'users/users',
                'actionName' => 'Register'
            );

            $this->view('authentication/register', $data);
        }

        public function login() {
            if(isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }

            $errors = null;
            $username = '';
            $password = '';

            if(isset($_POST['submit'])) {
                if(empty($_POST['username'])) {
                    $errors[] = "Field username is empty.";
                } else {
                    $username = $_POST['username'];
                }
                if(empty($_POST['password'])) {
                    $errors[] = "Field password is empty.";
                } else {
                    $password = $_POST['password'];
                }
                if($errors == null) {
                    $login = $this->authModel->login($username, $password);
                    if($login !== false) {
                        $_SESSION['loggedIn'] = $login;
                        header('Location: ' . ROOT_PATH);
                    } else {
                        $errors[] = "Login failed, password or username incorrect.";
                    }
                }
            }
            $data = array(
                'username' => $username,
                'errors' => $errors,
                'actionName' => 'Login'
            );

            $this->view('authentication/login', $data);
        }

        public function logout() {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }
            session_destroy();
            header('Location: ' . ROOT_PATH);
        }

    }