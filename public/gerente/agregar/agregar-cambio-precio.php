<?php
require('../../../app/help.php');

   $sql_reporte = "SELECT id FROM tb_cambio_precio ORDER BY id desc LIMIT 1";
   $result_reporte = mysqli_query($con, $sql_reporte);
   $numero_reporte = mysqli_num_rows($result_reporte);

   if ($numero_reporte == 0) {
   $noComunicado = 1;
   }else{
   while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
   $noComunicado = $row_reporte['id'] + 1;
   }
   }

$Producto = Valida($_POST['idEstacion'],$_POST['GSUPER'],$_POST['GPREMIUM'],$_POST['GDIESEL'],$con);

if($Producto['Producto1'] == 1){
CambioPrecio($_POST['idEstacion'],$_POST['Fecha'],$_POST['Hora'],'','G SUPER',$Session_IDUsuarioBD,$_POST['GSUPER'],$con);   
}

if($Producto['Producto2'] == 1){
CambioPrecio($_POST['idEstacion'],$_POST['Fecha'],$_POST['Hora'],'','G PREMIUM',$Session_IDUsuarioBD,$_POST['GPREMIUM'],$con);   
}

if($Producto['Producto3'] == 1){
CambioPrecio($_POST['idEstacion'],$_POST['Fecha'],$_POST['Hora'],'','G DIESEL',$Session_IDUsuarioBD,$_POST['GDIESEL'],$con);
}

$sql_insert = "INSERT INTO tb_cambio_precio (id, id_estacion,fecha,hora,gsuper,gpremium,gdiesel,estado)
VALUES (
'".$noComunicado."',
'".$_POST['idEstacion']."',
'".$_POST['Fecha']."',
'".$_POST['Hora']."',
'".$_POST['GSUPER']."',
'".$_POST['GPREMIUM']."',
'".$_POST['GDIESEL']."',
0)";

if (mysqli_query($con, $sql_insert)) {
echo $noComunicado;
} else {
echo 0;
}

function Valida($idEstacion,$Producto1,$Producto2,$Producto3,$con){

$sql = "SELECT * FROM tb_cambio_precio WHERE id_estacion = '".$idEstacion."' ORDER BY fecha DESC LIMIT 1";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$gsuper = $row['gsuper'];
$gpremium = $row['gpremium'];
$gdiesel = $row['gdiesel'];
}

if($gsuper == $Producto1 || $gsuper == 0){
$Producto1 = 0;
}else{
$Producto1 = 1;
}


if($gpremium == $Producto2 || $gpremium == 0){
$Producto2 = 0;
}else{
$Producto2 = 1;
} 

if($gdiesel == $Producto3 || $gdiesel == 0){
$Producto3 = 0;
}else{
$Producto3 = 1;
}

$return = array('Producto1' => $Producto1, 'Producto2' => $Producto2, 'Producto3' => $Producto3);

return $return;
}


function CambioPrecio($idEstacion,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$con){

$sql = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$idEstacion."' ORDER BY no_dispensario ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$idDispensario = $row['id'];

if($Producto == 'G SUPER'){
GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$row['producto1'],$con);
}else if($Producto == 'G PREMIUM'){
GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$row['producto2'],$con);
}else if($Producto == 'G DIESEL'){
GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$row['producto3'],$con);
}

}

}

function GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$mangueras,$con){

if ($mangueras > 0) {

$lado = 1;
for ($i=1; $i <= $mangueras; $i++) { 

$sql_insert1 = "INSERT INTO tb_dispensarios_apertura_bitacora (
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
VALUES 
(
'".$idDispensario."',
'".$Fecha."',
'".$HoraInicio."',
'".$HoraTermino."',
'".$lado."',
'".$Producto."',
'CAMP',
'Cambio de precio',
'".$idUsuario."',
'".$Detalle."'
)";

mysqli_query($con, $sql_insert1);


$lado++;
}  

}
}

mysqli_close($con);