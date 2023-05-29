<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.ico">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/modificarUsuario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Modificar</title>
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
        <h2>Modificar</h2>
        <?php
          include 'bbdd.php';
          $usuario = getUsuario($_SESSION['user']);
        ?>
        <form id="formulario" action="updateUsuario.php" method="post">
          <div class="grupoFormulario">
            <?php
              echo '<label>Usuario: '.$usuario['usuario'].'</label>';
              echo '<input type="hidden" id="idUsuario" name="idUsuario" value="'.$usuario['id_usuario'].'"/>';
              echo '<input type="hidden" id="user" name="user" value="'.$usuario['usuario'].'"/>';
            ?>
          </div>
          <div class="grupoFormulario">
            <label for="password">Antigua Contraseña</label>
            <input type="password" id="password" name="password"/><p class="mensajeErrorPassword"></p>
          </div>
          <div class="grupoFormulario">
            <label for="repassword">Nueva Contraseña</label>
            <input type="password" id="repassword" name="repassword"/>
          </div>
          <div class="grupoFormulario">
            <label for="email">Email</label>
            <?php
              echo '<input type="text" id="email" name="email" value="'.$usuario['email'].'"/>';
            ?>
          </div>
          <div class="grupoFormulario">
            <label for="enviar"></label>
            <input type="submit" id="enviar" value="Enviar"/>
          </div>
        </form>
      </div>
    </div>
    <script src="js/jquery-3.7.0.js"></script>
    <script src="js/modificar.js"></script>
</body>
</html>
