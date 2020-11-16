<?php
// initializ shopping cart class
include ("php/conexion.php");
include 'carrito.php';
$cart = new Cart;
$paginaActivo='verCarrito';

$idArticulo=isset($_GET['idArticulo'])?$_GET['idArticulo']:30307;

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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>El Original Online</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/cloud-zoom.css" rel="stylesheet" type="text/css" />
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

</style>

</head>

<body>
  <?php include_once('nav.php'); ?>

  <header>
  <div class="container">
    <h1>Header</h1>
  </div>
  </header>

<div class="container">
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Library</li>
  </ol>
</nav>
<div id="midground">
<div id="foreground">
<div id='container'>
  <div id="content-container" >
    <div id='maincontent' >

      <div class="row">
        <div class="col-md-12">
          <h4>Juegos De Creatividad Play Doh 23038 Escritorio De Actividad</h4>
        </div>
      </div>
  <p id='info'>Las fotos son tal cual como es el producto. </p>

	<div class="zoom-section">
    <div class="row">
      <div class="col-xs-12 col-sm-3">
        <div class="zoom-small-image"><a href='images/zoomengine/bigimage00.jpg' class = 'cloud-zoom' id='zoom1' rel="adjustX: 10, adjustY:-4"><img src="images/smallima.jpg" alt='' title="" /></a></div>
      </div>
      <div class="col-xs-12 col-sm-9 text-center">
        <div class="zoom-desc">
          <p>
            <a href='images/zoomengine/bigimage00.jpg' class='cloud-zoom-gallery' title='Red' rel="useZoom: 'zoom1', smallImage: 'images/zoomengine/smallimage.jpg' "><img class="zoom-tiny-image" src="images/tinyimag.jpg" alt = "Thumbnail 1"/></a>
            <a href='images/zoomengine/bigimage01.jpg' class='cloud-zoom-gallery' title='Blue' rel="useZoom: 'zoom1', smallImage: ' images/zoomengine/smallimage-1.jpg'"><img src="images/tinyimah.jpg" alt = "Thumbnail 2" border="0" class="zoom-tiny-image"/></a>
            <a href='images/zoomengine/bigimage02.jpg' class='cloud-zoom-gallery' title='Blue' rel="useZoom: 'zoom1', smallImage: 'images/zoomengine/smallimage-2.jpg' "><img src="images/tinyimai.jpg" alt = "Thumbnail 3" border="0" class="zoom-tiny-image"/></a></p>
          <table>
            <tr>
              <th class="text-left font-weight-normal"  style="font-size: 26px;" colspan ="2">&nbsp;&nbsp;
                <input type="hidden" id="input_precio" value="<?php echo $producto_precio;?>">
                 <div style="font-size: 18px;text-decoration:line-through">$&nbsp;<?php echo number_format($producto_precio,2,',','.');;?></div>
                 <div id="precio">$&nbsp;<?php echo number_format($producto_precio,2,',','.');;?></div>
               </th>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td class="text-left" style="font-size: 18px;">&nbsp;&nbsp;Cantidad:&nbsp;</td>
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
              <th colspan="2"  class="text-left">&nbsp;&nbsp;
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

	</div> <!-- div zoom section -->

     <h3 style="clear:both;">Caracteristicas</h3>


  </div> <!-- maincontent -->
</div> <!-- content-container -->
</div> <!-- container -->


</div> <!-- div foreground -->
</div> <!-- div midground -->
</div> <!-- div container -->
<?php include 'footer.php'; ?>

<!--Core JavaScript file  -->
<?php include_once('scriptJs.php'); ?>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/cloud-zoom.1.0.2.js"></script>

<script type="text/javascript">
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

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-254857-6']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
//<![CDATA[
(function() {
	var links = document.getElementsByTagName('a');
	var query = '?';
	for(var i = 0; i < links.length; i++) {
	if(links[i].href.indexOf('#disqus_thread') >= 0) {
		query += 'url' + i + '=' + encodeURIComponent(links[i].href) + '&';
	}
	}
	document.write('<script charset="utf-8" type="text/javascript" src="http://disqus.com/forums/professorcloud/get_num_replies.js' + query + '"></' + 'script>');
})();
//]]>
</script>
</body>
</html>
