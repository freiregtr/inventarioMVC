<?php

class ControllerUsuarios
{    
    // metodo para ingreso de usuario
    // nombreUsuario, passUsuario (clave - valor)
    static public function controllerIngresoUsuario()
    {
        if(isset($_POST["nombreUsuario"]))
        {
            // validacion expresion regular
            if(preg_match('/^[a-zA-z0-9]+$/', $_POST["nombreUsuario"]) &&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST["passUsuario"]))
            {
                // contraseña en sha256
                $password = hash('sha512', $_POST["passUsuario"]);

                $tablaBD = "usuarios";
                // usuario_tipo ya que ese es el nombre de la columna en la BBDD
                $columnaBD = "usuario_tipo";
                $valorBD = $_POST["nombreUsuario"];
                $respuesta = ModelUsuarios::modelMostrarUsuarios($tablaBD, $columnaBD, $valorBD); 
                // validacion user + password
                if($respuesta["usuario_tipo"] == $_POST["nombreUsuario"] && $respuesta["password_usuario"] ==
                  $password)
                {
                   // clave valor para el inicio de sesión
                   $_SESSION["iniciarSesion"] = "ok";
                   $_SESSION["id"] = $respuesta["id_usuario"];
                   $_SESSION["nombre"] = $respuesta["nombre_usuario"];
                   $_SESSION["usuario"] = $respuesta["usuario_tipo"];
                   $_SESSION["foto"] = $respuesta["foto_usuario"];
                   $_SESSION["perfil"] = $respuesta["perfil_usuario"];
                   $_SESSION["ultimo_log"] = $respuesta["ultimo_log_usuario"];

                   // refrescar e irse a inicio
                   echo '<script> window.location = "inicio"; </script>';
                }
                else
                {
                   echo '<br><div class="alert alert-danger">Error al ingresar, vuelva a intentarlo</div>';
                }
            }
        }
    }

    // metodo para registro de usuario
    static public function controllerRegistrarUsuario()
    {
        if(isset($_POST["nuevoUsuario"]))
        {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoPass"]))
            {
                // ruta del imagen vacía por defecto
                $ruta = "";

                // validar imagen. "nuevaFoto" es el name del atributo
                // [tmp_name] es el nombre del archivo temporal que se guarda en el caché
                if(isset($_FILES["nuevaFoto"]["tmp_name"]))
                { 
                    
                    // redimensionar la foto
                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                    // nuevas medidas
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // directorio donde se guardará el archivo
                    // se concatena la ruta mas el nombre del usuario
                    $directorio = "view/img/usuarios/".$_POST["nuevoUsuario"];
                    // Se crea la carpeta y se dan permisos de creacion, etc
                    mkdir($directorio, 0755);

                    // de acuerdo al archivo, se aplican diferentes metodos
                    // si es jpeg
                    if($_FILES["nuevaFoto"]["type"] == "image/jpeg")
                    {
                        // numero aleatorio, para efectos de nombres
                        $aleatorio = mt_rand(100,999);

                        // variable con ruta de la ubicacion
                        $ruta = "view/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

                        // variable con el origen del archivo
                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

                        // variable para no cambiar el color de la foto una vez editada
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        // metodo que ajusta la imagen al tamaño de 500x500
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        // metodo para guardar la foto, recibe el destino y la ruta
                        imagejpeg($destino, $ruta);
                    }

                    if($_FILES["nuevaFoto"]["type"] == "image/png")
                    {
                        // numero aleatorio, para efectos de nombres
                        $aleatorio = mt_rand(100,999);

                        // variable con ruta de la ubicacion
                        $ruta = "view/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

                        // variable con el origen del archivo
                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

                        // variable para no cambiar el color de la foto una vez editada
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        // metodo que ajusta la imagen al tamaño de 500x500
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        // metodo para guardar la foto, recibe el destino y la ruta
                        imagepng($destino, $ruta);
                    }
                }

                // a que tabla va dirigida la consulta
                $tablaBD = "usuarios";

                // contraseña en sha256
                $encriptado = hash('sha512', $_POST["nuevoPass"]);

                // array que contiene la inserción
                $arrayDatos = array("nombre" => $_POST["nuevoNombre"],
                               "usuario" => $_POST["nuevoUsuario"],
                               "password" => $encriptado,
                               "perfil" => $_POST["nuevoPerfil"],
                               "ruta" => $ruta
                );

                // envío al modelo para insertarlo a la bbdd y obtención de respuesta
                $respuesta = ModelUsuarios::modelRegistrarUsuario($tablaBD, $arrayDatos);
                echo "<script>console.log('PHP: ".$respuesta."');</script>";

                if($respuesta == "ok")
                {
                    // mensaje de error SweetAlert2
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El usuario ha sido ingresado de forma correcta",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result)=>{
                            if(result.value)
                            {
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                }
            }
            else
            {
                // mensaje de error SweetAlert2
                echo '<script>
                    swal({
                            title: "Error al ingresar el usuario",
                            text: "La password no puede tener caracteres.",
                            type: "error",
                            confirmButtonText: "cerrar"
                        });
                </script>';
            }
        }
    }

    // metodo para mostrar el usuario 
    // se conectará con el modelo y el metodo modelMostrarUsuarios()
    static public function controllerMostrarUsuarios($columnaBD, $valorBD)
    {
        // donde va dirigida la consulta SQL
        $tablaBD = "usuarios";
        $respuesta = ModelUsuarios::modelMostrarUsuarios($tablaBD, $columnaBD, $valorBD);

        return $respuesta;
    }

    // metodo para editar el usuario 
    public function controllerEditarUsuario()
    {
        if(isset($_POST["editarUsuario"]))
        {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]))
            {
                $ruta = $_POST["hiddenPic"];

                // validar imagen. "nuevaFoto" es el name del atributo
                // [tmp_name] es el nombre del archivo temporal que se guarda en el caché
                if(isset($_FILES["editarFoto"]["tmp_name"]))
                { 
                    // redimensionar la foto
                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                    // nuevas medidas
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // directorio donde se guardará el archivo
                    // se concatena la ruta mas el nombre del usuario
                    $directorio = "view/img/usuarios/".$_POST["editarUsuario"];

                    // se verifica si existe una img en la bbdd, si existe se borra
                    if(!empty($_POST["fotoActual"]))
                    {
                        // borrar la foto
                        unlink($_POST["fotoActual"]);
                    }
                    else
                    {
                        // Se crea la carpeta y se dan permisos de creacion, etc
                        mkdir($directorio, 0755);
                    }

                    // de acuerdo al archivo, se aplican diferentes metodos
                    // si es jpeg
                    if($_FILES["editarFoto"]["type"] == "image/jpeg")
                    {
                        // numero aleatorio, para efectos de nombres
                        $aleatorio = mt_rand(100,999);

                        // variable con ruta de la ubicacion
                        $ruta = "view/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

                        // variable con el origen del archivo
                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

                        // variable para no cambiar el color de la foto una vez editada
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        // metodo que ajusta la imagen al tamaño de 500x500
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        // metodo para guardar la foto, recibe el destino y la ruta
                        imagejpeg($destino, $ruta);
                    }

                    if($_FILES["editarFoto"]["type"] == "image/png")
                    {
                        // numero aleatorio, para efectos de nombres
                        $aleatorio = mt_rand(100,999);

                        // variable con ruta de la ubicacion
                        $ruta = "view/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

                        // variable con el origen del archivo
                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

                        // variable para no cambiar el color de la foto una vez editada
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        // metodo que ajusta la imagen al tamaño de 500x500
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        // metodo para guardar la foto, recibe el destino y la ruta
                        imagepng($destino, $ruta);
                    }
                }

                $tablaBD = "usuarios";
                if($_POST["editarPassword"])
                {

                }
            }
        }

    }
}
