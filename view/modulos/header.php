<header class="main-header">
    <!-- Logo -->
    <a href="inicio" class="logo">
        <!-- Logo normal -->
            <span class="logo-lg"><b>David </b>Alt</span>
            <span class="logo-mini"><b>INV</b></span>
        <!-- Logo simplificado -->
    </a>

    <!-- navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- boton de navegacion -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- perfil de usuario -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php 
                    if($_SESSION["foto"] != "")
                    {
                        echo '<img src="'.$_SESSION["foto"].'" alt="" class="user-image">';
                    }
                    else
                    {
                        echo '<img src="view/img/usuarios/anonimo.jpg" alt="" class="user-image">';
                    }
                    ?>
                        
                        <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
                    </a>
                    <!-- dropdown-toggle -->
                    <ul class="dropdown-menu">
                        <li class="user-body">
                            <div class="pull-right">
                                <a href="salir" class="btn btn-default btn-flat">Salir</a>
                             </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>