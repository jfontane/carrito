<?php
// initializ shopping cart class
include 'carrito.php';
$cart = new Cart;
$paginaActivo='verCarrito';

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
  <!-- Fontawesome core CSS -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <!--GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- custom CSS here -->
  <link href="assets/css/style.css" rel="stylesheet" />



</head>
<body>

  <?php include_once('nav.php'); ?>

  <header>
  <div class="container">
    <h1>Header</h1>
  </div>
  </header>



<div class="container">
  <h2><i class="fa fa-shopping-cart fa-lg"></i>&nbsp;Carrito de Compras </h2>
  <br>
  <div class="row">
      <div class="col-xs-12 col-sm-9">
        <div class="table-responsive">
        <table class="table table-stripped" width="100%">
          <thead>
            <tr>
              <th width='60%'class="text-center" style="font-size: 12px;padding-left: 5px;padding-right: 5px;">ITEM</th>
              <th width='5%' class="text-center" style="font-size: 12px;padding-left: 5px;padding-right: 5px;">P.UNIT.</th>
              <th width='3%' class="text-center" style="font-size: 12px;padding-left: 5px;padding-right: 5px;" >CANT.</th>
              <th width='10%' class="text-center" style="font-size: 12px;padding-left: 5px;padding-right: 5px;" >PRECIO</th>
              <th class="text-center" style="font-size: 12px;padding-left: 5px;padding-right: 5px;"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            //echo $cart->total_items();
            if($cart->total_items() > 0){
              //get cart items from session
              $cartItems = $cart->contents();
              //var_dump($cartItems);
              foreach($cartItems as $item){
                ?>
                <tr>
                  <td style="font-size: 12px;padding-left: 5px;padding-right: 5px;"><?php echo $item["name"]; ?></td>
                  <td class="text-right"  style="font-size: 12px;padding-left: 5px;padding-right: 5px;"><?php echo '$'.number_format($item["price"],2,'.',',').' '; ?></td>
                  <td class="text-center"  style="font-size: 12px;padding-left: 5px;padding-right: 5px;">
                    &nbsp;&nbsp;<span ><?php echo $item["qty"]; ?></span>&nbsp;&nbsp;
                  </td>
                     <td class="text-center"  style="font-size: 12px;padding-left: 5px;padding-right: 5px;">
                        <?php echo '$'.number_format($item["subtotal"],2,'.',',').' '; ?>&nbsp;
                     </td>
                     <td class="text-left" style="font-size: 12px;padding-left: 5px;padding-right: 5px;">
                       <a href="accionCarrito.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" onclick="return confirm('Confirma eliminar?')" >
                           <span class="material-icons">delete_outline</span>
                       </a>
                    </td>
                  </tr>

                <?php } }else{ ?>
                  <tr><td colspan="5"><p>Tu carrito esta vacio.....</p></td>
                  <?php } ?>
                </tbody>

                <tfoot>
                  <tr>
                    <td align='left'><b>Subtotal:</b></td>
                    <td align='left'><b>3 Items</b></td>
                    <td align='left'><b><?php echo '$'.number_format($cart->total(),2,'.',',').' '; ?></b></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td align='left'><b>Cupon:</b></td>
                    <td align='left'><b>10% off</b></td>
                    <td align='left'><b>$ 761,50</b></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="3" align='left'><b>Total:</b></td>
                    <td align='left'><b><?php echo '$'.number_format($cart->total(),2,'.',',').' '; ?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <?php if($cart->total_items() > 0){ ?>
                      <td class="text-right" colspan="4"><strong>Total <?php echo '$'.number_format($cart->total(),2,'.',',').' '; ?></strong></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <td colspan="5">
                      <a href="<?php echo ($usuario=="")?"login.php?target=ordenPagos":"ordenPagos.php"; ?>" id="btnConfirmarPedido" class="btn btn-primary orderBtn" >
                        Aceptar<i class="glyphicon glyphicon-menu-right"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href="index.php">Volver</a>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4">
                      <b>Nota:</b> El Boton 'Aceptar' del Pedido aun no realiza el pago. Solo acepta para pasar a otra instancia de verificacion.
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
            </div>
            <div class="col-xs-12 col-sm-3">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
          </div> <!-- END ROW -->
        </div>

      <?php include 'footer.php'; ?>
      <!--Footer end -->
      <!--Core JavaScript file  -->
      <?php
        include_once('scriptJs.php')
       ?>

      <script>
      function updateCartItem(valor,id,op){
        if (op=='suma') {
            valor = valor + 1;
        } else {
           if (valor != 1) {
              valor = valor - 1;
           };
        }
        $.get("accionCarrito.php", {action:"updateCartItem", id:id, qty:valor}, function(data){
          //alert(data)
          if(data == 'ok'){
            location.reload();
          }else{
            alert('Cart update failed, please try again.');
          }
        });
      }


    </script>

  </body>
  </html>
