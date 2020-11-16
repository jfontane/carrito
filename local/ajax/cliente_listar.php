<?php

/* Connect To Database*/
//require_once ("../conexion.php");
require_once ("../php/conexion.php");
require_once ("../php/libString.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	//$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$query=$_REQUEST['query'];
	$tables="clientes";
	$campos="*";
	$sWhere=" clientes.apellido LIKE '%".$query."%' or clientes.nombre LIKE '%".$query."%' or clientes.dni LIKE '%".$query."%' or clientes.email LIKE '%".$query."%' ";
	$sWhere.=" order by clientes.apellido asc, clientes.nombre asc ";


	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/

	$count_query = $db->query("SELECT * FROM $tables where $sWhere ");
	$numrows = $count_query->num_rows;


	$total_pages = ceil($numrows/$per_page);
	//main query to fetch the data
	//loop through fetched data
	$query = $db->query("SELECT $campos FROM $tables where $sWhere LIMIT $offset,$per_page");


	if ($numrows>0){

		?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class='text-center' width='5%'>Código</th>
						<th width='12%'>Apellido </th>
						<th width='17%'>Nombre </th>
						<th class='text-right' width='5%'>Dni</th>
						<th class='text-right'>Email</th>
						<th class='text-right'>Direccion</th>
						<th class='text-right' width='15%'>Telefono</th>
						<th width='20%'></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$finales=0;
					while($row = $query->fetch_assoc()){
						$client_id=$row['id'];
						$client_apellido=formateaApellidos($row['apellido']);
						$client_nombre=formateaNombres($row['nombre']);
						$client_dni=$row['dni'];
						$client_email=$row['email'];
						$client_direccion=$row['direccion'];
						$client_telefono=$row['telefono'];
						$finales++;
						?>
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $client_id;?></td>
							<td ><?php echo $client_apellido;?></td>
							<td ><?php echo $client_nombre;?></td>
							<td class='text-center' ><?php echo $client_dni;?></td>
							<td class='text-right'><?php echo $client_email;?></td>
							<td class='text-right'><?php echo $client_direccion;?></td>
							<td class='text-right'><?php echo $client_telefono;?></td>
							<td>
								<a href="#" data-target="#editClienteModal" class="edit" data-toggle="modal" data-id='<?php echo $client_id?>' data-apellido="<?php echo $client_apellido?>"
									          data-nombre="<?php echo $client_nombre?>" data-dni="<?php echo $client_dni?>" data-email="<?php echo $client_email?>"
														data-telefono="<?php echo $client_telefono; ?>" data-direccion="<?php echo $client_direccion;?>">
									<i class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Editar Cliente" ></i></a>
									<a href="#deleteClienteModal" class="delete" data-toggle="modal" data-id="<?php echo $client_id;?>">
										<i class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Eliminar Cliente" ></i>
									</a>
								</td>
							</tr>
						<?php }?>
						<tr>
							<td colspan="6"></td>
						</tr>
						<tr>
							<td colspan="6"></td>
						</tr>
						<tr>
							<td colspan='6'>
								<?php
								$inicios=$offset+1;
								$finales+=$inicios-1;
								echo "Mostrando $inicios al $finales de $numrows registros";
								echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
						<tr>
							<td colspan="6"></td>
						</tr>
						<tr>
							<td colspan="6"></td>
						</tr>
						<tr>
							<td colspan="6"></td>
						</tr>
					</tbody>
				</table>
			</div>



			<?php
		}
	}
	?>
