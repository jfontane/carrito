<?php

function formateaApellidos($str) {
  $apellido=strtoupper(substr($str,0,1)).strtolower(substr($str,1,strlen($str)-1));
  return $apellido;
}

function formateaNombres($str) {
  $nom=explode(" ",$str);
  $nombres="";
  $cantidad=count($nom);
  $c=0;
  foreach ($nom as $value) {
    $c++;
    if ($c<$cantidad) $nombres.=formateaApellidos($value)." ";
    else $nombres.=formateaApellidos($value);
  }
  return $nombres;
}

function dameDia($str) {
  if (strtoupper($str)=='MONDAY') $dia='Lunes';
  else if (strtoupper($str)=='TUESDAY') $dia='Martes';
  else if (strtoupper($str)=='WEDNESDAY') $dia='Miercoles';
  else if (strtoupper($str)=='THURSDAY') $dia='Jueves';
  else if (strtoupper($str)=='FRIDAY') $dia='Viernes';
  else if (strtoupper($str)=='SATURDAY') $dia='Sabado';
  else if (strtoupper($str)=='SUNDAY') $dia='Domingo';
  else return false;
  return $dia;
}

function dameMes($str) {
  if (strtoupper($str)=='01') $mes='Enero';
  else if (strtoupper($str)=='02') $mes='Febrero';
  else if (strtoupper($str)=='03') $mes='Marzo';
  else if (strtoupper($str)=='04') $mes='Abril';
  else if (strtoupper($str)=='05') $mes='Mayo';
  else if (strtoupper($str)=='06') $mes='Junio';
  else if (strtoupper($str)=='07') $mes='Julio';
  else if (strtoupper($str)=='08') $mes='Agosto';
  else if (strtoupper($str)=='09') $mes='Septiembre';
  else if (strtoupper($str)=='10') $mes='Octubre';
  else if (strtoupper($str)=='11') $mes='Noviembre';
  else if (strtoupper($str)=='12') $mes='Diciembre';
  else return false;
  return $mes;
}

function saludo() {
  if (date('a')=='pm') return "Buenas Tardes";
  else return "Buen Dia";
}

function calcular_tiempo_trasnc($hora1,$hora2){
  $separar[1]=explode(':',$hora1);
  $separar[2]=explode(':',$hora2);
  $total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1];
  $total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1];
  $total_minutos_trasncurridos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2];
  if($total_minutos_trasncurridos<=59) return($total_minutos_trasncurridos.' Minutos');
  elseif($total_minutos_trasncurridos>59){
    $HORA_TRANSCURRIDA = round($total_minutos_trasncurridos/60);
    if($HORA_TRANSCURRIDA<=9) $HORA_TRANSCURRIDA='0'.$HORA_TRANSCURRIDA;
    $MINUITOS_TRANSCURRIDOS = $total_minutos_trasncurridos%60;
    if($MINUITOS_TRANSCURRIDOS<=9) $MINUITOS_TRANSCURRIDOS='0'.$MINUITOS_TRANSCURRIDOS;
    return ($HORA_TRANSCURRIDA.':'.$MINUITOS_TRANSCURRIDOS.' Horas');

  } }

//echo date('H:i');
    //echo calcular_tiempo_trasnc(date('H:i'),'15:12');
  ?>
