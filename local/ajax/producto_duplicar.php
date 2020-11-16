<?php
if (empty($_POST['duplicate_id'])){
	$errors[] = "ID está vacío.";
} elseif (!empty($_POST['duplicate_id'])){
	require_once ("../php/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	$prod_code = $db->real_escape_string(strip_tags($_POST["duplicate_code"],ENT_QUOTES));
	$prod_name = $db->real_escape_string(strip_tags($_POST["duplicate_name"],ENT_QUOTES));
	$prod_empaque = $db->real_escape_string(strip_tags($_POST["duplicate_empaque"],ENT_QUOTES));
	$prod_barCode = $db->real_escape_string(strip_tags($_POST["duplicate_barCode"],ENT_QUOTES));
	//$stock = intval($_POST["duplicate_stock"]);
	$prod_price = floatval($_POST["duplicate_price"]);
	$prod_recargo = floatval($_POST["duplicate_recargo"]);
	$id=intval($_POST['duplicate_id']);
	$cantidad_por_empaque=intval($_POST['duplicate_cantidad_empaque']);
	// UPDATE data into database
	// $sql = "UPDATE articulos
	// SET idOnce='".$prod_code."-b', descripcion='".$prod_name."', empaque='".$prod_empaque.
	// "', precioConIva='".$prod_price."',  codigoBarra='".$prod_barCode."' WHERE id='".$id."' ";
  $prod_code.='-b';
	$prod_price_unidad=$prod_price/$cantidad_por_empaque;
	$sql = "INSERT INTO articulos(idOnce,descripcion,empaque,precioConIva,codigoBarra,porcentajeRecargo) VALUES
	        ('$prod_code','$prod_name','$prod_empaque', $prod_price_unidad, '$prod_barCode',$prod_recargo)";
	$query = $db->query($sql);
	$idOrigen=$id;
	$idDestino=$db->insert_id;
	$sql_2 = "INSERT INTO articulos_derivados(idOrigen, idDestino, cantidadPorEmpaque) VALUES
					                               ($idOrigen, $idDestino, $cantidad_por_empaque)";
	$query_2 = $db->query($sql_2);

	// if product has been added successfully
	if ($query && $query_2) {
		$messages[] = "El producto ha sido Duplicado con éxito.";
	} else {
		$errors[] = "Lo sentimos, la Duplicacion falló. Por favor, regrese y vuelva a intentarlo.".$sql_2;
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
