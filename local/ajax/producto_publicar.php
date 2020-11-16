<?php
if (empty($_POST['publicar_id'])){
	$errors[] = "ID está vacío.";
} elseif (!empty($_POST['publicar_id'])){
	require_once ("../php/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	$prod_titulo = $db->real_escape_string(strip_tags($_POST["publicar_titulo"],ENT_QUOTES));
	$prod_descripcion =addslashes($_POST["publicar_descripcion"]);
	$prod_price = floatval($_POST["publicar_price"]);
	$prod_porcentaje_recargo = floatval($_POST["publicar_porcentaje"]);
	$prod_id=intval($_POST['publicar_id']);
	$prod_promocion=($_POST['publicar_promocion']=='Si')?'Si':'No';
	$prod_categoria=$_POST['publicar_categoria'];
	$fecha_hora = date('Y-m-d h:i:s');
	// PONER LA FECHAAAAAAAAAA HORAAAAAAAAAAAAAAAAAAA
	$sql = "UPDATE articulos
	        SET titulo='{$prod_titulo}', descripcion='{$prod_descripcion}', categoria_id={$prod_categoria},
	            precioConIva={$prod_price} , porcentajeRecargo={$prod_porcentaje_recargo} , promocion='{$prod_promocion}',
							fecha='{$fecha_hora}'
				  WHERE id=$prod_id";
	$query = $db->query($sql);
	//die("acaaaa".addslashes($_POST["publicar_descripcion"]));
	//die($sql);

	// if product has been added successfully
	if ($query) {
		$messages[] = "El producto ha sido Publicado con éxito.";
	} else {
		$errors[] = "Lo sentimos, la Publicacion falló. Por favor, regrese y vuelva a intentarlo.".$sql;
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
