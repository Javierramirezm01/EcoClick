<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $solicitud = find_by_id('solicitudes',(int)$_GET['id']);
  if(!$solicitud){
    $session->msg("d","ID de la solicitud falta.");
    redirect('solicitudes.php');
  }
?>
<?php
  $delete_id = delete_by_id('solicitudes',(int)$solicitud['id']);
  if($delete_id){
      $session->msg("s","Solicitud eliminada");
      redirect('solicitudes.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('solicitudes.php');
  }
?>