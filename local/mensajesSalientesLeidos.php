<?php
include_once 'php/conexion.php';
function mensajesSalientesLeidos($db, $id) {
  $sql="SELECT * FROM mp WHERE leido='no' and id=".$id;
  //echo $sql;
  //die;
  $result=$db->query($sql);
  $row_cnt = $result->num_rows;
  return $row_cnt;
};
?>
