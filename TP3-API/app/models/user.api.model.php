<?php

class UserApiModel{


    private $db;

    function __construct()
    {
        $this->db = $this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
        return $db;
    }


    public function getUsuario($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }



}