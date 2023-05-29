$(document).ready(function() {
        
    $("#ver-button").css("background-color", "#FFA73F");

    var opcionPanel = "ver";
	cargarPreguntas();
	var preguntaInsertada = false;
	var preguntaInsertadaDos = false;

    //  DETECTAR EL CLICK EN LOS BOTONES DEL PANEL
    $("#ver-button").click(function() {
        opcionPanel = "ver";
        cambiarPanel('panel-preguntas');
        cargarPreguntas();
        cambiarColores();
    });

    $("#add-button").click(function() {
        opcionPanel = "add";
        cambiarPanel('nuevaPregunta');
        cargarPreguntas();
        cambiarColores();
    });

    $("#edit-button").click(function() {
        opcionPanel = "edit";
		cambiarPanel('panel-preguntas');
        cargarPreguntas();
        cambiarColores();
    });

    $("#del-button").click(function() {
        opcionPanel = "del";
        cambiarPanel('panel-preguntas');
        cargarPreguntas();
        cambiarColores();
    });

	// DETECTAR EL CLICK EN LA PREGUNTA 
	$(document).on("click", ".pregunta", function() {
		let id = $(this).children(".id-preg").text();
		if (opcionPanel == "ver") {
			cambiarPanel('verPregunta');
			llenarPanel(id);
		} else if (opcionPanel == "edit") {
			cambiarPanel('editPregunta');
			mostrarEdit(id);
		} else if (opcionPanel == "del") {
			cambiarPanel('delPregunta');
			confirmarDel(id);
		}
		
	});

	// DETECTAR EL CLICK EN LOS BOTONES VOLVER 
	$(document).on("click", "#btn-ver-volver", function() {
		cambiarPanel('panel-preguntas');
	});
	
	$(document).on("click", "#btn-del-volver", function() {
		cambiarPanel('panel-preguntas');
	});

	$(document).on("click", "#cancelar-edit", function() {
		cambiarPanel('panel-preguntas');
	});

	// CANCELAR EL SUBMIT EN LA CREACION DE LA PREGUNTA
	$("#crear-pregunta").submit(function(e) {
		if (!preguntaInsertada) {
			crearPregunta(this);
			e.preventDefault();
		}
	});

	// CANCELAR EL SUBMIT EN LA EDICION DE LA PREGUNTA
	$(document).on("submit", "#edit-pregunta", function(e) {
		if (!preguntaInsertadaDos) {
			editPregunta(this);
			e.preventDefault();
		}
	});

	// CLICK PARA ELIMINAR UNA PREGUNTA
	$(document).on("click", "#del-preg", function() {
		let id = $(this).parent().siblings("#id-del").text();
		$.ajax ({
            url: 'http://192.168.0.136:7070/api/preguntas/' + id,
            type: 'DELETE',
            success: function() {
				cargarPreguntas();
				cambiarPanel("panel-preguntas");
            }, 
            error: function(err) {
                console.log(err);
            }
        });
	});

	// RELLENA EL SELECT DEL FILTRO CON TODAS LAS CATEGORIAS
	/*$.ajax ({
		url: 'http://192.168.245.128:7070/api/preguntas/categorias',
		type: 'GET',
		dataType: 'json',
		success: function(response) {
			console.log(response);
		}, 
		error: function(err) {
			console.log(err);
		}
	});*/

	$("#btn-filtro").click(function() {

	});

	//FUNCION PARA RELLENAR LA CONFIRMACION DEL DELETE
	function confirmarDel(id) {
		$.ajax ({
            url: 'http://192.168.0.136:7070/api/preguntas/' + id,
            type: 'GET',
            success: function(response) {
                var pregunta = response["data"];

				let html = '<h1>¿Estas seguro que deseas eliminar esta pregunta?</h1>'+
				'<h2 id="id-del" hidden>'+pregunta["_id"]+'</h2>'+
				'<h2>Título: '+pregunta["titulo"]+'</h2>'+
				'<h2>Categoría: '+pregunta["categoria"]+'</h2>'+
				'<img src="imagesPreg/'+pregunta["imagenPregunta"]+'">'+
				'<div id="botones-del">'+
				'<button id="del-preg">Eliminar</button>'+
				'<button id="btn-del-volver">Cancelar</button>'+
				'</div>';
				$("#container-del").html(html);

            }, 
            error: function(err) {
                console.log(err);
            }
        });
	}

	// FUNCION PARA RELLENAR LA EDICION UNA PREGUNTA
	function mostrarEdit(id) {
		
		$.ajax ({
            url: 'http://192.168.0.136:7070/api/preguntas/' + id,
            type: 'GET',
            success: function(response) {
                var pregunta = response["data"];

				let html = '<form id="edit-pregunta" action="actions/crearNoticia.php" method="post" enctype="multipart/form-data">'+
				'<p id="id_edit" hidden>'+pregunta["_id"]+'</p>'+
				'<h3>Título</h3>'+
				'<input type="text" id="edit-titulo" name="edit-titulo" value="'+pregunta["titulo"]+'">'+
				'<h3>Categoría</h3>'+
				'<input type="text" id="edit-categoria" name="edit-categoria" value="'+pregunta["categoria"]+'">'+
				'<h3>Imagen</h3>'+
				'<input type="file" id="upload-image1" name="upload-image1" accept="image/*">'+
				'<h3>Repuesta correcta</h3>'+
				'<div class="edit-resp">'+
					'<textarea name="edit-resp1" class="resp-correcta-edit" id="edit-resp1" cols="118" rows="4">'+pregunta["respuestas"][0]["titulo"]+'</textarea>'+
				'</div>'+
				'<div class="titulo-edit-resp"><h3>Repuesta 2</h3><h3>Explicación 2</h3></div>'+
				'<div class="edit-resp">'+
					'<textarea name="edit-resp2" class="resp-normal-edit" id="edit-resp2" cols="55" rows="4">'+pregunta["respuestas"][1]["titulo"]+'</textarea>'+
					'<textarea name="edit-exp2" class="resp-normal-edit" id="edit-exp2" cols="55" rows="4">'+pregunta["respuestas"][1]["explicacion"]+'</textarea>'+
				'</div>'+
				'<div class="titulo-edit-resp"><h3>Repuesta 3</h3><h3>Explicación 3</h3></div>'+
				'<div class="edit-resp">'+
					'<textarea name="edit-resp3" class="resp-normal-edit" id="edit-resp3" cols="55" rows="4">'+pregunta["respuestas"][2]["titulo"]+'</textarea>'+
					'<textarea name="edit-exp3" class="resp-normal-edit" id="edit-exp3" cols="55" rows="4">'+pregunta["respuestas"][2]["explicacion"]+'</textarea>'+
				'</div>'+
				'<div class="titulo-edit-resp"><h3>Repuesta 4</h3><h3>Explicación 4</h3></div>'+
				'<div class="edit-resp">'+
					'<textarea name="edit-resp4" class="resp-normal-edit" id="edit-resp4" cols="55" rows="4">'+pregunta["respuestas"][3]["titulo"]+'</textarea>'+
					'<textarea name="edit-exp4" class="resp-normal-edit" id="edit-exp4" cols="55" rows="4">'+pregunta["respuestas"][3]["explicacion"]+'</textarea>'+
				'</div>'+
				'<div id="botones-del">'+
				'<input id="btn-edit-preg" type="submit" value="Confirmar">'+
				'<h3 id="cancelar-edit">Cancelar<h3>'+
				'</div>';
				'</form>';

				$("#container-edit").html(html);

            }, 
            error: function(err) {
                console.log(err);
            }
        });
	}

	// FUNCION QUE EDITA UNA PREGUNTA 
	function editPregunta(e) {

		let id = $(e).children("#id_edit").text();
		let titulo = $("#edit-titulo").val();
		let categoria = $("#edit-categoria").val();
		let imagenPregunta = $("#upload-image1").val().substring(12);
		let resp1 = $("#edit-resp1").val();
		let resp2 = $("#edit-resp2").val();
		let exp2 = $("#edit-exp2").val();
		let resp3 = $("#edit-resp3").val();
		let exp3 = $("#edit-exp3").val();
		let resp4 = $("#edit-resp4").val();
		let exp4 = $("#edit-exp4").val();

		if (titulo.length > 0) {
			let pregunta = {
				"titulo": titulo,
				"categoria": categoria,
				"imagenPregunta": imagenPregunta,
				"respuestas": [
					{
						"titulo": resp1,
						"correcto": true
					},
					{
						"titulo": resp2,
						"explicacion": exp2,
						"correcto": true
					},
					{
						"titulo": resp3,
						"explicacion": exp3,
						"correcto": true
					},
					{
						"titulo": resp4,
						"explicacion": exp4,
						"correcto": true
					}
				]
			};

			$.ajax ({
				url: 'http://192.168.0.136:7070/api/preguntas/' + id,
				type: 'PUT',
				data: pregunta,
				success: function() {
					preguntaInsertadaDos = true;
					e.submit();
				}, 
				error: function(err) {
					console.log(err);
				}
			});
		}
	}

	// FUNCION QUE CREA UNA PREGUNTA 
	function crearPregunta(e) {

		let titulo = $("#add-titulo").val();
		let categoria = $("#add-categoria").val();
		let imagenPregunta = $("#upload-image").val().substring(12);
		let resp1 = $("#add-resp1").val();
		let resp2 = $("#add-resp2").val();
		let exp2 = $("#add-exp2").val();
		let resp3 = $("#add-resp3").val();
		let exp3 = $("#add-exp3").val();
		let resp4 = $("#add-resp4").val();
		let exp4 = $("#add-exp4").val();

		if (titulo.length > 0) {
			let pregunta = {
				"titulo": titulo,
				"categoria": categoria,
				"imagenPregunta": imagenPregunta,
				"respuestas": [
					{
						"titulo": resp1,
						"correcto": true
					},
					{
						"titulo": resp2,
						"explicacion": exp2,
						"correcto": true
					},
					{
						"titulo": resp3,
						"explicacion": exp3,
						"correcto": true
					},
					{
						"titulo": resp4,
						"explicacion": exp4,
						"correcto": true
					}
				]
			};

			$.post("http://192.168.0.136:7070/api/preguntas", pregunta, function() {
				preguntaInsertada = true;
				e.submit();
			});
		}
	}

    // FUNCION QUE CAMBIA LOS COLORES DE LOS BOTONES CORRESPONDIENTEMENTE
    function cambiarColores() {
        if(opcionPanel == "ver") {
            $("#ver-button").css("background-color", "#FFA73F");

            $("#add-button").css("background-color", "#E3E3E3");
            $("#edit-button").css("background-color", "#E3E3E3");
            $("#del-button").css("background-color", "#E3E3E3");
        } else if(opcionPanel == "add") {
            $("#add-button").css("background-color", "#FFA73F");

            $("#ver-button").css("background-color", "#E3E3E3");
            $("#edit-button").css("background-color", "#E3E3E3");
            $("#del-button").css("background-color", "#E3E3E3");
        } else if(opcionPanel == "edit") {
            $("#edit-button").css("background-color", "#FFA73F");

            $("#ver-button").css("background-color", "#E3E3E3");
            $("#add-button").css("background-color", "#E3E3E3");
            $("#del-button").css("background-color", "#E3E3E3");
        } else if(opcionPanel == "del") {
            $("#del-button").css("background-color", "#FFA73F");

            $("#ver-button").css("background-color", "#E3E3E3");
            $("#add-button").css("background-color", "#E3E3E3");
            $("#edit-button").css("background-color", "#E3E3E3");
        }
    }

    // FUNCION PARA CARGAR LAS PREGUNTAS
    function cargarPreguntas() {

        $.ajax ({
            url: 'http://192.168.0.136:7070/api/preguntas',
            type: 'GET',
            success: function(response) {
                var preguntas = response["data"];
                cargarModoPregunta(preguntas);
            }, 
            error: function(err) {
                console.log(err);
            }
        });
    }

    // MODO VISUALIZAR
    function cargarModoPregunta(preguntas) {

        var htmlInsertado = "";

        if(opcionPanel == "ver") {
            for(var i = 0; i < preguntas.length; i++) {
                htmlInsertado += "" +
                '<div class="pregunta ver">' +
                '<img src="imagesPreg/'+preguntas[i]["imagenPregunta"]+'">' +
                '<div class="texto-pregunta">' +
                    '<div class="divisor-vertical-alt"></div>' +
                    '<p>'+preguntas[i]["titulo"]+'</p>' +
                '</div>' +
				'<div class="cat-pregunta">' +
                    '<div class="divisor-vertical-alt"></div>' +
                    '<p>'+preguntas[i]["categoria"]+'</p>' +
                '</div>' +
				'<p hidden class="id-preg">'+preguntas[i]["_id"]+'</p>' +
            '</div>';
            }
        } else if(opcionPanel == "edit") {
            for(var i = 0; i < preguntas.length; i++) {
                htmlInsertado += "" +
                '<div class="pregunta edit">' +
                '<img src="imagesPreg/'+preguntas[i]["imagenPregunta"]+'">' +
                '<div class="texto-pregunta">' +
                    '<div class="divisor-vertical-alt"></div>' +
                    '<p>'+preguntas[i]["titulo"]+'</p>' +
                '</div>' +
				'<div class="cat-pregunta">' +
                    '<div class="divisor-vertical-alt"></div>' +
                    '<p>'+preguntas[i]["categoria"]+'</p>' +
                '</div>' +
				'<p hidden class="id-preg">'+preguntas[i]["_id"]+'</p>' +
            '</div>';
            }
        } else if(opcionPanel == "del") {
            for(var i = 0; i < preguntas.length; i++) {
                htmlInsertado += "" +
                '<div class="pregunta del">' +
                '<img src="imagesPreg/'+preguntas[i]["imagenPregunta"]+'">' +
                '<div class="texto-pregunta">' +
                    '<div class="divisor-vertical-alt"></div>' +
                    '<p>'+preguntas[i]["titulo"]+'</p>' +
                '</div>' +
				'<div class="cat-pregunta">' +
                    '<div class="divisor-vertical-alt"></div>' +
                    '<p>'+preguntas[i]["categoria"]+'</p>' +
                '</div>' +
				'<p hidden class="id-preg">'+preguntas[i]["_id"]+'</p>' +
            '</div>';
            }
        }

        $("#panel-preguntas").html(htmlInsertado);
    }

    // CAMBIAR EL PANEL ACTUAL
    function cambiarPanel(current) {
        let paneles = $('.paneles');
        for (let i = 0; i < paneles.length; i++) {
            paneles[i].style.display = 'none';  
        }
        document.getElementById(current).style.display = 'block'
    }

	// LLENAR CADA PANEL CON LA PREGUNTA CORRESPONDIENTE
	function llenarPanel(id) {
		if(opcionPanel == "ver") {
			$.ajax ({
				url: 'http://192.168.0.136:7070/api/preguntas/' + id,
				type: 'GET',
				success: function(response) {
					var pregunta = response["data"];
					console.log(pregunta);

					let html = '<button id="btn-ver-volver">Volver</button>';
					
					html += '<img src="imagesPreg/'+pregunta["imagenPregunta"]+'">'+
					'<h2>Titulo: '+pregunta["titulo"]+'</h2>'+
					'<h2>Categoria: '+pregunta["categoria"]+'</h2>'+
					'<div class="respuestas-ver">'+
					'<div class="titulos-ver">'+
					'<h3>Respuesta 1 - Correcta</h3>'+
					'</div>'+
					'<div class="resp">'+
						'<p>'+pregunta["respuestas"][0]["titulo"]+'</p>'+
					'</div>'+
					'</div>';

					for (let i = 1; i < 4; i++) {
						html += '<div class="respuestas-ver">'+
						'<div class="titulos-ver">'+
						'<h3>Respuesta 1</h3>'+
						'<h3>Explicacion 1</h3>'+
						'</div>'+
						'<div class="resp">'+
							'<p>'+pregunta["respuestas"][i]["titulo"]+'</p>'+
						'</div>'+
						'<div class="divisor-vertical"></div>'+
						'<div class="exp">'+
							'<p>'+pregunta["respuestas"][i]["explicacion"]+'</p>'+
						'</div>'+
						'</div>';
					}
					
					html += '</div>';

					$("#container-ver").html(html);

				}, 
				error: function(err) {
					console.log(err);
				}
			});
		}
	}
})