<?php
include_once 'carrito.php';
$cart = new Cart;
include 'userControl.php';
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD de productos con PHP - MySQL - jQuery AJAX </title>
  <?php
  include("head.php");
  ?>
  <link rel="stylesheet" href="css/custom.css">
  <style media="screen">
  footer {
    background-color:#1A1A1A;
    height: 15%;
    color: white;
    padding: 15px;
  }
  .highlight {
    background-color: #ec971f;
    padding: 0.15em 0;
  }
  tr:nth-child(odd) {
    background-color:#ED8B76;
  }
  tr:nth-child(even) {
    background-color:#fbfbfb;
  }
  </style>
</head>
<body>
  <?php
  include("navbar.php");
  ?>

  <div class="container-fluid">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2>Catalogo de <b>Productos</b></h2>
          </div>
        </div>
      </div>
      <div class='col-sm-4 pull-right'>
        <div id="custom-search-input">
          <div class="input-group col-md-12">
            <input type="text" class="form-control" placeholder="Buscar"  id="q" onkeyup="load(1);" />
            <span class="input-group-btn">
              <button class="btn btn-info" type="button" onclick="load(1);">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </span>
          </div>
        </div>
      </div>
      <div class='clearfix'></div>
      <hr>
      <div id="loader"></div><!-- Carga de datos ajax aqui -->
      <div id="resultados"></div><!-- Carga de datos ajax aqui -->
      <div class='outer_div'></div><!-- Carga de datos ajax aqui -->


    </div>
  </div>

  <!-- View Modal HTML -->
  <?php include("html/producto_modal_view.php"); ?>

  <?php include("footer.php");  ?>

  <!-- ********************************************************************************* -->
  <!-- ************ JAVASCRIPT ********************************************************* -->
  <!-- ********************************************************************************* -->

  <?php
  include("scriptJs.php");
  ?>

  <script type="text/javascript">
  $(function() {
    load(1);
  });

  function load(page){
    var query=$("#q").val();
    var per_page=15;
    var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
    $("#loader").fadeIn('slow');
    $.ajax({
      url:'ajax/producto_listar.php',
      data: parametros,
      beforeSend: function(objeto){
        $("#loader").html("Cargando...");
      },
      success:function(data){
        $(".outer_div").html(data).fadeIn('slow');
        $("#loader").html("");
      }
    })
  }

  $('#viewProductModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id')
    $('#view_id').val(id)
    var code = button.data('code');
    $('#view_code').val(code);
    var name = button.data('name');
    $('#view_name').val(name);
    var empaque = button.data('empaque');
    $('#view_empaque').val(empaque);
    var barCode = button.data('barcode');
    $('#view_barCode').val(barCode);
    var price = button.data('price');
    $('#view_price').val(price);
    //var categoria = button.data('categoria'); // no se usa
    var recargo = button.data('recargo');
    $('#view_recargo').val(recargo);
  });
  
</script>
</body>
</html>
