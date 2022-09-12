<?php
  $page_title = 'Lista de residuos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_residuos = find_all('residuos')
?>
<?php
 if(isset($_POST['add_re'])){
   $req_field = array('residuo');
   validate_fields($req_field);
   $ub_name = remove_junk($db->escape($_POST['residuo']));
   if(empty($errors)){
      $sql  = "INSERT INTO residuos (residuo)";
      $sql .= " VALUES ('{$ub_name}')";
      if($db->query($sql)){
        $session->msg("s", "Residuo agregado exitosamente.");
        redirect('add_residuo.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Residuo</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="add_residuo.php">
            <div class="form-group">
                <input type="text" class="form-control" name="residuo" placeholder="Tipo de residuo" required>
            </div>
            <button type="submit" name="add_re" class="btn btn-primary">Agregar Residuo</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Residuos</span>
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
              <?php foreach ($all_residuos as $resi):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($resi['residuo'])); ?></td>
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