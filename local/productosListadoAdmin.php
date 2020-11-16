<?php
include_once 'carrito.php';
$cart = new Cart;
include 'userControl.php';
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
            <h2><font color="red"><b>(ADMIN)</b> </font>- Administrar <b>Productos</b></h2>
          </div>
          <div class="col-sm-6">
            <a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i><span>Agregar nuevo producto</span></a>
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
      <div class='outer_div'>




      </div><!-- Carga de datos ajax aqui -->


    </div>

  </div>
  <!-- Add Modal HTML -->
  <?php include("html/producto_modal_add.php");?>
  <!-- Edit Modal HTML -->
  <?php include("html/producto_modal_edit.php");?>
  <!-- Delete Modal HTML -->
  <?php include("html/producto_modal_delete.php");?>
  <!-- Duplicate Modal HTML -->
  <?php include("html/producto_modal_duplicate.php"); ?>
  <!-- View Modal HTML -->
  <?php include("html/producto_modal_view.php"); ?>

  <?php
  include("footer.php");
  ?>

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
    var per_page=10;
    var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
    $("#loader").fadeIn('slow');
    $.ajax({
      url:'ajax/producto_listar_admin.php',
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

  $('#editProductModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id')
    $('#edit_id').val(id)
    var code = button.data('code');
    $('#edit_code').val(code);
    var name = button.data('name');
    $('#edit_name').val(name);
    var empaque = button.data('empaque');
    $('#edit_empaque').val(empaque);
    var barCode = button.data('barcode');
    $('#edit_barCode').val(barCode);
    var price = button.data('price');
    $('#edit_price').val(price);
    var categoria = button.data('categoria'); // no se usa
    $("#edit_categoria option[value="+categoria+"]"). attr("selected",true);
    var recargo = button.data('recargo');
    $('#edit_recargo').val(recargo);
  });

  $('#duplicateProductModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id')
    $('#duplicate_id').val(id)
    var code = button.data('code');
    $('#duplicate_code').val(code);
    var name = button.data('name');
    $('#duplicate_name').val(name);
    var empaque = button.data('empaque');
    $('#duplicate_empaque').val(empaque);
    var barCode = button.data('barcode');
    $('#duplicate_barCode').val(barCode);
    var price = button.data('price');
    $('#duplicate_price').val(price);
    var recargo = button.data('recargo');
    $('#duplicate_recargo').val(recargo);

  });

  $('#deleteProductModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    console.log(id)
    $('#delete_id').val(id)
  })

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


  $( "#add_product" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/producto_guardar.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados").html("Enviando...");
      },
      success: function(datos){
        $("#resultados").html(datos);
        load(1);
        $('#addProductModal').modal('hide');
      }
    });
    event.preventDefault();
  });



  $( "#edit_product" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/producto_editar.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados").html("Enviando...");
      },
      success: function(datos){
        $("#resultados").html(datos);
        load(1);
        $('#editProductModal').modal('hide');
      }
    });
    event.preventDefault();
  });

  $( "#duplicate_product" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/producto_duplicar.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados").html("Enviando...");
      },
      success: function(datos){
        $("#resultados").html(datos);
        load(1);
        $('#duplicateProductModal').modal('hide');
      }
    });
    event.preventDefault();
  });


  $( "#delete_product" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/producto_eliminar.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados").html("Enviando...");
      },
      success: function(datos){
        $("#resultados").html(datos);
        load(1);
        $('#deleteProductModal').modal('hide');
      }
    });
    event.preventDefault();
  });


</script>
</body>
</html>
