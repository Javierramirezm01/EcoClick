<?php
  $page_title = 'Actualizacion de recoleccion';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $recoleccion = find_by_id('recoleccionresiduos',(int)$_GET['id']);
  $all_estados = find_all('recoleccionresiduos');
  $all_ubicacion= find_all('ubicacion');
  $all_usuarios = find_all('users');
  if(!$recoleccion){
    $session->msg("d","Missing recoleccion id.");
    redirect('adminrecoleccion.php');
  }
?>
<?php
 if(isset($_POST['edit_recoleccion'])){
   $req_fields = array('area','tipo_residuo','peso','usuario','observaciones' );
   validate_fields($req_fields);
   if(empty($errors)){
     $r_area  = remove_junk($db->escape($_POST['area']));
     $r_residuo   = remove_junk($db->escape($_POST['tipo_residuo']));
     $r_peso  = remove_junk($db->escape($_POST['peso']));
     $r_usuario  = remove_junk($db->escape($_POST['usuario']));
     $r_observacion  = remove_junk($db->escape($_POST['observaciones']));
     $r_date    = make_date('d-m-Y');
    
     $query   = "UPDATE recoleccionresiduos SET";
     $query  .=" area ='{$r_area}', tipo_residuo ='{$r_residuo}',";
     $query  .=" peso ='{$r_peso}', usuario ='{$r_usuario}', observaciones ='{$r_observacion}',fecha='{$r_date}'";
     $query  .=" WHERE id ='{$recoleccion['id']}'";
     $result = $db->query($query);
             if($result && $db->affected_rows() === 1){
               $session->msg('s',"La recoleccion ha sido actualizado. ");
               redirect('adminrecoleccion.php', false);
             } else {
               $session->msg('d',' Lo siento, actualización falló.');
               redirect('edit_recoleccion.php?id='.$recoleccion['id'], false);
             }

 } else{
     $session->msg("d", $errors);
     redirect('edit_recoleccion.php?id='.$recoleccion['id'], false);
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
          <form method="post" action="edit_recoleccion.php?id=<?php echo (int)$recoleccion['id'] ?>" class="clearfix">
          <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="area">
                      <option value="">Seleccione Ubicacion</option>
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
                <input type="text" class="form-control" name="tipo_residuo" placeholder="Tipo de residuo" required>
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
              <button type="submit" name="edit_recoleccion" class="btn btn-danger">Actualizar Recoleccion</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>