<?php
	if (empty($_POST['apellido'])){
		$errors[] = "Ingresa el Apellido del Cliente.";
	} elseif (empty($_POST['nombre'])){
    $errors[] = "Ingresa el Nombre del Cliente.";
	} elseif (!empty($_POST['apellido'] && !empty($_POST['nombre']))) {
	require_once ("../php/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
  $cliente_apellido = $_POST["apellido"];
	$cliente_nombre = $_POST["nombre"];
	$cliente_dni = $_POST["dni"];
	$cliente_email = $_POST["email"];
	$cliente_telefono = $_POST["telefono"];
	$cliente_direccion = $_POST["direccion"];


	// REGISTER data into database
    $sql = "INSERT INTO clientes(id, apellido, nombre, dni, email, direccion, telefono) VALUES
		       (NULL,'$cliente_apellido','$cliente_nombre','$cliente_dni','$cliente_email','$cliente_telefono','$cliente_direccion')";
    $resultado=$db->query($sql);
    // if product has been added successfully
    if ($resultado) {
        $messages[] = "El Cliente ha sido guardado con éxito.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
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
