<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar usuarios</h1>

    <!-- Breadcrumb o posición de la pagina -->
    <ol class="breadcrumb">
      <li>
        <a href="inicio">
          <i class="fa fa-dashboard"></i> Inicio</a>
      </li>
      <li>Administrar Usuarios</li>
    </ol>
  </section>

  <section class="content">

    <!-- Botones CRUD -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Usuario</button>
      </div>

      <!-- contenido -->
      <div class="box-body">
        <!-- tabla administración CRUD usuarios -->
        <table class="table table-hover table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php
            // parametros vacios en consulta general
            $columna = null;
            $valor = null;

            // metodo para mostrar usuarios registrados
              $usuarios = ControllerUsuarios::controllerMostrarUsuarios($columna, $valor);

              // recorrer el array con un foreach
              foreach($usuarios as $key => $objUsuario)
              {
                echo'
                <tr>
                  <td>1</td>
                  <td>'.$objUsuario["nombre_usuario"].'</td>
                  <td>'.$objUsuario["usuario_tipo"].'</td>';

                  if($objUsuario["foto_usuario"] != "")
                  {
                    echo '<td><img src="'.$objUsuario["foto_usuario"].'" class="img-thumbnail" width="40px" alt="Usuario"></td>';
                  }
                  else
                  {
                    echo '<td><img src="view/img/usuarios/anonimo.jpg" class="img-thumbnail" width="40px" alt="Usuario"></td>
                  <td>Administrador</td>';
                  }
                  echo '<td>'.$objUsuario["perfil_usuario"].'</td>';
                  echo '<td>'.$objUsuario["perfil_usuario"].'</td>';
                  echo '<td>'.$objUsuario["perfil_usuario"].'</td>';
                  echo '<td>
                  <div class="btn-group">
                    <!-- btnEditarUsuario trae info via ajax, idUsuario envía el id del usuario -->
                    <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$objUsuario["id_usuario"].'" data-toggle="modal" data-target="#modalEditarUsuario">
                      <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-danger">
                      <i class="fa fa-times"></i>
                    </button>
                  </div></td>
                  
                  ';
              }

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<!-- Modal Agregar Usuario -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- multipart/form-data para encriptar el archivo -->
    <form method="POST" role="form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ingresar nuevo usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            
            <!-- div Nombre -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingrese el nombre" required>
              </div>
            </div>
            
            <!-- div Usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-key"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingrese usuario" required>
              </div>
            </div>

            <!-- div password -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoPass" placeholder="Ingrese contraseña" required>
              </div>
            </div>

            <!-- div perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-users"></i>
                </span>
                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Seleccione un perfil</option>
                  <option value="sdministrador">Super usuario</option>
                  <option value="supervisor">Supervisor</option>
                  <option value="operador">Operador</option>
                </select>
              </div>
            </div>

            <!-- div fotografía -->
            <div class="form-group">
              <div class="panel">Subir Foto</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso  máximo de la foto: 2 MB </p>
              <img src="view/img/usuarios/anonimo.jpg" alt="Anonimo" class="img-thumbnail previsualizar" width="100px">
            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Crear usuario</button>
        </div>
      </div>
      <?php
        // ejecutar el controlador y el metodo para agregar usuario
        $crearUsuario = new ControllerUsuarios();
        $crearUsuario -> controllerRegistrarUsuario();
      ?>
    </form>
  </div>
</div>

<!-- Modal Editar Usuario -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- multipart/form-data para encriptar el archivo -->
    <form method="POST" role="form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            
            <!-- div Nombre -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
              </div>
            </div>
            
            <!-- div Usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-key"></i>
                </span>
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
              </div>
            </div>

            <!-- div password -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="text" class="form-control input-lg" name="editarPass" placeholder="**********">
                
                <!-- revisar carpeta ajax/usuarios -->
                <!-- valor hidden CRUD update -->
                <input type="hidden" id="hiddenPass" name="hp">
                <!-- valor hidden CRUD update -->
                <input type="hidden" id="hiddenPic" name="hip">

              </div>
            </div>

            <!-- div perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-users"></i>
                </span>
                <select class="form-control input-lg" name="editarPerfil">
                  <!-- mediante js se modificará el id "editarPerfil" --> 
                  <option value="" id="editarPerfil"></option>
                  <option value="sdministrador">Super usuario</option>
                  <option value="supervisor">Supervisor</option>
                  <option value="operador">Operador</option>
                </select>
              </div>
            </div>

            <!-- div fotografía -->
            <div class="form-group">
              <div class="panel">Subir Foto</div>
              <!-- la clase nuevaFoto se mantiene para reciclar código -->
              <input type="file" class="editarFoto" name="editarFoto">
              <p class="help-block">Peso  máximo de la foto: 2 MB </p>
              <img src="view/img/usuarios/anonimo.jpg" alt="Anonimo" class="img-thumbnail previsualizar" width="100px">
            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar usuario</button>
        </div>
      </div>
      <?php
        //ejecutar el controlador y el metodo para editar usuario
        //$editarUsuario = new ControllerUsuarios();
        //$editarUsuario -> controllerEditarUsuario();
      ?>
    </form>
  </div>
</div>