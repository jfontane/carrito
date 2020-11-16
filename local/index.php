<!DOCTYPE html>
<html lang="es">
<head>
  <title>PHP Shopping Cart Tutorial</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap-3.3.7.min.css">
  <style>
  footer {
    background-color:#1A1A1A;
    height: 50%;
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

  <nav id="navbar" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <span class="navbar-brand">
          <span>
            <img src="img/fotocopia.png" style="height: 44px; margin-top: -14px;">
          </span>
        </span>
        <span class="navbar-brand">
          <span class="hidden-xs"><strong>Fotocopias "El Original"</strong></span>
        </span>

      </div>
    </div>
  </nav>

  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        poner algo
      </div>

      <div class="panel-body">
        <h1>Login</h1>
    <form id="formLogin">
        <div id="products" class="row">
          <div class="item col-lg-3">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Usuario</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Ingrese Usuario">
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese Password">
              </div>
 
          </div>
        </div>
        <div id="products" class="row">
          <div class="item col-lg-3">
              <div class="form-group col-md-12">
                   <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
        </div>
    </form>        
  </div>
</div><!--Panek cierra-->

      <div id="resultado">

      </div>
    </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <h6 class="text-muted lead">CONTACTO:</h6>
          <h6 class="text-muted">
            jfontanellaz@gmail.com<br>
            Teléfonos: 342-5163923.<br>
          </h6>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="row"> <p class="text-muted small text-right">AUS. Javier Fontanellaz @2019. <br> Todos los derechos reservados.</p></div>
        </div>
      </div>
    </div>
  </footer>

  <script>
  $(document).ready(function() {
    $( "#formLogin" ).submit(function( event ) {
      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "autenticacion.php",
        data: parametros,
        beforeSend: function(objeto){
          $("#resultado").html("<center><img src='img/ajax-loader.gif'></center>");
        },
        success: function(datos){
          mensaje='<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>'+
                  '<strong>Error!</strong> El Usuario/Password son Incorrectos.</div>';
          if (datos=='no') $("#resultado").html(mensaje);
          else $(location).attr('href','principal.php');
        }
      });
      event.preventDefault();
    });
  });

  </script>

</body>
</html>
