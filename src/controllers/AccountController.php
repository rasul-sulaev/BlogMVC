<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Router;

class AccountController extends Controller {
    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'account';
    }

    public function loginAction() {
        if (isset($_SESSION['user'])) {
            Router::redirect('/');
        }

        if (!empty($_POST['account-login'])) {
            if (!$this->model->loginAccount($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->location('/');
        }

        $this->view->render('Страница входа');
    }

    public function registrationAction() {
        if (isset($_SESSION['user'])) {
            Router::redirect('/');
        }

        if (!empty($_POST['account-registration'])) {
            if (!$this->model->registrationAccount($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->transitionMessage('Отлично!', 'Вы успешно зарегистрировались!', '/');
        }

        $this->view->render('Страница регистрации');
    }

    public function logoutAction() {
        unset($_SESSION['user']);
        Router::redirect('/');
    }
}