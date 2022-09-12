<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $residuo = find_by_id('residuos',(int)$_GET['id']);
  if(!$residuo){
    $session->msg("d","ID del residuo falta.");
    redirect('add_residuo.php');
  }
?>
<?php
  $delete_id = delete_by_id('residuos',(int)$residuo['id']);
  if($delete_id){
      $session->msg("s","Residuo eliminada");
      redirect('add_residuo.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('add_residuo.php');
  }
?>