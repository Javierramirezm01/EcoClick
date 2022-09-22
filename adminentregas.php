<?php
  $page_title = 'Entregas de materiales';

	require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $entregas = find_all('entregamateriales');
?>
<?php include_once('layouts/header.php'); ?> 

<div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Entrega materiales</span>
         </strong>
        </div>

        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">Id</th>
                <th class="text-center" style="width: 12%;">Gestor</th>
                <th class="text-center" style="width: 10%;">Residuo</th>
                <th class="text-center" style="width: 10%;">Material</th>
                <th class="text-center" style="width: 4%;">Peso</th>
                <th class="text-center" style="width: 10%;">Usuario</th>
                <th class="text-center" style="width: 12%;">Responsable recibido</th>
				        <th class="text-center" style="width: 20%;">Observaciones</th>
                <th class="text-center" style="width: 10%;">Fecha</th>
                <th class="text-center" style="width: 6%;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($entregas as $entregas):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($entregas['gestor']); ?></td>
                <td class="text-center"> <?php echo remove_junk($entregas['residuo']); ?></td>
                <td class="text-center"> <?php echo remove_junk($entregas['material']); ?></td>
                <td class="text-center"> <?php echo remove_junk($entregas['peso']); ?></td>
                <td class="text-center"> <?php echo remove_junk($entregas['usuario']); ?></td>
                <td class="text-center"> <?php echo remove_junk($entregas['responsable_recibido']); ?></td>
                <td class="text-center"> <?php echo remove_junk($entregas['observaciones']); ?></td>
                <td class="text-center"><?php echo remove_junk(ucwords($entregas['fecha']))?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_entrega.php?id=<?php echo (int)$entregas['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_entrega.php?id=<?php echo (int)$entregas['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
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
  <?php include_once('layouts/footer.php'); ?>