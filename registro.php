<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.ico">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/registro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Registro</title>
</head>
<body>
    <?php
        include 'menu.php';
    ?>
    <div id="right-side">
      <div id="panel-login">
        <h2>Registro</h2>
        <form id="formulario" action="insertUsuario.php" method="post">
          <div class="grupoFormulario">
            <label for="name">Usuario</label>
            <input type="text" id="user" name="user"/><p id="mensajeErrorUsuario"></p>
          </div>
          <div class="grupoFormulario">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password"/><p class="mensajeErrorPassword"></p>
          </div>
          <div class="grupoFormulario">
            <label for="repassword">Repetir Contraseña</label>
            <input type="password" id="repassword" name="repassword"/><p class="mensajeErrorPassword"></p>
          </div>
          <div class="grupoFormulario">
            <label for="email">Email</label>
            <input type="text" id="email" name="email"/><p id="mensajeErrorEmail"></p>
          </div>
          <div class="grupoFormulario">
            <label for="enviar"></label>
            <input type="submit" id="enviar" value="Enviar"/>
          </div>
        </form>
      </div>
    </div>
    <script src="js/jquery-3.7.0.js"></script>
    <script src="js/register.js"></script>
</body>
</html>
