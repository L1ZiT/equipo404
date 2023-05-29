<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.ico">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/preguntas.css">
	<link rel="stylesheet" href="style/verPregunta.css">
	<link rel="stylesheet" href="style/addPregunta.css">
	<link rel="stylesheet" href="style/editPregunta.css">
	<link rel="stylesheet" href="style/delPregunta.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Preguntas</title>
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
    <div id="content"> 
    <div id="left-side">
        <div id="panel">
            <button class="panel-button" id="ver-button">
                <img src="images/eye-fill.svg" alt="Icono de borrar">
            </button>
            <button class="panel-button" id="add-button">
                <img src="images/plus-circle-fill.svg" alt="Icono de añadir">
            </button>
            <button class="panel-button" id="edit-button">
                <img src="images/pencil-fill.svg" alt="Icono de editar">
            </button>
            <button class="panel-button" id="del-button">
                <img src="images/trash-fill.svg" alt="Icono de borrar">
            </button>
        </div>
    </div>
	<!--<div id="middle-side">
		<div id="panel-filtro">
			<div id="interior-panel">
				<h2>Filtros:</h2>
				<div id="filtros-container">
					<h3>Categoría:</h3>
					<select name="categoria" id="categoria">
						<option value="FOL">FOL</option>
						<option value="Inglés">Inglés</option>
					</select>
					<button id="btn-filtro">Buscar</button>
				</div>
			</div>
        </div>
    </div>-->
    <div id="right-side">
        <div id="panel-preguntas" class="paneles"></div>
		<div id="verPregunta" class="paneles">
            <div id="container-ver"></div>
        </div>
        <div id="nuevaPregunta" class="paneles">
		<div id="container-add">
			<form id="crear-pregunta" action="actions/crearNoticia.php" method="post" enctype="multipart/form-data">
				<input type="text" id="add-titulo" name="add-titulo" placeholder="Titulo">
				<input type="text" id="add-categoria" name="add-categoria" placeholder="Categoria">
				<input type="file" id="upload-image" name="upload-image" accept="image/*">
				<div class="add-resp">
					<textarea name="add-resp1" class="resp-correcta" id="add-resp1" cols="118" rows="4" placeholder="Respuesta correcta"></textarea>
				</div>
				<div class="add-resp">
					<textarea name="add-resp2" class="resp-normal" id="add-resp2" cols="55" rows="4" placeholder="Respuesta 2"></textarea>
					<textarea name="add-exp2" class="resp-normal" id="add-exp2" cols="55" rows="4" placeholder="Explicación 2"></textarea>
				</div>
				<div class="add-resp">
					<textarea name="add-resp3" class="resp-normal" id="add-resp3" cols="55" rows="4" placeholder="Respuesta 3"></textarea>
					<textarea name="add-exp3" class="resp-normal" id="add-exp3" cols="55" rows="4" placeholder="Explicación 3"></textarea>
				</div>
				<div class="add-resp">
					<textarea name="add-resp4" class="resp-normal" id="add-resp4" cols="55" rows="4" placeholder="Respuesta 4"></textarea>
					<textarea name="add-exp4" class="resp-normal" id="add-exp4" cols="55" rows="4" placeholder="Explicación 4"></textarea>
				</div>
				<input id="btn-crear-preg" type="submit" value="Crear pregunta">
			</form>
		</div>
        </div>
        <div id="editPregunta" class="paneles">
			<div id="container-edit">
			</div>
        </div>
		<div id="delPregunta" class="paneles">
			<div id="container-del">
			</div>
        </div>
    </div>
    </div>
    <script src="js/jquery-3.7.0.js"></script>
    <script src="js/panelPreguntas.js"></script>
</body>
</html>