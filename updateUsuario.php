<?php
  session_start();

  include_once('bbdd.php');

  $modificado = modificarUsuario($_POST['idUsuario'], $_POST['repassword'], $_POST['email']);
  if($modificado){
    header("location: index.php");
  }else{
    header("location: modificarUsuario.php");
  }
 ?>
