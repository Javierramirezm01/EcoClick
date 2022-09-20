<?php
  $page_title = 'Actualizacion de gestor';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $gestor = find_by_id('gestores',(int)$_GET['id']);
  if(!$gestor){
    $session->msg("d","Missing recoleccion id.");
    redirect('adminrecoleccion.php');
  }
?>
<?php
 if(isset($_POST['edit_gestor'])){
   $req_fields = array('nit','nombreempresa','representante','direccion','persona','fijo','celular','correo','estado');
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
    $estado  = mb_strtoupper(remove_junk($db->escape($_POST['estado'])));
    
     $query   = "UPDATE gestores SET";
     $query  .=" nit ='{$nit}', nombre_empresa ='{$empresa}',representante ='{$representante}', direccion ='{$direccion}',";
     $query  .=" persona_contacto ='{$persona}',fijo='{$fijo}',celular='{$celular}',correo='{$correo}',estado='{$estado}'";
     $query  .=" WHERE id ='{$gestor['id']}'";
     $result = $db->query($query);
             if($result && $db->affected_rows() === 1){
               $session->msg('s',"Gestor ha sido actualizado. ");
               redirect('add_gestor.php', false);
             } else {
               $session->msg('d',' Lo siento, actualización falló.');
               redirect('edit_gestor.php?id='.$gestor['id'], false);
             }

 } else{
     $session->msg("d", $errors);
     redirect('edit_gestor.php?id='.$gestor['id'], false);
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
  <div class="col-md-7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Actualizar gestor</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-9">
          <form method="post" action="edit_gestor.php?id=<?php echo (int)$gestor['id'] ?>" class="clearfix">
          <div class="form-group">
           <input type="text" class="form-control" name="nit" value="<?php echo remove_junk(ucfirst($gestor['nit']));?>">
          </div>

          <div class="form-group">
           <input type="text" class="form-control" name="nombreempresa" value="<?php echo remove_junk(ucfirst($gestor['nombre_empresa']));?>">
          </div>

          <div class="form-group">
           <input type="text" class="form-control" name="representante" value="<?php echo remove_junk(ucfirst($gestor['representante']));?>">
          </div>

          <div class="form-group">
           <input type="text" class="form-control" name="direccion" value="<?php echo remove_junk(ucfirst($gestor['direccion']));?>">
          </div>

          <div class="form-group">
           <input type="text" class="form-control" name="persona" value="<?php echo remove_junk(ucfirst($gestor['persona_contacto']));?>">
          </div>

          <div class="form-group">
           <input type="text" class="form-control" name="fijo" value="<?php echo remove_junk(ucfirst($gestor['fijo']));?>">
          </div>

          <div class="form-group">
           <input type="text" class="form-control" name="celular" value="<?php echo remove_junk(ucfirst($gestor['celular']));?>">
          </div>

          <div class="form-group">
           <input type="text" class="form-control" name="correo" value="<?php echo remove_junk(ucfirst($gestor['correo']));?>">
          </div>
          
          <div class="form-group">
          <label for="status">Estado</label>
            <select class="form-control" name="estado">
              <option <?php if($gestor['estado'] === '1') echo 'selected="selected"';?>value="1">Activo</option>
              <option <?php if($gestor['estado'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
            </select>
          </div>

          <button type="submit" name="edit_gestor" class="btn btn-success">Actualizar Recoleccion</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>