<?php
  $page_title = 'Actualizacion de entrega';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $entrega = find_by_id('entregamateriales',(int)$_GET['id']);
  $gestores = find_by_status('gestores');
  $residuos = find_all('residuos');
  

  if(!$entrega){
    $session->msg("d","Missing recoleccion id.");
    redirect('adminentregas.php');
  }
?>
<?php
 if(isset($_POST['edit_entrega'])){
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
    
     $query   = "UPDATE entregamateriales SET";
     $query  .=" gestor ='{$gestor}', residuo ='{$residuo}',";
     $query  .=" material ='{$material}', peso ='{$peso}', usuario ='{$usuario}',responsable_recibido='{$responsablerecibido}',observaciones='{$observaciones}'";
     $query  .=" WHERE id ='{$entrega['id']}'";
     $result = $db->query($query);
             if($result && $db->affected_rows() === 1){
               $session->msg('s',"La entrega ha sido actualizado. ");
               redirect('adminentregas.php', false);
             } else {
               $session->msg('d',' Lo siento, actualización falló.');
               redirect('adminentregas.php?id='.$entrega['id'], false);
             }

 } else{
     $session->msg("d", $errors);
     redirect('edit_entrega.php?id='.$entrega['id'], false);
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
            <span>Actualizar Entrega</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-8">
          <form method="post" action="edit_entrega.php?id=<?php echo (int)$entrega['id'] ?>" class="clearfix">
          <div class="form-group">
            <select class="form-control" name="gestor">
              <option value="<?php echo remove_junk($entrega['gestor']);?>"><?php echo remove_junk($entrega['gestor']);?></option>
              <?php  foreach ($gestores as $ges): ?>
                <option value="<?php echo (string)$ges['nombre_empresa'] ?>">
                <?php echo $ges['nombre_empresa'] ?></option>
                <?php endforeach; ?>
            </select>
			   </div>
         <div class="form-group">
            <select class="form-control" name="residuo">
              <option value="<?php echo remove_junk($entrega['residuo']);?>"><?php echo remove_junk($entrega['residuo']);?></option>
              <?php  foreach ($residuos as $resi): ?>
                <option value="<?php echo (string)$resi['residuo'] ?>">
                <?php echo $resi['residuo'] ?></option>
                <?php endforeach; ?>
            </select>
			   </div>
         <div class="form-group">
            <select class="form-control" name="material">
              <option value="<?php echo remove_junk($entrega['material']);?>"><?php echo remove_junk($entrega['material']);?></option>
              <?php  foreach ($residuos as $resi): ?>
                <option value="<?php echo (string)$resi['material'] ?>">
                <?php echo $resi['material'] ?></option>
                <?php endforeach; ?>
            </select>
			   </div>
         <div class="form-group">
          <input type="text" class="form-control" name="peso" value="<?php echo remove_junk(ucfirst($entrega['peso']));?>">
         </div>

         <div class="form-group">
          <input type="text" class="form-control" id="sug_input" name="usuario" value="<?php echo remove_junk($user['name']); ?>" readonly>
         </div>

         <div class="form-group">
          <input type="text" class="form-control" name="responsablerecibido" value="<?php echo remove_junk(ucfirst($entrega['responsable_recibido']));?>">
         </div>

         <div class="form-group">
          <input type="text" class="form-control" name="observaciones" value="<?php echo remove_junk(ucfirst($entrega['observaciones']));?>">
         </div>
              <button type="submit" name="edit_entrega" class="btn btn-success">Actualizar Entrega</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>