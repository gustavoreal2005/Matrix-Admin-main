<?php
class Conexion{
    public static function conectar(){
        $link = new PDO("mysql:host=localhost;dbname=matrix-admin","root","");
        $link->exec("set names utf8");
        return $link;
    }
}