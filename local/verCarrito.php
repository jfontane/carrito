<?php
// initializ shopping cart class
include 'carrito.php';
$cart = new Cart;
include 'userControl.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  include("head.php");
  ?>

  <style>
  .container{padding: 20px;}

  input[type="number"]{width: 40%;}

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
    <br><br>
    <div class="panel-heading">
      <h2><b>Carrito de Compras</b></h2>
    </div>

    <div class="panel-body">
      <table class="table">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Descuento</th>
            <th>Sub total</th>
            <th>&nbsp;</th>
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
                <td><?php echo $item["name"]; ?></td>
                <td><?php echo '$'.number_format($item["price"],2,'.',',').' '; ?></td>
                <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>

                <td><input type="number" class="form-control text-center" value="<?php echo $item["discount"]; ?>" onchange="updateCartItemDisc(this, '<?php echo $item["rowid"]; ?>')"></td>

                <td><?php echo '$'.number_format($item["subtotal"],2,'.',',').' '; ?></td>
                <td>
                  <a href="accionCarrito.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Confirma eliminar?')"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
              </tr>
            <?php } }else{ ?>
              <tr><td colspan="5"><p>Tu carrito esta vacio.....</p></td>
              <?php } ?>
            </tbody>

            <tfoot>
              <tr>
                <td colspan="5"></td>
              </tr>
              <tr>
                <td colspan="5"></td>
              </tr>
              <tr>
                <td colspan="5"></td>
              </tr>
              <tr>
                <td><a href="productosListado.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Comprando</a></td>
                <td colspan="2"></td>
                <?php if($cart->total_items() > 0){ ?>
                  <td class="text-center"><strong>Total <?php echo '$'.number_format($cart->total(),2,'.',',').' '; ?></strong></td>
                  <td><a href="ordenPagos.php" class="btn btn-success btn-block">Pagos <i class="glyphicon glyphicon-menu-right"></i></a></td>
                <?php } ?>
              </tr>
              <tr>
                <td colspan="5"></td>
              </tr>
              <tr>
                <td colspan="5"></td>
              </tr>
              <tr>
                <td colspan="5"></td>
              </tr>
            </tfoot>
          </table>

        </div><!--Cierra Panel body-->
      </div><!-- Cierra Panel-->
    </div><!-- Cierra Container-->

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
    function updateCartItem(obj,id){
      console.log('qty: '+obj.value+' id: '+id);
      $.get("accionCarrito.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        //alert(data)
        if(data == 'ok'){
          location.reload();
        }else{
          alert('Cart update failed, please try again.');
        }
      });
    }

    function updateCartItemDisc(obj,id){
      console.log('discount: '+obj.value+' id: '+id);
      $.get("accionCarrito.php", {action:"updateCartItemDisc", id:id, discount:obj.value}, function(data){
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
