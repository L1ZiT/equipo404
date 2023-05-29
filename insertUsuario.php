<?php
  include_once('bbdd.php');

  $funciona = insertarUsuario($_POST['user'], $_POST['password'], $_POST['email']);
  if($funciona)
  {
    header('location: login.php');
  } else
  {
    header('location: registro.php');
  }
 ?>
