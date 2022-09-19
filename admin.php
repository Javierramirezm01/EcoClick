<?php
  $page_title = 'Admin página de inicio';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
 $recoleccion       = count_by_id('recoleccionresiduos');
 $solicitudes         = count_by_id('solicitudes');
 $residuos       = count_by_id('residuos');
 $usuarios         = count_by_id('users');
 $Recoleccion_residuos   = ultimas_recolecciones('8');
 $solicitudes_pendientes  = solicitudes_pendientes('5');
?>
<?php include_once('layouts/header.php'); ?>
<style>
 .clearfix{
  height: 125;
 }
</style>

<div class="row">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-leaf"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $recoleccion['total']; ?> </h2>
          <p class="text-muted">Recolecciones</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-dashboard"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $solicitudes['total']; ?> </h2>
          <p class="text-muted">Solicitudes</p>
        </div>
      </div>
    </div>
	<div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-tree-conifer"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $residuos['total']; ?> </h2>
          <p class="text-muted">Materiales</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $usuarios['total']; ?> </h2>
          <p class="text-muted">Usuarios</p>
        </div>
      </div>
    </div>
</div>
<div class="row">
   <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span>Ultimas Solicitudes pendientes</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
           <tr>
           <th>Id</th>
             <th>Tipo de solicitud</th>
             <th>Área</th>
             <th>Usuario</th>
             <th>Prioridad</th>
             <th>Estado</th>
             <th>Fecha</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($solicitudes_pendientes as  $solicitud): ?>
              <tr>
                <td><?php echo remove_junk(first_character($solicitud['id'])); ?></td>
                <td><?php echo remove_junk(first_character($solicitud['tipo_solicitud'])); ?></td>
                <td><?php echo remove_junk(first_character($solicitud['area'])); ?></td>
                <td><?php echo remove_junk(first_character($solicitud['usuario'])); ?></td>
                <td class="text-center">
                  <?php if($solicitud['prioridad'] === '1'): ?>
                    <span class="label label-success"><?php echo "Media"; ?></span>
                  <?php elseif($solicitud['prioridad'] === '2'): ?>
                    <span class="label label-danger"><?php echo "Alta"; ?></span>
                  <?php else: ?>
                    <span class="label label-primary"><?php echo "Baja"; ?></span>
                  <?php endif;?>
                </td>
                <td class="text-center">
                  <?php if($solicitud['estado'] === '1'): ?>
                    <span class="label label-success"><?php echo "Solucionado"; ?></span>
                  <?php else: ?>
                    <span class="label label-danger"><?php echo "Pendiente"; ?></span>
                  <?php endif;?>
                </td>
                <td><?php echo remove_junk(first_character($solicitud['fecha'])); ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>

   <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span>Ultimas recolecciones</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
           <th>Id</th>
             <th>Área</th>
             <th>Tipo de residuo</th>
             <th>Cantidad</th>
             <th>Usuario</th>
             <th>Fecha</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($Recoleccion_residuos as  $recoleccion): ?>
              <tr>
                <td><?php echo remove_junk(first_character($recoleccion['id'])); ?></td>
                <td><?php echo remove_junk(first_character($recoleccion['area'])); ?></td>
                <td><?php echo remove_junk(first_character($recoleccion['tipo_residuo'])); ?></td>
                <td><?php echo remove_junk(first_character($recoleccion['peso'])); ?></td>
                <td><?php echo remove_junk(first_character($recoleccion['usuario'])); ?></td>
                <td><?php echo remove_junk(first_character($recoleccion['fecha'])); ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
 </div>
    
<?php include_once('layouts/footer.php'); ?>
