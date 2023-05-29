<?php
  /*header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  header("Allow: GET, POST, OPTIONS, PUT, DELETE");
  $method = $_SERVER['REQUEST_METHOD'];
  if($method == "OPTIONS") {
      die();
  }*/
  //if(isset($_SERVER['HTTP_ORIGIN']))
  //{
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 86400");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
  //}



  /*if($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
  {
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    {
      header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS");
    }
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
    {
      header("Access_Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
      exit(0);
    }
  }*/

  header('Content-Type: application/JSON');

  $function = $_POST['function'];
  include_once('bbdd.php');

  if($function == "usuarios")
  {
    $usuario = getUsuario($_POST['varUsuario']);
    //para fabricar el JSON
    $usuarioJSON = json_encode($usuario, JSON_UNESCAPED_UNICODE); //casting a JSON
    echo $usuarioJSON; //se imprime en la pagina
    //y de aqui va a generos.js a succes o a error
  }

  if($function == "loguear")
  {
    $usuario = getUsuario($_POST['varUsuario']);
    //para fabricar el JSON
    $usuarioJSON = json_encode($usuario, JSON_UNESCAPED_UNICODE); //casting a JSON
    echo $usuarioJSON; //se imprime en la pagina
    //y de aqui va a generos.js a succes o a error
  }

  if($function == "validarPassword")
  {
    $usuario = getUsuario($_POST['varUsuario']);
    //para fabricar el JSON
    $usuarioJSON = json_encode($usuario, JSON_UNESCAPED_UNICODE); //casting a JSON
    echo $usuarioJSON; //se imprime en la pagina
    //y de aqui va a generos.js a succes o a error
  }

?>
