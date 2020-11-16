<?php
include_once 'carrito.php';
$cart = new Cart;
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
  </style>
</head>
<body>
  <?php
  include("navbar.php");
  ?>


  <div class="container">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2><font color="red"><b>(ADMIN)</b> </font>- Administrar <b>Clientes</b></h2>
          </div>
          <div class="col-sm-6">
            <a href="#addClienteModal" class="btn btn-success" data-toggle="modal">
              <i class="fa fa-plus"></i>
              <span>Agregar nuevo Cliente</span>
            </a>
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
  <!-- Add Modal HTML -->
  <?php include("html/cliente_modal_add.php");?>
  <!-- Edit Modal HTML -->
  <?php include("html/cliente_modal_edit.php");?>
  <!-- Delete Modal HTML -->
  <?php include("html/cliente_modal_delete.php");?>

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
      url:'ajax/cliente_listar.php',
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

  $( "#add_cliente" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/cliente_guardar.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados").html("Enviando...");
      },
      success: function(datos){
        $("#resultados").html(datos);
        load(1);
        $('#addClienteModal').modal('hide');
      }
    });
    event.preventDefault();
  });

  $('#editClienteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    $('#edit_id').val(id)
    var apellido = button.data('apellido')
    $('#edit_apellido').val(apellido)
    var nombre = button.data('nombre')
    $('#edit_nombre').val(nombre)
    var dni = button.data('dni')
    $('#edit_dni').val(dni)
    var email = button.data('email')
    $('#edit_email').val(email)
    var telefono = button.data('telefono')
    $('#edit_telefono').val(telefono)
    var direccion = button.data('direccion')
    $('#edit_direccion').val(direccion)

  })


  $("#edit_cliente").submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/cliente_editar.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados").html("Enviando...");
      },
      success: function(datos){
        $("#resultados").html(datos);
        load(1);
        $('#editClienteModal').modal('hide');
      }
    });
    event.preventDefault();
  });


  $('#deleteClienteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    $('#delete_id').val(id)
  })

  $( "#delete_cliente" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/cliente_eliminar.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados").html("Enviando...");
      },
      success: function(datos){
        $("#resultados").html(datos);
        load(1);
        $('#deleteClienteModal').modal('hide');
      }
    });
    event.preventDefault();
  });

</script>
</body>
</html>
