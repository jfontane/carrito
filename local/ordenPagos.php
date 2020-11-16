<?php
// include database configuration file
include 'php/conexion.php';
include 'php/libString.php';
// initializ shopping cart class
include 'carrito.php';
$cart = new Cart;
include 'userControl.php';
// redirect to home if cart is empty
if($cart->total_items() <= 0){
  header("Location: index.php");
}

// set customer ID in session
$_SESSION['sessCustomerID'] = 2;

// get customer details by session customer ID
$query = $db->query("SELECT * FROM clientes WHERE id = ".$_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?php
  include("head.php");
  ?>

  <style>
  .container{padding: 20px;}

  .table{width: 65%;float: left;}

  .shipAddr{width: 30%;float: left;margin-left: 30px;
    border-radius: 13px 13px 13px 13px;
    -moz-border-radius: 13px 13px 13px 13px;
    -webkit-border-radius: 13px 13px 13px 13px;
    border: 1px solid #000000;
  }


  .footBtn{width: 95%;float: left;}

  .orderBtn {float: right;}

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
<body id="ped">
  <?php
  include("navbar.php");
  ?>

<div class="container">
  <div class="panel panel-default">
    <br><br>
    <div class="panel-heading">
      <h1><b>Confirmar Pedido</b></h1>
    </div>
    <div class="panel-body">
      <h3>Vista previa de la Orden</h3>
      <table class="table">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Sub total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
              ?>
              <tr>
                <td><?php echo $item["name"]; ?></td>
                <td><?php echo '$'.number_format($item["price"],2,'.',',').' '; ?></td>
                <td><?php echo $item["qty"]; ?></td>
                <td><?php echo '$'.number_format($item["subtotal"],2,'.',',').' '; ?></td>
              </tr>
            <?php } }else{ ?>
              <tr><td colspan="4"><p>No hay articulos en tu carrito......</p></td>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3"></td>
                <?php if($cart->total_items() > 0){ ?>
                  <td class="text-center"><strong>Total <?php echo '$'.number_format($cart->total(),2,'.',',').' '; ?></strong></td>
                <?php } ?>
              </tr>
            </tfoot>
          </table>

          <div class="shipAddr">



            <fieldset>
              <table id="users" class="ui-widget ui-widget-content">
                <thead>
                  <tr class="ui-widget-header ">
                    <th colspan="2"><br>&nbsp;&nbsp;Datos del Cliente</th>
                  </tr>
                  <tr class="ui-widget-header ">
                    <th colspan="2">

                      <div class='col-sm-12 pull-left' style='padding-left: 5px;padding-right: 5px;'>
                        <div id="custom-search-input">
                          <div class="input-group col-md-12">
                            <input type="text" class="form-control" placeholder="Buscar Clientes"/>
                            <span class="input-group-btn">
                              <button class="btn btn-info" type="button" data-target="#myModal" data-toggle="modal">
                                <span class="glyphicon glyphicon-search"></span>
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>

                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th><br>&nbsp;&nbsp;Nombre:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;&nbsp;Dni:</td>
                        <td></td>
                      </tr>
                      <tr>
                        <th>&nbsp;&nbsp;Telefono:</td>
                          <td></td>
                        </tr>
                        <tr>
                          <th>&nbsp;&nbsp;Email:</td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </fieldset>
                    <br><br>
                  </div>
                  <div class="footBtn">
                    <br>
                    <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Comprando</a>
                    <a href="accionCarrito.php?action=placeOrder" class="btn btn-success orderBtn" id="btnPedido" >Realizar pedido <i class="glyphicon glyphicon-menu-right"></i></a>
                  </div>
                </div><!--Cierra Panel body-->
              </div><!-- Cierra Panel-->
            </div><!-- Cierra Container-->


            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Listado de Clientes</h4>
                  </div>
                  <div class="modal-body">
                    <p>Busqueda por Apellido:</p>

                    <div class='col-sm-12 pull-left'>
                      <div id="custom-search-input">
                        <div class="input-group col-md-12">
                          <input type="text" class="form-control" placeholder="Buscar por apellido.."  id="textBuscarApellido" />
                          <span class="input-group-btn">
                            <button class="btn btn-info" type="button">
                              <span class="glyphicon glyphicon-search"></span>
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class='clearfix'></div>
                    <hr>

                    <div class="table-responsive" id="listado_clientes">

                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCerrar">Close</button>
                  </div>
                </div>

              </div>
            </div>

          </div>

          <?php
          include("footer.php");
          ?>

          <!-- ********************************************************************************* -->
          <!-- ************ JAVASCRIPT ********************************************************* -->
          <!-- ********************************************************************************* -->

          <?php
          include("scriptJs.php");
          ?>

          <script>
          $("document").ready(function(){
            $("#btnPedido").click(function(e){
              dniCliente=$("#dni").html();
              idCliente=$("#textidcliente").val();
              //console.log("valor:"+idCliente);
              url='accionCarrito.php?action=placeOrder'+'&idcliente='+idCliente;
              e.preventDefault();

              $(location).attr('href',url);
              /*$( "#users tbody" ).append( "<tr>" +
              "<td>aaaaa</td>" +
              "<td>bbbbb</td>" +
              "</tr>" );*/
            });


            $.ajax({
              url:'ajax/listar_clientes.php',
              beforeSend: function(objeto){
                $("#listado_clientes").html("Cargando...");
              },
              success:function(data){
                //$(".outer_div").html(data).fadeIn('slow');
                $("#listado_clientes").html(data);
              }
            }); //END AJAX

            $("#textBuscarApellido").keyup(function(){
              $("#loader").fadeIn('slow');
              $valor=$("#textBuscarApellido").val();

              $.ajax({
                url:'ajax/listar_clientes.php',
                type: 'post',
                data: {"textBuscarApellido":$valor} ,
                beforeSend: function(objeto){
                  $("#listado_clientes").html("Cargando...");
                },
                success:function(data){
                  //$(".outer_div").html(data).fadeIn('slow');
                  $("#listado_clientes").html(data);
                }
              }); //END AJAX
            }); //END KEYUP


          })

          </script>

        </body>
        </html>
