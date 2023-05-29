<?php
  session_start();

  include_once('bbdd.php');

  if($_POST["modificar"] == Eliminar){
    unset($_SESSION['user']);
    $eliminado = eliminarUsuario($_POST["idUsuario"]);
    if($eliminado){
      header("location: index.php");
    }else{
      header("location: perfilUsuario.php");
    }
  }else if($_POST["modificar"] == Modificar){
    header("location: modificarUsuario.php");
  }

 ?>
