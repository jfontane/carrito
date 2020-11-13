<?php
session_start();
include("../php/conexion.php");

$login=$_POST['login'];
$password=$_POST['password'];
$targetUrl=$_POST['textTargetUrl'];
$sql="select * from clientes where email='".$login."' and password='".$password."'";
$resultado=$con->query($sql);
$cant=$resultado->num_rows;

if ($cant>0) {
  $row=$resultado->fetch_assoc();
  $user=explode("@",$login)[0];
  $_SESSION['usuario']=$row['email'];
  $_SESSION['email']=$row['email'];
  $_SESSION['username']=$row['email'];
  $_SESSION['idCliente']=$row['id'];
  $_SESSION['foto']=$row['foto'];
  echo $targetUrl.'.php';
  //aca se crea la variable de session['usuario'];
} else echo "no";


?>
