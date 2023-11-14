<?php

class PerifericoApiModel{

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
        $query = $this->db->prepare ('SELECT * FROM periferico');
        $query->execute();
        $tipos = $query->fetchAll(PDO:: FETCH_OBJ);
        return $tipos;
    }


    function get($id){
        $query = $this->db->prepare ('SELECT * FROM periferico WHERE id = ?' );
        $query->execute([$id]);
        $tipo = $query->fetch(PDO:: FETCH_OBJ);
        return $tipo;
    }


    function delete($id){
        $query = $this->db->prepare('DELETE FROM periferico WHERE id = ?');
        $query->execute([$id]);
    }


    function insertar($marca, $precio, $color,$id_periferico){
        $query = $this->db->prepare ('INSERT INTO periferico (marca, precio, color,id_periferico) VALUES (?,?,?,?)');
        $query->execute([$marca, $precio, $color,$id_periferico]);

        return $this->db->lastInsertId();
    }


    function actualizar($marca,$precio,$color,$id_periferico,$id){
        $query = $this->db->prepare('UPDATE periferico SET marca = ?, precio = ? , color = ? , id_periferico = ? WHERE id = ? ');
        $query->execute([$marca,$precio,$color,$id_periferico,$id]);
    }


    
    function order($sort = null, $order = null){
        $query = $this->db->prepare("SELECT * FROM periferico ORDER BY $sort $order");
        $query->execute();
        $periferico = $query->fetchAll(PDO::FETCH_OBJ);
        return $periferico;
    }




    public function getMarcasFiltradas($parametros){
        $query = $this->db->prepare("SELECT * FROM periferico WHERE marca = ?");
        $query->execute([($parametros['marca'])]);
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);

        return $marcas;
    }

}