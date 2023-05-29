<?php
  session_start();

  $user = $_POST['user'];
  $password = $_POST['password'];

  include 'bbdd.php';

  if($user!="" && $password!=""){
      $id_usuario = login($user, $password);
  }

  if($id_usuario){
    header("location: index.php");
    $_SESSION['user'] = $user;
    $_SESSION['id_usuario'] = $id_usuario;
  }else{
    header("location: login.php");
  }
 ?>
