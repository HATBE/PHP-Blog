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
            $this->include();
            $this->getUrl();
            $this->getController();
            $this->controller = new $this->controller;
            $this->getMethod();
            $this->getParams();
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

        private function getController() {
            $controller = ucfirst(strtolower($this->url[0])) . 'Controller';
            if(file_exists(__DIR__ . '/controllers/' . $controller . '.php')) {
                $this->controller = $controller;
                unset($this->url[0]);
            }
            require_once(__DIR__ . '/controllers/' . $this->controller . '.php');
        }
        
        private function getMethod() {
            if(isset($this->url[1])) {
                $method = strtolower($this->url[1]);
                if(method_exists($this->controller, $method)) {
                    $this->method = $method;
                    unset($this->url[1]);
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
            }
        }
    }