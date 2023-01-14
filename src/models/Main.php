<?php

namespace App\models;

use App\core\Model;

class Main extends Model {
    public $error;

//    public function getPosts() {
//        return $this->db->fetchAll('SELECT * FROM posts AND users');
//    }

    public function getPostsPublished() {
        return $this->db->fetchAll("
            SELECT
            p.*,
            u.username AS author,
            c.link AS category_link,
            c.name AS category_name
            FROM posts AS p
            JOIN users AS u ON u.id = p.id_user
            JOIN categories AS c ON c.id = p.id_category
            WHERE p.status = 'P'
            ORDER BY p.id DESC
        ");
    }

    public function getPost($id) {
        $params = [
            'id' => $id
        ];

        return $this->db->fetchAll("
            SELECT
            p.*,
            u.username AS author,
            c.link AS category_link,
            c.name AS category_name
            FROM posts AS p
            JOIN users AS u ON u.id = p.id_user
            JOIN categories AS c ON c.id = p.id_category
            WHERE p.id = :id AND p.status = 'P'",
        $params);
    }

    public function getPostComments($id_post) {
        $params = [
            'id_post' => $id_post
        ];

        return $this->db->fetchAll("
            SELECT 
            c.*,
            u.username,
            u.role AS user_role
            FROM comments AS c
            JOIN users AS u ON u.id = c.id_user
            WHERE c.id_post = :id_post AND c.status = 1",
        $params);
    }

    public function getTopPosts() {
        return $this->db->fetchAll('SELECT id, title, img FROM posts WHERE top_post = 1 ORDER BY id DESC');
    }

    public function getCategoryPosts($category_link) {
        $params = [
            'category_link' => $category_link
        ];

        return $this->db->fetchAll("
            SELECT 
            p.*,
            u.username AS author,
            c.link AS category_link,
            c.name AS category_name,
            c.description AS category_description
            FROM posts AS p
            JOIN users AS u ON u.id = p.id_user
            JOIN categories AS c ON c.id = p.id_category
            WHERE c.link = :category_link AND p.status = 'P'
        ", $params);
    }

    public function getCategory($link) {
        return $this->db->fetchAll("SELECT * FROM categories WHERE link = :link", ['link' => $link]);
    }

    public function getCategories() {
        return $this->db->fetchAll("SELECT * FROM categories");
    }

    public function getSearchResults($query) {
        $params = [
            'query' => $query
        ];

        return $this->db->fetchAll("
            SELECT
            p.*,
            u.username AS author,
            c.link AS category_link,
            c.name AS category_name
            FROM posts AS p
            JOIN users AS u ON u.id = p.id_user
            JOIN categories AS c ON c.id = p.id_category 
            WHERE title LIKE '%$query%'");
    }

    public function contactValidate($post) {
        if (iconv_strlen($post['name']) < 3 || iconv_strlen($post['name']) > 20) {
            $this->error = 'Имя должно содержать от 3х до 20 символов!';
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'E-mail указан неверно!';
            return false;
        } elseif (iconv_strlen($post['message']) < 10 || iconv_strlen($post['message']) > 500) {
            $this->error = 'Сообщение должно содержать от 10 до 500 символов!';
            return false;
        }
        return true;
    }

    public function searchValidate($post) {
        if (iconv_strlen($post['query']) == 0) {
            $this->error = 'Заполните поле!';
            return false;
        }
        return true;
    }

    public function commentValidate($post) {
        if (iconv_strlen($post['comment']) == 0) {
            $this->error = 'Заполните поле!';
            return false;
        }
        return true;
    }

    public function sendComment($post, $id_post) {
        $params = [
            'id_user' => isset($_SESSION['admin']) ? $_SESSION['admin']['id'] : $_SESSION['user']['id'],
            'id_post' => $id_post,
            'comment' => $post['comment']
        ];

        $this->db->query("INSERT INTO comments (id_user, id_post, comment) VALUES (:id_user, :id_post, :comment)", $params);
    }
}