<?php
include("php/conexion.php");
function calcularPedidosPendientes($db) {
  $sql="SELECT * FROM orden WHERE estado='No Preparado'";
  $result=$db->query($sql);
  $row_cnt = $result->num_rows;
  return $row_cnt;
}

function cantidadMensajesEntrantes($db) {
  $sql="SELECT * FROM mp WHERE leido='no' and receptor='".$_SESSION['usuarioAdmin']."'";
  //die($sql);
  $result=$db->query($sql);
  $row_cnt = $result->num_rows;
  return $row_cnt;
};

$cantidad_pedidos=calcularPedidosPendientes($db);

$display="";
$cantidad_mensajes=0;
if ($_SESSION['usuarioAdmin']!='jfontane') {
  $display=' style="display:none" ';

} else {
  $cantidad_mensajes=cantidadMensajesEntrantes($db);
  $display='';
}
?>

<nav id="navbar" class="navbar navbar-inverse" >
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="principal.php">
      <span class="navbar-brand">
        <span>
          <img src="img/fotocopia.png" style="height: 44px; margin-top: -14px;">
        </span>
      </span>
      <span class="navbar-brand">
        <span class="hidden-xs"><strong>"El Original" </strong></span>
      </span>
      </a>

    </div>
    <div class="navbar-collapse collapse" id="navnav">
      <ul id="nav-menu" class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="ordenListado.php" title="Pedidos Pendientes"><i class="fa fa-truck fa-lg"></i>
            <?php if ($cantidad_pedidos>0) echo "<span class='badge badge-notify'>".$cantidad_pedidos."</span>";?>
          </a>
        </li>
        <li class="dropdown">
          <a href="verCarrito.php" title="Carrito de Compras"><i class="fa fa-shopping-cart fa-lg"></i>
            <?php if ($cart->total_items()) echo "<span class='badge badge-notify'>".$cart->total_items()."</span>";?>
          </a>
        </li>

        <li class="dropdown">
          <a href="mp.php?action=recibido" class="nav-link" title="Mensajes">
              <i class="fa fa-envelope fa-lg">&nbsp;</i>
              <?php if ($cantidad_mensajes>0) echo "<span id='mensajes_pendientes'><span class='badge badge-light'>".$cantidad_mensajes."</span></span>";?>
              </a>
        </li>


        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="glyphicon glyphicon-user"></i>
            <?php echo $_SESSION['usuarioAdmin']; ?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="authLogout.php"><span class="glyphicon glyphicon-log-out">&nbsp;</span>Salir</a>
            </li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="glyphicon glyphicon-list"></i>
            &nbsp;Configuracion&nbsp;
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="productosListadoAdmin.php" title="Tabla de Articulos">
              <i class="fa fa-book" aria-hidden="true"></i>&nbsp;Adm. Articulos
            </a>
          </li>

          <li><a href="clientesListadoAdmin.php" title="Tabla de Clientes">
            <i class="fa fa-address-book" aria-hidden="true"></i>&nbsp;Adm. Clientes
            </a>
          </li>

          <li class="divider" <?php echo $display;?>></li>

          <li <?php echo $display;?> ><a href="productosListadoJavier.php" title="Articulos para Destacar">
            <i class="fa fa-image"></i>&nbsp;Adm. Articulos
          </a>
          </li>

          <li <?php echo $display;?> ><a href="bannerList.php" title="Banners">
            <i class="fa fa-image"></i>&nbsp;Adm. Banner
          </a>
          </li>


    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="glyphicon glyphicon-tag"></i>
      Ventas
      <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="productosListado.php" title="Listado de Articulos">
          <i class="fa fa-gift" aria-hidden="true"></i>&nbsp;Articulos
        </a>
      </li>
      <li>
        <a href="ordenListado.php" title="Listado de Pedidos">
          <i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;Pedidos
        </a>
      </li>
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="glyphicon glyphicon-cog"></i>
      Actualizacion&nbsp;&nbsp;
      <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="importarProductos.php" title="Listado de Articulos">
          <i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;"Once May."
        </a>
      </li>
      <li>
        <a href="importarProductos2.php" title="Listado de Articulos">
          <i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;"Celeste y Bca"
        </a>
      </li>
    </ul>
  </li>


</ul>
</div>
</div>
</nav>
