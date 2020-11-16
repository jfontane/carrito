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
            <h2>Listado de <b>PEDIDOS</b></h2>
          </div>
          <div class="col-sm-6">
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
  <!-- Edit Modal HTML -->
  <?php include("html/pedido_modal_edit.php");?>
  <!-- Delete Modal HTML -->
  <?php include("html/pedido_modal_delete.php");?>

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
    //alert(query)
    $("#loader").fadeIn('slow');
    $.ajax({
      url:'ajax/pedido_listar.php',
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

  $('#editPedidoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    $('#edit_id').val(id)
    var estado = button.data('estado')
    $("#edit_estado option:selected").removeAttr("selected");
    $("#edit_estado option[value='"+estado+"']").attr('selected', 'selected');

  })


  $("#edit_pedido").submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/pedido_editar.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados").html("Enviando...");
      },
      success: function(datos){
        $("#resultados").html(datos);
        load(1);
        $('#editPedidoModal').modal('hide');
      }
    });
    event.preventDefault();
  });

  $('#deletePedidoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    console.log(id)
    $('#delete_id').val(id)
  })

  $( "#delete_pedido" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/pedido_eliminar.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados").html("Enviando...");
      },
      success: function(datos){
        $("#resultados").html(datos);
        load(1);
        $('#deletePedidoModal').modal('hide');
      }
    });
    event.preventDefault();
  });
</script>
</body>
</html>
