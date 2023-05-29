<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.ico">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/perfilUsuario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Perfil de Usuario</title>
</head>
<body>
    <?php
        include 'menu.php';
        session_start();
        if(!isset($_SESSION["user"]))
        {
          header('location: login.php');
        }
    ?>
    <div id="right-side">
      <div id="panel-login">
        <h2>Perfil de Usuario</h2>
        <?php
          include 'bbdd.php';
          $usuario = getUsuario($_SESSION['user']);
        ?>
        <form id="formulario" action="deleteUsuario.php" method="post">
          <div class="grupoFormulario">
            <?php
              echo '<label>Usuario: '.$usuario['usuario'].'</label>';
              echo '<input type="hidden" id="idUsuario" name="idUsuario" value="'.$usuario['id_usuario'].'"/>';
            ?>
          </div>
          <div class="grupoFormulario">
            <?php
              echo '<label>Email: '.$usuario['email'].'</label>';
            ?>
          </div>
          <div class="grupoFormulario">
            <label for="modificar"></label>
            <input type="submit" id="modificar" name="modificar" value="Modificar"/>
            <label for="modificar"></label>
            <input type="submit" id="modificar" name="modificar" value="Eliminar"/>
          </div>
        </form>
      </div>
    </div>
</body>
</html>
