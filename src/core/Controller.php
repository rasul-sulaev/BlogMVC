<?php

namespace App\core;

use App\core\View;

abstract class Controller {
    protected $route = [];
    protected $view;
    protected $model;
    protected $acl;

    public function __construct($route) {
        $this->route = $route;

        if (!$this->checkAcl()) {
             View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name) {
        if (class_exists($path = 'App\models\\'.ucfirst($name))) {
            return new $path;
        }
    }

    public function checkAcl() {
        if (file_exists($path = '..\src\acl\\'.$this->route['controller'].'.php')) {
            $this->acl = require $path;

            if ($this->actionIsAcl('all')) {
                return true;
            } elseif ($this->actionIsAcl('guest') && !isset($_SESSION['user']['id'])) {
                return true;
            } elseif ($this->actionIsAcl('auth') && (isset($_SESSION['user']['id']) || isset($_SESSION['admin']))) {
                return true;
            } elseif ($this->actionIsAcl('admin') && isset($_SESSION['admin'])) {
                return true;
            }
            return false;
        }
    }

    public function actionIsAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}