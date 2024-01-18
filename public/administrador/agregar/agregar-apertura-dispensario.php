<?php
require('../../../app/help.php');

$idEstacion = $_POST['idEstacion'];
$Dispensario = $_POST['Dispensario'];

$filename = $_FILES["File"]["name"];
$info = new SplFileInfo($filename);
$extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
$fila = 1;

 if($extension == 'csv')
 {

  $filename = $_FILES['File']['tmp_name'];
  $handle = fopen($filename, "r");

  while(($data = fgetcsv($handle, 1000, ",") ) !== FALSE)
  {

  if($fila != 1){

	AgregarDA($idEstacion,$Dispensario,$data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$con);
  AgregarDAB($idEstacion,$Dispensario,$data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$con);	
  
  }
  
  $fila++;
  }
  fclose($handle);
  }

  function Detalle($dato1){

    if($dato1 == 1){
    $Clave = 'CALI';
    $Motivo = 'Ajuste';
    $Producto = '';
    $Lado = 1;
    }else if($dato1 == 2){
    $Clave = 'CALI';
    $Motivo = 'Ajuste';
    $Producto = '';
    $Lado = 1;
    }else if($dato1 == 3){
    $Clave = 'CALI';
    $Motivo = 'Ajuste';
    $Producto = '';
    $Lado = 1;
    }else if($dato1 == 4){
    $Clave = 'CALI';
    $Motivo = 'Ajuste';
    $Producto = '';
    $Lado = 1;
    }else if($dato1 == 5){
    $Clave = 'CALI';
    $Motivo = 'Ajuste';
    $Producto = '';
    $Lado = 2;
    }else if($dato1 == 6){
    $Clave = 'CALI';
    $Motivo = 'Ajuste';
    $Producto = '';
    $Lado = 2;
    }else if($dato1 == 7){
    $Clave = 'CALI';
    $Motivo = 'Ajuste';
    $Producto = '';
    $Lado = 2;
    }else if($dato1 == 8){
    $Clave = 'CALI';
    $Motivo = 'Ajuste';
    $Producto = '';
    $Lado = 2;
    }else if($dato1 == 9){
    $Clave = 'CAMP';
    $Motivo = 'Cambio de Precio';
    $Producto = 'G SUPER';
    $Lado = 1;
    }else if($dato1 == 10){
    $Clave = 'CAMP';
    $Motivo = 'Cambio de Precio';
    $Producto = 'G PREMIUM';
    $Lado = 1;
    }else if($dato1 == 11){
    $Clave = 'CAMP';
    $Motivo = 'Cambio de Precio';
    $Producto = 'G DIESEL';
    $Lado = 1;
    }else if($dato1 == 17){
    $Clave = 'CAMP';
    $Motivo = 'Cambio de Precio';
    $Producto = 'G SUPER';
    $Lado = 2;
    }else if($dato1 == 18){
    $Clave = 'CAMP';
    $Motivo = 'Cambio de Precio';
    $Producto = 'G PREMIUM';
    $Lado = 2;
    }else if($dato1 == 19){
    $Clave = 'CAMP';
    $Motivo = 'Cambio de Precio';
    $Producto = 'G DIESEL';
    $Lado = 2;
    }else if($dato1 == 25){
    $Clave = 'OTRO';
    $Motivo = 'Fallo de Energía';
    $Producto = '';
    $Lado = 0;
    }else if($dato1 == 26){
    $Clave = 'ACMO';
    $Motivo = 'Acceso al modo de programacion';
    $Producto = '';
    $Lado = 0;
    }else if($dato1 == 28){
    $Clave = 'APPU';
    $Motivo = 'Apertura en puerta';
    $Producto = '';
    $Lado = 0;
    }else if($dato1 == 33){
    $Clave = 'CAMF';
    $Motivo = 'Cambio de fecha y hora';
    $Producto = 'CAMF';
    $Lado = 0;
    }else if($dato1 == 66){
    $Clave = 'ACTU';
    $Motivo = 'Actualizacion del o los programas de computo';
    $Producto = '';
    $Lado = 0;
    }

    $arrayName = array('Motivo' => $Motivo, 'Clave' => $Clave, 'Producto' => $Producto, 'Lado' => $Lado);
    return $arrayName;

  }

  function AgregarDA($idEstacion,$Dispensario,$dato1,$dato2,$dato3,$dato4,$dato5,$dato6,$con)
  {

  if ($dato1 != 65) {

  $Detalle = Detalle($dato1);
  $Fecha = $dato4.'-'.$dato3.'-'.$dato2;
  $sql_insert = "INSERT INTO tb_dispensarios_apertura(
  id_estacion,
  dispensario,
  clave,
  motivo,
  producto,
  lado,
  fecha,
  hora,
  detalle
  )
  VALUES (
  '".$idEstacion."',
  '".$Dispensario."',
  '".$Detalle['Clave']."',
  '".$Detalle['Motivo']."',
  '".$Detalle['Producto']."',
  '".$Detalle['Lado']."',
  '".$Fecha."',
  '".$dato5."',
  '".$dato6."'
  )";
  mysqli_query($con, $sql_insert);
  

  }

  return true;

  }

  function Responsable($idEstacion,$con){
  $sql = "SELECT id FROM tb_usuarios WHERE id_gas = '".$idEstacion."' AND id_puesto = 6 AND estatus= 0 ORDER BY id ASC LIMIT 1 ";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $idUsuario = $row['id'];
  }
  return $idUsuario;
  }

  function AgregarDAB($idEstacion,$Dispensario,$dato1,$dato2,$dato3,$dato4,$dato5,$dato6,$con)
  {

  $Detalle = Detalle($dato1);
  $Fecha = $dato4.'-'.$dato3.'-'.$dato2;
  $Responsable = Responsable($idEstacion,$con);

  if ($dato1 != 65) {
  $sql_insert = "INSERT INTO tb_dispensarios_apertura_bitacora (
  id_dispensario,
  fecha,
  hora_inicio,
  hora_termino,
  lado,
  producto,
  clave,
  motivo,
  responsable,
  detalle
  )
  VALUES (
  '".$Dispensario."',
  '".$Fecha."',
  '".$dato5."',
  '',
  '".$Detalle['Lado']."',
  '".$Detalle['Producto']."',  
  '".$Detalle['Clave']."',
  '".$Detalle['Motivo']."',
  '".$Responsable."',
  '".$dato6."'
  )";
  mysqli_query($con, $sql_insert);

    }
    
  return true;

  }


//------------------
mysqli_close($con);
//------------------