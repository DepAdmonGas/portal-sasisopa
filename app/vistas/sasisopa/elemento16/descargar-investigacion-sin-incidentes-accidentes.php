<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Sin accidentes a la fecha</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 1cm; font-family: Arial, Helvetica, sans-serif;}
*,
*::before,
*::after {
  box-sizing: border-box;
}

@-ms-viewport {
  width: device-width;
}


body {
 margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #212529;
  background-color: #fff;
}

.text-right {
  text-align: right !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

$contenid0 .= '<div>';

function Puesto($idpuesto,$con){

$sqlID = "SELECT tipo_puesto FROM tb_puestos WHERE id = '".$idpuesto."' ";
$resultID = mysqli_query($con, $sqlID);
while($rowID = mysqli_fetch_array($resultID, MYSQLI_ASSOC)){
$Puesto = $rowID['tipo_puesto'];
}
return $Puesto;
}

function Estacion($idestacion,$con){
$sql = "SELECT * FROM tb_estaciones WHERE id = '".$idestacion."' ";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Razonsocial = $row['razonsocial'];
$Estado = $row['di_estado'];
$Municipio = $row['di_municipio'];
$Direccion = $row['direccioncompleta'];
}

$array = array('Razonsocial' => $Razonsocial, 'Estado' => $Estado, 'Municipio' => $Municipio, 'Direccion' => $Direccion);

return $array;
}

$sqlCR = "SELECT * FROM tb_investigacion_incidente_accidente_no WHERE id = '".$GET_ID."' ";
$resultCR = mysqli_query($con, $sqlCR);
while($rowCR = mysqli_fetch_array($resultCR, MYSQLI_ASSOC)){

$Estacion = Estacion($rowCR['id_estacion'],$con);

$sql_usuario = "SELECT nombre, id_puesto, firma FROM tb_usuarios WHERE id = '".$rowCR['id_usuario']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
$Puesto = Puesto($row_usuario['id_puesto'],$con);
$firma = $row_usuario['firma'];
}

$razonsocial = $Estacion['Razonsocial'];
$estado = $Estacion['Estado'];
$municipio = $Estacion['Municipio'];
$domicilio = $Estacion['Direccion'];
$fecha = $rowCR['fecha'];

}

    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);

    $RutaFirma = RUTA_IMG_FIRMA_PERSONAL.$firma;
    $DataFirma = file_get_contents($RutaFirma);
    $baseFirma = 'data:image/;base64,' . base64_encode($DataFirma);

$contenid0 .= '<div><img src="'.$baseLogo.'" style="width: 150px;"></div>';

$contenid0 .= '<div class="text-right" style="margin-top: 40px;">'.$municipio.' '.$estado.', a '.FormatoFecha($fecha).'</div>';

$contenid0 .= '<div style="text-align: justify;margin-top: 40px;"><b>A quien corresponda</b></div>';

$contenid0 .= '<p class="mt-3" style="text-align: justify;margin-top: 40px;"><b>'.$nomencargado.'</b>, en carácter de Representante técnico del regulado <b>'.$razonsocial.'</b>, con ubicación en <b>'.$domicilio.'</b> manifiesto bajo protesta de decir verdad y sabedor de la pena que conlleva a quienes actúan de mala fe o declaran con falsedad, manifiesto que en las instalaciones antes mencionadas a la fecha del presente no han ocurrido ningún tipo de incidentes o accidentes. </p>';

$contenid0 .= '<p style="text-align: justify;">Lo anterior en cumplimiento a las DISPOSICIONES administrativas de carácter general que establecen los Lineamientos para Informar la ocurrencia de incidentes y accidentes a la Agencia Nacional de Seguridad Industrial y de Protección al Medio Ambiente del Sector Hidrocarburos.</p>';

$contenid0 .= '<p style="margin-top: 60px;"><b>Atentamente</b></p>';
$contenid0 .= '<div><img src="'.$baseFirma.'" style="width: 100px;"></div>';
$contenid0 .= '<div>'.$nomencargado.'</div>';
$contenid0 .= '<div>'.$Puesto.'</div>';

//-----------------------------------------------------------------

$contenid0 .= '</div>';
$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream('Sin accidentes a la fecha.pdf',["Attachment" => true]);

//------------------
mysqli_close($con);
//------------------