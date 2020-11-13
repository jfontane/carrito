<?php
include("php/conexion.php");
include 'carrito.php';
$cart = new Cart;
$paginaActivo='ingresar';
$targetUrl=!isset($_GET['target'])?NULL:$_GET['target'];
if ($targetUrl=="") $targetUrl="index";
$paginaActiva='ingresar';


?>
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>El Original Online</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet" />
</style>

</head>

<body>
  <?php
  include('nav.php');
  ?>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col">
        <div class="modal-dialog">
          <div class="modal-content">

            <form name="formLogin" id="formLogin">

              <div class="modal-header">
                <h4 class="modal-title">Login</h4>
              </div>

              <div class="modal-body">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="login" id="login" class="form-control" required>
                  <input type="hidden" id="textTargetUrl" class="fadeIn second" name="textTargetUrl" value="<?php echo $targetUrl;?>">
                </div>
                <div class="form-group">
                  <label>Contraseña</label>
                  <input type="password" name="password" id="password" class="form-control" required>
                </div>
              </div>

              <div class="modal-footer">

                <a href="registrarme.php">Registrame</a>&nbsp;&nbsp;&nbsp;
                <input type="submit" class="btn btn-success" value="Aceptar">
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>

    <br>
    <div id="resultado" class="text-center"></div>
    <div class="outer_div"></div><!-- Datos ajax Final -->


</div><!-- Cierra Container-->

<?php
include('footer.php');
?>

<!-- ********************************************************************************* -->
<!-- ************ JAVASCRIPT ********************************************************* -->
<!-- ********************************************************************************* -->

<!--Core JavaScript file  -->
<?php
  include_once('scriptJs.php')
 ?>

<script>

$(document).ready(function() {

 /*$.ajaxSetup({ cache: true });
  $.getScript('https://connect.facebook.net/en_US/sdk.js', function(){
    FB.init({
      appId: '562700931186018',
      version: 'v5.0' // or v2.1, v2.2, v2.3, ...
    });
    $('#loginbutton,#feedbutton').removeAttr('disabled');
    //FB.getLoginStatus(updateStatusCallback);
  });    */


  $( "#formLogin" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/autenticacion.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultado").html("<center><img src='img/ajax-loader.gif'></center>");
      },
      success: function(datos){
        mensaje='<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong>Error!</strong> El Usuario/Password son Incorrectos.</div>';
        if (datos=='no') $("#resultado").html(mensaje);
        else $(location).attr('href',datos);
      }
    });
    event.preventDefault();
  });
});


</script>


</body>
</html>
