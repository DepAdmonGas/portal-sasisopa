<?php
error_reporting(0);
include_once "config/inc.configuracion.php";
include_once "bd/inc.conexion.php";
include_once "modelo/Cursos.php";
include_once "modelo/Mantenimiento.php";
session_start();

date_default_timezone_set('America/Mexico_City');
$fecha_del_dia = date("Y-m-d");
$hora_del_dia = date("H:i:s");
$hoy = date("Y-m-d h:i:s");

$fecha_year = date("Y");
$fecha_mes = date("m");

$ClassCursos = new Cursos();
$ClassMantenimiento = new Mantenimiento();

$Session_IDUsuarioBD = $_SESSION["id_usuario"];
$session_nomusuario = $_SESSION["nombre_usuario"];
$Session_IDEstacion = $_SESSION["id_gas_usuario"];
$session_idpuesto = $_SESSION["id_puesto_usuario"];
$session_nomestacion = $_SESSION["nombre_gas_usuario"];
$session_nompuesto = $_SESSION["tipo_puesto_usuario"];

if ($Session_IDUsuarioBD == "") {
unset($_SESSION);
session_destroy();
mysqli_close($con);
header("Location:".PORTAL."");
die();
}

$explodeUsuario = explode(" ", $session_nomusuario);
$nombreCorto = $explodeUsuario[0]." ".$explodeUsuario[1];

$sql_estacion = "SELECT * FROM tb_estaciones WHERE id = '".$Session_IDEstacion."' ";
$result_estacion = mysqli_query($con, $sql_estacion);
$numero_estacion = mysqli_num_rows($result_estacion);

while($row_estacion = mysqli_fetch_array($result_estacion, MYSQLI_ASSOC)){
$Session_Permisocre = $row_estacion['permisocre'];
$Session_Razonsocial = $row_estacion['razonsocial'];
$Session_Direccion = $row_estacion['direccioncompleta'];
$Session_Franquicia = $row_estacion['franquicia'];
$Session_ProductoUno = $row_estacion['producto_uno'];
$Session_ProductoDos = $row_estacion['producto_dos'];
$Session_ProductoTres = $row_estacion['producto_tres'];
$Session_Sasisopa = $row_estacion['sasisopa'];
$Session_Politica = $row_estacion['politica'];
$Session_Mision = $row_estacion['mision'];
$Session_Vision = $row_estacion['vision'];
$Session_Organigrama = $row_estacion['organigrama'];
$Session_ApoderadoLegal = $row_estacion['apoderado_legal'];
$Session_ApoderadoLegalFirma = $row_estacion['firma'];
$Session_Autorizacion = $row_estacion['fecha_autorizacion'];
$Session_DiEstado = $row_estacion['di_estado'];
$Session_DiMunicipio = $row_estacion['di_municipio'];
}

//--------------------------------------------------------------------------------
//---------------------------------Formato Fechas---------------------------------
function nombremes($mes){

if ($mes=="01") $mes="Enero";
if ($mes=="02") $mes="Febrero";
if ($mes=="03") $mes="Marzo";
if ($mes=="04") $mes="Abril";
if ($mes=="05") $mes="Mayo";
if ($mes=="06") $mes="Junio";
if ($mes=="07") $mes="Julio";
if ($mes=="08") $mes="Agosto";
if ($mes=="09") $mes="Septiembre";
if ($mes=="10") $mes="Octubre";
if ($mes=="11") $mes="Noviembre";
if ($mes=="12") $mes="Diciembre";

return $mes;
}

function FormatoFecha($fechaFormato){
  $formato_fecha = explode("-",$fechaFormato);
  $resultado = $formato_fecha[2]." de ".nombremes($formato_fecha[1])." del ".$formato_fecha[0];
  return $resultado;
}
//--------------------------------------------------------------------------------
?>
