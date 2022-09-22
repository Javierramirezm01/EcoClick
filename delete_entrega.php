<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $entrega = find_by_id('entregamateriales',(int)$_GET['id']);
  if(!$entrega){
    $session->msg("d","ID de la entrega falta.");
    redirect('adminentregas.php');
  }
?>
<?php
  $delete_id = delete_by_id('entregamateriales',(int)$entrega['id']);
  if($delete_id){
      $session->msg("s","Entrega eliminada");
      redirect('adminentregas.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('adminentregas.php');
  }
?>