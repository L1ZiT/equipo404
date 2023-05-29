$(document).ready(function()
{
  $('#formulario').submit(function(event)
  {
      event.preventDefault();
      var usu = $("#user").val();
      var pass = $("#password").val();
      if(usu != "" && pass != "")
      {
      $.ajax(
          {
            data:{varUsuario: usu, function:"loguear"},
            url:'http://192.168.0.138/PhotoPlay/servicios.php',
            type:'post',
            success:function(response)
            {
              console.log(response);
              var usuarioEncontrado = $.parseJSON(response);

              if(usuarioEncontrado == null || usuarioEncontrado.password != pass){
                $("#mensajeError").text("Usuario o contraseña no encontrado");
                $("#user").css({border: "solid 3px red"});
                $("#password").css({border: "solid 3px red"});
              }
              if(usuarioEncontrado != null && usuarioEncontrado.password == pass){
                $('#formulario').off('submit').submit();
              }

            },
            error:function(error)
            {
              console.log(error);
            }
          }
        );
      }
  });
});
