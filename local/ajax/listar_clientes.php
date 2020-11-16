<?php

/* Connect To Database*/
//require_once ("../conexion.php");
  require_once ("../php/conexion.php");
  require_once ("../php/libString.php");
//$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

$query=isset($_REQUEST['textBuscarApellido'])?$_REQUEST['textBuscarApellido']:"";
//echo $query;die;
$tables="clientes";
$campos="*";
$sWhere=" clientes.apellido LIKE '%".$query."%'";
$sWhere.=" order by clientes.id";

$count_query = $db->query("SELECT * FROM $tables WHERE $sWhere ");
$numrows = $count_query->num_rows;
//$strSQL="SELECT $campos FROM $tables WHERE $sWhere";echo $strSQL;die;
$query = $db->query("SELECT $campos FROM $tables WHERE $sWhere ");


if ($numrows>0){

  ?>

  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class='text-center'>ID</th>
          <th>Apellido y Nombre </th>
          <th class='text-center'>DNI</th>
          <th class='text-right'>Email</th>
          <th class='text-center'>Telefono</th>
          <th class='text-right'>Direccion</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($row = $query->fetch_assoc()){
          $cliente_id=$row['id'];
          $apellido_nombre=formateaApellidos($row['apellido']).", ".formateaNombres($row['nombre']);
          $dni=$row['dni'];
          $email=$row['email'];
          $telefono=$row['telefono'];
          $direccion=$row['direccion'];
          ?>
          <tr class='filasResultado' data-datos="<?php echo $cliente_id.'-'.$apellido_nombre.'-'.$dni.'-'.$email.'-'.$direccion.'-'.$telefono;?>" >
            <td class='text-center'><?php echo $cliente_id;?></td>
            <td ><?php echo $apellido_nombre;?></td>
            <td class='text-center' ><?php echo $dni;?></td>
            <td class='text-right'><?php echo $email;?></td>
            <td class='text-center' ><?php echo $telefono;?></td>
            <td class='text-right'><?php echo $direccion;?></td>
          </tr>
        <?php };?>
      </tbody>
    </table>
  </div>
<?php };?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(".filasResultado").on("click",function(){
  //console.log($(this).data("datos"));//aca hacer un split
  $var=$(this).data("datos");
  $var1=$var.split("-");
  $id=$var1[0];
  $apellido_nombre=$var1[1];
  $dni=$var1[2];
  $email=$var1[3];
  $direccion=$var1[4];
  $telefono="("+$var1[5]+") "+$var1[6];



  $( "#users tbody" ).html("<tr><td colspan='2' class='text-left small'><br></td></tr>"+
    "<tr><th class='text-left small'>&nbsp;Nombre:</td><td class='text-left small' style='color: black !important;' style='padding: 2px;'>"+$apellido_nombre+"</td></tr>"+
    "<tr><th class='text-left small'>&nbsp;DNI:</td><td class='text-left small' style='color: black !important;' style='padding: 2px;'><span id='dni'>"+$dni+"<input type='hidden' id='textidcliente' value='"+$id+"'></span></td></tr>"+
    "<tr><th class='text-left small'>&nbsp;Telefono:</td><td class='text-left small' style='color: black !important;' style='padding: 2px;'>"+$telefono+"</td></tr>"+
    "<tr><th class='text-left small'>&nbsp;Direccion:</td><td class='text-left small' style='color: black !important;' style='padding: 2px;'>"+$direccion+"</td></tr>"+
    "<tr><th class='text-left small'>&nbsp;Email:</td><td class='text-left small' style='color: black !important;' style='padding: 2px;'>"+$email+"</td></tr>");
    $('#myModal').modal("hide");
  //$('#myModal').hide();
    //$('#ped').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
  //$('.modal-backdrop').remove();//eliminamos el backdrop del modal

});
</script>
