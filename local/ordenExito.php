<?php

if(!isset($_REQUEST['id'])){
  header("Location: index.php");
}

include_once 'carrito.php';
$cart = new Cart;
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <?php
  include("head.php");
  ?>

  <style>
  .container{padding: 20px;}

  p{color: #34a853;font-size: 18px;}

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
</head>
<body>

  <?php
  include("navbar.php");
  ?>

<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2><b>Orden de Pedido</b></h2>
    </div>

    <div class="panel-body">
      <h3>Estado de su Orden</h3>
      <p>Su pedido ha sido enviado exitosamente. La ID del pedido es #<?php echo $_GET['id']; ?></p>
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

</body>
</html>
