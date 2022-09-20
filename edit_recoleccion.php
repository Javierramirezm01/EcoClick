<?php
  $page_title = 'Actualizacion de recoleccion';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $recoleccion = find_by_id('recoleccionresiduos',(int)$_GET['id']);
  $recoleccion_residuos = find_all('recoleccionresiduos');
  $ubicaciones= find_all('ubicacion');
  

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
     $r_area  = mb_strtoupper(remove_junk($db->escape($_POST['area'])));
     $r_residuo   = mb_strtoupper(remove_junk($db->escape($_POST['tipo_residuo'])));
     $r_peso  = remove_junk($db->escape($_POST['peso']));
     $r_usuario  = mb_strtoupper(remove_junk($db->escape($_POST['usuario'])));
     $r_observacion  = mb_strtoupper(remove_junk($db->escape($_POST['observaciones'])));
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
  <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Actualizar Recolección</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-8">
          <form method="post" action="edit_recoleccion.php?id=<?php echo (int)$recoleccion['id'] ?>" class="clearfix">
          <div class="form-group">
            <select class="form-control" name="area">
              <option value="<?php echo remove_junk($recoleccion['area']);?>"><?php echo remove_junk($recoleccion['area']);?></option>
              <?php  foreach ($ubicaciones as $ubi): ?>
                <option value="<?php echo (string)$ubi['ubicacion'] ?>">
                <?php echo $ubi['ubicacion'] ?></option>
                <?php endforeach; ?>
            </select>
			   </div>

         <div class="form-group">
          <input type="text" class="form-control" name="tipo_residuo" value="<?php echo remove_junk(ucfirst($recoleccion['tipo_residuo']));?>">
         </div>

         <div class="form-group">
          <input type="text" class="form-control" name="peso" value="<?php echo remove_junk(ucfirst($recoleccion['peso']));?>">
         </div>

         <div class="form-group">
          <input type="text" class="form-control" id="sug_input" name="usuario" value="<?php echo remove_junk($user['name']); ?>" readonly>
         </div>

         <div class="form-group">
          <input type="text" class="form-control" name="observaciones" value="<?php echo remove_junk(ucfirst($recoleccion['observaciones']));?>">
         </div>
              <button type="submit" name="edit_recoleccion" class="btn btn-success">Actualizar Recoleccion</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>