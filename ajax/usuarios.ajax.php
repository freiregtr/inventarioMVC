<?php
    // la solicitud por parte de javascript se considera una nueva solicitud al 
    require_once "../controller/usuarios.controller.php";
    require_once "../model/usuarios.model.php";

    class AjaxUsuarios{
        public $idUsuario;
        public function ajaxEditarUsuario(){

            // nombre de la columna de la tabla usuarios
            $columnaBD = "id_usuario";

            // valor de la columna de la tabla usuarios. idUsuarios ya viene por POST
            $valorBD = $this->idUsuario;

            $respuesta = ControllerUsuarios::controllerMostrarUsuarios($columnaBD, $valorBD);
            
            // respuesta convertida a formato json. encode = convertir
            echo json_encode($respuesta);
        }
    }

    // se valida si viene información en la variable post idUsuario para ejecutar el metodo de editar usuario
    if(isset($_POST["idUsuario"]))
    {
        $editar = new AjaxUsuarios();
        $editar -> idUsuario = $_POST["idUsuario"];
        $editar -> ajaxEditarUsuario();
    }
?>