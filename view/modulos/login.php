<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Sistema </b>POS</a>
    <!-- Si va un logo, reemplazar -->
    <!-- <img src="#" alt="Logo  POS" class="img-responsive" style="padding: 30px 100px 0px 100px"> -->
  </div>

  <!-- Modulo Login -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión o inscribete para tu prueba de 30 dias</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Ingresa tu Email" name="nombreUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Ingresa tu password" name="passUsuario" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>

      <?php
        $login = new ControllerUsuarios();
        $login -> controllerIngresoUsuario();
      ?>

    </form>

    <div class="social-auth-links text-center">
      <p>- O puedes -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Ingresar usando Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Ingresar usando Gmail</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="#">He olvidado mi contraseña</a><br>
    <a href="register.html" class="text-center">Obtén tu cuenta gratuita!</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /Modulo Login -->