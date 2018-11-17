<?php
  // variables de sesión
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrador de Inventario/ventas</title>

  <!-- favicon -->
  <link rel="icon" href="">

  <!--=====================================
  plugins de css
  ======================================-->
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="view/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="view/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="view/dist/css/skins/_all-skins.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- DataTables -->
  <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- DataTables: adición para responsive -->
  <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!--=====================================
  plugins de javascript
  ======================================-->

  <!-- jQuery 3 -->
  <script src="view/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="view/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="view/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="view/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="view/dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="view/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- DataTables: adición para responsive -->
  <script src="view/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="view/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <!-- SweetAlert 2 -->
  <script src="view/plugins/sweetalert2/sweetalert2.all.js"></script>
  
</head>
<!--=====================================
Cuerpo del documento
sidebar collapse - contraer el sidebar
======================================-->

<body class="hold-transition skin-blue sidebar-mini login-page">

<?php
  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok")
  {
    // wrapper
    echo '<div class="wrapper">';
    // header
    include "modulos/header.php";

    // menu
    include "modulos/menu.php";

    // contenido
    if(isset($_GET["ruta"]))
    {
      if($_GET["ruta"] == "inicio"      ||
         $_GET["ruta"] == "usuarios"    ||
         $_GET["ruta"] == "categorias"  ||
         $_GET["ruta"] == "productos"   ||
         $_GET["ruta"] == "clientes"    ||
         $_GET["ruta"] == "ventas"      ||
         $_GET["ruta"] == "crear-venta" ||
         $_GET["ruta"] == "reportes"    ||
         $_GET["ruta"] == "salir")
      {
        include "modulos/".$_GET["ruta"].".php"; // se concatena la variable
      }
      else
      {
        include "modulos/404.php";
      }
    }
    else
    {
      include "modulos/inicio.php";
    }
  
    // footer
    include "modulos/footer.php";
    echo '</div>';
  }
  else
  {
    include "modulos/login.php";
  }
?>

<!--=====================================
Funcionamiento AdminLTE
======================================-->
<!-- script comportamiento tree aside y DataTables-->
<script src="view/js/plantilla.js"></script>
<!-- script para tomar foto de usuario en Upload -->
<script src="view/js/usuarios.js"></script>

</body>
</html>
