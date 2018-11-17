<?php

    class Conexion
    {
        static public function conectar()
        {
            // metodo de conexion: direccion bbdd, nombre bbdd, user, pass
            $link = new PDO("mysql:host=localhost;dbname=pos_ejemplo", "root", "");

            $link -> exec("set names utf8");
            return $link;
        }
    }