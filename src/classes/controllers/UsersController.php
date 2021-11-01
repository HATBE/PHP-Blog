<?php
    class UsersController extends Controller {
        private $userModel;
        private $postModel;
        
        public function __construct() {
            $this->userModel = $this->model('User');
            $this->postModel = $this->model('Post');
        }

        public function index() {
            if(!isset($_SESSION['loggedIn'])) {
                header('Location: ' . ROOT_PATH);
                exit();
            }

            $users = $this->userModel->getAllUsers();

            $data = array(
                'usersData' => $users
            );
            
            $this->render('users/index', $data);
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

            $msg = null;
            $username = '';
            $password = '';

            if(!$this->userModel->existsId($id)) {
                header('Location: ' . ROOT_PATH . 'users/users');
                exit();
            }

            $user = $this->userModel->getUserById($id);

            if(isset($_POST['submitInput'])) {
                if(empty($_POST['usernameInput'])) {
                    $msg[] = "Field username is empty.";
                } else {
                    $username = $_POST['usernameInput'];
                }
                if(empty($_POST['passwordInput'])) {
                    $password = '';
                } else {
                    $password = $_POST['passwordInput'];
                }

                if($msg == null) {
                    $username = htmlentities($username, ENT_QUOTES, "UTF-8");
                    
                    $password = $password == '' ? $user->password : password_hash($password, PASSWORD_DEFAULT);

                    $this->userModel->update($username, $password, $id);
                    header('Location: ' . ROOT_PATH . 'users/users');
                    exit();
                }
            }

            $data = array(
                'msg' => $msg,
                'id' => $user->id,
                'username' => $user->username,
                'backPath' => 'users/users',
                'actionName' => 'Edit'
            );

            $this->render('users/edit', $data);
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
            if($id == $_SESSION['loggedIn'] || $id == 1) {
                header('Location: ' . ROOT_PATH . 'users/users');
                exit();
            }

            if(isset($_POST['sure'])) {
                $this->postModel->deleteAllPostsFromUserId($id);
                $this->userModel->delete($id);

                header('Location: ' . ROOT_PATH);
            }

            $data = array(
                'id' => $id,
                'backPath' => 'users/users'
            );  

            $this->render('users/delete', $data);
        }
    }