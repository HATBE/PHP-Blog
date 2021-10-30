<?php
    abstract class Controller {
        protected function model($model) {
            $path = __DIR__ . '/../models/' . $model . '.php';
            if(file_exists($path)) {
                require_once($path);
                return new $model();
            }
            return null;
        }
        
        protected function render($view, $data = []) {
            $path = __DIR__ . '/../views/' . $view . '.php';
            if(file_exists($path)) {
                require_once($path);
            } else {
                echo 'View not found';
                exit();
            }
        }
    }