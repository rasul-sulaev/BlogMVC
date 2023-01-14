<?php

namespace App\Models;

use App\core\Model;

class Admin extends Model {
    public $error;

    public function uploadFile($file, $dir) {
        $upload_img_name = time()."_{$file['name']}";
        $destination = $dir.$upload_img_name;


        $result = move_uploaded_file($file['tmp_name'], $destination);
        if (!$result) {
            $this->error = "Возника ошибка при загрузке картинки!";
            return false;
        }
        return $upload_img_name;
    }



    /** Login to Admin Panel **/
    public function loginValidate($post) {
        if (!$admin = $this->db->fetchAll("SELECT * FROM users WHERE login = :login AND role = 'admin'", ['login' => $post['login']])) {
            $this->error = 'Логин или пароль не верный!';
            return false;
        } elseif (!password_verify($post['password'], $admin[0]['password'])) {
            $this->error = 'Логин или пароль не верный!';
            return false;
        } elseif ($admin[0]['status'] === 'ban') {
            $this->error = 'Администратор заблокирован!';
            return false;
        } elseif ($admin[0]['status'] === 'deleted') {
            $this->error = 'Администратор удален!';
            return false;
        }

        unset($_SESSION['user']);
        unset($admin[0]['password']);
        $_SESSION['admin'] = $admin[0];
        return true;
    }



    /** Posts **/
    public function getPosts() {
        return $this->db->fetchAll("
            SELECT
            p.*,
            u.username AS author,
            c.name AS category
            FROM posts AS p
            JOIN users AS u ON u.id = p.id_user
            JOIN categories AS c ON c.id = p.id_category
            ORDER BY p.id DESC
        ");
    }

    public function getPost($id) {
        if (!$posts = $this->db->fetchAll("SELECT * FROM posts WHERE id = :id", ['id' => $id])) {
            return false;
        }
        return $posts[0];
    }

    public function changePostStatus($post) {
        if (!$this->db->fetchColumn('SELECT id FROM posts WHERE id = :id', ['id' => $post['id']])) {
            return false;
        }

        $params = [
            'id' => $post['id'],
            'status' => $post['status']
        ];

        $this->db->query("UPDATE posts SET status = :status WHERE id = :id", $params);
        return true;
    }

    public function changeTopPost($post) {
        if (!$this->db->fetchColumn('SELECT id FROM posts WHERE id = :id', ['id' => $post['id']])) {
            return false;
        }

        $params = [
            'id' => $post['id'],
            'top_post' => (isset($post['top_post']) && $post['top_post'] === 1) || !isset($post['top_post']) ? 0 : 1
        ];

        $this->db->query('UPDATE posts SET top_post = :top_post WHERE id = :id', $params);
        return true;
    }

    public function postAddValidate($post, $file) {
        $category = isset($post['category']) ? htmlspecialchars(trim($post['category'])) : 0;
        $img = $file['img'];
        $img_name_to_server = '';

        if (mb_strlen($post['title']) < 5) {
            $this->error = 'Название постав должно содержать не менее 5 символов!';
            return false;
        } elseif ($this->db->fetchColumn("SELECT title FROM posts WHERE title = :title", ['title' => $post['title']])) {
            $this->error = 'Пост с указанным названием уже существует!';
            return false;
        } elseif (mb_strlen($post['text']) < 100) {
            $this->error = 'Текст поста должен содержать не менее 100 символов!';
            return false;
        } elseif ($post['status'] === '') {
            $this->error = 'Выберите статус публикации поста!';
            return false;
        } elseif ($category == 0 || $category == '') {
            $this->error = 'Выберите категорию поста!';
            return false;
        } elseif ($img) {
            if ($img['name'] === '') {
                $this->error = 'Добавьте картинку для поста!';
                return false;
            }
            elseif (strpos($img['type'], 'image') !== 0) {
                $this->error = 'Файл должен быть картинкой!';
                return false;
            }
            $img_name_to_server = $this->uploadFile($img, '../uploads/img/posts/');
        }

        $params = [
            'title' => $post['title'],
            'text' => $post['text'],
            'status' => $post['status'],
            'img' => $img_name_to_server,
            'id_user' => $_SESSION['admin']['id'],
            'id_category' => $post['category'],
            'top_post' => 0
        ];

        $this->db->query("INSERT INTO posts (title, text, status, id_category, img, top_post, id_user) VALUES (:title, :text, :status, :id_category, :img, :top_post, :id_user)", $params);
        return true;
    }

    public function postEdit($id, $post, $file) {
        $category = isset($post['category']) ? htmlspecialchars(trim($post['category'])) : 0;
        $img = $file['img'];
        $img_name_to_server = '';

        if (mb_strlen($post['title']) < 5) {
            $this->error = 'Название постав должно содержать не менее 5 символов!';
            return false;
        }  elseif (mb_strlen($post['text']) < 100) {
            $this->error = 'Текст поста должен содержать не менее 100 символов!';
            return false;
        } elseif ($post['status'] === '') {
            $this->error = 'Выберите статус публикации поста!';
            return false;
        } elseif ($category == 0 || $category == '') {
            $this->error = 'Выберите категорию поста!';
            return false;
        }

        elseif (!empty($img['name'])) {
//        elseif ($img['name'] !== '') {
            $img_name_to_server = $this->uploadFile($img, '../uploads/img/posts/');
        }

        $params = [
            'id' => $id,
            'title' => $post['title'],
            'text' => $post['text'],
            'status' => $post['status'],
            'img' => !empty($img_name_to_server) ? $img_name_to_server : $this->getPost($id)['img'],
            'id_category' => $post['category'],
        ];

        $this->db->query("UPDATE posts SET title = :title, text = :text, status = :status, id_category = :id_category, img = :img WHERE id = :id", $params);
        return true;
    }

    public function postDeleteValidate($id) {
        if (!$post = $this->db->fetchAll('SELECT * FROM posts WHERE id = :id', ['id' => $id])) {
            return false;
        }

        $this->db->query('DELETE FROM posts WHERE id = :id', ['id' => $id]);

        if (file_exists($img = "../uploads/img/posts/{$post[0]['img']}")) {
            unlink($img);
        }
        return true;
    }



    /** Category **/
    public function getCategory($id) {
        if (!$category = $this->db->fetchAll("SELECT * FROM categories WHERE id = :id", ['id' => $id])) {
            return false;
        }
        return $category[0];
    }

    public function getCategories() {
        return $this->db->fetchAll("SELECT * FROM categories");
    }

    public function categoryAddValidate($post) {
        if (mb_strlen($post['name']) < 3) {
            $this->error = 'Название категории должно содержать не менее 3х символов!';
            return false;
        } elseif ($this->db->fetchColumn("SELECT link FROM categories WHERE `link` = :link", ['link' => $post['link']])) {
            $this->error = 'Категория с указанной ссылкой уже существует!';
            return false;
        } elseif ($this->db->fetchColumn("SELECT name FROM categories WHERE `name` = :name", ['name' => $post['name']])) {
            $this->error = 'Категория с указанным названием уже существует!';
            return false;
        }

        $params = [
            'link' => $post['link'],
            'name' => $post['name'],
            'description' => $post['description']
        ];

        $this->db->query("INSERT INTO categories (link, name, description) VALUES (:link, :name, :description)", $params);
        return true;
    }

    public function categoryEdit($id, $post) {
        if (mb_strlen($post['name']) < 3) {
            $this->error = 'Название категории должно содержать не менее 3х символов!';
            return false;
        } elseif (mb_strlen($post['link']) < 3) {
            $this->error = 'Ссылка категории должно содержать не менее 3х символов!';
            return false;
        }

        $params = [
            'id' => $id,
            'name' => $post['name'],
            'link' => $post['link'],
            'description' => $post['description']
        ];

        $this->db->fetchAll("UPDATE categories SET name = :name, link = :link, description = :description WHERE id = :id", $params);
        return true;
    }

    public function categoryDelete($id) {
        if (!$this->db->fetchColumn('SELECT * FROM categories WHERE id = :id', ['id' => $id])) {
            return false;
        }

        $this->db->query('DELETE FROM categories WHERE id = :id', ['id' => $id]);
        return true;
    }



    /** Users **/
    public function getUsers() {
        return $this->db->fetchAll("SELECT * FROM users");
    }

    public function getUser($id) {
        if (!$users = $this->db->fetchAll("SELECT * FROM users WHERE id = :id", ['id' => $id])) {
            return false;
        }
        return $users[0];
    }

    public function changeUserStatus($post) {
        if (!$this->db->fetchColumn('SELECT id FROM users WHERE id = :id', ['id' => $post['id']])) {
            return false;
        }

        $params = [
            'id' => $post['id'],
            'status' => $post['status']
        ];

        $this->db->query("UPDATE users SET status = :status WHERE id = :id", $params);
        return true;
    }

    public function changeUserRole($post) {
        if (!$this->db->fetchColumn('SELECT id FROM users WHERE id = :id', ['id' => $post['id']])) {
            return false;
        }

        $params = [
            'id' => $post['id'],
            'role' => $post['role']
        ];

        $this->db->query('UPDATE users SET role = :role WHERE id = :id', $params);
        return true;
    }

    public function userAddValidate($post) {
        $role = isset($post['role']) ? htmlspecialchars(trim($post['role'])) : 0;
        $password  = htmlspecialchars(trim($post['password']));
        $password2 = htmlspecialchars(trim($post['password2']));

        if (mb_strlen($post['username']) < 3) {
            $this->error = "ФИО должно содержать не менее 3х символов!";
            return false;
        } elseif (mb_strlen($post['login']) < 3) {
            $this->error = "Логин должен содержать не менее 3х символов!";
            return false;
        } elseif ($this->db->fetchColumn("SELECT login FROM users WHERE login = :login", ['login' => $post['login']])) {
            $this->error = "Указанный логин занят!";
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = "Введен некорректный адрес почты!";
            return false;
        } elseif ($this->db->fetchColumn("SELECT email FROM users WHERE email = :email", ['email' => $post['email']])) {
            $this->error = "Указанная почта занята!";
            return false;
        } elseif (mb_strlen($password) < 8) {
            $this->error = "Пароль должен содержать не менее 8 символов!";
            return false;
        } elseif ($password !== $password2) {
            $this->error = "Пароли не совпадают!";
            return false;
        } elseif ($role === 0) {
            $this->error = "Выберите роль пользователя!";
            return false;
        } elseif (!in_array($role, ['user', 'admin'])) {
            $this->error = "Некорректный роль пользователя!";
            return false;
        }

        $params = [
            'username' => $post['username'],
            'email'    => $post['email'],
            'login'    => $post['login'],
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $role
        ];

        $this->db->query("INSERT INTO users (username, email, login, password, `role`) VALUES (:username, :email, :login, :password, :role)", $params);
        return true;
    }

    public function userEdit($id, $post) {
        $role = isset($post['role']) ? htmlspecialchars(trim($post['role'])) : 'user';
        $password = htmlspecialchars(trim($post['password']));
        $password2 = htmlspecialchars(trim($post['password2']));

        if (mb_strlen($post['username']) < 3) {
            $this->error = "ФИО должно содержать не менее 3х символов!";
            return false;
        } elseif (mb_strlen($post['login']) < 3) {
            $this->error = "Логин должен содержать не менее 3х символов!";
            return false;
        } elseif ($this->db->fetchColumn("SELECT login FROM users WHERE login = :login AND id != :id", ['login' => $post['login'], 'id' => $id])) {
            $this->error = "Указанный логин занят другим пользователем!";
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = "Введен некорректный адрес почты!";
            return false;
        } elseif ($this->db->fetchColumn("SELECT email FROM users WHERE email = :email AND id != :id", ['email' => $post['email'], 'id' => $id])) {
            $this->error = "Указанная почта занята другим пользователем!";
            return false;
        }
        elseif (mb_strlen($password) < 8) {
            $this->error = "Пароль должен содержать не менее 8 символов!";
            return false;
        } elseif ($password !== $password2) {
            $this->error = "Пароли не совпадают!";
            return false;
        } elseif ($role === 0) {
            $this->error = "Выберите роль пользователя!";
            return false;
        } elseif (!in_array($role, ['user', 'admin'])) {
            $this->error = "Некорректный роль пользователя!";
            return false;
        }

        $params = [
            'id' => $id,
            'username' => $post['username'],
            'email' => $post['email'],
            'login' => $post['login'],
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
            'status' => $post['status']
        ];

        $this->db->query("UPDATE users SET username = :username, email = :email, login = :login, password = :password, role = :role, status = :status WHERE id = :id", $params);
        return true;
    }

    public function userDelete($id) {
        if (!$this->db->fetchColumn('SELECT id FROM users WHERE id = :id', ['id' => $id])) {
            return false;
        }

        $this->db->query('DELETE FROM users WHERE id = :id', ['id' => $id]);
        return true;
    }



    /** Comments **/
    public function getComments() {
        return $this->db->fetchAll("
            SELECT
            c.*,
            u.username,
            u.email AS user_email,
            p.id AS id_post
            FROM comments AS c
            JOIN users AS u ON u.id = c.id_user
            JOIN posts AS p ON p.id = c.id_post
            ORDER BY c.id DESC");
    }

    public function changeCommentStatus($post) {
        if (!$this->db->fetchColumn('SELECT id FROM comments WHERE id = :id', ['id' => $post['id']])) {
            return false;
        }

        $params = [
            'id' => $post['id'],
            'status' => (isset($post['status']) && $post['status'] === 1) || !isset($post['status']) ? 0 : 1
        ];

        $this->db->query('UPDATE comments SET status = :status WHERE id = :id', $params);
        return true;
    }

    public function getComment($id) {
        if (!$comment = $this->db->fetchAll("SELECT * FROM comments WHERE id = :id", ['id' => $id])) {
            return false;
        }
        return $comment[0];
    }

    public function commentEdit($id, $post) {
        $params = [
            'id' => $id,
            'comment' => $post['comment']
        ];

        $this->db->query("UPDATE comments SET comment = :comment WHERE id = :id", $params);
        return true;
    }

    public function commentDelete($id) {
        if (!$this->db->fetchColumn('SELECT id FROM comments WHERE id = :id', ['id' => $id])) {
            return false;
        }

        $this->db->query('DELETE FROM comments WHERE id = :id', ['id' => $id]);
        return true;
    }
}