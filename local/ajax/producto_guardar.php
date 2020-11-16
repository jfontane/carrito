<?php
	if (empty($_POST['add_name'])){
		$errors[] = "Ingresa el nombre del producto.";
	} elseif (!empty($_POST['add_name'])){
	require_once ("../php/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
  $prod_code = $db->real_escape_string(strip_tags($_POST["add_code"],ENT_QUOTES));
	$prod_name = $db->real_escape_string(strip_tags($_POST["add_name"],ENT_QUOTES));
	$prod_empaque = $db->real_escape_string(strip_tags($_POST["add_empaque"],ENT_QUOTES));
	$prod_barCode = $db->real_escape_string(strip_tags($_POST["add_barCode"],ENT_QUOTES));

	$prod_price = floatval($_POST["add_price"]);
  $prod_categoria =intval($_POST["add_categoria"]);
	$prod_recargo = floatval($_POST["add_recargo"]);

	// REGISTER data into database
    $sql = "INSERT INTO articulos(idOnce, descripcion, empaque, precioConIva, porcentajeRecargo, codigoBarra, proveedor, url_image, categoria_id)
		        VALUES ('$prod_code','$prod_name','$prod_empaque',$prod_price,$prod_recargo,'$prod_barCode','Sin Informacion','demo.png',$prod_categoria)";


		/*
		INSERT INTO `articulos` (`id`, `idOnce`, `descripcion`, `empaque`, `precioSinIva`, `precioConIva`, `porcentajeRecargo`, `descuento`, `codigoBarra`, `proveedor`, `url_image`, `categoria_id`)
		VALUES (NULL, '11111', 'descripcion', 'unidad', '10', '22', '1.50', '0.00', '3434343434343434', 'Sin Informacion', 'demo.png', '100');
		*/

    $query = $db->query($sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El producto ha sido guardado con éxito.";
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
