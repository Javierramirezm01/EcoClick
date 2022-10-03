<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>

<div class="text-left">
  <img src="uploads\products\icono.png"/>
</div>
<div class="text-center">
  <img src="uploads\products\inicio.png"/>
</div>
<div class="login-page">
    <div class="text-center">
       <p>Iniciar sesión </p>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Usario</label>
              <input type="name" class="form-control" name="username" placeholder="Usario">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Contraseña</label>
            <input type="password" name= "password" class="form-control" placeholder="Contraseña">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success  pull-right">Entrar</button>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>
<?php include_once('layouts/header.php'); ?>
<style>
  body{
    background: #24BA82;
  }
</style>
