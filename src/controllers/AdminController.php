<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Router;
use App\core\View;

class AdminController extends Controller {
    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    public function loginAction() {
        if (isset($_SESSION['admin'])) {
            Router::redirect('/admin');
        }
        if (!empty($_POST)) {
            if (!$this->model->loginValidate($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->location('/admin');
         }

        $this->view->render('Страница входа в Админ панель');
    }

    public function logoutAction() {
        unset($_SESSION['admin']);
        Router::redirect('/');
    }

    public function indexAction() {
        if (!isset($_SESSION['admin'])) {
            Router::redirect('/admin/login');
        }

        $this->view->render('Админка');
    }

    public function postsAction() {
        if (!empty($_POST['change-post-status'])) {
            if (!$this->model->changePostStatus($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
        } elseif (!empty($_POST['change-top-post'])) {
            if (!$this->model->changeTopPost($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
        }

        $vars = [
            'posts' => $this->model->getPosts()
        ];

        $this->view->render('Посты', $vars);
    }

    public function postAddAction() {

        $vars = [
            'categories' => $this->model->getCategories()
        ];

        if(!empty($_POST['post-add'])) {
            if (!$this->model->postAddValidate($_POST, $_FILES)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->message('Отлично!', 'Пост добавлен!');
        }

        $this->view->render('Добавление поста', $vars);
    }

    public function postEditAction() {
        if (!empty($_POST['post-edit'])) {
            if (!$this->model->postEdit($this->route['id'], $_POST, $_FILES)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->message('Отлично!', 'Пост обнавлен!');
        }

        if (!$post = $this->model->getPost($this->route['id'])) {
            View::errorCode();
        }

        $vars = [
            'post_title' => $post['title'],
            'text' => $post['text'],
            'img' => $post['img'],
            'categories' => $this->model->getCategories(),
            'category' => $post['id_category'],
            'status' => $post['status'],
        ];

        $this->view->render('Изменение поста', $vars);
    }

    public function postDeleteAction() {
        if (!$this->model->postDeleteValidate($this->route['id'])) {
            View::errorCode();
        }
        Router::redirect('/admin/posts');
    }

    public function categoriesAction() {
        $vars = [
            'categories' => $this->model->getCategories()
        ];

        $this->view->render('Список категорий', $vars);
    }

    public function categoryAddAction() {
        if (!empty($_POST['category-add'])) {
            if (!$this->model->categoryAddValidate($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->message('Отлично!', 'Категория создана!');
        }
        $this->view->render('Добавление категории');
    }

    public function categoryEditAction() {
        if(!empty($_POST['category-edit'])) {
            if (!$this->model->categoryEdit($this->route['id'], $_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->message('Отлично!', 'Категория обновлена!');
        }

        if (!$category = $this->model->getCategory($this->route['id'])) {
            View::errorCode();
        }

        $vars = [
            'name' => $category['name'],
            'link' => $category['link'],
            'description' => $category['description']
        ];

        $this->view->render('Редактирование категории', $vars);

    }

    public function categoryDeleteAction() {
        if (!$this->model->categoryDelete($this->route['id'])) {
            View::errorCode();
        }
        Router::redirect('/admin/categories');
    }

    public function usersAction() {
        if (!empty($_POST['change-user-status'])) {
            if (!$this->model->changeUserStatus($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
        } elseif (!empty($_POST['change-user-role'])) {
            if (!$this->model->changeUserRole($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
        }


        $vars = [
            'users' => $this->model->getUsers()
        ];

        $this->view->render('Список пользователей', $vars);
    }

    public function userAddAction() {
        if (!empty($_POST['user-add'])) {
            if (!$this->model->userAddValidate($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->message('Отлично!', 'Пользователь добавлен!');
        }

        $this->view->render('Добавление пользователя');
    }

    public function userEditAction() {
        if (!empty($_POST['user-edit'])) {
            if (!$this->model->userEdit($this->route['id'], $_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->message('Отлично!', 'Пользователь обновлен!');
        }

        if (!$user = $this->model->getUser($this->route['id'])) {
            View::errorCode();
        }

        $vars = [
            'username' => $user['username'],
            'login' => $user['login'],
            'email' => $user['email'],
            'createdAt' => $user['createdAt'],
            'role' => $user['role'],
            'status' => $user['status']
        ];

        $this->view->render('Редактирование пользователя', $vars);
    }

    public function userDeleteAction() {
        if (!$this->model->userDelete($this->route['id'])) {
            View::errorCode();
        }
        Router::redirect('/admin/users');
    }

    public function commentsAction() {
        if (!empty($_POST['change-comment-status'])) {
            if (!$this->model->changeCommentStatus($_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
        }

        $vars = [
            'comments' => $this->model->getComments()
        ];

        $this->view->render('Список комментариев', $vars);
    }

    public function commentEditAction() {
        if (!empty($_POST['comment-edit'])) {
            if (!$this->model->commentEdit($this->route['id'], $_POST)) {
                $this->view->message('Ошибка!', $this->model->error);
            }
            $this->view->message('Отлично!', 'Комментарий обновлен!');
        }

        if (!$comment = $this->model->getComment($this->route['id'])) {
            View::errorCode();
        }

        $vars = [
            'comment' => $comment['comment'],
            'status' => $comment['status']
        ];

        $this->view->render('Редактирование комментария', $vars);
    }

    public function commentDeleteAction() {
        if (!$this->model->commentDelete($this->route['id'])) {
            View::errorCode();
        }
        Router::redirect('/admin/comments');
    }
}