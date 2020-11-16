<?php

/* Connect To Database*/
//require_once ("../conexion.php");
require_once ("../php/conexion.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	//$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$query=$_REQUEST['query'];
	if (strlen($_REQUEST['query'])<13) {
	    $sWhere=" (articulos.descripcion LIKE '%".$query."%' or articulos.idOnce LIKE '%".$query."%') and articulos.proveedor<>'javier'";
	} else {
	    $sWhere=" (articulos.codigoBarra LIKE '%".$query."%') and articulos.proveedor<>'javier'";
	}
	$tables="articulos";
	$campos="*";
	/*$sWhere=" (articulos.descripcion LIKE '%".$query."%' or articulos.idOnce LIKE '%".$query."%' or 
	articulos.codigoBarra LIKE '%".$query."%') and articulos.proveedor<>'javier'";*/
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
	$query = $db->query("SELECT $campos FROM $tables where $sWhere LIMIT $offset,$per_page");


	if ($numrows>0){
		$cadena=strtoupper($_REQUEST['query']);
		?>
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th width='5%'class='text-center' style="color: black !important;">CODIGO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th width='5%' class='text-center' style="color: black !important;">PIC</th>
						<th width='25%' class='text-center' style="color: black !important;">DESCRIPCION</th>
						<th width='5%' class='text-center'  style="color: black !important;">EMPAQUE</th>
						<th width='10%' class='text-center' style="color: black !important;">PRECIO</th>
						<th width='40%' class='text-center' style="color: black !important;">CODIGO DE BARRA</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$finales=0;
					while($row = $query->fetch_assoc()){
						$product_id=$row['id'];
						$prod_code=$row['idOnce'];
						$prod_name=$row['descripcion'];
						$empaque=$row['empaque'];
						$prod_barCode=$row['codigoBarra'];
						$prod_url_image=$row['url_image'];
						$prod_precio_con_iva=$row['precioConIva'];
						$prod_porcentaje_recargo=$row['porcentajeRecargo'];
						$prod_qty=1;//$row['prod_qty'];
						$price=$row['precioConIva']*$row['porcentajeRecargo'];
						$finales++;
						$prod_name_patron=$prod_name;
						$prod_barCode_patron=$prod_barCode;
						$prod_code_patron=$prod_code;
						if ($cadena!="" && strlen($cadena)>1) {
							$prod_code_patron=str_replace($cadena, "<span title class='highlight'>".$cadena."</span>", strtoupper($prod_code));
							$prod_name_patron=str_replace($cadena, "<span title class='highlight'>".$cadena."</span>", strtoupper($prod_name));
							$prod_barCode_patron=str_replace($cadena, "<span title class='highlight'>".$cadena."</span>", strtoupper($prod_barCode));
						}

						?>
						<tr style="height: 10px;">
							<td class='text-left small' style="color: black !important;" style="padding: 2px;">
								<a href="#" data-target="#viewProductModal" data-toggle="modal" data-id='<?php echo $prod_id?>' data-code='<?php echo $prod_code?>'
									data-name="<?php echo $prod_name?>" data-empaque="<?php echo $empaque?>"
									data-barcode="<?php echo $prod_barCode?>" data-price="<?php echo $prod_precio_con_iva?>"
									data-categoria="<?php echo $prod_categoria?>" data-recargo="<?php echo $prod_porcentaje_recargo?>">
									<i class="fa fa-eye"></i></a>
									&nbsp;
									<?php echo '<b>'.$prod_code_patron.'<b>';?>
									</td>
							<td>
									<?php echo "<img src='../img/banner/".$prod_url_image."' width='30'>"; ?>
							</td>		
						    <td class='text-left small' style="color: black !important;" style="padding: 2px;"><?php echo '<b>'.$prod_name_patron.'<b>';?></td>
						    <td class='text-left small' style="color: black !important;" style="padding: 2px;"><?php echo '<b>'.$empaque.'<b>';?></td>
							<td class='text-left ' style="color: black !important;" style="padding: 2px;"><?php echo '<b>$&nbsp;'.number_format($price,2,'.',',')."</b>";?></td>
							<td class='text-center font-weight-bold small' style="color: black !important;" style="padding: 2px;"><?php echo '<b>'.$prod_barCode_patron.'</b>';?></td>
							<td style="padding: 5px;">
												<a href="accionCarrito.php?action=addToCart&id=<?php echo $row["id"]; ?>" >
													<i class="fa fa-shopping-cart" aria-hidden="true"></i>
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
