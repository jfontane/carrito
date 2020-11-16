<?php
if (!isset($_SESSION['usuarioAdmin']) || $_SESSION['usuarioAdmin']=="") header("location: index.php");
 ?>
