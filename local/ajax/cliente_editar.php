<?php
if (empty($_POST['edit_id'])){
	$errors[] = "ID está vacío.";
} elseif (!empty($_POST['edit_id'])){
	require_once ("../php/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	$cliente_apellido = $db->real_escape_string(strip_tags($_POST["edit_apellido"],ENT_QUOTES));
	$cliente_nombre = $db->real_escape_string(strip_tags($_POST["edit_nombre"],ENT_QUOTES));
	$cliente_dni = $db->real_escape_string(strip_tags($_POST["edit_dni"],ENT_QUOTES));
	$cliente_email = $db->real_escape_string(strip_tags($_POST["edit_email"],ENT_QUOTES));
	$cliente_telefono = $db->real_escape_string(strip_tags($_POST["edit_telefono"],ENT_QUOTES));
	$cliente_direccion = $db->real_escape_string(strip_tags($_POST["edit_direccion"],ENT_QUOTES));
	//$stock = intval($_POST["duplicate_stock"]);
	$cliente_id=intval($_POST['edit_id']);
	// UPDATE data into database
	// $sql = "UPDATE articulos
	// SET idOnce='".$prod_code."-b', descripcion='".$prod_name."', empaque='".$prod_empaque.
	// "', precioConIva='".$prod_price."',  codigoBarra='".$prod_barCode."' WHERE id='".$id."' ";
	$sql = "UPDATE clientes
	        SET apellido='$cliente_apellido', nombre='$cliente_nombre', dni='$cliente_dni',
					    email='$cliente_email', telefono='$cliente_telefono', direccion='$cliente_direccion'
					WHERE id=$cliente_id ";
  $resultado=$db->query($sql);


	// if product has been added successfully
	if ($resultado) {
		$messages[] = "El <b>Cliente</b> ha sido Actualizado con éxito.";
	} else {
		$errors[] = "Lo sentimos, la Actualizacion falló. Por favor, regrese y vuelva a intentarlo.";
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
