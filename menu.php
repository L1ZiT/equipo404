<div id="top-menu">
        <div id="left-menu" class="menu-side">
			<img id="seguridad-frank" src="images/logo.png" style="height:55px; width: auto;">
            <?php
                if(strpos($_SERVER['REQUEST_URI'], "index") !== false) {
                    echo '<button class="menu-button active">';
                    echo '<a href="index.php">Inicio</a>';
                    echo '</button>';
                } else {
                    echo '<button class="menu-button">';
                    echo '<a href="index.php">Inicio</a>';
                    echo '</button>';
                }

		session_start();  //cambio Iraitz

                if(isset($_SESSION["user"])){ //cambio Iraitz
                  if(strpos($_SERVER['REQUEST_URI'], "preguntas") !== false) {
                      echo '<button class="menu-button active">';
                      echo '<a href="preguntas.php">Panel de preguntas</a>';
                      echo '</button>';
                  } else {
                      echo '<button class="menu-button">';
                      echo '<a href="preguntas.php">Panel de preguntas</a>';
                      echo '</button>';
                  }
                }
            ?>
        </div>
        <div id="right-menu" class="menu-side">
            <?php
            if(!isset($_SESSION["user"])){
              echo '<button class="menu-button login"><a href="login.php">Iniciar sesión</a></button>';
              echo '<button class="menu-button login"><a href="registro.php">Registro</a></button>';
            }else{
              echo '<button class="menu-button login"><a href="perfilUsuario.php">Tu perfil</a></button>';
              echo '<button class="menu-button login"><a href="cerrarSesion.php">Cerrar sesión</a></button>';
            }
          ?>
        </div>
    </div>
</div>