<?php
//DB details
$DB_HOST="localhost";
$DB_NAME= "mrlhofsr_eloriginal";
$DB_USER= "root";
$DB_PASS= "";

//Create connection and select DB
$db = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
$db->set_charset("utf8");
if ($db->connect_error) {
    die("No hay Conexion con la base de datos: " . $db->connect_error);
}
?>
