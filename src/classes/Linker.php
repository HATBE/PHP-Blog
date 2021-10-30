<?php
    class Linker {
        public static function link($controller, $method, array $args = []) {
            $link = ROOT_PATH . $controller . '/' . $method;
            $link .= '/' . join('/', $args);
            return $link;
        }
    }