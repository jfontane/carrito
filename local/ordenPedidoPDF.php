<?php
require('php/mc_table.php');
require('php/conexion.php');

function GenerateWord()
{
	//Get a random word
	$nb=rand(3,10);
	$w='';
	for($i=1;$i<=$nb;$i++)
	$w.=chr(rand(ord('a'),ord('z')));
	return $w;
}

function GenerateSentence()
{
	//Get a random sentence
	$nb=rand(1,10);
	$s='';
	for($i=1;$i<=$nb;$i++)
	$s.=GenerateWord().' ';
	return substr($s,0,-1);
}

function generateItem($db,$orden_id) {
	$arreglo_items=array();
	$tables=" orden_articulos, articulos ";
	$campos="orden_articulos.id, orden_id, articulos.id as articulo_id, articulos.idOnce as articulo_idonce,
	         articulos.descripcion as descripcion, orden_articulos.cantidad as cantidad, orden_articulos.descuento as descuento,
					 orden_articulos.precioUnitario as precioU, orden_articulos.porcentajeRecargo as orden_porcentajeRecargo,
					 (orden_articulos.precioUnitario*orden_articulos.porcentajeRecargo*orden_articulos.cantidad) as valor
					  ";
	$sWhere=" orden_id=".$orden_id." and orden_articulos.articulo_id=articulos.id ";
	$sWhere.=" order by articulos.id ";
	//$strSQL="SELECT $campos FROM $tables WHERE $sWhere";echo $strSQL;
	$query = $db->query("SELECT $campos FROM $tables WHERE $sWhere ");
	while($row = $query->fetch_assoc()){
    $arr=array();
		$arr['item_pedido_order_id']=$row['orden_id'];
		$arr['item_pedido_idArticulo']=$row['articulo_id'];
		$arr['item_pedido_idArticuloOnce']=$row['articulo_idonce'];
		$arr['item_pedido_descripcion']=$row['descripcion'];
		$arr['item_pedido_cantidad']=$row['cantidad'];
		$arr['item_pedido_precio_unitario']=$row['precioU']*$row['orden_porcentajeRecargo'];
		$arr['item_pedido_descuento']=$row['descuento'];
		$arr['item_pedido_valor']=$row['valor'];
		//die($row['subtotal']);
		array_push($arreglo_items,$arr);
  };

 return $arreglo_items;
}

function generateDatosGeneralesPedido($db,$orden_id) {
	$tables=" orden,clientes ";
	$campos=" orden.precio_total, orden.creado, orden.estado, clientes.* ";
	$sWhere=" orden.id=".$orden_id." and orden.cliente_id=clientes.id ";
	//$strSQL="SELECT $campos FROM $tables WHERE $sWhere";echo $strSQL;
	$query = $db->query("SELECT $campos FROM $tables WHERE $sWhere ");
	while($row = $query->fetch_assoc()){
    $arr=array();
		$arr['pedido_order_id']=$row['id'];
		$arr['pedido_cliente_apellido']=$row['apellido'];
		$arr['pedido_cliente_nombre']=$row['nombre'];
		$arr['pedido_cliente_dni']=$row['dni'];
		$arr['pedido_cliente_email']=$row['email'];
		$arr['pedido_cliente_telefono']=$row['telefono'];
		$arr['pedido_cliente_direccion']=$row['direccion'];
		$arr['pedido_precio_total']=$row['precio_total'];
		$arr['pedido_fecha_creado']=$row['creado'];
		$arr['pedido_estado']=$row['estado'];
  };

 return $arr;
}


$pdf=new PDF_MC_Table('P','mm','A4');

//$pdf=new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->setTopMargin(5);


$pdf->AddPage();

//Table with 20 rows and 4 columns

$pdf->Header($_GET['id']);

$arr_orden=generateDatosGeneralesPedido($db,$_GET['id']);
//var_dump($arr_orden);
$pdf->SetFont('Arial','b',8);
$pdf->Cell(22,6,'SE'.utf8_decode('Ñ').'ORES:',0,0,'L',true);
$pdf->SetFont('Arial','',8);
$pdf->Cell(160,5,$arr_orden['pedido_cliente_apellido'].', '.$arr_orden['pedido_cliente_nombre'],'B',1,'L',true);

$pdf->SetFont('Arial','b',8);
$pdf->Cell(22,6,'DIRECCION:',0,0,'L',true);
$pdf->SetFont('Arial','',8);
$pdf->Cell(100,5,$arr_orden['pedido_cliente_direccion'],'B',0,'L',true);
$pdf->SetFont('Arial','b',8);
$pdf->Cell(10,6,'TE.:',0,0,'L',true);
$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,$arr_orden['pedido_cliente_telefono'],'B',1,'L',true);

$pdf->SetFont('Arial','b',8);
$pdf->Cell(22,6,'EMAIL:',0,0,'L',true);
$pdf->SetFont('Arial','',8);
$pdf->Cell(100,5,$arr_orden['pedido_cliente_email'],'B',1,'L',true);
$pdf->ln(5);
//$pdf->Cell(185,10,'',0,2,'L',true);



$pdf->SetFont('Arial','b',10);
$pdf->SetWidths(array(10,17,80,15,20,20,20));
$pdf->Row(array('#','Cod.','Detalle','Cant.','P.Unit.','Desc.','Valor'));
$arr=generateItem($db,$_GET['id']);
$pdf->SetFont('Arial','',8);
$c=0;
$totalDescuento=0;
$subtotal=0;
foreach($arr as $value) {
	$c++;
	$totalDescuento+=$value['item_pedido_descuento'];
	$subtotal+=$value['item_pedido_valor'];
	$pdf->Row(array($c,$value['item_pedido_idArticuloOnce'],$value['item_pedido_descripcion'],
	                $value['item_pedido_cantidad'],number_format($value['item_pedido_precio_unitario'],2,',','.'),
									number_format($value['item_pedido_descuento'],2,',','.'),number_format($value['item_pedido_valor'],2,',','.')));
}

/*$pdf->SetWidths(array(30));
$pdf->Row(array('Subtotal'));
$pdf->Row(array(number_format($subtotal,2,',','.')));
*/
$pdf->SetFont('Arial','b',8);
$pdf->Cell(162,10,'SUB TOTAL',1,0,'R',true);
$pdf->SetFont('Arial','',8);
$pdf->Cell(20,10,number_format($subtotal,2,',','.'),1,1,'L',true);
/*
$pdf->SetWidths(array(30));
$pdf->Row(array('Descuento Total'));
$pdf->Row(array(number_format($totalDescuento,2,',','.')));
*/
$pdf->SetFont('Arial','b',8);
$pdf->Cell(162,10,'DESCUENTOS',1,0,'R',true);
$pdf->SetFont('Arial','',8);
$pdf->Cell(20,10,number_format($totalDescuento,2,',','.'),1,1,'L',true);

$pdf->SetFont('Arial','b',8);
$pdf->Cell(162,10,'TOTAL',1,0,'R',true);
$pdf->SetFont('Arial','',8);
$pdf->Cell(20,10,number_format($subtotal-$totalDescuento,2,',','.'),1,1,'L',true);

$pdf->footer();
$pdf->Output();

?>
