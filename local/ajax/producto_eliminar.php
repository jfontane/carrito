<?php
if (empty($_POST['delete_id'])){
	$errors[] = "Id vacío.";
} elseif (!empty($_POST['delete_id'])){
	require_once ("../php/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	$id_producto=intval($_POST['delete_id']);


	// DELETE de la constraint FOREIGN KEY
	$sql_1 = "DELETE FROM  articulos_derivados WHERE idOrigen='$id_producto' or idDestino='$id_producto' ";
	$query_1 = $db->query($sql_1);

	// DELETE de la constraint FOREIGN KEY
	$sql_2 = "DELETE FROM  promociones WHERE articulo_id='$id_producto'";
	$query_2 = $db->query($sql_2);

	// DELETE del articulo ahora si
	$sql = "DELETE FROM  articulos WHERE id='$id_producto'";
	$query = $db->query($sql);

	// if product has been added successfully
	if ($query && $query_1 && $query_2) {
		$messages[] = "El producto ha sido eliminado con éxito.";
	} else {
		$errors[] = "Lo sentimos, la eliminación falló. Por favor, regrese y vuelva a intentarlo.".$sql_1.'----'.$sql;
	}

} else
{
	$errors[] = "desconocido.";
}
if (isset($errors)){

	?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong>
		<?php
		foreach ($errors as $error) {
			echo $error;
		}
		?>
	</div>
	<?php
}
if (isset($messages)){

	?>
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡Bien hecho!</strong>
		<?php
		foreach ($messages as $message) {
			echo $message;
		}
		?>
	</div>
	<?php
}
?>
