<?php
  $page_title = 'Lista de residuos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_residuos = find_all('residuos')
?>
<?php
 if(isset($_POST['add_re'])){
   $req_field = array('residuo','material','colorbolsa','pretratamiento','tratamiento','disposicionfinal','usuario');
   validate_fields($req_field);
   $resiudo = mb_strtoupper(remove_junk($db->escape($_POST['residuo'])));
   $material = mb_strtoupper(remove_junk($db->escape($_POST['material'])));
   $colorbolsa = mb_strtoupper(remove_junk($db->escape($_POST['colorbolsa'])));
   $pretratamiento = mb_strtoupper(remove_junk($db->escape($_POST['pretratamiento'])));
   $tratamiento = mb_strtoupper(remove_junk($db->escape($_POST['tratamiento'])));
   $disposicion = mb_strtoupper(remove_junk($db->escape($_POST['disposicionfinal'])));
   $usuario = mb_strtoupper(remove_junk($db->escape($_POST['usuario'])));
   $r_date    = make_date('d-m-Y');

   if(empty($errors)){
      $query  = "INSERT INTO residuos (";
      $query .=" residuo,material,color_bolsa,pretratamiento,tratamiento,disposicion_final,usuario,fecha";
      $query .=") VALUES (";
      $query .=" '{$resiudo}', '{$material }', '{$colorbolsa}', '{$pretratamiento}', '{$tratamiento}', '{$disposicion}', '{$usuario}','{$r_date}'";
      $query .=")";
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
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Material</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="add_residuo.php">
            <div class="form-group">
                <input type="text" class="form-control" name="residuo" placeholder="Tipo de residuo" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="material" placeholder="Tipo de material" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="colorbolsa" placeholder="Ingrese color de bolsa" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="pretratamiento" placeholder="Ingrese pretratamiento" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="tratamiento" placeholder="Ingrese tratamiento" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="disposicionfinal" placeholder="Disposición final" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="sug_input" name="usuario" value="<?php echo remove_junk($user['name']); ?>" readonly>
            </div>
          <button type="submit" name="add_re" class="btn btn-success">Agregar Material</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <br/>
      <br/>
      <img src="uploads\products\logoPrincipal.png"/>
  </div>
<div class="col-md-12">
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
                    <th class="text-center" style="width: 50px;">Id</th>
                    <th class="text-center" style="width: 50px;">Residuo</th>
                    <th class="text-center" style="width: 50px;">Material</th>
                    <th class="text-center" style="width: 50px;">Color bolsa</th>
                    <th class="text-center" style="width: 50px;">Pretratamiento</th>
                    <th class="text-center" style="width: 50px;">Tratamiento</th>
                    <th class="text-center" style="width: 50px;">Disposición final</th>
                    <th class="text-center" style="width: 50px;">Usuario</th>
                    <th class="text-center" style="width: 50px;">Fecha</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_residuos as $resi):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($resi['residuo'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($resi['material'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($resi['color_bolsa'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($resi['pretratamiento'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($resi['tratamiento'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($resi['disposicion_final'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($resi['usuario'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($resi['fecha'])); ?></td>
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