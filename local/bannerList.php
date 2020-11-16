<?php
include 'carrito.php';
include 'userControl.php';
include 'php/libString.php';
$cart = new Cart;

$title="Galería de imágenes";
/* Llamar la Cadena de Conexion*/
include ("php/conexion.php");
$active_config="active";
$active_banner="active";

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?php include('head.php'); ?>
  <!-- Custom styles for this template -->
  <style>
  footer {
    background-color:#1A1A1A;
    height: 15%;
    color: white;
    padding: 15px;
  }

  .main1 {
    display:flex;
    margin:0 auto;
  }

  a img:hover {
    color: #fff;
  }
  </style>
</head>
<body>
  <?php
  include("navbar.php");
  ?>

  <div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="row">

      <ol class="breadcrumb">
        <li><a href="#">Inicio</a></li>
        <li class="active">Banner</li>
        <li><a href="../index.php" target="_blank"><i class='glyphicon glyphicon-blackboard'></i> Ver Sitio</a></li>
      </ol>


      <br>
      <div id="loader" class="text-center"> <span><img src="../img/ajax-loader.gif"></span></div>
      <div class="outer_div"></div><!-- Datos ajax Final -->

    </div>

  </div> <!-- /container -->
  <?php include("footer.php");?>

  <?php include("scriptJs.php");?>

<script>
$(document).ready(function(){
  load(1);
});

function load(page){
  var parametros = {"action":"ajax","page":page};
  $.ajax({
    url:'./ajax/banner_listar.php',
    data: parametros,
    beforeSend: function(objeto){
      $("#loader").html("<img src='../img/ajax-loader.gif'>");
    },
    success:function(data){
      $(".outer_div").html(data).fadeIn('slow');
      $("#loader").html("");
    }
  })
}
function eliminar_slide(id){
  page=1;
  var parametros = {"action":"ajax","page":page,"id":id};
  if(confirm('Esta acción  eliminará de forma permanente el banner \n\n Desea continuar?')){
    $.ajax({
      url:'./ajax/banner_listar.php',
      data: parametros,
      beforeSend: function(objeto){
        $("#loader").html("<img src='../images/ajax-loader.gif'>");
      },
      success:function(data){
        $(".outer_div").html(data).fadeIn('slow');
        $("#loader").html("");
      }
    })
  }
}
</script>


</body>
</html>
