<?php
  $page_title = 'Editar ubicacion';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $ubicacion = find_by_id('ubicacion',(int)$_GET['id']);
  if(!$ubicacion){
    $session->msg("d","Missing ubicacion id.");
    redirect('add_ubicacion.php');
  }
?>

<?php
if(isset($_POST['edit_ubi'])){
  $req_field = array('ubicacion');
  validate_fields($req_field);
  $ubi_name = remove_junk($db->escape($_POST['ubicacion']));
  if(empty($errors)){
        $sql = "UPDATE ubicacion SET ubicacion='{$ubi_name}'";
       $sql .= " WHERE id='{$ubicacion['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Ubicacion actualizada con éxito.");
       redirect('add_ubicacion.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('add_ubicacion.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('add_ubicacion.php',false);
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
           <span>Editando <?php echo remove_junk(ucfirst($ubicacion['ubicacion']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_ubicacion.php?id=<?php echo (int)$ubicacion['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="ubicacion" value="<?php echo remove_junk(ucfirst($ubicacion['ubicacion']));?>">
           </div>
           <button type="submit" name="edit_ubi" class="btn btn-primary">Actualizar ubicacion</button>
       </form>
       </div>
     </div>
   </div>
</div>

<?php include_once('layouts/footer.php'); ?>