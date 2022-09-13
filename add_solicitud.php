<?php
  $page_title = 'Agregar solicitud';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
   $all_usuarios = find_all('users');
   $all_ubicacion = find_all('ubicacion');
   $all_tiposolicitud = find_all('tiposolicitud');
?>
<?php
  if(isset($_POST['add_solicitud'])){

   $req_fields = array('tiposolicitud','area','usuario', 'contacto','descripcion','prioridad','cantidad');
   validate_fields($req_fields);

   if(empty($errors)){
		$tipo   = remove_junk($db->escape($_POST['tiposolicitud']));
        $area   = remove_junk($db->escape($_POST['area']));
        $usuario   = remove_junk($db->escape($_POST['usuario']));
        $contacto   = remove_junk($db->escape($_POST['contacto']));
	    $descripcion   = remove_junk($db->escape($_POST['descripcion']));
        $prioridad   = remove_junk($db->escape($_POST['prioridad']));
		$cantidad   = remove_junk($db->escape($_POST['cantidad']));
        $s_date    = make_date('d-m-Y');

        $query = "INSERT INTO solicitudes (";
        $query .="tipo_solicitud,area,usuario,contacto,descripcion,prioridad,cantidad,estado,fecha";
        $query .=") VALUES (";
        $query .=" '{$tipo}', '{$area}', '{$usuario}', '{$contacto}','{$descripcion}','{$prioridad
        }','{$cantidad}','0','{$s_date}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," La solicitud ha sido creada");
          redirect('add_solicitud.php', false);
        } else {
          //failed
          $session->msg('d',' No se pudo crear la solicitud.');
          redirect('add_solicitud.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_solicitud.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
<div class="col-md-12">
  <?php echo display_msg($msg); ?>
  </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar solicitud</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_solicitud.php">
          <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="tiposolicitud">
                      <option value="">Seleccione tipo de solcitud</option>
                    <?php  foreach ($all_tiposolicitud as $soli): ?>
                      <option value="<?php echo (string)$soli['tiposolicitud'] ?>">
                        <?php echo $soli['tiposolicitud'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
				       </div>        
             </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="area">
                      <option value="">Seleccione Area</option>
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
                        <input type="text" class="form-control" id="sug_input" name="usuario" value="<?php echo remove_junk($user['name']); ?>" readonly>
                    </div>
				         </div>
			      </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="contacto" placeholder="contacto" required>
                  </div>
		           </div>
             </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="descripcion" placeholder="Descripcion de la solicitud" required>
                  </div>
		        </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="prioridad">Prioridad</label>
                        <select class="form-control" name="prioridad">
                            <option value="0">Baja</option>
                            <option value="1">Media</option>
                            <option value="2">Alta</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="number" class="form-control" name="cantidad" placeholder="Cantidad solicitada" required>
                  </div>
		        </div>
            </div> 
                <button type="submit" name="add_solicitud" class="btn btn-success">Registrar solicitud</button>
            </form>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>