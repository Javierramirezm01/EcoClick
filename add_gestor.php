<?php
  $page_title = 'Lista de gestores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_gestores = find_all('gestores');
?>
<?php
 if(isset($_POST['add_gestor'])){
   $req_fields = array('nit','nombreempresa','representante','direccion','persona','fijo','celular','correo' );
   validate_fields($req_fields);
   if(empty($errors)){
     $nit  = mb_strtoupper(remove_junk($db->escape($_POST['nit'])));
     $empresa   = mb_strtoupper(remove_junk($db->escape($_POST['nombreempresa'])));
     $representante  = mb_strtoupper(remove_junk($db->escape($_POST['representante'])));
     $direccion  = mb_strtoupper(remove_junk($db->escape($_POST['direccion'])));
     $persona  = mb_strtoupper(remove_junk($db->escape($_POST['persona'])));
     $fijo  = remove_junk($db->escape($_POST['fijo']));
     $celular  = mb_strtoupper(remove_junk($db->escape($_POST['celular'])));
     $correo  = mb_strtoupper(remove_junk($db->escape($_POST['correo'])));
     $g_date    = make_date('d-m-Y');
    
	 
     $query  = "INSERT INTO gestores (";
     $query .=" nit,nombre_empresa,representante,direccion,persona_contacto,fijo,celular,correo,estado,fecha";
     $query .=") VALUES (";
     $query .=" '{$nit}', '{$empresa }', '{$representante}', '{$direccion}', '{$persona}', '{$fijo}', '{$celular}', '{$correo}', '1', '{$g_date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE nit='{$nit}'";
     if($db->query($query)){
       $session->msg('s',"Gestor agregado exitosamente. ");
       redirect('add_gestor.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_gestor.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_gestor.php',false);
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
            <span>Registrar gestor externo</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_gestor.php" class="clearfix">
            <div class="form-group">
                <input type="text" class="form-control" name="nit" placeholder="Ingrese nit del gestor" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="nombreempresa" placeholder="Ingrese nombre de la empresa" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="representante" placeholder="Ingrese representante legal" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="direccion" placeholder="Ingrese direccion" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="persona" placeholder="Persona de contacto" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="fijo" placeholder="Telefono fijo" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="celular" placeholder="telefono celular" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="correo" placeholder="Ingrese correo electronico" required>
            </div>
            <button type="submit" name="add_gestor" class="btn btn-success">Registrar Recolección</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de gestores externos</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 4%;">Id</th>
                    <th class="text-center" style="width: 10%;">Nit</th>
                    <th class="text-center" style="width: 14%;">Empresa</th>
                    <th class="text-center" style="width: 10%;">Representante</th>
                    <th class="text-center" style="width: 20%;">Dirección</th>
                    <th class="text-center" style="width: 10%;">Persona de contacto</th>
                    <th class="text-center" style="width: 7%;">Telefono fijo</th>
                    <th class="text-center" style="width: 8%;">Telefono celular</th>
                    <th class="text-center" style="width: 10%;">Correo</th>
                    <th class="text-center" style="width: 4%;">estado</th>
                    <th class="text-center" style="width: 4%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_gestores as $gestores):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($gestores['nit'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($gestores['nombre_empresa'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($gestores['representante'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($gestores['direccion'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($gestores['persona_contacto'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($gestores['fijo'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($gestores['celular'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($gestores['correo'])); ?></td>
                    <td class="text-center">
                    <?php if($gestores['estado'] === '1'): ?>
                      <span class="label label-success"><?php echo "Activo"; ?></span>
                    <?php else: ?>
                      <span class="label label-danger"><?php echo "Inactivo"; ?></span>
                    <?php endif;?>
                    </td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_gestor.php?id=<?php echo (int)$gestores['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_gestor.php?id=<?php echo (int)$gestores['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
