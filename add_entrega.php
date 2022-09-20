<?php
  $page_title = 'Entrega de materiales';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $materiales = find_all('residuos');
  $gestores = find_by_status('gestores');
?>
<?php
 if(isset($_POST['add_entrega'])){
   $req_fields = array('gestor','residuo','material','peso','usuario','responsablerecibido','observaciones' );
   validate_fields($req_fields);
   if(empty($errors)){
     $gestor  = mb_strtoupper(remove_junk($db->escape($_POST['gestor'])));
     $residuo   = mb_strtoupper(remove_junk($db->escape($_POST['residuo'])));
     $material  = remove_junk($db->escape($_POST['material']));
     $peso  = mb_strtoupper(remove_junk($db->escape($_POST['peso'])));
     $usuario  = mb_strtoupper(remove_junk($db->escape($_POST['usuario'])));
     $responsablerecibido  = mb_strtoupper(remove_junk($db->escape($_POST['responsablerecibido'])));
     $observaciones  = mb_strtoupper(remove_junk($db->escape($_POST['observaciones'])));
     $g_date    = make_date('d-m-Y');
    
	 
     $query  = "INSERT INTO entregamateriales (";
     $query .=" gestor,residuo,material,peso,usuario,responsable_recibido,observaciones,fecha";
     $query .=") VALUES (";
     $query .=" '{$gestor}', '{$residuo }', '{$material}', '{$peso}', '{$usuario}', '{$responsablerecibido}', '{$observaciones}', '{$g_date}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Entrega agregada exitosamente.");
       redirect('add_entrega.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_entrega.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_entrega.php',false);
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
            <span>Registrar entrega de materiales</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_entrega.php" class="clearfix">
          <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="gestor">
                      <option value="">Seleccione gestor</option>
                    <?php  foreach ($gestores as $gestor): ?>
                      <option value="<?php echo (string)$gestor['nombre_empresa'] ?>">
                        <?php echo $gestor['nombre_empresa'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
				       </div>
			        </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="residuo">
                      <option value="">Seleccione tipo de residuo</option>
                    <?php  foreach ($materiales as $resi): ?>
                      <option value="<?php echo (string)$resi['residuo'] ?>">
                        <?php echo $resi['residuo'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
				       </div>
			        </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="material">
                      <option value="">Seleccione material</option>
                    <?php  foreach ($materiales as $material): ?>
                      <option value="<?php echo (string)$material['material'] ?>">
                        <?php echo $material['material'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
				       </div>
			        </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="number" class="form-control" name="peso" placeholder="Ingrese Peso" required>
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
                <input type="text" class="form-control" name="responsablerecibido" placeholder="Responsable de recolección" required>
            </div>
				  </div>
			  </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="observaciones" placeholder="Observacion" required>
            </div>
				  </div>
			  </div>
              <button type="submit" name="add_entrega" class="btn btn-success">Registrar Entrega</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
