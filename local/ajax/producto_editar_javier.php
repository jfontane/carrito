<?php
if (empty($_POST['edit_id'])){
	$errors[] = "ID está vacío.";
} elseif (!empty($_POST['edit_id'])){
	require_once ("../php/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	$prod_name = $db->real_escape_string(strip_tags($_POST["edit_name"],ENT_QUOTES));
	$prod_empaque = $db->real_escape_string(strip_tags($_POST["edit_empaque"],ENT_QUOTES));
	$prod_barCode = $db->real_escape_string(strip_tags($_POST["edit_barCode"],ENT_QUOTES));
	$prod_code = $db->real_escape_string(strip_tags($_POST["edit_code"],ENT_QUOTES));
	//$stock = intval($_POST["duplicate_stock"]);
	$prod_price = floatval($_POST["edit_price"]);
	$prod_recargo = floatval($_POST["edit_recargo"]);
	$prod_categoria = intval($_POST["edit_categoria"]);
	$id=intval($_POST['edit_id']);
	// UPDATE data into database
	// $sql = "UPDATE articulos
	// SET idOnce='".$prod_code."-b', descripcion='".$prod_name."', empaque='".$prod_empaque.
	// "', precioConIva='".$prod_price."',  codigoBarra='".$prod_barCode."' WHERE id='".$id."' ";
	$sql = "UPDATE articulos
	        SET descripcion='$prod_name', empaque='$prod_empaque',
			        precioConIva=$prod_price, codigoBarra='$prod_barCode', porcentajeRecargo=$prod_recargo,
				      categoria_id=$prod_categoria, idOnce=$prod_code
			    WHERE id=$id ";
	$query = $db->query($sql);


	// if product has been added successfully
	if ($query) {
		$messages[] = "El producto ha sido Actualizado con éxito.";
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
