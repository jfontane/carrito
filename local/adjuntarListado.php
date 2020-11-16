<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
set_time_limit(0);
$con=mysqli_connect("localhost","uiakkdaq_javier","1q2w3e4r","uiakkdaq_eloriginal");
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$_SESSION['array_productos_nuevos']=array();

function productos_cargar_nuevos($conexion) {
  $sqlSelect="SELECT articulosonce.*
  FROM articulosonce
  LEFT JOIN articulos ON articulosonce.idOnce = articulos.idOnce
  WHERE articulos.idOnce IS NULL";
  $resultadoSelect = mysqli_query($conexion, $sqlSelect);
  if (mysqli_num_rows($resultadoSelect)) {
    $array_productos_nuevos=array();
    while ($filasNuevas=mysqli_fetch_array($resultadoSelect)) {
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
    "porcentajeRecargo, codigoBarra) Values".
    "('".
    $valor['idOnce']."','".
    $valor['descripcion']."','".
    $valor['empaque']."',".
    $valor['precioSinIva'].",".
    $valor['precioConIva'].",1.45,'".
    $valor['codigoBarra'].
    "')";
    $resultadoUpdate = mysqli_query($conexion, $sqlUpdate);
    if (!$resultadoUpdate) die("ERROR!!!: ".$sqlUpdate);
  };
  return $array_productos_nuevos;

}; /* END FUNCTION productos_cargar_nuevos */


function productos_actualizar_precios($conexion) {
  $sql="SELECT articulosonce.*
  FROM articulosonce";
  $resultado = mysqli_query($conexion, $sql);
  if (mysqli_num_rows($resultado)) {
    $array_productos=array();
    while ($fila=mysqli_fetch_array($resultado)) {
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
    $sql="Update articulos Set descripcion='{$valor[descripcion]}', precioSinIva={$valor['precioSinIva']}, precioConIva={$valor['precioConIva']}, codigoBarra='{$valor['codigoBarra']}' ".
    "Where idOnce like '{$valor['idOnce']}'";
    $resultado = mysqli_query($conexion, $sql);

    //                    if ($valor['idOnce']=='71070') {
    //                         echo $valor['idOnce'].'-'.$valor['precioConIva'].'-'.$sql;
    //                    }
  };
};  // END FUNCTION productos_actualizar_precios

?>
<!DOCTYPE html>
<html>
<head>
  <script id="tinyhippos-injected">if (window.top.ripple) { window.top.ripple("bootstrap").inject(window, document); }</script>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tabla de Articulos</title>
  <link rel="stylesheet" type="text/css" href="./components/assets/css/main.css">
  <script type="text/javascript" src="./arti_files/require-config.js.descarga"></script>
  <script type="text/javascript" data-main="pgui.list-page-main" src="./arti_files/require.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery" src="./arti_files/jquery.min.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="modal_customize" src="./arti_files/modal_customize.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.sidebar" src="./arti_files/pgui.sidebar.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.list-page-main" src="./arti_files/pgui.list-page-main.js.descarga"></script>

  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.text_highlight" src="./arti_files/pgui.text_highlight.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.grid" src="./arti_files/pgui.grid.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.advanced_filter" src="./arti_files/pgui.advanced_filter.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.shortcuts" src="./arti_files/pgui.shortcuts.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.page_settings" src="./arti_files/pgui.page_settings.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.datetimepicker" src="./arti_files/pgui.datetimepicker.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="components/js/pgui.user_management_api.js" src="./arti_files/pgui.user_management_api.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="components/js/pgui.change_password_dialog.js" src="./arti_files/pgui.change_password_dialog.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="components/js/pgui.password_dialog_utils.js" src="./arti_files/pgui.password_dialog_utils.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="components/js/pgui.self_change_password.js" src="./arti_files/pgui.self_change_password.js.descarga"></script>

  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery.highlight" src="./arti_files/jquery.highlight.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="class" src="./arti_files/class.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.localizer" src="./arti_files/pgui.localizer.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="microevent" src="./arti_files/microevent.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.overlay" src="./arti_files/pgui.overlay.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="async" src="./arti_files/async.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="underscore" src="./arti_files/underscore.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="multiple_sorting" src="./arti_files/multiple_sorting.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="sorter" src="./arti_files/sorter.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.utils" src="./arti_files/pgui.utils.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.field-embedded-video" src="./arti_files/pgui.field-embedded-video.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.autohide-message" src="./arti_files/pgui.autohide-message.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.select2_filter" src="./arti_files/pgui.select2_filter.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.events" src="./arti_files/pgui.events.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="moment" src="./arti_files/moment.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery.hotkeys" src="./arti_files/jquery.hotkeys.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="locales/datetimepicker_locale" src="./arti_files/datetimepicker_locale.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="user-js" src="./arti_files/user.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="components/js/jslang.php?" src="./arti_files/jslang.php"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery.plainoverlay" src="./arti_files/jquery.plainoverlay.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="bootbox.min" src="./arti_files/bootbox_locale.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="libs/sprintf" src="./arti_files/sprintf.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery.query" src="./arti_files/jquery.query.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="libs/select2" src="./arti_files/select2.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery.resize" src="./arti_files/jquery.resize.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="datepicker" src="./arti_files/bootstrap-datetimepicker.min.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="libs/bootbox.min" src="./arti_files/bootbox.min.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.modal_insert" src="./arti_files/pgui.modal_insert.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.inline_grid_edit" src="./arti_files/pgui.inline_grid_edit.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="jquery.magnific-popup" src="./arti_files/jquery.magnific-popup.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.modal_editing" src="./arti_files/pgui.modal_editing.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.modal_operations" src="./arti_files/pgui.modal_operations.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.forms" src="./arti_files/pgui.forms.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.validation" src="./arti_files/pgui.validation.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.editors" src="./arti_files/pgui.editors.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.jquery.utils" src="./arti_files/pgui.jquery.utils.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.editors/global_notifier" src="./arti_files/global_notifier.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.editors/custom" src="./arti_files/custom.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.editors/plain" src="./arti_files/plain.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.editors/autocomplete" src="./arti_files/autocomplete.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.editors/multilevel_autocomplete" src="./arti_files/multilevel_autocomplete.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.editors/multivalue_select" src="./arti_files/multivalue_select.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.editors/image_uploader" src="./arti_files/image_uploader.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="locales/select2_locale" src="./arti_files/select2_locale.js.descarga"></script>
  <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pgui.editors/select2_format" src="./arti_files/select2_format.js.descarga"></script>
</head>


<body id="pgpage-articulos">
  <nav id="navbar" class="navbar navbar-default navbar-fixed-top">


    <div class="container-fluid">
      <div class="navbar-header">

        <span class="navbar-brand">
          <span>
            <img src="./components/assets/img/fotocopia.png" style="height: 44px; margin-top: -14px;">
          </span>
        </span>
        <span class="navbar-brand">
          <span class="hidden-xs"><strong>Fotocopias "El Original"</strong></span>
        </span>

        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navnav" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="navbar-collapse collapse" id="navnav">
        <ul id="nav-menu" class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="./articulos.php#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="icon-user"></i>
              julian
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="./login.php?operation=logout">Salir</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="./articulos.php#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              Tablas
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="./articulos.php" title="Tabla de Articulos">
                  Tabla de Articulos
                </a>
              </li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="./articulos.php#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              Ventas
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="./qListadoArticulos.php" title="Listado de Articulos">
                Listado de Articulos
              </a>
            </li>

          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Actualizacion
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="./adjuntarListado.php#" title="Adjuntar Archivo Once">
              Adjuntar Archivo
            </a>
          </li>

        </ul>
      </li>

    </ul>
  </div>
</div>
</nav>




<div class="container-fluid">

  <div class="row">


    <div class="col-md-12">
      <div class="container-padding">

        <div class="page-header">

          <h1>Importar Archivo de Libreria Once</h1>

        </div>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" >
          <table width="90%" border="0" cellspacing="1" cellpadding="2">
            <tr>
              <td bgcolor="#FA9005">Archivo:</td>
              <td colspan="3"><input type="file" name="archivo" id="archivo" value="... Ingresa El archivo a Subir" size="10" /><input type="hidden" name="MAX_FILE_SIZE" value="30000"></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4"><input type="submit" name="botonAdjuntar" value="Adjuntar" /></td>
            </tr>
          </table>
        </form>

        <?php

        if ($_POST['botonAdjuntar']) {


          //Cargamos el Archivo
          move_uploaded_file($_FILES['archivo']['tmp_name'],'./datos/datos.txt');

          /* Recorremos el archivo datos.txt y producimos un nuevo archivo 'salida.txt' con los decimales con notacion de puntos del tipo 'xx.xx' */
          $fileEntrada = "./datos/datos.txt";
          $fileSalida = "./datos/salida.txt";
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
          mysqli_query($con, $sql_0);

          //        $sqlLoadData= "LOAD DATA LOCAL INFILE './datos/salida.txt' IGNORE INTO TABLE articulosonce
          //               FIELDS TERMINATED BY ';'
          //               LINES TERMINATED BY '\n'
          //               (idOnce,descripcion,empaque,precioSinIva,precioConIva, codigoBarra)";
          $sqlLoadData="LOAD DATA LOCAL INFILE './datos/salida.txt' IGNORE
          INTO TABLE articulosonce FIELDS TERMINATED BY ';' 
          LINES TERMINATED BY '\n'
          (idOnce,@descripcion,empaque,@precioSinIva,@precioConIva, @codigoBarra)
          SET precioSinIva=REPLACE(@precioSinIva,'.','')/100,
          precioConIva=REPLACE(@precioConIva,'.','')/100,
          codigoBarra=REPLACE(REPLACE(@codigoBarra,'\"=concatenar(\"\"',''),'\"\")\"',''),
          descripcion=REPLACE(@descripcion,\"'\",'')";
          $resultadoLoadData = mysqli_query($con, $sqlLoadData);

          $_SESSION['array_productos_nuevos']=productos_cargar_nuevos($con);
          //var_dump($_SESSION['array_productos_nuevos']);
          echo "<br><br><br><font color='red'><b>ATENCION: </b>1er ETAPA TERMINADA. EXISTEN PRODUCTOS NUEVOS</font><br>";
          productos_actualizar_precios($con);
          echo "<br><font color='red'><b>ATENCION: </b>2da ETAPA TERMINADA. SE ACTUALIZARON LOS PRECIOS DE LOS PRODUCTOS</font><br>";
          echo "<br><br><br><font color='red'><b>ATENCION: </b>TABLA ARTICULOS ACTUALIZADA CORRECTAMENTE!!!</font><br><br><br><br>";
        };

        ?>





        <hr>
        <footer></footer>
      </div>
    </div>

  </div>
</div>

<div id="pg-change-password-dialog" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span aria-hidden="true">×</span></span></button>
        <h4 class="modal-title" id="pg-change-password-dialog-header-user">Cambiar contraseña</h4>
        <h4 class="modal-title" id="pg-change-password-dialog-header-admin" style="display: none;">Cambiar clave del usuario '<span data-bind="text: changePasswordUser.name"></span>'</h4>
      </div>

      <div class="modal-body">

        <form class="form-horizontal">
          <fieldset>

            <div class="form-group" id="pg-change-password-dialog-current-password-form-group">
              <label class="col-sm-3 control-label" for="pg-change-password-dialog-current-password">
                Contraseña actual
              </label>
              <div class="col-sm-9">
                <input id="pg-change-password-dialog-current-password" type="password" name="currentPassword" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label" for="pg-change-password-dialog-new-password">Nueva clave</label>
              <div class="col-sm-9">
                <input id="pg-change-password-dialog-new-password" type="password" name="newPassword" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label" for="pg-change-password-dialog-confirmed-password">Confirmar contraseña</label>
              <div class="col-sm-9">
                <input id="pg-change-password-dialog-confirmed-password" type="password" name="confirmedPassword" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-9 col-offset-sm-3">
                <div class="alert alert-warning" id="pg-change-password-dialog-confirmed-password-error">
                  <p>Las contraseñas no coinciden. Intente nuevamente.</p>
                </div>
              </div>
            </div>
          </fieldset>
        </form>
      </div>

      <div class="modal-footer">
        <a href="http://127.0.0.1/eloriginalNuevo/articulos.php#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
        <a href="http://127.0.0.1/eloriginalNuevo/articulos.php#" class="btn btn-primary" id="pg-change-password-dialog-ok-button">Cambiar clave</a>
      </div>
    </div>
  </div>
</div>

<script>
function EditValidation(fieldValues, errorInfo) { ; return true; }  function InsertValidation(fieldValues, errorInfo) { ; return true; } function EditForm_EditorValuesChanged(sender, editors) { ; return true; } function InsertForm_EditorValuesChanged(sender, editors) { ; return true; } function EditForm_initd(editors) { ; return true; } function InsertForm_initd(editors) { ; return true; }
require(['jquery', 'bootstrap'], function() {


  $(function () {



  });

});
</script>

<script type="text/javascript">
require([
  'components/js/pgui.user_management_api.js',
  'components/js/pgui.change_password_dialog.js',
  'components/js/pgui.password_dialog_utils.js',
  'components/js/pgui.self_change_password.js'
], function() {});
</script>


</body></html>
