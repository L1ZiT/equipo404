$(document).ready(function()
{
  $("#ver").click(function()
  {
    if($("#pagina").css("display") == "none") {
      /*$("#pagina").fadeIn(2000);
      $("#pagina").css("display", "block");*/
      $("#ver").text("Ocultar");
      $("#pagina").fadeIn( "slow", function() {
        $("#pagina").css("display", "block");
      });
    } else {
      $("#pagina").fadeOut( "slow", function() {
        $("#pagina").css("display", "none");
        $("#ver").text("Descubre nuestro trabajo más reciente");
      });
    }
    
  });
});
