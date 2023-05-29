<?php
  function connectBBDD(){

    $conexion = new mysqli("192.168.0.137", "equipo404", "Almi123", "PhotoPlay");

    if($conexion->connect_errno){
      echo "Fallo en la conexión: ".$conexion->connect_errno;
    }
    return $conexion;
  }

  function login($user, $password)
  {
    $conexion = connectBBDD();
    $sql = "SELECT id_usuario FROM Usuario WHERE nombre = ? AND password = ?";

    $resultado = $conexion->prepare($sql);
    if(!$resultado)
    {
      echo "Fallo al preparar la consulta".$conexion->errno;
    }

    $unir = $resultado->bind_param("ss", $user, $password);
    if(!$unir)
    {
      "Fallo al unir parámetros: ".$conexion->errno;
    }

    $ejecucion = $resultado->execute();
    if(!$ejecucion)
    {
      echo "Fallo al ejecutar la consulta: ".$conexion->errno;
    }

    $usuario = "";
    $pass = "";

    $asociar = $resultado->bind_result($id_usuario);
    if(!$asociar)
    {
      echo "Fallo al asociar los parámetros: ".$conexion->errno;
    }

    if($resultado->fetch())
    {

    }

    $resultado->close();
    $conexion->close();

    return $id_usuario;
  }

  function insertarUsuario($usuario, $password, $email){

      $conexion = connectBBDD();
      $sql = "INSERT INTO Usuario(nombre, password, email) VALUES (?, ?, ?)";

      $resultado = $conexion->prepare($sql);
      if(!$resultado)
      {
        echo "Fallo al preparar la consulta".$conexion->errno;
      }

      $unir = $resultado->bind_param("sss", $usuario, $password, $email);
      if(!$unir)
      {
        "Fallo al unir parámetros: ".$conexion->errno;
      }

      $ejecutar = $resultado->execute();
      if(!$ejecutar){
        echo "Fallo al ejecutar la consulta".$conexion->errno;
      }

      $resultado->close();
      $conexion->close();

      return $ejecutar;
    }

    function getUsuario($usuario){

      $conexion = connectBBDD();
      $sql = "SELECT * FROM Usuario WHERE nombre = ?";

      $resultado = $conexion->prepare($sql);
      if(!$resultado)
      {
        echo "Fallo al preparar la consulta".$conexion->errno;
      }

      $unir = $resultado->bind_param("s", $usuario);
      if(!$unir)
      {
        "Fallo al unir parámetros: ".$conexion->errno;
      }

      $ejecutar = $resultado->execute();
      if(!$ejecutar){
        echo "Fallo al ejecutar la consulta".$conexion->errno;
      }

      $id_usuario = -1;
      $usuario = "";
      $password = "";
      $email = "";
      $asociar = $resultado->bind_result($id_usuario, $usuario, $password, $email);
      if(!$asociar){
        echo "Fallo al asociar los resultados".$conexion->errno;
      }

      if($resultado->fetch()){
        $usu = array(
          'id_usuario' => $id_usuario,
          'usuario' => $usuario,
          'password' => $password,
          'email' => $email
        );
      }

      $resultado->close();
      $conexion->close();

      return $usu;
    }

    function eliminarUsuario($id_usuario){

      $conexion = connectBBDD();
      $sql = "DELETE FROM Usuario WHERE id_usuario = ?";

      $resultado = $conexion->prepare($sql);
      if(!$resultado)
      {
        echo "Fallo al preparar la consulta".$conexion->errno;
      }

      $unir = $resultado->bind_param("i", $id_usuario);
      if(!$unir)
      {
        "Fallo al unir parámetros: ".$conexion->errno;
      }

      $ejecutar = $resultado->execute();
      if(!$ejecutar){
        echo "Fallo al ejecutar la consulta".$conexion->errno;
      }

      $resultado->close();
      $conexion->close();

      return $ejecutar;
    }

    function modificarUsuario($id_usuario, $password, $email){

      $conexion = connectBBDD();
      $sql = "UPDATE Usuario SET password=?, email=? WHERE id_usuario=?";

      $resultado = $conexion->prepare($sql);
      if(!$resultado)
      {
        echo "Fallo al preparar la consulta".$conexion->errno;
      }

      $unir = $resultado->bind_param("ssi", $password, $email, $id_usuario);
      if(!$unir)
      {
        "Fallo al unir parámetros: ".$conexion->errno;
      }

      $ejecutar = $resultado->execute();
      if(!$ejecutar){
        echo "Fallo al ejecutar la consulta".$conexion->errno;
      }

      $resultado->close();
      $conexion->close();

      return $ejecutar;
    }

?>
