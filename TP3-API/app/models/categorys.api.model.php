<?php

class caterogysApiModel{

    private $db;

    function __construct()
    {
        $this->db = $this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
        return $db;
    }

    function getAll(){
        $query = $this->db->prepare ('SELECT * FROM tipo_periferico');
        $query->execute();
        $tipos = $query->fetchAll(PDO:: FETCH_OBJ);
        return $tipos;
    }


    function get($id){
        $query = $this->db->prepare ('SELECT * FROM tipo_periferico WHERE id = ?' );
        $query->execute([$id]);
        $tipo = $query->fetch(PDO:: FETCH_OBJ);
        return $tipo;
    }


    function delete($id){
        $query = $this->db->prepare('DELETE FROM tipo_periferico WHERE id = ?');
        $query->execute([$id]);
    }


    function insertar($id_periferico){
        $query = $this->db->prepare ('INSERT INTO tipo_periferico (id_periferico) VALUES (?)');
        $query->execute([$id_periferico]);

        return $this->db->lastInsertId();
    }


    function actualizar($id_periferico,$id){
        $query = $this->db->prepare('UPDATE tipo_periferico SET id_periferico = ? WHERE id = ? ');
        $query->execute([$id_periferico,$id]);
    }


    
    function order($sort = null, $order = null){
        $query = $this->db->prepare("SELECT * FROM tipo_periferico ORDER BY $sort $order");
        $query->execute();
        $periferico = $query->fetchAll(PDO::FETCH_OBJ);
        return $periferico;
    }




    public function getCategorysFiltradas($parametros){
        $query = $this->db->prepare("SELECT * FROM tipo_periferico WHERE id_periferico = ?");
        $query->execute([($parametros['id_periferico'])]);
        $categorys = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorys;
    }

}