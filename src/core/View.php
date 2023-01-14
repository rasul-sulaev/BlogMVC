<?php

namespace App\core;

use App\lib\Db;

class View {
    public $path;
    public $layout = 'default';

    public function __construct($route) {
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $global_vars = [], $vars = []) {
        extract($global_vars);
        extract($vars);

        if (file_exists($path = '../src/views/'.$this->path.'.php')) {
            ob_start();
            require $path;
            $content = ob_get_clean();

            // Вывожу данные для Сайдбара
            $db = new Db();
            $categories = $db->fetchAll("SELECT * FROM categories");
            // Конец вывода данных для Сайдбара

            require '../src/views/layouts/'.$this->layout.'.php';
        } else {
            self::errorCode();
        }
    }

    static function errorCode($code = 404) {
        http_response_code($code);

        if (file_exists($path = '../src/views/errors/'.$code.'.php')) {
            require $path;
        }
        exit();
    }


    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function transitionMessage($status, $message, $transitionUrl) {
        exit(json_encode(['status' => $status, 'message' => $message, 'transitionUrl' => $transitionUrl]));
    }

    public function location($url) {
        exit(json_encode(['url' => $url]));
    }
}