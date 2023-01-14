<?php

namespace App\lib;

use PDO;

class Db {
    protected $db;

    public function __construct() {
        $config = require '..\src\config\db.php';
        $this->db = new PDO("mysql:host=${config['host']};dbname=${config['db']};", $config['user'], $config['password']);
    }

    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $type = is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue(":$key", $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function fetchAll($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchColumn($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
}