<?php
include 'carrito.php';
include 'userControl.php';
include 'php/libString.php';
$cart = new Cart;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php
include("head.php");
   ?>
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
  <div class="panel panel-default">
    <br><br><br>
    <div class="panel-heading">
      <h2><?php
      $dia="<b>".dameDia(date('l'))." ".date('d')."</b>";
      $mes=dameMes(date('m'));
      echo '<b>'.saludo().'</b> '."Hoy es <b>".$dia.'</b> de <b>'.$mes."</b> de <b>".date("Y")."</b>";
      ?>
    </h2>
  </div>

  <div class="panel-body">

    <div id="products" class="row list-group">
      <div class='col-sm-4 pull-center'>
        &nbsp;
      </div>
      <div class='col-sm-4 pull-center'>
        &nbsp;
      </div>
      <div class='col-sm-4 pull-center'>
        &nbsp;
      </div>
    </div>

    <div id="products" class="row list-group">
      <div class='col-sm-4 pull-center'>
        <a href='productosListado.php' class="btn btn-info" data-toggle="tooltip" title="Articulos.">
          <img src="img/articulosListado.png" alt="" width="90">
        </a>
      </div>
      <div class='col-sm-4 pull-center'>
        <a href='clientesListadoAdmin.php' class="btn btn-info" data-toggle="tooltip" title="Clientes.">
          <img src="img/clientesListado.png" alt="" width="90">
        </a>
      </div>
      <div class='col-sm-4 pull-center'>
        <a href='importarProductos.php'  class="btn btn-info" data-toggle="tooltip" title="Actualizacion de Articulos.">
          <img src="img/excelImportIcon.png" alt="" width="90">
        </a>
      </div>
    </div>

    <div id="products" class="row list-group">
      <div class='col-sm-4 pull-center'>
        &nbsp;
      </div>
      <div class='col-sm-4 pull-center'>
        &nbsp;
      </div>
      <div class='col-sm-4 pull-center'>
        &nbsp;
      </div>
    </div>


  </div><!--Cierra Panel body-->
</div><!-- Cierra Panel-->
</div><!-- Cierra Container-->


<?php
include("footer.php");
 ?>

<!-- ********************************************************************************* -->
<!-- ************ JAVASCRIPT ********************************************************* -->
<!-- ********************************************************************************* -->

<?php
include("scriptJs.php");
 ?>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>
