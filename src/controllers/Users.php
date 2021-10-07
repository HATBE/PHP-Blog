<?php

    require_once(__DIR__ . '/../Controller.php');

    class Users extends Controller {

        private $userModel;

        public function __construct() {
            $this->userModel = $this->model('User');
            $this->postModel = $this->model('Post');
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
                if($this->userModel->exists($username)) {
                    $errors[] = 'User already exists';
                }
                if($errors == null) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $username = htmlentities($username, ENT_QUOTES, 'utf-8');
                    $username = trim($username);
                    $username = str_replace(' ', '', $username);

                    $this->userModel->register($username, $password);
                    header('Location: ' . ROOT_PATH . 'users/users');
                }
            }

            $data = array(
                'username' => $username,
                'errors' => $errors
            );

            $this->view('register', $data);
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
                    $login = $this->userModel->login($username, $password);
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
                'errors' => $errors
            );

            $this->view('login', $data);
        }

        public function logout() {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }
            session_destroy();
            header('Location: ' . ROOT_PATH);
        }

        public function users() {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }

            $users = $this->userModel->getAllUsers();

            $data = array(
                'usersData' => $users
            );

            $this->view('users', $data);
        }

        public function edit($id) {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }
            if($id === null || !is_numeric($id)) {
                header('Location: ' . ROOT_PATH . 'users/users');
                exit();
            }
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $errors = null;
            $username = '';
            $password = '';

            if(!$this->userModel->existsId($id)) {
                header('Location: ' . ROOT_PATH . 'users/users');
                exit();
            }

            $user = $this->userModel->getUserById($id);

            if(isset($_POST['submit'])) {
                if(empty($_POST['username'])) {
                    $errors[] = "Field username is empty.";
                } else {
                    $username = $_POST['username'];
                }
                if(empty($_POST['password'])) {
                    $password = '';
                } else {
                    $password = $_POST['password'];
                }

                if($errors == null) {
                    $username = htmlentities($username, ENT_QUOTES, "UTF-8");
                    
                    $password = $password == '' ? $user->password : password_hash($password, PASSWORD_DEFAULT);

                    $this->userModel->update($username, $password, $id);
                    header('Location: ' . ROOT_PATH . 'users/users');
                    exit();
                }
            }

            $data = array(
                'errors' => $errors,
                'id' => $user->id,
                'username' => $user->username
            );

            $this->view('useredit', $data);
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

            if(!$this->userModel->existsId($id)) {
                header('Location: ' . ROOT_PATH);
                exit();
            }
            if($id == $_SESSION['loggedIn']) {
                header('Location: ' . ROOT_PATH . 'users/users');
                exit();
            }

            if(isset($_POST['sure'])) {
                $this->userModel->delete($id);

                $this->postModel->deleteAllPostsFromUserId($id);

                header('Location: ' . ROOT_PATH);
            }

            $data = array(
                'id' => $id
            );  

            $this->view('deleteuser', $data);
        }
    }