<?php
  $page_title = 'Lista de residuos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_tiposolicitud = find_all('tiposolicitud')
?>
<?php
 if(isset($_POST['add_so'])){
   $req_field = array('solicitud');
   validate_fields($req_field);
   $so_name = remove_junk($db->escape($_POST['solicitud']));
   if(empty($errors)){
      $sql  = "INSERT INTO tiposolicitud (tiposolicitud)";
      $sql .= " VALUES ('{$so_name}')";
      if($db->query($sql)){
        $session->msg("s", "tipo de solicitud agregado exitosamente.");
        redirect('add_tiposolicitud.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('add_tiposolicitud.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('add_tiposolicitud.php',false);
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
            <span>Agregar Tipo de Solicitud</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="add_tiposolicitud.php">
            <div class="form-group">
                <input type="text" class="form-control" name="solicitud" placeholder="Tipo de solicitud" required>
            </div>
            <button type="submit" name="add_so" class="btn btn-primary">Agregar tipo de solicitud</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de tipos de solicitud</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Residuos</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_tiposolicitud as $soli):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($soli['tiposolicitud'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_residuo.php?id=<?php echo (int)$resi['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_residuo.php?id=<?php echo (int)$resi['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>