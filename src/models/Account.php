<?php

namespace App\Models;

use App\core\Model;

class Account extends Model {
    public $error;

    public function loginAccount($post) {
        if (!$user = $this->db->fetchAll("SELECT * FROM users WHERE login = :login AND role = 'user'", ['login' => $post['login']])) {
            $this->error = 'Логин или пароль не верный!';
            return false;
        } elseif (!password_verify($post['password'], $user[0]['password'])) {
            $this->error = 'Логин или пароль не верный!';
            return false;
        } elseif ($user[0]['status'] === 'ban') {
            $this->error = 'Пользователь заблокирован!';
            return false;
        } elseif ($user[0]['status'] === 'deleted') {
            $this->error = 'Пользователь удален!';
            return false;
        }

        unset($_SESSION['admin']);
        unset($user[0]['password']);
        $_SESSION['user'] = $user[0];
        return true;
    }

    public function registrationAccount($post) {
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
        }

        $params = [
            'username' => $post['username'],
            'login'    => $post['login'],
            'email'    => $post['email'],
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'user',
            'status'   => 'active'
        ];

        $this->db->query("INSERT INTO users (username, email, login, password, `role`, status) VALUES (:username, :email, :login, :password, :role, :status)", $params);
        return true;
    }
}