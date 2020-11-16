<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["titulo"])){
	/* Llamar la Cadena de Conexion*/
	include ("../php/conexion.php");
	// escaping, additionally removing everything that could be (html/javascript-) code
  $titulo = $db->real_escape_string(strip_tags($_POST['titulo'], ENT_QUOTES));
	 $descripcion = $_POST['descripcion'];
	 $orden = intval($_POST['orden']);
	 $estado = intval($_POST['estado']);
	 $recargo = floatval($_POST['recargo']);
	 $id_banner=intval($_POST['id_banner']);
	 $sql="UPDATE promociones SET titulo='$titulo', descripcion='$descripcion', orden='$orden', 
	              estado='$estado', porcentajeRecargo=$recargo
	       WHERE id='$id_banner'";
	 $query = $db->query($sql);
	// if user has been added successfully
	if ($query) {
		$messages[] = "Datos  han sido actualizados satisfactoriamente.";
	} else {
		$errors []= "Lo siento algo ha salido mal intenta nuevamente.".$db->error;
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
