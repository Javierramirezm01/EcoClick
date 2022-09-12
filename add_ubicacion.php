<?php
  $page_title = 'Lista de ubicaciones';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_ubicaciones = find_all('ubicacion')
?>
<?php
 if(isset($_POST['add_ub'])){
   $req_field = array('ubicacion');
   validate_fields($req_field);
   $ub_name = remove_junk($db->escape($_POST['ubicacion']));
   if(empty($errors)){
      $sql  = "INSERT INTO ubicacion (ubicacion)";
      $sql .= " VALUES ('{$ub_name}')";
      if($db->query($sql)){
        $session->msg("s", "Ubicación agregada exitosamente.");
        redirect('add_ubicacion.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Ubicación</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="add_ubicacion.php">
            <div class="form-group">
                <input type="text" class="form-control" name="ubicacion" placeholder="Nombre de la Ubicación" required>
            </div>
            <button type="submit" name="add_ub" class="btn btn-primary">Agregar ubicación</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de ubicaciones</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Ubicaciones</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_ubicaciones as $ubi):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($ubi['ubicacion'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_ubicacion.php?id=<?php echo (int)$ubi['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_ubicacion.php?id=<?php echo (int)$ubi['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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