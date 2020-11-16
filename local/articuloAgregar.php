<?php
include 'carrito.php';
include 'userControl.php';
include 'php/libString.php';
$cart = new Cart;
$title="Agregar Banner";
/* Llamar la Cadena de Conexion*/
include ("php/conexion.php");
//Insert un nuevo producto
$imagen_demo="demo.png";
$insert=$db->query("insert into articulos (url_image) values ('$imagen_demo')");
$id_banner=$db->insert_id;
$sql=$db->query("select * from articulos where id='$id_banner' limit 0,1");
$count=$sql->num_rows;
if ($count==0){
  //header("location: bannerlist.php");
  //exit;
}

$rw=$sql->fetch_assoc();
/*$titulo=$rw['titulo'];
$descripcion=$rw['descripcion'];*/
$url_image=$rw['url_image'];
/*
$orden=intval($rw['orden']);
$estado=intval($rw['estado']);

$active_config="active";
$active_banner="active";*/

$categorias=$db->query("select * from categorias");
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../images/ico/favicon.ico">
  <title><?php echo $title;?></title>
  <!-- Bootstrap core CSS -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!-- Custom styles for this template -->
  <link href="css/navbar-fixed-top.css" rel="stylesheet">
  <link href="css/preview-image.css" rel="stylesheet">
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

    <!-- Main component for a primary marketing message or call to action -->
    <div class="row">

    
      <div class="col-md-7">
        <h3 ><span class="glyphicon glyphicon-edit"></span>Agregar Articulo</h3>
        <form class="form-horizontal" id="editar_banner">

          <div class="form-group">
          <label for="titulo" class="col-sm-3 control-label">Codigo</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="codigo" value="" required name="codigo">
            <input type="hidden" class="form-control" id="id_banner" value="<?=$id_banner?>" name="id_banner">
          </div>
          </div>

          <div class="form-group">
  				<label for="titulo" class="col-sm-3 control-label">Descripción</label>
  				<div class="col-sm-9">
  				  <textarea class='form-control' name="descripcion" id="descripcion" required rows=8></textarea>
  				</div>
  			  </div>

          <div class="form-group">
          <label for="titulo" class="col-sm-3 control-label">Empaque</label>
          <div class="col-sm-9">
            <input type="text" class='form-control' name="empaque" id="empaque" value="">
          </div>
          </div>

          <div class="form-group">
          <label for="titulo" class="col-sm-3 control-label">Precio Con Iva</label>
          <div class="col-sm-9">
            <input type="text" class='form-control' name="precioConIva" id="precioConIva" value="">
          </div>
          </div>

          <div class="form-group">
          <label for="titulo" class="col-sm-3 control-label">Porcentaje Recargo</label>
          <div class="col-sm-9">
            <input type="text" class='form-control' name="porcentajeRecargo" id="porcentajeRecargo" value="">
          </div>
          </div>

          <div class="form-group">
          <label for="titulo" class="col-sm-3 control-label">Codigo de Barra</label>
          <div class="col-sm-9">
            <textarea class='form-control' name="codigoBarra" id="codigoBarra" required rows=2></textarea>
          </div>
          </div>

          <div class="form-group">
          <label for="titulo" class="col-sm-3 control-label">Proveedor</label>
          <div class="col-sm-9">
            <input type="text" class='form-control' name="proveedor" id="proveedor" value="">
          </div>
          </div>

          <div class="form-group">
          <label for="titulo" class="col-sm-3 control-label">Categoria</label>
          <div class="col-sm-9">
            <select class="form-control" name="categoria" id="categoria">
              <?php
                while ($row=$categorias->fetch_assoc()) {
                ?>
                          <option value="<?=$row['id']?>" ><?=$row['descripcion']?></option>
              <?php
                  }
               ?>
            </select>
          </div>
          </div>

          <div class="form-group">
            <div id='loader'></div>
            <div class='outer_div'></div>
            <div class="col-sm-offset-3 col-sm-9">
              <button type="submit" class="btn btn-success">Agregar datos</button>&nbsp;&nbsp;&nbsp;
              <button type="button" class="btn btn-warning" onclick="location.href='productosListadoJavier.php'" >Volver Atras</button>
            </div>
          </div>
        </form>

      </div>
      <div class="col-md-5">
        <h3 ><span class="glyphicon glyphicon-picture"></span>Imagen</h3>
        <form class="form-vertical">
          <div class="form-group">
            <div class="col-sm-12">
              <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 250px;">
                  <img class="img-rounded" src="../img/banner/<?php echo $url_image;?>" />
                </div>
                <div>
                  <span class="btn btn-info btn-file"><span class="fileinput-new">Selecciona una imagen</span>
                  <span class="fileinput-exists" ></span><input type="file" name="fileToUpload" id="fileToUpload" required onchange="upload_image();"></span>
                </div>
              </div>
              <div class="upload-msg"></div>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div><!-- /container -->

  <?php include("footer.php");?>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="js/jasny-bootstrap.min.js"></script>

</body>
</html>
<script>
function upload_image(){
  $(".upload-msg").text('Cargando...');
  var id_banner=$("#id_banner").val();
  var inputFileImage = document.getElementById("fileToUpload");
  var file = inputFileImage.files[0];
  var data = new FormData();
  data.append('fileToUpload',file);
  data.append('id',id_banner);

  $.ajax({
    url: "ajax/upload_banner.php",        // Url to which the request is send
    type: "POST",             // Type of request to be send, called as method
    data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false,       // The content type used when sending data to the server.
    cache: false,             // To unable request pages to be cached
    processData:false,        // To send DOMDocument or non processed data file it is set to false
    success: function(data)   // A function to be called if request succeeds
    {
      $("#fileToUpload").attr("disabled",true)
      $(".upload-msg").html(data);
      window.setTimeout(function() {
        $(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
        });	}, 5000);
      }
    });

  }

  function eliminar(id){
    var parametros = {"action":"delete","id":id};
    $.ajax({
      url:'ajax/upload2.php',
      data: parametros,
      beforeSend: function(objeto){
        $(".upload-msg2").text('Cargando...');
      },
      success:function(data){
        $(".upload-msg2").html(data);

      }
    })

  }

  $("#editar_banner").submit(function(e) {

    $.ajax({
      url: "ajax/articulo_editar.php",
      type: "POST",
      data: $("#editar_banner").serialize(),
      beforeSend: function(objeto){
        $("#loader").html("Cargando...");
      },
      success:function(data){
        $(".outer_div").html(data).fadeIn('slow');
        $("#loader").html("");
      }
    });
    e.preventDefault();
  });
  </script>
