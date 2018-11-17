// function para subir la foto del usuario
$(".nuevaFoto").change(function(){
    // la variable imagen sería la foto tomada desde el input
    var imagen = this.files[0];

    // validacion jpg o png
    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
    {
        //limpiar la variable
        $(".nuevaFoto").val("");

        // mensaje de error
        swal({
            title: "Error al subir la imagen",
            text: "la imagen debe estar en formato JPG o PNG",
            type: "error",
            confirmButtonText: "cerrar"
        });
    }else if(imagen["size"] > 2000000){
        // 2.000.000 -> 2 mb

        //limpiar la variable
        $(".nuevaFoto").val("");

        // mensaje de error
        swal({
            title: "Error al subir la imagen",
            text: "la imagen no debe pesar mas de 2 MB",
            type: "error",
            confirmButtonText: "cerrar"
        });
    }
    else
    {
        // clase para hacer lectura de archivo
        var datosImagen = new FileReader;
        // leer como archivo url
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function(event){
            // ruta para la imagen
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen)
        })
    }
})

// function para editar usuario
/*

*/
$(".btnEditarUsuario").click(function(){
    var idUsuario = $(this).attr("idUsuario");
    //console.log("idUsuario", idUsuario);

    //envío mediante POST
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            
            //Modificación del modal Editar Usuario

            $("#editarNombre").val(respuesta["nombre_usuario"]);
            $("#editarUsuario").val(respuesta["usuario_tipo"]);
            $("#editarPerfil").html(respuesta["perfil_usuario"]);
            
            //hp = hidden password
            $("#hp").val(respuesta["password_usuario"]);

            //hip = hidden picture
            $("#hip").val(respuesta["foto_usuario"]);

            if(respuesta["foto_usuario"] != "")
            {
                $(".previsualizar").attr("src", respuesta["foto_usuario"]);
            }
        }
    });
})