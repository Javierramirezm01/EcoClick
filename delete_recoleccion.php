<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $recoleccion = find_by_id('recoleccionresiduos',(int)$_GET['id']);
  if(!$recoleccion){
    $session->msg("d","ID vacío");
    redirect('adminrecoleccion.php');
  }
?>
<?php
  $delete_id = delete_by_id('recoleccionresiduos',(int)$recoleccion['id']);
  if($delete_id){
      $session->msg("s","Recoleccion eliminada");
      redirect('adminrecoleccion.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('adminrecoleccion.php');
  }
?>