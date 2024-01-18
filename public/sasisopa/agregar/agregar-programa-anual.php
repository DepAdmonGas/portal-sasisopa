<?php
require('../../../app/help.php');

$idreporte = $_POST['idreporte'];
$idelento = $_POST['id'];
$ultimafecha = $_POST['fecha'];
$select = $_POST['select'];

if ($idelento  != 43) {
 $sql_mantenimiento_lista = "SELECT * FROM po_mantenimiento_lista WHERE id = '".$idelento."' ";
        $result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
        $numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
        while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){
         $periodicidad = $row_mantenimiento_lista['periodicidad'];

         }
}else{
	$periodicidad = $select;
}


$mes1 = valida($periodicidad,$ultimafecha,'01');
$mes2 = valida($periodicidad,$ultimafecha,'02');
$mes3 = valida($periodicidad,$ultimafecha,'03');
$mes4 = valida($periodicidad,$ultimafecha,'04');
$mes5 = valida($periodicidad,$ultimafecha,'05');
$mes6 = valida($periodicidad,$ultimafecha,'06');
$mes7 = valida($periodicidad,$ultimafecha,'07');
$mes8 = valida($periodicidad,$ultimafecha,'08');
$mes9 = valida($periodicidad,$ultimafecha,'09');
$mes10 = valida($periodicidad,$ultimafecha,'10');
$mes11 = valida($periodicidad,$ultimafecha,'11');
$mes12 = valida($periodicidad,$ultimafecha,'12');

function getUltimoDiaMes($elAnio,$elMes) {
  return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
}

function valida($periodo,$fecha,$mes){

$newperiodo = strtolower($periodo);

if ($newperiodo == "mensual") {

$formato_fecha = explode("-",$fecha);
$dia = $formato_fecha[2];

$ultimoDia = getUltimoDiaMes($formato_fecha[0],$mes);

if ($dia > $ultimoDia) {
$resultado = $formato_fecha[0]."-".$mes."-".$ultimoDia;
}else{
$resultado = $formato_fecha[0]."-".$mes."-".$formato_fecha[2];
}


}else if ($newperiodo == "trimestral") {

$formato_fecha = explode("-",$fecha);

if ($formato_fecha[0] == intval(date("Y"))) {

if ($formato_fecha[1] > $mes) {
for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 3) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}else{	
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 3) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}
}else{
$nuevafecha = strtotime ( '+3 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$formato_fecha = explode("-",$nuevafecha);
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 3) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}
}else if ($newperiodo == "cuatrimestral") {

$formato_fecha = explode("-",$fecha);

if ($formato_fecha[0] == intval(date("Y"))) {

if ($formato_fecha[1] > $mes) {
for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 4) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}else{	
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 4) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}
}else{
$nuevafecha = strtotime ( '+4 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$formato_fecha = explode("-",$nuevafecha);
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 4) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}
}else if ($newperiodo == "semestral") {

$formato_fecha = explode("-",$fecha);

if ($formato_fecha[0] == intval(date("Y"))) {

if ($formato_fecha[1] > $mes) {
for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 6) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}else{	
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 6) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}
}else{
$nuevafecha = strtotime ( '+6 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$formato_fecha = explode("-",$nuevafecha);
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 6) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}
}else if ($newperiodo == "anual") {
$formato_fecha = explode("-",$fecha);

if ($formato_fecha[0] == intval(date("Y"))) {

if ($formato_fecha[1] > $mes) {
for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 12) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}else{	
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 12) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}
}else{
$nuevafecha = strtotime ( '+12 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$formato_fecha = explode("-",$nuevafecha);
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 12) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}
}else if ($newperiodo == "bianual") {
$formato_fecha = explode("-",$fecha);

if ($formato_fecha[0] == intval(date("Y"))) {

if ($formato_fecha[1] > $mes) {
for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 24) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}else{	
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 24) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}
}else{
$nuevafecha = strtotime ( '+24 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$formato_fecha = explode("-",$nuevafecha);

if ($formato_fecha[0] == intval(date("Y"))) {
for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 24) {
if ($i == $mes) {
$resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
}else{
$resultado = "";	
}
}
}else{
$resultado = "";	
}

}
}


return $resultado;	
}

$sql_insert = "INSERT INTO po_programa_anual_mantenimiento_detalle (id_programa_fecha,id_mantenimiento,ultimafecha,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,estado)
VALUES (
'".$idreporte."',
'".$idelento."',
'".$ultimafecha."',
'".$mes1."',
'".$mes2."',
'".$mes3."',
'".$mes4."',
'".$mes5."',
'".$mes6."',
'".$mes7."',
'".$mes8."',
'".$mes9."',
'".$mes10."',
'".$mes11."',
'".$mes12."',
1
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------
?>