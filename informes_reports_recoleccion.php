<?php
$page_title = 'Reporte de recolección de residuos';
$results = '';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);

?>
<?php
  if(isset($_POST['submit'])){
    $req_dates = array('start-date','end-date');
    validate_fields($req_dates);
    if(empty($errors)):
      $start_date   = remove_junk($db->escape($_POST['start-date']));
      $end_date     = remove_junk($db->escape($_POST['end-date']));
      $results      = find_by_report($start_date,$end_date);
    else:
      $session->msg("d", $errors);
      redirect('informes_recoleccion.php', false);
    endif;
  } else {
    $session->msg("d", "Select dates");
    redirect('informes_recoleccion.php', false);
  }
?>
<?php include_once('layouts/header.php'); ?> 
<?php include_once('layouts/footer.php'); ?>

<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de recolección</title>
   <style>
      .sidebar {
        
        display:none;
      }
   </style>
</head>
<body>
  <?php if($results): ?>
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
            <span>Recoleccion residuos</span>
            <?php if(isset($start_date)){ echo $start_date;}?> a <?php if(isset($end_date)){echo $end_date;}?>
         </strong>
         <a href="home.php" class="btn btn-info pull-right">Volver a menu</a>
        </div>

        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 6%;">#</th>
                <th class="text-center" style="width: 10%;"> Área </th>
                <th class="text-center" style="width: 15%;"> Tipo de residuo </th>
                <th class="text-center" style="width: 8%;"> Peso </th>
                <th class="text-center" style="width: 10%;"> Usuario </th>
                <th class="text-center" style="width: 30%;"> Observación </th>
				        <th class="text-center" style="width: 10%;"> Fecha registro </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($results as $result):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($result['area']); ?></td>
                <td class="text-center"> <?php echo remove_junk($result['tipo_residuo']); ?></td>
                <td class="text-center"> <?php echo remove_junk($result['peso']); ?></td>
                <td class="text-center"> <?php echo remove_junk($result['usuario']); ?></td>
                <td class="text-center"> <?php echo remove_junk($result['observaciones']); ?></td>
                <td class="text-center"><?php echo remove_junk(ucwords($result['fecha']))?></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php
    else:
        $session->msg("d", "No se encontraron registros. ");
        redirect('informes_recoleccion.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); }?>

