<?php
// initializ shopping cart class
include ("php/conexion.php");
include 'carrito.php';
$cart = new Cart;
$paginaActivo='verCarrito';
$idArticulo=$_GET['idArticulo'];

/*

select promociones.*, categorias.descripcion
from promociones, articulos, categorias
where promociones.articulo_id=4035 and promociones.articulo_id=articulos.id and articulos.categoria_id=categorias.id


*/

$tables=" articulos";
$sWhere=" articulos.id=".$idArticulo;
$sql="SELECT articulos.* FROM  $tables  WHERE $sWhere ";
//echo $sql;
$resultado = $con->query($sql);

$fila=$resultado->fetch_assoc();
$producto_descripcion=$fila['descripcion'];
$producto_titulo=$fila['titulo'];
$producto_array_fotos=unserialize($fila['url_image']);

//$producto_id=$fila['articulo_id'];

$producto_precio=$fila['precioConIva']*$fila['porcentajeRecargo'];
//$producto_categoria=$fila['categoria_descripcion'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>El Original</title>
  <!-- Bootstrap core CSS -->
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <!--GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet" />
  <style media="screen">
  .quantity {
position: relative;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button
{
-webkit-appearance: none;
margin: 0;
}

input[type=number]
{
-moz-appearance: textfield;
}

.quantity input {
width: 65px;
height: 42px;
line-height: 1.65;
float: left;
display: block;
padding: 0;
margin: 0;
padding-left: 20px;
border: 1px solid #eee;
}

.quantity input:focus {
outline: 0;
}

.quantity-nav {
float: left;
position: relative;
height: 42px;
}

.quantity-button {
position: relative;
cursor: pointer;
border-left: 1px solid #eee;
width: 20px;
text-align: center;
color: #333;
font-size: 13px;
font-family: "Trebuchet MS", Helvetica, sans-serif !important;
line-height: 1.7;
-webkit-transform: translateX(-100%);
transform: translateX(-100%);
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}

.quantity-button.quantity-up {
position: absolute;
height: 50%;
top: 0;
border-bottom: 1px solid #eee;
}

.quantity-button.quantity-down {
position: absolute;
bottom: -1px;
height: 50%;
}

img.zoom {
    width: 350px;
    height: 200px;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
}

.transition {
    -webkit-transform: scale(1.8);
    -moz-transform: scale(1.8);
    -o-transform: scale(1.8);
    transform: scale(1.8);
}
  </style>
</head>
<body>
<?php include('nav.php'); ?>
<header>
<div class="container">
  <h3>Detalle</h3>
</div>
</header>

  <div class="container">
    <!-- /.row -->

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Library</li>
      </ol>
    </nav>

    <!-- /.col -->
      <div class="row">
        <div class="col-md-12">
          <h4>Juegos De Creatividad Play Doh 23038 Escritorio De Actividad</h4>
          <hr>
        </div>
      </div>
      <!-- /.row -->

        <!-- /.row -->
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6 text-center ">
            <div class="thumbnail product-box">
              <img src="assets/img/banner/<?=$producto_array_fotos[0]?>" data-zoom-image="assets/img/banner/<?=$producto_array_fotos[0]?>" id="zoom_01" alt="" style="width: 80%; height: auto;">
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="thumbnail product-box">
              <div class="caption">
                <table>
                  <tr>
                    <th class="text-left font-weight-normal"  style="font-size: 26px;" colspan ="2">
                      <input type="hidden" id="input_precio" value="<?php echo $producto_precio;?>">
                       <div id="precio">$&nbsp;<?php echo number_format($producto_precio,2,',','.');;?></div>
                     </th>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="text-left" style="font-size: 18px;">Cantidad:&nbsp;</td>
                    <td class="text-left">
                      <div class="quantity">
                          <input type="number" min="1" max="9" step="1" value="1" id="qty">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <th colspan="2"  class="text-left">
                      <input type="hidden" id="idArticulo" value="<?php echo $idArticulo;?>">
                          <a class="btn btn-primary" id="btnComprar" style="color:#ffffff;">
                             <i class="fa fa-shopping-cart fa-lg"></i>&nbsp;Comprar
                          </a>
                    </th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
        <div class="row">
          <h3>Descripcion</h3>
          <hr>
          <div class="col-md-12 text-left col-sm-12 col-xs-12">
            <p align='left'>
              <?php
                echo $producto_descripcion;
               ?>
            </p>
          </div>
      </div>
      <!-- /.row -->
</div>
<!-- /.container -->

<?php
include("footer.php");
?>

<!-- ********************************************************************************* -->
<!-- ************ JAVASCRIPT ********************************************************* -->
<!-- ********************************************************************************* -->

<?php
include("scriptJs.php");
?>


<script src='jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/2.2.3/jquery.elevatezoom.min.js'></script>
<script>

$(document).ready(function(){
    $('.zoom').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });
});

$('#zoom_01').elevateZoom({
       cursor: "crosshair",
       zoomWindowFadeIn: 500,
       zoomWindowFadeOut: 750
     });


function formatMoney(number, decPlaces, decSep, thouSep) {
decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
decSep = typeof decSep === "undefined" ? "." : decSep;
thouSep = typeof thouSep === "undefined" ? "," : thouSep;
var sign = number < 0 ? "-" : "";
var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
var j = (j = i.length) > 3 ? j % 3 : 0;

return sign +
	(j ? i.substr(0, j) + thouSep : "") +
	i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
	(decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
}

$("#btnComprar").click(function (e) {
  e.preventDefault();
  var idArticulo = $("#idArticulo").val();
  var qty = $("#qty").val();
  location.href='accionCarrito.php?action=addToCart&id='+idArticulo+"&cantidad="+qty;

})


jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up" style="font-weight: bold;">+</div><div class="quantity-button quantity-down" style="font-weight: bold;">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var precio=$("#input_precio").val();
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        total = precio*newVal;
        total_formateado = formatMoney(total, 2, ',', '.')
        $("#precio").html("$ "+total_formateado);
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var precio=$("#input_precio").val();
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        total = precio*newVal;
        total_formateado = formatMoney(total, 2, ',', '.')
        $("#precio").html("$ "+total_formateado);
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });

</script>
</body>
</html>
