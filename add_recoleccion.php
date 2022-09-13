<?php
  $page_title = 'Recoleeción de residuos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_estados = find_all('recoleccionresiduos');
  $all_usuarios = find_all('users');
  $all_ubicacion= find_all('ubicacion');
  $all_residuos= find_all('residuos');
?>
<?php
 if(isset($_POST['add_recoleccion'])){
   $req_fields = array('area','tipo_residuo','peso','usuario','observaciones' );
   validate_fields($req_fields);
   if(empty($errors)){
     $r_area  = remove_junk($db->escape($_POST['area']));
     $r_residuo   = remove_junk($db->escape($_POST['tipo_residuo']));
     $r_peso  = remove_junk($db->escape($_POST['peso']));
     $r_usuario  = remove_junk($db->escape($_POST['usuario']));
     $r_observacion  = remove_junk($db->escape($_POST['observaciones']));
     $r_date    = make_date('d-m-Y');
    
	 
     $query  = "INSERT INTO recoleccionresiduos (";
     $query .=" area,tipo_residuo,peso,usuario,observaciones,fecha";
     $query .=") VALUES (";
     $query .=" '{$r_area}', '{$r_residuo }', '{$r_peso}', '{$r_usuario}', '{$r_observacion}', '{$r_date}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Recolección agregada exitosamente. ");
       redirect('add_recoleccion.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_recoleccion.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_recoleccion.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Registrar Recolección</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_recoleccion.php" class="clearfix">
          <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="area">
                      <option value="">Seleccione Ubicación</option>
                    <?php  foreach ($all_ubicacion as $ubi): ?>
                      <option value="<?php echo (string)$ubi['ubicacion'] ?>">
                        <?php echo $ubi['ubicacion'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
				       </div>
			        </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="tipo_residuo">
                      <option value="">Seleccione Tipo de Residuo</option>
                    <?php  foreach ($all_residuos as $resi): ?>
                      <option value="<?php echo (string)$resi['residuo'] ?>">
                        <?php echo $resi['residuo'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
				       </div>
			        </div>
			  <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                <input type="number" class="form-control" name="peso" placeholder="Ingrese Peso" required>
                </div>
				 </div>
			  </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <input type="text" class="form-control" id="sug_input" name="usuario" value="<?php echo remove_junk($user['name']); ?>" readonly>
            </div>
				  </div>
			  </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="observaciones" placeholder="Observacion" required>
            </div>
				  </div>
			  </div>
              <button type="submit" name="add_recoleccion" class="btn btn-success">Registrar Recolección</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
