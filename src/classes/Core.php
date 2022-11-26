<?php
    class Core {
        private $url;
        private $controller = 'PostsController'; // this must exist! in /src/classes/controllers/{class}
        private $method = 'index'; // this must exist! in /src/classes/controllers/{class}->{method}
        private $params = [];

        public function __construct() {
            $this->init();
        }

        private function init() {
            session_start();

            $this->checkInstalled();

            $this->include();
            $this->getUrl();
            $this->getController();
            $this->controller = new $this->controller();
            $this->getMethod();
            $this->getParams();
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

        private function getController() {
            $controller = ucfirst(strtolower($this->url[0])) . 'Controller';
            if(file_exists(__DIR__ . '/controllers/' . $controller . '.php')) {
                $this->controller = $controller;
                array_shift($this->url);
            }
            require_once(__DIR__ . '/controllers/' . $this->controller . '.php');
        }
        
        private function getMethod() {
            if(isset($this->url[0])) {
                $method = strtolower($this->url[0]);
                if(method_exists($this->controller, $method)) {
                    $this->method = $method;
                    array_shift($this->url);
                }
            }
        }

        private function getParams() {
            $this->params = $this->url ? array_values($this->url) : [null];
        }

        private function include() {
            require_once(__DIR__ . '/../../config/config.php');
            require_once(__DIR__ . '/Database.php');
            require_once(__DIR__ . '/Controller.php');
            require_once(__DIR__ . '/Model.php');
            require_once(__DIR__ . '/Linker.php');
            require_once(__DIR__ . '/lib/Parsedown.php');
            require_once(__DIR__ . '/Template.php');
        }

        private function getUrl() {
            if(isset($_SERVER['PATH_INFO'])) {
                $url = rtrim($_SERVER['PATH_INFO'], '/'); // remove last slash
                $url = substr($url, 1); // remove first slash
                $url = filter_var($url, FILTER_SANITIZE_URL); // sanitize URL
                $url = explode('/', $url);
                if($url[0] == '') return;
                $this->url = $url;
            } else {
                $this->url = ['/'];
            }
        }

        private function checkInstalled() {
            if(!file_exists(__DIR__ . '/../../install/.installed')) {
                require_once(__DIR__ . '/../../install/install.php');
                exit();
            }
        }
    }