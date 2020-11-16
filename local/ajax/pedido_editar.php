<?php
if (empty($_POST['edit_id'])){
	$errors[] = "ID está vacío.";
} elseif (!empty($_POST['edit_id'])){
	require_once ("../php/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	$pedido_estado = $db->real_escape_string(strip_tags($_POST["edit_estado"],ENT_QUOTES));
  $pedido_fecha_modificado=date('Y-m-d');
	$pedido_id=intval($_POST['edit_id']);

	$sql = "UPDATE orden
	        SET estado='$pedido_estado', modificado='$pedido_fecha_modificado'
					WHERE id=$pedido_id ";
  $resultado=$db->query($sql);


	// if product has been added successfully
	if ($resultado) {
		$messages[] = "El <b>Pedido</b> ha sido Actualizado con éxito.";
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
