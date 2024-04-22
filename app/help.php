<?php
//error_reporting(0);
include_once "config/inc.configuracion.php";
include_once "bd/ConexionBD.php";
include_once "modelo/Cursos.php";
include_once "modelo/Mantenimiento.php";
//---------------------------------------
include_once "modelo/Estacion.php";
session_start();

$ClassConexionBD = new ConexionBD();
//--------------------------------------------------------------------------------------------
$ClassMantenimiento = new Mantenimiento();
$con = $ClassConexionBD->conectarBD();

date_default_timezone_set('America/Mexico_City');
$fecha_del_dia = date("Y-m-d");
$hora_del_dia = date("H:i:s");
$hoy = date("Y-m-d h:i:s");
$fecha_year = date("Y");
$fecha_mes = date("m");

$Session_IDUsuarioBD = $_SESSION["id_usuario"];
$session_nomusuario = $_SESSION["nombre_usuario"];
$Session_IDEstacion = $_SESSION["id_gas_usuario"];
$session_idpuesto = $_SESSION["id_puesto_usuario"];
$session_nomestacion = $_SESSION["nombre_gas_usuario"];
$session_nompuesto = $_SESSION["tipo_puesto_usuario"];

$ClassEstacion = new Estacion($Session_IDEstacion);
$ClassEstacion->getNombreEstacion();
$Session_Permisocre = $ClassEstacion->getPermisoCre();
$Session_Razonsocial = $ClassEstacion->getRazonSocial();
$Session_Direccion = $ClassEstacion->getDireccionCompleta();
$Session_DiEstado = $ClassEstacion->getDireccionEstado();
$Session_DiMunicipio = $ClassEstacion->getDireccionMunicipio();
$Session_ApoderadoLegal = $ClassEstacion->getApoderadoLegal();
$Session_ApoderadoLegalFirma = $ClassEstacion->getFirma();
$Session_Politica = $ClassEstacion->getPolitica();
$Session_Mision = $ClassEstacion->getMision();
$Session_Vision = $ClassEstacion->getVision();
$Session_Franquicia = $ClassEstacion->getFranquicia();
$Session_ProductoUno = $ClassEstacion->getProductoUno();
$Session_ProductoDos = $ClassEstacion->getProductoDos();
$Session_ProductoTres = $ClassEstacion->getProductoTres();
$Session_Sasisopa = $ClassEstacion->getSasisopa();
$Session_Autorizacion = $ClassEstacion->getFechaAutorizacion();
$Session_Organigrama = $ClassEstacion->getOrganigrama();

$explodeUsuario = explode(" ", $session_nomusuario);
$nombreCorto = $explodeUsuario[0]." ".$explodeUsuario[1];

if ($Session_IDUsuarioBD == "") {
unset($_SESSION);
session_destroy();
$ClassConexionBD->desconectarBD($con);
header("Location:".PORTAL."");
die();
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
