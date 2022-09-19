<?php
  $page_title = 'Editar residuo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $residuo = find_by_id('residuos',(int)$_GET['id']);
  if(!$residuo){
    $session->msg("d","Missing residuo id.");
    redirect('add_residuo.php');
  }
?>

<?php
if(isset($_POST['edit_resi'])){
  $req_field = array('residuo','material','colorbolsa','pretratamiento','tratamiento','disposicionfinal');
  validate_fields($req_field);
  $resi_name = mb_strtoupper(remove_junk($db->escape($_POST['residuo'])));
  $material = mb_strtoupper(remove_junk($db->escape($_POST['material'])));
  $colorbolsa = mb_strtoupper(remove_junk($db->escape($_POST['colorbolsa'])));
  $pretratamiento = mb_strtoupper(remove_junk($db->escape($_POST['pretratamiento'])));
  $tratamiento = mb_strtoupper(remove_junk($db->escape($_POST['tratamiento'])));
  $disposicion = mb_strtoupper(remove_junk($db->escape($_POST['disposicionfinal'])));

  if(empty($errors)){
      $query   = "UPDATE residuos SET";
      $query  .=" residuo ='{$resi_name}', material ='{$material}',";
      $query  .=" color_bolsa ='{$colorbolsa}', pretratamiento ='{$pretratamiento}', tratamiento ='{$tratamiento}',disposicion_final='{$disposicion}'";
      $query  .=" WHERE id ='{$residuo['id']}'";
      $result = $db->query($query);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Residuo actualizado con éxito.");
       redirect('add_residuo.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('add_residuo.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('add_residuo.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando <?php echo remove_junk(ucfirst($residuo['residuo']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_residuo.php?id=<?php echo (int)$residuo['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="residuo" value="<?php echo remove_junk(ucfirst($residuo['residuo']));?>">
           </div>
           <div class="form-group">
               <input type="text" class="form-control" name="material" value="<?php echo remove_junk(ucfirst($residuo['material']));?>">
           </div>
           <div class="form-group">
               <input type="text" class="form-control" name="colorbolsa" value="<?php echo remove_junk(ucfirst($residuo['color_bolsa']));?>">
           </div>
           <div class="form-group">
               <input type="text" class="form-control" name="pretratamiento" value="<?php echo remove_junk(ucfirst($residuo['pretratamiento']));?>">
           </div>
           <div class="form-group">
               <input type="text" class="form-control" name="tratamiento" value="<?php echo remove_junk(ucfirst($residuo['tratamiento']));?>">
           </div>
           <div class="form-group">
               <input type="text" class="form-control" name="disposicionfinal" value="<?php echo remove_junk(ucfirst($residuo['disposicion_final']));?>">
           </div>
           <button type="submit" name="edit_resi" class="btn btn-success">Actualizar Residuo</button>
       </form>
       </div>
     </div>
   </div>
</div>

<?php include_once('layouts/footer.php'); ?>