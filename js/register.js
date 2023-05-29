$(document).ready(function()
{
  $('#formulario').submit(function(event)
  {
      //Contraseñas no repetidas
      var falloPassword = false;
      if($('#password').val()!=$('#repassword').val()){
        falloPassword = true;
      }

      //Email no valido
      var email = $("#email").val();
      var indice = email.indexOf("@");
      var correcto = false;
      if(indice >= 1){
        var indicePunto = email.indexOf(".");
        if(indicePunto >= indice+2){
          correcto = true;
        }
      }

      event.preventDefault();
      var usu = $("#user").val();
      if(usu != "")
      {
      $.ajax(
          {
            data:{varUsuario: usu, function:"usuarios"},
            url:'http://192.168.0.138/PhotoPlay/servicios.php',
            type:'post',
            success:function(response)
            {
              console.log(response);
              var usuarioEncontrado = $.parseJSON(response);

              if(falloPassword == true){
                $(".mensajeErrorPassword").text("Las contraseñas no coinciden");
                $("#password").css({border: "solid 3px red"});
                $("#repassword").css({border: "solid 3px red"});
              }else{
                $(".mensajeErrorPassword").text("");
                $("#password").css({border: "solid 3px green"});
                $("#repassword").css({border: "solid 3px green"});
              }
              if(correcto == false){
                $("#mensajeErrorEmail").text("El formato de email no es correcto (Ej.: a@a.com)");
                $("#email").css({border: "solid 3px red"});
              }else{
                $("#mensajeErrorEmail").text("");
                $("#email").css({border: "solid 3px green"});
              }
              if(usuarioEncontrado != null){
                $("#mensajeErrorUsuario").text("El nombre de Usuario ya existe");
                $("#user").css({border: "solid 3px red"});
              }else{
                $("#mensajeErrorUsuario").text("");
                $("#user").css({border: "solid 3px green"});
              }
              if(falloPassword == false && correcto == true && usuarioEncontrado == null){
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
