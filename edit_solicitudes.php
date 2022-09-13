<?php
  $page_title = 'Editar Solicitudes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $solicitud = find_by_id('solicitudes',(int)$_GET['id']);
  if(!$solicitud){
    $session->msg("d","Missing solicitud id.");
    redirect('solicitudes.php');
  }
?>
<?php
//Update estado basic info
  if(isset($_POST['actualizar'])) {
    $req_fields = array('estado');
    validate_fields($req_fields);
	$estado = remove_junk($db->escape($_POST['estado']));
	if(empty($errors)){
            $sql = "UPDATE solicitudes SET estado='{$estado}'";
			$sql .= " WHERE id='{$solicitud['id']}'";
		  $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount Updated ");
            redirect('solicitudes.php', false);
          } else {
            $session->msg('d',' Lo siento no se actualizó los datos.');
            redirect('solicitudes.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('solicitudes.php',false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
      <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Solucionar Solicitud</span>
         </strong>
       </div>
       <div class="panel-body">
	    <div class="col-md-6">
          <form method="post" action="edit_solicitudes.php?id=<?php echo (int)$solicitud['id'];?>" class="clearfix">
            <div class="form-group">
              <label for="estado">Estado</label>
                <select class="form-control" name="estado">
                  <option <?php if($solicitud['estado'] === '1') echo 'selected="selected"';?>value="1">Solucionado</option>
                  <option <?php if($solicitud['estado'] === '0') echo 'selected="selected"';?> value="0">Pendiente</option>
                </select>
            </div>
            <div class="form-group clearfix">
                    <button type="submit" name="actualizar" class="btn btn-info">Actualizar</button>
            </div>
        </form>
		</div>
       </div>
     </div>
  </div>
 </div>
<?php include_once('layouts/footer.php'); ?>