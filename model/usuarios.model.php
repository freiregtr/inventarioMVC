<?php

require_once "Conexion.php";

class ModelUsuarios
{
    // mostrar usuarios
    // funcion estática segun servidor
    static public function modelMostrarUsuarios($tablaBD, $columnaBD, $valorBD)
    {
        // true: si en la consulta se proporciona la columna - false: no se proporciona
        if($columnaBD != null)
        {
            // statement sentencia SQL (:$columna -> nombre de la columna de la tabla)
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaBD WHERE $columnaBD = :$columnaBD");

            // enlazar a :$item con bindParam, PARAM_STR para asegurarse de recibir string, evita SQLinjection
            $stmt -> bindParam(":".$columnaBD, $valorBD, PDO::PARAM_STR);

            //jecucion de sentencia sql
            $stmt -> execute();
            
            // fetch retorna una sola linea de la tabla 
            return $stmt -> fetch();
        }
        else
        {
            // solo se consulta por la tabla
            $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tablaBD");

            //jecucion de sentencia sql
            $stmt -> execute();
            
            // fetchall todas las filas de la consulta 
            return $stmt -> fetchall();
        }

        // cerrar la conexion en caso de excepcion
        $stmt -> close();
        // dejar el objeto nulo
        $stmt = null;
    }

    // registro de usuarios
    static public function modelRegistrarUsuario($tablaBD, $arrayDatos)
    {
        // se ingresa con : para que se conviertan en parametros
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tablaBD(nombre_usuario, usuario_tipo, password_usuario, perfil_usuario, foto_usuario) 
        VALUES(:nombre, :usuario, :pass, :perfil, :ruta)");
        // PARAM_STR para que los datos se aseguren de venir en string
        $stmt -> bindParam(":nombre", $arrayDatos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario", $arrayDatos["usuario"], PDO::PARAM_STR);
        $stmt -> bindParam(":pass", $arrayDatos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":perfil", $arrayDatos["perfil"], PDO::PARAM_STR);
        $stmt -> bindParam(":ruta", $arrayDatos["ruta"], PDO::PARAM_STR);

        // respuesta
        $mensaje = "";

        // validar la respuesta
        if($stmt -> execute())
        {
            $mensaje = "ok";
            echo "console.log('sucess');";
        }
        else
        {
            $mensaje = "error";
            echo "console.log('not sucess');";
        }

        return $mensaje;
        // cierre de la conexion
        $stmt -> close();
        $stmt = null;
    }
}