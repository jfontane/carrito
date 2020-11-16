<?php
include_once 'carrito.php';
$cart = new Cart;
include 'userControl.php';
if ($_SESSION['usuarioAdmin']!='jfontane') header("location: principal.php");

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
            <h2><font color="red"><b>(ADMIN)</b> </font>- Administrar <b>Productos y Destacar</b> </h2>
          </div>
          <div class="col-sm-6">
            <!-- <a href="#addProductModalJavier" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> -->
            <a href="articuloAgregar.php" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>
              <span>Agregar nuevo producto</span>
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
    <!-- Edit Modal HTML -->
    <?php include("html/producto_modal_add_javier.php");?>
    <!-- Edit Modal HTML -->
    <?php //include("html/producto_modal_edit.php");?>
    <!-- Delete Modal HTML -->
    <?php include("html/producto_modal_delete.php");?>
    <!-- Duplicate Modal HTML -->
    <?php include("html/producto_modal_duplicate.php"); ?>
    <!-- Publish Modal HTML -->
    <?php include("html/producto_modal_publicar.php"); ?>
    <!-- View Modal HTML -->
    <?php include("html/producto_modal_view.php"); ?>
    <!-- Subir Fotos HTML -->
    <?php include("html/producto_modal_upload_pic.php"); ?>



    <?php
    include("footer.php");
    ?>

    <!-- ********************************************************************************* -->
    <!-- ************ JAVASCRIPT ********************************************************* -->
    <!-- ********************************************************************************* -->

    <?php
    include("scriptJs.php");
    ?>
    <script src="includes/ckeditor/ckeditor.js"></script>

    <script type="text/javascript">
    // instance, using default configuration.
      //CKEDITOR.replace('publicar_descripcion');
      CKEDITOR.replace('publicar_descripcion');
      //set data

    </script>

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
        url:'ajax/producto_listar_javier.php',
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
      //console.log(id)
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

    });

    $('#publicarProductModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var id = button.data('id')
      var title = button.data('title');
      var descripcion = button.data('descripcion');
      var categoria = button.data('categoria');
      var price = button.data('price');
      var recargo = button.data('recargo');
      var promocion = button.data('promocion');
      //alert(categoria+promocion)
      $('#publicar_id').val(id)
      $('#publicar_titulo').val(title);
      $("#publicarProductModal").find("select").val(categoria);
      $("#publicar_categoria option[value="+categoria+"]").attr("selected",true);
      $('#publicar_price').val(price);
      $('#publicar_porcentaje').val(recargo);
      //$("#publicarProductModal").find("select").val(promocion);
      //modal.find('#modalbody #publicar_promocion').val(promocion)
      //$("#publicar_promocion option[value="+promocion+"]").attr("selected",true);
      if (promocion=='Si') {
          $("#r1").attr("checked",true)
       }
       if (promocion=='No') {
           $("#r2").attr("checked",true)
        }

      CKEDITOR.instances['publicar_descripcion'].setData(descripcion);

    });

    $("#publicarProductModal").on("hidden.bs.modal", function() {
      //$("#publicarProductModal").find("select").val("");
});


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

    $('#subirFotosProductModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id')
      $('#upload_pic_id').val(id)
    });


    $('#deleteProductModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id')
      $('#delete_id').val(id)
    })

    $( "#add_product" ).submit(function( event ) {
      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "ajax/producto_guardar_javier.php",
        data: parametros,
        beforeSend: function(objeto){
          $("#resultados").html("Enviando...");
        },
        success: function(datos){
          $("#resultados").html(datos);
          load(1);
          $('#addProductModalJavier').modal('hide');
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

    $( "#publicar_product" ).submit(function( event ) {
      //nicEditors.findEditor('publicar_descripcion').saveContent();
      var id = $("#publicar_id").val();
      var titulo = $("#publicar_titulo").val();
      var descripcion = CKEDITOR.instances['publicar_descripcion'].getData();
      var categoria = $("#publicar_categoria").val();
      var precio = $("#publicar_price").val();
      var porcentaje = $("#publicar_porcentaje").val();
      var promocion = $('input:radio[name=publicar_promocion]:checked').val();
      var parametros = {"publicar_id":id, "publicar_titulo":titulo, "publicar_descripcion":descripcion, "publicar_categoria":categoria, "publicar_price":precio, "publicar_porcentaje":porcentaje, "publicar_promocion":promocion };
      $.ajax({
        type: "POST",
        url: "ajax/producto_publicar.php",
        data: parametros,
        beforeSend: function(objeto){
          $("#resultados").html("Enviando...");
        },
        success: function(datos){
          $("#resultados").html(datos);
          // LIMPIAR MODAL PORQUE QUEDA SUCIO
          load(1);
          $('#publicarProductModal').modal('hide');
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

    $("#upload_pic_product").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'ajax/uploadImg.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#uploadStatus').html('<img src="img/ajax-loader.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<span style="color:#EA4335;">Images upload failed, please try again.<span>');
            },
            success: function(data){
                $('#upload_pic_product')[0].reset();
                $('#uploadStatus').html('<span style="color:#28A74B;">Images uploaded successfully.<span>');
                $('.galeria').html(data);
            }
        });
    });

    // File type validation
    $("#fileInput").change(function(){
        var fileLength = this.files.length;
        var match= ["image/jpeg","image/png","image/jpg","image/gif"];
        var i;
        for(i = 0; i < fileLength; i++){
            var file = this.files[i];
            var imagefile = file.type;
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
                alert('Please select a valid image file (JPEG/JPG/PNG/GIF).');
                $("#fileInput").val('');
                return false;
            }
        }
    });

    </script>
  </body>
  </html>
