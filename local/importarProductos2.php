<?php
include 'carrito.php';
$cart = new Cart;
include 'userControl.php';
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
  <div class="panel panel-default">
    <br><br><br>
    <div class="panel-heading">
      <h2>Importar <b>Productos</b></h2>
    </div>

    <div class="panel-body">
      <div id="products" class="row list-group">
        <div class='col-sm-4 pull-center'>
          <div id="custom-search-input">
            <div class="input-group col-md-12">

            </div>
          </div>
        </div>
        <div class='col-sm-4 pull-center'>
          <div id="custom-search-input">
            <div class="input-group col-md-12">
              <span class="input-group-btn">
                <a href='#' data-target="#uploadArchivoModal" data-toggle="modal" class="btn btn-info" type="button" data-role="disabled">
                  <img src="img/importar2.png" alt="">
                </a>
              </span>
            </div>
          </div>
        </div>
        <div class='col-sm-4 pull-center'>
          <div id="custom-search-input">
            <div class="input-group col-md-12">

            </div>
          </div>
        </div>
        <div class='clearfix'></div>
        <hr>
        <div id="loader"></div><!-- Carga de datos ajax aqui -->
        <div id="resultados"></div><!-- Carga de datos ajax aqui -->
        <div class='outer_div'></div><!-- Carga de datos ajax aqui -->
      </div>
    </div><!--Cierra Panel body-->
  </div><!-- Cierra Panel-->
</div><!-- Cierra Container-->



<!-- Edit Modal HTML -->
<?php include("html/modal_upload2.php");?>

<?php
  include("footer.php");
  ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">

$( "#upload_products" ).submit(function(e) {
  e.preventDefault();

  var f = $(this);
  var formData = new FormData($(this)[0]);
  //formData.append("archivo", $(this)[0].files[0]);
  //formData.append(f.attr("name"), $(this)[0].files[0]);
  $.ajax({
    url: "ajax/upload_archivo2.php",
    type: 'post',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function(objeto){
      $("#ress").html("<center><img src='img/loading.gif' width='80'></center>");
    },
  })
  .done(function(res){

    msg="<div class='alert alert-success' role='alert'>"+
    "<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
    "<strong>"+res+"</strong></div>";
    $("#botonAdjuntar").attr('disabled','disabled');
    $("#ress").html(msg);

  });

});

$("#btnCerrar").click(function(){

  $("#uploadArchivoModal").toggle();

})

</script>

</body>
</html>
