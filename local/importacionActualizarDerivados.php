<?php
require_once ("php/conexion1.php");//Contiene funcion que conecta a la base de datos
function productos_actualizar_derivados($con) {
  $sql = "SELECT * FROM articulos_derivados";
  $query = mysqli_query($con,$sql);

  while ($fila=mysqli_fetch_assoc($query)) {
    $idOrigen=$fila['idOrigen'];
    $idDestino=$fila['idDestino'];
    $cantidad_por_empaque=$fila['cantidadPorEmpaque'];
    $sql_tmp_1 = "SELECT * FROM articulos WHERE id=$idOrigen";
    $query_tmp_1 = mysqli_query($con,$sql_tmp_1);
    $subfila=mysqli_fetch_assoc($query_tmp_1);
    $precioConIva=$subfila['precioConIva'];
    $precioActualizado=$precioConIva/$cantidad_por_empaque;
    $sql_tmp_2 = "UPDATE articulos SET precioConIva=$precioActualizado WHERE id=$idDestino";
    $query_tmp_2 = mysqli_query($con,$sql_tmp_2);
  };
};
?>
