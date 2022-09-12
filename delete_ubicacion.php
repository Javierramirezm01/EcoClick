<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $ubicacion = find_by_id('ubicacion',(int)$_GET['id']);
  if(!$ubicacion){
    $session->msg("d","ID de la ubicacion falta.");
    redirect('add_ubicacion.php');
  }
?>
<?php
  $delete_id = delete_by_id('ubicacion',(int)$ubicacion['id']);
  if($delete_id){
      $session->msg("s","Ubicacion eliminada");
      redirect('add_ubicacion.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('add_ubicacion.php');
  }
?>