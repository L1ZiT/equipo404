$(document).ready(function()
{
  $('#formulario').submit(function(event)
  {
      var pass = $('#password').val();

      event.preventDefault();
      var usu = $("#user").val();
      if(pass != "")
      {
      $.ajax(
          {
            data:{varUsuario: usu, function:"validarPassword"},
            url:'http://192.168.0.138/PhotoPlay/servicios.php',
            type:'post',
            success:function(response)
            {
              console.log(response);
              var usuarioEncontrado = $.parseJSON(response);

              if(pass != usuarioEncontrado.password){
                $(".mensajeErrorPassword").text("Contraseña no encontrada");
                $("#password").css({border: "solid 3px red"});
              }else{
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
