<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
	/* Llamar la Cadena de Conexion*/
	include ("../php/conexion.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
  /*   $titulo = mysqli_real_escape_string($db,(strip_tags($_POST['titulo'], ENT_QUOTES)));
	 $descripcion = mysqli_real_escape_string($db,($_POST['descripcion']));
	 $orden = intval($_POST['orden']);
	 $estado = intval($_POST['estado']);
	 $id_banner=intval($_POST['id_banner']);*/
	 //$sql="UPDATE articulos SET titulo='$titulo', descripcion='$descripcion', orden='$orden', estado='$estado' WHERE id='$id_banner'";
	 $prod_titulo = $db->real_escape_string(strip_tags($_POST["titulo"],ENT_QUOTES));
	 $prod_name = $db->real_escape_string(strip_tags($_POST["descripcion"],ENT_QUOTES));
	 $prod_empaque = $db->real_escape_string(strip_tags($_POST["empaque"],ENT_QUOTES));
	 $prod_barCode = $db->real_escape_string(strip_tags($_POST["codigoBarra"],ENT_QUOTES));
	 $prod_code = $db->real_escape_string(strip_tags($_POST["codigo"],ENT_QUOTES));
	 //$stock = intval($_POST["duplicate_stock"]);
	 $prod_price = floatval($_POST["precioConIva"]);
	 $prod_recargo = floatval($_POST["porcentajeRecargo"]);
	 $prod_categoria = intval($_POST["categoria"]);
	 $prod_promocion = $db->real_escape_string(strip_tags($_POST["promocion"],ENT_QUOTES));
	 $id=intval($_POST['id_banner']);

	 $sql = "UPDATE articulos
 	        SET descripcion='$prod_name', empaque='$prod_empaque',
 			        precioConIva=$prod_price, codigoBarra='$prod_barCode', porcentajeRecargo=$prod_recargo,
 				      categoria_id=$prod_categoria, idOnce='$prod_code', promocion='$prod_promocion', titulo='$prod_titulo'
 			    WHERE id=$id ";
 	 $query = $db->query($sql);

	// $query = mysqli_query($db,$sql);
	// if user has been added successfully
	if ($query) {
		$messages[] = "Datos  han sido actualizados satisfactoriamente.";
	} else {
		$errors []= "Lo siento algo ha salido mal intenta nuevamente.";
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

}
?>
