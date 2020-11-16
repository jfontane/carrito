<?php
session_start();
include("php/conexion.php");

$login=$_POST['login'];
$password=md5($_POST['password']);
$sql="select * from usuario where nombreUsuario='".$login."' and passwordUsuario='".$password."'";

$resultado=$db->query($sql);
$cant=$resultado->num_rows;

if ($cant>0) {
  $_SESSION['usuarioAdmin']=$login;
  $_SESSION['username']=$login;
  $_SESSION['email']=$row['email'];
  //aca se crea la variable de session['usuario'];
} else echo "no";

?>
