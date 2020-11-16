<?php

/* Connect To Database*/
//require_once ("../conexion.php");
require_once ("../php/conexion.php");
require_once ("../php/libString.php");
//$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

$query=isset($_REQUEST['query'])?$_REQUEST['query']:"";
//echo $query." - ";
//die;
$tables=" orden, clientes ";
$campos="clientes.*, orden.id as orden_id, orden.precio_total as orden_precio, orden.creado as orden_creado,
orden.estado as orden_estado, orden.modificado as orden_modificado, orden.origen as orden_origen ";
$sWhere=" orden.cliente_id=clientes.id and (clientes.apellido LIKE '%".$query."%' or  clientes.nombre LIKE '%".$query."%')";
$sWhere.=" order by orden.id ";

$count_query = $db->query("SELECT * FROM $tables WHERE $sWhere ");
$numrows = $count_query->num_rows;

//$strSQL="SELECT $campos FROM $tables WHERE $sWhere";echo $strSQL;
//die;

$query = $db->query("SELECT $campos FROM $tables WHERE $sWhere ");

if ($numrows>0){

  ?>

  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class='text-center' width='10%'>ID PEDIDO</th>
          <th class='text-center' width='10%'>FECHA</th>
          <th class='text-center' width='18%'>APELLIDO Y NOMBRE </th>
          <!--<th>Email </th>-->
          <th class='text-center' width='15%'>MONTO</th>
          <th class='text-center' width='10%'>MODIFICACION</th>
          <th class='text-center' width='10%'>ESTADO</th>
          <th class='text-center' width='8%'>ORIGEN</th>
          <th class='text-center' width='15%'></th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($row = $query->fetch_assoc()){
          $pedido_id=$row['orden_id'];
          $pedido_creado=$row['orden_creado'];
          $pedido_nombre=formateaApellidos($row['apellido']).", ".formateaNombres($row['nombre']);
          //$pedido_email=$row['email'];
          $pedido_precio=$row['orden_precio'];
          $pedido_modificado=$row['orden_modificado'];
          $pedido_estado=$row['orden_estado'];
          $pedido_origen=$row['orden_origen'];
          ?>
          <tr>
            <td class='text-center'><?php echo '#'.$pedido_id;?></td>
            <td class='text-center'><?php echo $pedido_creado;?></td>
            <td class='text-left' ><?php echo $pedido_nombre;?></td>
            <!--  <td class='text-center' ><?php //echo $pedido_email;?></td>-->
            <td class='text-center' ><?php echo number_format($pedido_precio,'2',',','.');?></td>
            <td class='text-left' ><?php echo $pedido_modificado;?></td>
            <td class='text-center'><?php
            if ($pedido_estado=='No Preparado') echo "<label class='label label-danger'>PENDIENTE</label>";
            else if ($pedido_estado=='Preparado') echo "<label class='label label-warning'>PREPARADO</label>";
            else if ($pedido_estado=='Entregado') echo "<label class='label label-success'>ENTREGADO</label>";

            ?></td>
            <td class='text-center'><?php
            if ($pedido_origen=='Local') echo "<label class='label label-info'>LOCAL</label>";
            else if ($pedido_origen=='Internet') echo "<label class='label label-primary'>INTERNET</label>";
            ?></td>
            <td class='text-left'>
              <a href="ordenPedidoPDF.php?id=<?php echo $pedido_id;?>" target='_blank'>
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
              </a>
              <a href="#" data-target="#editPedidoModal" data-toggle="modal" data-id='<?php echo $pedido_id?>' data-estado='<?php echo $pedido_preparado?>' >
                <i class="fa fa-edit" aria-hidden="true"></i>
              </a>
              <a href="#deletePedidoModal" class="delete" data-toggle="modal" data-id="<?php echo $pedido_id;?>">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        <?php };?>
      </tbody>
    </table>
  </div>
<?php };?>
