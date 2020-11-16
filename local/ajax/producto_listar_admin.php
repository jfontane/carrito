<?php

/* Connect To Database*/
//require_once ("../conexion.php");
require_once ("../php/conexion.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	//$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$query=$_REQUEST['query'];
	if (strlen($_REQUEST['query'])<13) {
	    $sWhere="(articulos.categoria_id=categorias.id) and (articulos.descripcion LIKE '%".$query."%' or
	             articulos.idOnce LIKE '%".$query."%')  and
	             articulos.proveedor<>'javier' ";
	} else {
	    $sWhere="(articulos.categoria_id=categorias.id) and (articulos.codigoBarra LIKE '%".$query."%')  and
	             articulos.proveedor<>'javier' ";
	};
	/*$sWhere="(articulos.categoria_id=categorias.id) and (articulos.descripcion LIKE '%".$query."%' or
	             articulos.idOnce LIKE '%".$query."%' or articulos.codigoBarra LIKE '%".$query."%')  and
	             articulos.proveedor<>'javier' ";*/
	$tables="articulos, categorias ";
	$campos="articulos.*, categorias.descripcion as categoria_descripcion";

	$sWhere.=" order by articulos.id asc, articulos.descripcion";


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
	$strsql="SELECT $campos FROM $tables where $sWhere LIMIT $offset,$per_page";
	$query = $db->query($strsql);


	if ($numrows>0){
          $cadena=strtoupper($_REQUEST['query']);
		?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class='text-left' width='15%' style="color: black !important;">CODIGO</th>
						<th style="color: black !important;" width='4%'>PIC</th>
						<th width='23%' style="color: black !important;">PRODUCTO</th>
						<th width='5%' style="color: black !important;">EMPAQUE</th>
						<th width='3%' style="color: black !important;">P.COSTO</th>
					  <th class='text-right' width='5%' style="color: black !important;">P.VENTA</th>
						<th class='text-center' width='35%' style="color: black !important;">CODIGO DE BARRA</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$finales=0;
					while($row = $query->fetch_assoc()){
						$prod_id=$row['id'];
						$prod_code=$row['idOnce'];
						$prod_name=strip_tags($row['descripcion']);
						$prod_empaque=$row['empaque'];
						$prod_barCode=$row['codigoBarra'];
						$prod_url_image=$row['url_image'];
						$prod_precio_con_iva=$row['precioConIva'];
						$prod_porcentaje_recargo=$row['porcentajeRecargo'];
						$prod_categoria=$row['categoria_id'];
						$prod_categoria_descripcion=$row['categoria_descripcion'];
						$prod_qty=1;//$row['prod_qty'];
						$price=$row['precioConIva']*$row['porcentajeRecargo'];
						$finales++;
						$prod_name_patron=$prod_name;
						$prod_barCode_patron=$prod_barCode;
						$prod_code_patron=$prod_code;
						if ($cadena!="" && strlen($cadena)>1) {
								$prod_name_patron=str_replace($cadena, "<span title class='highlight'>".$cadena."</span>", strtoupper($prod_name));
								$prod_barCode_patron=str_replace($cadena, "<span title class='highlight'>".$cadena."</span>", strtoupper($prod_barCode));
								$prod_code_patron=str_replace($cadena, "<span title class='highlight'>".$cadena."</span>", strtoupper($prod_code));
						}

						?>
						<tr >
							<td class='text-left font-weight-bold small' style="color: black !important;">
								<a href="#" data-target="#viewProductModal" data-toggle="modal" data-id='<?php echo $prod_id?>' data-code='<?php echo $prod_code?>'
														data-name="<?php echo $prod_name?>" data-empaque="<?php echo $prod_empaque?>"
														data-barcode="<?php echo $prod_barCode?>" data-price="<?php echo $prod_precio_con_iva?>"
														data-categoria="<?php echo $prod_categoria?>" data-recargo="<?php echo $prod_porcentaje_recargo?>">
														<i class="fa fa-eye"></i></a>&nbsp;
								<?php echo '<b>'.$prod_code_patron.'</b>';?>

							</td>
							<td>
									<?php echo "<img src='../img/banner/".$prod_url_image."' width='30'>"; ?>
							</td>
							<td class="text-left font-weight-bold small" style="color: black !important;"><?php echo '<b>'.$prod_name_patron.'</b>';?></td>
							<td class="font-weight-bold small" style="color: black !important;"><?php echo $prod_empaque;?></td>
							<td class="font-weight-bold small" style="color: black !important;"><?php echo '<b>$&nbsp;</b>'.number_format($prod_precio_con_iva,2,'.',',');?></td>
							<td class='text-right font-weight-bold small' style="color: black !important;"><?php echo '<b>$&nbsp;'.number_format($price,2,'.',',').'</b>';?></td>
							<td class="font-weight-bold small" style="color: black !important;"><?php echo '<b>'.$prod_barCode_patron.'</b>';?></td>
							<td class="font-weight-bold small" style="color: black !important;">
								<a href="#" data-target="#duplicateProductModal" data-toggle="modal" data-id='<?php echo $prod_id?>' data-code='<?php echo $prod_code?>'
									data-name="<?php echo $prod_name?>" data-empaque="<?php echo $prod_empaque?>" data-barcode="<?php echo $prod_barCode?>"
									data-price="<?php echo $prod_precio_con_iva?>" data-recargo="<?php echo $prod_porcentaje_recargo?>">
									<i class="fa fa-copy fa-1x" data-toggle="tooltip" title="Duplicar Articulo" ></i></a>
							  <a href="#" data-target="#editProductModal" data-toggle="modal" data-id='<?php echo $prod_id?>' data-code='<?php echo $prod_code?>'
									          data-name="<?php echo $prod_name?>" data-empaque="<?php echo $prod_empaque?>"
													  data-barcode="<?php echo $prod_barCode?>" data-price="<?php echo $prod_precio_con_iva?>"
														data-categoria="<?php echo $prod_categoria?>" data-recargo="<?php echo $prod_porcentaje_recargo?>">
									<i class="fa fa-edit" data-toggle="tooltip" title="Editar Articulo" ></i></a>
								<a href="#deleteProductModal" class="delete" data-toggle="modal" data-id="<?php echo $prod_id;?>">
									<i class="fa fa-trash" data-toggle="tooltip" title="Eliminar Articulo" ></i>
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
