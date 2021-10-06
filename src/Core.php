<?php

    session_start();

    require_once(__DIR__ . '/config/config.php');
    
    class Core {

        protected $currentController = 'Posts';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->getUrl();

            $controller = ucfirst(strtolower($url[0]));
            if(file_exists(__DIR__ . '/controllers/' . $controller . '.php')) {
                $this->currentController = $controller;
                unset($url[0]);
            }
            require_once(__DIR__ . '/controllers/' . $this->currentController . '.php');
            $this->currentController = new $this->currentController;

            if(isset($url[1])) {
                $method = strtolower($url[1]);
                if(method_exists($this->currentController, $method)) {
                    $this->currentMethod = $method;
                    unset($url[1]);
                }
            }
            
            $this->params = $url ? array_values($url) : array(null);

            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl() {
            if(isset($_SERVER['PATH_INFO'])) {
                $url = rtrim($_SERVER['PATH_INFO'], '/'); // remove last slash
                $url = substr($url, 1); // remove first slash
                $url = filter_var($url, FILTER_SANITIZE_URL); // sanitize URL
                $url = explode('/', $url);
                return $url;
            }
        }
    }