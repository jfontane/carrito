<?php
ob_start();
include("php/conexion.php");
include 'carrito.php';
$cart = new Cart;
$paginaActivo='index';
include('mensajesSalientesLeidos.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title></title>
	<?php include('head.php'); ?>
	<link rel="stylesheet" href="http://rawgithub.com/cheeaun/mooeditable/master/Assets/MooEditable/MooEditable.css">

	<style>
	footer {
		background-color:#1A1A1A;
		height: 15%;
		color: white;
		padding: 15px;
	}

	.main1 {
		display:flex;
		margin:0 auto;
	}

	a img:hover {
		color: #fff;
	}
	</style>

	<script src="http://ajax.googleapis.com/ajax/libs/mootools/1.3.0/mootools-yui-compressed.js"></script>
	<script src="http://rawgithub.com/cheeaun/mooeditable/master/Source/MooEditable/MooEditable.js"></script>

	<script>
	window.addEvent('domready', function(){
		$('textarea-1').mooEditable();
	});
	</script>
	<body>
<?php
require('navbar.php');
require('php/conexion1.php');
 ?>
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>&nbsp;&nbsp;&nbsp;Administrar <b>Mensajes</b></h2>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
		<?php
		$badgeRecibidos="";
		if ($cantidad_mensajes>0) $badgeRecibidos="<span id='mensajes_pendientes'><span class='badge badge-light'>".$cantidad_mensajes."</span></span>";
		echo '<br><a href="?action=create"><i class="fa fa-paper-plane fa-lg"></i>&nbsp;Enviar mensaje</a> | <a href="?action=recibido"><i class="fa fa-inbox fa-lg">'.$badgeRecibidos.'</i>&nbsp;Mensajes recibidos</a> | '.
		'<a href="?action=enviado"><i class="fa fa-paper-plane fa-lg"></i>&nbsp;Mensajes enviados</a><hr>';
		if(isset($_SESSION['username'])):
			if(@$_GET['action'] == 'delete-receptor' AND isset($_GET['id'])):
				$mensaje = mysqli_query($con, "SELECT id,title,message FROM mp WHERE id = '".mysqli_real_escape_string($con, $_GET['id'])."' AND receptor = '".$_SESSION['username']."'");
				if($mensaje1 = mysqli_fetch_assoc($mensaje)):
					mysqli_query($con, "DELETE FROM mp WHERE id = '".mysqli_real_escape_string($con, $_GET['id'])."' AND receptor = '".$_SESSION['username']."'");
					header('Location: ?action=recibido');
				else:
					echo 'No puedes eliminar este mensaje<br>';
				endif;
				elseif(@$_GET['action'] == 'recibido' AND isset($_GET['id'])):
					$mensaje = mysqli_query($con, "SELECT id,title,message, emisor FROM mp WHERE id = '".mysqli_real_escape_string($con, $_GET['id'])."' AND receptor = '".$_SESSION['username']."'");
					if($mensaje1 = mysqli_fetch_assoc($mensaje)):
						mysqli_query($con, "UPDATE mp SET leido = 'yes' WHERE id = '".mysqli_real_escape_string($con, $_GET['id'])."' AND receptor = '".$_SESSION['username']."'");
						echo '<b>Emisor:</b> '.$mensaje1['emisor'].'<br><b>Titulo:</b> '.$mensaje1['title'].'<br><b>Mensaje:</b> '.$mensaje1['message'].'<br> <a href="?action=delete-receptor&id='.$mensaje1['id'].'">Eliminar mensaje</a><br>';
					else:
						echo 'No puedes leer este mensaje<br>';
					endif;
					elseif(@$_GET['action'] == 'recibido'):
						echo '<h3>&nbsp;&nbsp;&nbsp;Bandeja de Entrada</h3><br>';

						$receptor = mysqli_query($con, "SELECT title FROM mp WHERE receptor = '".$_SESSION['username']."'");
						if($receptor1 = mysqli_fetch_assoc($receptor)):
							$receptor1 = mysqli_query($con, "SELECT id,title,leido,emisor, fecha FROM mp WHERE receptor = '".$_SESSION['username']."' ORDER BY leido");
							echo "<table class='table'><th>Remitente</th><th>Asunto</th><th>Fecha</th><th></th>";
							while($receptor2 = mysqli_fetch_assoc($receptor1)):
								if($receptor2['leido'] == 'no'):
									echo "<tr><td>".$receptor2['emisor']."</td><td>".'<a href="?action=recibido&id='.$receptor2['id'].'">'.$receptor2['title']."</a></td><td>".$receptor2['fecha']."</td><td>"."<i class='fa fa-envelope'></i>"."</td>";
								else:
									echo "<tr><td>".$receptor2['emisor']."</td><td>".'<a href="?action=recibido&id='.$receptor2['id'].'">'.$receptor2['title']."</a></td><td>".$receptor2['fecha']."</td><td>"."<i class='fa fa-envelope-open'></i>"."</td>";
								endif;
							endwhile;
							echo "</table>";
						else:
							echo 'No haz enviado ningun mensaje<br><br>';
						endif;
						elseif(@$_GET['action'] == 'delete-emisor' AND isset($_GET['id'])):
							$mensaje = mysqli_query($con, "SELECT id,title,message FROM mp WHERE id = '".mysqli_real_escape_string($con, $_GET['id'])."' AND emisor = '".$_SESSION['username']."'");
							if($mensaje1 = mysqli_fetch_assoc($mensaje)):
								mysqli_query($con, "DELETE FROM mp WHERE id = '".mysqli_real_escape_string($con, $_GET['id'])."' AND emisor = '".$_SESSION['username']."'");
								header('Location: ?action=enviado');
							else:
								echo 'No puedes eliminar este mensaje<br>';
							endif;
							elseif(@$_GET['action'] == 'enviado' AND isset($_GET['id'])):
								$mensaje = mysqli_query($con, "SELECT receptor, id, title, message FROM mp WHERE id = '".mysqli_real_escape_string($con, $_GET['id'])."' AND emisor = '".$_SESSION['username']."'");
								if($mensaje1 = mysqli_fetch_assoc($mensaje)):
									echo '<b>Enviado a: </b>'.$mensaje1['receptor'].'<br><b>Titulo:</b> '.$mensaje1['title'].'<br><b>Mensaje:</b> '.$mensaje1['message'].' <a href="?action=delete-emisor&id='.$mensaje1['id'].'">Eliminar mensaje</a><br>';
								else:
									echo 'No puedes leer este mensaje<br>';
								endif;
								elseif(@$_GET['action'] == 'enviado'):
									echo '<h3><img src="img/bandeja_salida.png" width="80">&nbsp;&nbsp;&nbsp;Bandeja de Salida</h3><br>';
									$sql="SELECT title FROM mp WHERE emisor = '".$_SESSION['username']."'";
									//	die($sql);
									$emisor = mysqli_query($con, "SELECT id,title FROM mp WHERE emisor = '".$_SESSION['username']."'");
									if($emisor1 = mysqli_fetch_assoc($emisor)):
										$emisor1 = mysqli_query($con, "SELECT id,title, receptor, fecha FROM mp WHERE emisor = '".$_SESSION['username']."'");
										echo "<table class='table'><th>Destinatario</th><th>Asunto</th><th>Fecha</th><th></th>";
										while($emisor2 = mysqli_fetch_assoc($emisor1)):
											//echo '<b>Enviado a: </b>'.$emisor2['receptor'].'&nbsp;&nbsp;<b>|</b>&nbsp;<a href="?action=enviado&id='.$emisor2['id'].'">'.$emisor2['title'].'</a>';
											if (mensajesSalientesLeidos($db, $emisor2['id'])) $ico_msg='&nbsp;&nbsp;<i class="fa fa-envelope"></i>';
											else $ico_msg='&nbsp;&nbsp;<i class="fa fa-envelope-open"></i>';
											echo "<tr><td>".$emisor2['receptor']."</td><td>".'<a href="?action=enviado&id='.$emisor2['id'].'">'.$emisor2['title']."</a></td><td>".$emisor2['fecha']."</td><td>".$ico_msg."</td>";
										endwhile;
										echo "</table>";
									else:
										echo 'No haz enviado ningun mensaje<br><br>';
									endif;
									elseif(@$_GET['action'] == 'create'):
										if(isset($_POST['enviar'])):
											if(empty($_POST['username']) || empty($_POST['title']) || empty($_POST['message'])):
												echo 'Haz dejado campos en blanco';
											else:
												//$email = $_SESSION['email'];
												//if($email):
												mysqli_query($con, "INSERT INTO mp(id,emisor,receptor,title,message,leido,fecha,ip) VALUES ('', '".$_SESSION['username']."', '".mysqli_real_escape_string($con, $_POST['username'])."', '".mysqli_real_escape_string($con, $_POST['title'])."', '".mysqli_real_escape_string($con, $_POST['message'])."', 'no', '".date("Y-m-d")."', '".$_SERVER['SERVER_ADDR']."')");
												header('Location: ?action=enviado');
												//else:
												//        echo 'El usuario no existe';
												//endif;
											endif;
										endif;
										echo '<h3><img src="img/redactar_mensaje.png" width="80">&nbsp;&nbsp;&nbsp;Redactar Mensaje</h3><br>';
										echo '<form action="" method="post">
										<input name="username" placeholder="Usuario para enviarle el mensaje"><br>
										<input name="title" value="Sin asunto"><br>
										<textarea class="mooeditable" id="textarea-1" name="message" rows="10" cols="50">Mensaje</textarea><br>
										<input name="enviar" type="submit" value="Enviar mensaje">
										</form>';
									endif;
									$badgeRecibidos="";

									if ($cantidad_mensajes>0) $badgeRecibidos="<span id='mensajes_pendientes'><span class='badge badge-light'>".$cantidad_mensajes."</span></span>";
									echo '<hr>';
									echo '<br><a href="?action=create"><i class="fa fa-paper-plane fa-lg"></i>&nbsp;Enviar mensaje</a> | <a href="?action=recibido"><i class="fa fa-inbox fa-lg">'.$badgeRecibidos.'</i>&nbsp;Mensajes recibidos</a> | '.
									'<a href="?action=enviado"><i class="fa fa-paper-plane fa-lg"></i>&nbsp;Mensajes enviados</a><hr>';
								else:
									header('Location: index.php');
								endif;
								?>
							</div>
							<div class="col-sm-1"></div>
				</div>
				<?php
				include_once('footer.php');
				include_once('scriptJs.php');
				 ?>
		</body>
</html>
