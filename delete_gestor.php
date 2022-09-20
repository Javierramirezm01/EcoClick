<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $gestor = find_by_id('gestores',(int)$_GET['id']);
  if(!$gestor){
    $session->msg("d","ID vacío");
    redirect('add_gestor.php');
  }
?>
<?php
  $delete_id = delete_by_id('gestores',(int)$gestor['id']);
  if($delete_id){
      $session->msg("s","Gestor eliminado");
      redirect('add_gestor.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('add_gestor.php');
  }
?>