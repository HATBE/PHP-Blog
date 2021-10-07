<?php

    require_once(__DIR__ . '/../Controller.php');

    class Users extends Controller {

        private $userModel;

        public function __construct() {
            $this->userModel = $this->model('User');
            $this->postModel = $this->model('Post');
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

            $this->view('user/users', $data);
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
                'username' => $user->username,
                'backPath' => 'users/users',
                'actionName' => 'Edit'
            );

            $this->view('user/edit', $data);
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
                'id' => $id,
                'backPath' => 'users/users'
            );  

            $this->view('user/delete', $data);
        }
    }