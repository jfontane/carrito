<?php
include 'php/conexion.php';
include 'carrito.php';
$cart = new Cart;
$paginaActiva='listado';
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
  <?php include('nav.php'); ?>
  <header>
  <div class="container">
    <h3>Listado</h3>
  </div>
  </header>

  <div class="container">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Listado</li>
      </ol>
    </nav>


    <!-- /.col -->
    <div class="col-xs-12">

      <!-- /.row -->


      <hr>

<div class="row">
  <div class="col-xs-12 col-sm-4" >

    <div id="custom-search-input">
      <div class="input-group">
         <select class="form-control" id="selectCategoria">
            <option value="99">Todas las Categorias</option>
            <option value="101">papeleria</option>
         </select>
      </div>
    </div>
    <br>
    <div id="custom-search-input">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Buscar"  id="q" onkeyup="load(1);" />
        <span class="input-group-btn">
          <button class="btn btn-info" type="button" onclick="load(1);">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </div>
  </div>
</div>

<br>

      <!-- Page Content -->

      <!-- /.row -->
      <div id="loader"></div><!-- Carga de datos ajax aqui -->
      <div id="resultados"></div><!-- Carga de datos ajax aqui -->
      <div class='outer_div'></div><!-- Carga de datos ajax aqui -->




            <!-- /.row -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->

      <!--Footer -->
      <?php include 'footer.php'; ?>
      <!--Footer end -->
      <!--Core JavaScript file  -->
      <?php
        include_once('scriptJs.php')
       ?>

      <script>
      $(function() {
        load(1);
      });

      function load(page){
        var query=$("#q").val();
        var per_page=10;
        var categoria = $("#selectCategoria").val();
        var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page, 'categoria':categoria};
        $("#loader").fadeIn('slow');
        $.ajax({
          url:'ajax/productos_listar.php',
          data: parametros,
          beforeSend: function(objeto){
            $("#loader").html("Cargando...");
          },
          success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
          }
        })
      };

   $("#selectCategoria").change(function() {
     load(1);

     /* Act on the event */
   });

    </script>

  </body>
  </html>
