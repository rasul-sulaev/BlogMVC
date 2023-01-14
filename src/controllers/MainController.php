<?php

namespace App\controllers;

use App\core\Controller;
use App\core\View;
use App\lib\Db;

class MainController extends Controller {
    public function __construct($route) {
        parent::__construct($route);

        if(!empty($_POST) && isset($_POST['query'])) {
            if (!$this->model->searchValidate($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->location("/search/query={$_POST['query']}");
        }
    }


    public function indexAction() {
        $vars = [
            'posts' => $this->model->getPostsPublished(),
            'top_posts' => $this->model->getTopPosts(),
        ];

        $this->view->render('Главная', $vars);
    }

    public function aboutAction () {
        $this->view->render('Страница О нас');
    }

    public function contactsAction() {
        if(!empty($_POST) && isset($_POST['message'])) {
            if (!$this->model->contactValidate($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            mail('mr.sylaev@gmail.com', "Сообщение из блога от {$_POST['name']}", $_POST['message']);
            $this->view->message('Успешно!', 'Сообщение отправлено Администратору!');
        }

        $this->view->render('Страница Контакты');
    }

    public function postAction() {
        $post = $this->model->getPost($this->route['id']);

        if (!$post) {
            View::errorCode();
        }

        if(!empty($_POST) && isset($_POST['comment'])) {
            if (!$this->model->commentValidate($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->model->sendComment($_POST, $this->route['id']);
            $this->view->transitionMessage('Спасибо!', 'Комментарий отправлен на модерацию...', $_SERVER['REQUEST_URI']);
        }

        $vars = [
            'post' => $post[0],
            'comments' => $this->model->getPostComments($this->route['id'])
        ];

        $this->view->render($post[0]['title'], $vars);
    }

    public function categoryAction() {
        $category = $this->model->getCategory($this->route[1]);

        if (!$category) {
            View::errorCode();
        }

        $vars = [
            'category' => $category[0],
            'posts' => $this->model->getCategoryPosts($this->route[1])
        ];

        $this->view->render('Страница категории', $vars);
    }

    public function searchAction() {
        $vars = [
            'query' => $this->route[1],
            'posts' => $this->model->getSearchResults($this->route[1])
        ];

        $this->view->render('Страница поиска', $vars);
    }
}