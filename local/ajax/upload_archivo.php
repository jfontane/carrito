<?php
session_start();
set_time_limit(0);
require_once '../php/conexion.php';
require_once '../php/libString.php';

$_SESSION['array_productos_nuevos']=array();

//********************************************************************************************************************************************
//********************************************************************************************************************************************
// FUNCTION productos_cargar_nuevos
//********************************************************************************************************************************************
//********************************************************************************************************************************************
function productos_cargar_nuevos($conexion) {
  $array_productos_nuevos=array();
  $sqlSelect="SELECT articulosonce.*
  FROM articulosonce
  LEFT JOIN articulos ON articulosonce.idOnce = articulos.idOnce
  WHERE articulos.idOnce IS NULL";
  $resultadoSelect = $conexion->query($sqlSelect);
  if ($resultadoSelect->num_rows) {
    while ($filasNuevas=$resultadoSelect->fetch_assoc()) {
      $arr2=array();
      $arr2['idOnce']=$filasNuevas['idOnce'];
      $arr2['descripcion']=addslashes($filasNuevas['descripcion']);
      $arr2['empaque']=addslashes($filasNuevas['empaque']);
      $arr2['precioSinIva']=$filasNuevas['precioSinIva'];
      $arr2['precioConIva']=$filasNuevas['precioConIva'];
      $arr2['codigoBarra']=addslashes($filasNuevas['codigoBarra']);
      array_push($array_productos_nuevos, $arr2);
    };
  }

  /********************************************************************************************************************************************/
  /* CARGAR LOS ARTICULOS NUEVOS DEL LISTADO. */
  /* Se recorre el arreglo con los articulos nuevos y a medida que se va recorriendo se va Insertando en la tabla Articulos */
  $i=0;
  //var_dump($array_productos_nuevos);
  //echo count($array_productos_nuevos);
  foreach ($array_productos_nuevos as $clave => $valor) {
    $sqlUpdate="Insert into articulos(idOnce,descripcion,empaque,precioSinIva,precioConIva, ".
    "porcentajeRecargo, codigoBarra, proveedor) Values".
    "('".
    $valor['idOnce']."','".
    $valor['descripcion']."','".
    $valor['empaque']."',".
    $valor['precioSinIva'].",".
    $valor['precioConIva'].",1.50,'".
    $valor['codigoBarra']."','Once Mayorista".
    "')";
    $resultadoUpdate = $conexion->query($sqlUpdate);
    if (!$resultadoUpdate) die("ERROR!!!: ".$sqlUpdate);
  };
  return $array_productos_nuevos;
};
//********************************************************************************************************************************************
//********************************************************************************************************************************************
// END FUNCTION productos_cargar_nuevos
//********************************************************************************************************************************************
//********************************************************************************************************************************************




//********************************************************************************************************************************************
//********************************************************************************************************************************************
// FUNCTION productos_actualizar_precios
//********************************************************************************************************************************************
//********************************************************************************************************************************************
function productos_actualizar_precios($conexion) {
  $sql="SELECT articulosonce.*
        FROM articulosonce";
  $resultado = $conexion->query($sql);
  if ($resultado->num_rows) {
    $array_productos=array();
    while ($fila=$resultado->fetch_assoc()) {
      $arr2=array();
      $arr2['idOnce']=$fila['idOnce'];
      $arr2['descripcion']=addslashes($fila['descripcion']);
      $arr2['empaque']=addslashes($fila['empaque']);
      $arr2['precioSinIva']=$fila['precioSinIva'];
      $arr2['precioConIva']=$fila['precioConIva'];
      $arr2['codigoBarra']=addslashes($fila['codigoBarra']);
      array_push($array_productos, $arr2);
    };
  };
  /******************************************************************************************************************************************/
  /******************************************************************************************************************************************/
  /* Se recorre el arreglo y a medida que se va recorriendo se va modificando los importes actuales con los nuevos importes de los articulos */
  foreach ($array_productos as $clave => $valor) {
    $sql="Update articulos Set descripcion='".$valor['descripcion']."', precioSinIva={$valor['precioSinIva']}, precioConIva={$valor['precioConIva']}, codigoBarra='".$valor['codigoBarra']."' ".
    "Where idOnce like '{$valor['idOnce']}'";
    $resultado = $conexion->query($sql);

    //                    if ($valor['idOnce']=='71070') {
    //                         echo $valor['idOnce'].'-'.$valor['precioConIva'].'-'.$sql;
    //                    }
  };
};
//********************************************************************************************************************************************
//********************************************************************************************************************************************
// END FUNCTION productos_actualizar_precios
//********************************************************************************************************************************************
//********************************************************************************************************************************************


//********************************************************************************************************************************************
//********************************************************************************************************************************************
// FUNCTION productos_actualizar_derivados
//********************************************************************************************************************************************
//********************************************************************************************************************************************
function productos_actualizar_derivados($conexion) {
  $sql = "SELECT * FROM articulos_derivados";
  $query = $conexion->query($sql);
  while ($fila=$query->fetch_assoc()) {
    $idOrigen=$fila['idOrigen'];
    $idDestino=$fila['idDestino'];
    $cantidad_por_empaque=$fila['cantidadPorEmpaque'];
    $sql_tmp_1 = "SELECT * FROM articulos WHERE id=$idOrigen";
    $query_tmp_1 = $conexion->query($sql_tmp_1);
    $subfila=$query_tmp_1->fetch_assoc();
    $precioConIva=$subfila['precioConIva'];
    $precioActualizado=$precioConIva/$cantidad_por_empaque;
    $sql_tmp_2 = "UPDATE articulos SET precioConIva=$precioActualizado WHERE id=$idDestino";
    $query_tmp_2 = $conexion->query($sql_tmp_2);
  };
};
//********************************************************************************************************************************************
//********************************************************************************************************************************************
// END FUNCTION productos_actualizar_derivados
//********************************************************************************************************************************************
//********************************************************************************************************************************************


//********************************************************************************************************************************************
//********************************************************************************************************************************************
// MAIN DEL PROGRAMA
//********************************************************************************************************************************************
//********************************************************************************************************************************************

$horaInicial=date('H:i');

//Cargamos el Archivo
move_uploaded_file($_FILES['archivo']['tmp_name'],'../datos/datos.txt');
if (strtolower($_FILES['archivo']['name'])!='once.csv') {
  echo "Error: el archivo no pertenece a Once Mayorista";
} else {
        //die('upload once!!!');
        /* Recorremos el archivo datos.txt y producimos un nuevo archivo 'salida.txt' con los decimales con notacion de puntos del tipo 'xx.xx' */
        $fileEntrada = "../datos/datos.txt";
        $fileSalida = "../datos/salida.txt";
        $archivoEntrada = @fopen($fileEntrada, "rb");
        $archivoSalida = fopen($fileSalida, "w");
        if (is_resource($archivoEntrada)) {
          while ($linea = fgets($archivoEntrada, 4096)) {
            if (substr($linea, 0,1)!=';') {
              $aux = strip_tags(nl2br(str_replace(",", ".", $linea)));
              fwrite($archivoSalida, $aux);
            }
          }
          fclose($archivoEntrada);
          fclose($archivoSalida);
        }
        else{
          die("el archivo no existe o no se puede leer");
        }
        /*****************************************************************************************************************************************/

        /* Recorremos el archivo 'salida.txt' y creamos un arreglo de productos/articulos con el codigo de once el precioSinIva y precioConIva */
        $archivoEntrada = @fopen($fileSalida, "rb");
        $arregloProductos=array();
        if (is_resource($archivoEntrada)) {
          while ($linea = fgets($archivoEntrada, 4096)) {
            $arreglo=explode(";",$linea);
            array_push($arregloProductos,$arreglo);
          };
        };

        /******************************************************************************************************************************************/

        $sql_0= "TRUNCATE TABLE articulosonce";
        $db->query($sql_0);

        //        $sqlLoadData= "LOAD DATA LOCAL INFILE './datos/salida.txt' IGNORE INTO TABLE articulosonce
        //               FIELDS TERMINATED BY ';'
        //               LINES TERMINATED BY '\n'
        //               (idOnce,descripcion,empaque,precioSinIva,precioConIva, codigoBarra)";
        $sqlLoadData="LOAD DATA LOCAL INFILE '../datos/salida.txt' IGNORE
        INTO TABLE articulosonce FIELDS TERMINATED BY ';'
        LINES TERMINATED BY '\n'
        (idOnce,@descripcion,empaque,@precioSinIva,@precioConIva, @codigoBarra)
        SET precioSinIva=REPLACE(@precioSinIva,'.','')/100,
        precioConIva=REPLACE(@precioConIva,'.','')/100,
        codigoBarra=REPLACE(REPLACE(@codigoBarra,'\"=concatenar(\"\"',''),'\"\")\"',''),
        descripcion=REPLACE(@descripcion,\"'\",'')";
        $resultadoLoadData = $db->query($sqlLoadData);

        $_SESSION['array_productos_nuevos']=productos_cargar_nuevos($db);
        //var_dump($_SESSION['array_productos_nuevos']);
        echo "<font color='black'>1er ETAPA TERMINADA. EXISTEN PRODUCTOS NUEVOS</font><br>";
        productos_actualizar_precios($db);
        echo "<font color='black'>2da ETAPA TERMINADA. SE ACTUALIZARON LOS PRECIOS DE LOS PRODUCTOS</font><br>";
        echo "<font color='black'>TABLA ARTICULOS ACTUALIZADA CORRECTAMENTE!!!</font><br>";
        productos_actualizar_derivados($db);
        echo "<font color='black'>TABLA ARTICULOS_DERIVADOS (Articulos individualizados) ACTUALIZADA CORRECTAMENTE!!!</font><br>";
        $horaFinal=date('H:i');
        $cantidadTiempoTranscurrido=calcular_tiempo_trasnc($horaFinal,$horaInicial);
        echo "<font color='red'><b>TIEMPO TRANSCURRIDO: </b></font> <font color='black'><b>".$cantidadTiempoTranscurrido."</b></font><br>";
};

?>
