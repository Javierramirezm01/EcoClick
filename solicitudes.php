<?php
  $page_title = 'Lista de solicitudes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 page_require_level(1);
//pull out all user form database
$all_solicitudes= find_all('solicitudes');
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Solicitudes</span>
       </strong>
         <a href="add_solicitud.php" class="btn btn-info pull-right">Crear solicitud</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th class="text-center" style="width: 15%;">Tipo de solicitud </th>
			<th class="text-center" style="width: 10%;">Área</th>
            <th class="text-center" style="width: 8%;">Usuario</th>
            <th class="text-center" style="width: 8%;">Contacto</th>
            <th class="text-center" style="width: 20%%;">Descripción</th>
			<th class="text-center" style="width: 50px;">Prioridad</th>
			<th class="text-center" style="width: 50px;">Cantidad</th>
            <th class="text-center" style="width: 8%%;">Estado</th>
            <th class="text-center" style="width: 8%%;">Fecha</th>
            <th class="text-center" style="width: 100px;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_solicitudes as $a_solicitud): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
		       <td class="text-center"><?php echo remove_junk(ucwords($a_solicitud['tipo_solicitud']))?></td>
		       <td class="text-center"><?php echo remove_junk(ucwords($a_solicitud['area']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_solicitud['usuario']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_solicitud['contacto']))?></td>
           <td><?php echo remove_junk(ucwords($a_solicitud['descripcion']))?></td>
           <td class="text-center">
           <?php if($a_solicitud['prioridad'] === '1'): ?>
            <span class="label label-success"><?php echo "Media"; ?></span>
           <?php elseif($a_solicitud['prioridad'] === '2'): ?>
            <span class="label label-danger"><?php echo "Alta"; ?></span>
           <?php else: ?>
            <span class="label label-primary"><?php echo "Baja"; ?></span>
           <?php endif;?>
           </td>
		  <td class="text-center"><?php echo remove_junk(ucwords($a_solicitud['cantidad']))?></td>
          <td class="text-center">
           <?php if($a_solicitud['estado'] === '1'): ?>
            <span class="label label-success"><?php echo "Solucionado"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Pendiente"; ?></span>
          <?php endif;?>
           </td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_solicitud['fecha']))?></td>
			 <td class="text-center">
             <div class="btn-group">
                <a href="edit_solicitudes.php?id=<?php echo (int)$a_solicitud['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="delete_solicitud.php?id=<?php echo (int)$a_solicitud['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
                </div>
           </td>
          
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>