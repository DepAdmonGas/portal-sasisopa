<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();


$FirmaImg = "http://portal.admongas.com.mx/api-bitacora-fulles/app/Mantenimiento/ImagenFirma/";
$actualpath = "http://portal.admongas.com.mx/api-bitacora-fulles/app/Mantenimiento/Evidencias/";


function NombreEquipo($idequipo, $con){
  $sql_equipo = "SELECT * FROM po_mantenimiento_lista WHERE id = '".$idequipo."' ";
  $result_equipo = mysqli_query($con, $sql_equipo);
  $numero_equipo = mysqli_num_rows($result_equipo);
  while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
  $detalle = $row_equipo['detalle'];
  } 
  return $detalle;
    }

 function FormatFolio($Folio){
        $NumString = strlen($Folio);    
        if($NumString == 1){
        $resultado = "00".$Folio;    
        }else if($NumString == 2){
        $resultado = "0".$Folio;    
        }else if($NumString == 3){
        $resultado = $Folio;    
        }
        return $resultado;    
        }

        function numeroExtintor($idextintor, $con)
{
$sql_extintores = "SELECT * FROM po_extintores_estacion WHERE id = '".$idextintor."' ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);
 while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){
$resultado = $row_extintores['no_extintor'];
 }

 return $resultado;
}

$RutaLogo = RUTA_IMG_LOGOS."Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/' . $type . ';base64,' . base64_encode($DataLogo);       

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Reporte de Mantenimiento ".$Mantenimiento."</title>";
    $contenid0 .= "<style>@page {margin: 0.5cm 1cm;} </style>";
    $contenid0 .= "</head>";
    $contenid0 .= "<body style='margin-top: 2px;margin-left:2px;margin-bottom: 2px;margin-right: 2px;'>";
    $contenid0 .= "<div style='width: 100%;'>";
    $contenid0 .= "<img src='".$baseLogo."' style='width: 200px;'>";

    $contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'><b>Reporte Mantenimiento ".$Mantenimiento."</b></div>";
    $contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'><b>".$Session_Permisocre."</b></div>";
    $contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'>".$Session_Razonsocial."</div>";
    $contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'><small>".$Session_Direccion."</small></div>";


$contenid0 .= "<div style='width: 100%;margin-top: 20px;'>";
$sql_mantenimiento = "SELECT * FROM bi_mantenimientos WHERE id_estacion = '".$Session_IDEstacion."' AND categoria_mantenimiento = '".$Mantenimiento."' AND estado = 1 ORDER BY id desc";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);

if ($numero_mantenimiento > 0) {

$contenid0 .= "<table style='text-align: center;border-collapse: collapse;font-family: Arial, Helvetica, sans-serif;width: 99%;margin-top: 20px;'>";
    $contenid0 .= "<tr bgcolor='#F5F5F5' style='font-size: 12px;'>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Folio</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Actividad</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Fecha y hora de inicio</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Fecha y hora de termino</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Descripción</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Areá</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>EPP</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>I/E</b></td>";
    $contenid0 .= "</tr>";

while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){

$idMantenimiento = $row_mantenimiento['id'];
$folio = FormatFolio($row_mantenimiento['folio']);

$idactividad = $row_mantenimiento['id_actividad'];

$fechainicio = FormatoFecha($row_mantenimiento['fechainicio']);
$horainicio = date("g:i a",strtotime($row_mantenimiento['horainicio']));

$fechatermino = FormatoFecha($row_mantenimiento['fechatermino']);
$horatermino = date("g:i a",strtotime($row_mantenimiento['horaintermino']));

$descripcion = $row_mantenimiento['descripcion'];
$area = $row_mantenimiento['area'];
$epp = $row_mantenimiento['epp'];
$tipo = $row_mantenimiento['tipo'];

if ($idactividad == "") {
$actividad = $row_mantenimiento['actividad'];
}else{
$actividad = NombreEquipo($idactividad, $con);
}

$sql_imagen1 = "SELECT nombre,imagen_firma FROM bi_mantenimientos_firma WHERE id_mantenimiento = '".$idMantenimiento."'  AND tipo_firma = 'FPR' ";
$result_imagen1 = mysqli_query($con, $sql_imagen1);
$numero_imagen1 = mysqli_num_rows($result_imagen1);
while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){
$PR = $row_imagen1['nombre'];
$FPR = $row_imagen1['imagen_firma'];
}

$sql_imagen2 = "SELECT nombre,imagen_firma FROM bi_mantenimientos_firma WHERE id_mantenimiento = '".$idMantenimiento."'  AND tipo_firma = 'FPS' ";
$result_imagen2 = mysqli_query($con, $sql_imagen2);
$numero_imagen2 = mysqli_num_rows($result_imagen2);
while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
$PS = $row_imagen2['nombre'];
$FPS = $row_imagen2['imagen_firma'];
}

$DataFPR = file_get_contents($FirmaImg.$FPR);
$DataFPS = file_get_contents($FirmaImg.$FPS);
$baseFPR = 'data:image/' . $type . ';base64,' . base64_encode($DataFPR);
$baseFPS = 'data:image/' . $type . ';base64,' . base64_encode($DataFPS);

$contenid0 .= "<tr style='font-size: 10px;'>";
$contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>".$folio."</b></td>";
$contenid0 .= "<td style='border: 1px solid #6F6F6F;'>".$actividad."</td>";
$contenid0 .= "<td style='border: 1px solid #6F6F6F;'>".$fechainicio.", ".$horainicio."</td>";
$contenid0 .= "<td style='border: 1px solid #6F6F6F;'>".$fechatermino.", ".$horainicio."</td>";
$contenid0 .= "<td style='border: 1px solid #6F6F6F;'>".$descripcion."</td>";
$contenid0 .= "<td style='border: 1px solid #6F6F6F;'>".$area."</td>";
$contenid0 .= "<td style='border: 1px solid #6F6F6F;'>".$epp."</td>";
$contenid0 .= "<td style='border: 1px solid #6F6F6F;'>".$tipo."</td>";
$contenid0 .= "</tr>";
$contenid0 .= "<tr style='font-size: 10px;'>";
$contenid0 .= "<td style='border: 1px solid #6F6F6F;' colspan='8'>";

//--------------------------------------------------------------------------------------------------------
if ($idactividad == 20) {
$sql_extintores = "SELECT * FROM bi_mantenimientos_extintores WHERE id_verificar = '".$idMantenimiento."' ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);

$contenid0 .= '<table style="text-align: center;border-collapse: collapse;width: 100%;margin: 5px;">';
	$contenid0 .= '<thead>';
		$contenid0 .= '<tr>';
			$contenid0 .= '<th style="border: 1px solid #6F6F6F;">No. De extintor </th>';
			$contenid0 .= '<th style="border: 1px solid #6F6F6F;">Manometro</th>';
			$contenid0 .= '<th style="border: 1px solid #6F6F6F;">Boquilla Descarga</th>';
			$contenid0 .= '<th style="border: 1px solid #6F6F6F;">Manguera</th>';
			$contenid0 .= '<th style="border: 1px solid #6F6F6F;">Funcionalidad</th>';
			$contenid0 .= '<th style="border: 1px solid #6F6F6F;">Observaciones</th>';
		$contenid0 .= '</tr>';
	$contenid0 .= '</thead>';
	$contenid0 .= '<tbody>';

if ($numero_extintores > 0) {
    while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){

        $idextintor = $row_extintores['id_extintor'];
        $numeroExtintor = numeroExtintor($idextintor, $con);
        $manometro = $row_extintores['manometro'];
        $boquilladescarga = $row_extintores['boquilla_descarga'];
        $manguera = $row_extintores['manguera'];
        $funcionalidad = $row_extintores['funcionalidad'];
        $observaciones = $row_extintores['observaciones'];

$contenid0 .='<tr>';
$contenid0 .='<td style="border: 1px solid #6F6F6F;">'.$numeroExtintor.'</td>';
$contenid0 .='<td style="border: 1px solid #6F6F6F;">'.$manometro.'</td>';
$contenid0 .='<td style="border: 1px solid #6F6F6F;">'.$boquilladescarga.'</td>';
$contenid0 .='<td style="border: 1px solid #6F6F6F;">'.$manguera.'</td>';
$contenid0 .='<td style="border: 1px solid #6F6F6F;">'.$funcionalidad.'</td>';
$contenid0 .='<td style="border: 1px solid #6F6F6F;">'.$observaciones.'</td>';
$contenid0 .='</tr>';
    }

}else{

}
$contenid0 .='</tbody>';
$contenid0 .='</table>';
}
//-----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------

$sql_evidencias = "SELECT * FROM bi_mantenimientos_evidencia WHERE id_mantenimiento = '".$idMantenimiento."' ";
$result_evidencias = mysqli_query($con, $sql_evidencias);
$numero_evidencias = mysqli_num_rows($result_evidencias);
if ($numero_evidencias > 0) {
$contenid0 .= "<div style='border: 1px solid #6F6F6F;padding: 10px;'>";
$contenid0 .= "<div style='margin-top: 5px;'><small><b>Evidencias:</b></small></div>";
$contenid0 .= "<div>";
    while($row_evidencias = mysqli_fetch_array($result_evidencias, MYSQLI_ASSOC)){

        $url = $actualpath.$row_evidencias['url'];
        $nombreimg = $row_evidencias['nombre'];

$Evidencia = file_get_contents($url);
$baseEvidencia = 'data:image/' . $type . ';base64,' . base64_encode($Evidencia);
$contenid0 .= "<img style='margin-top: 30px;width: 120px;height: 220px; padding: 5px;' src='".$baseEvidencia."' />";

    }
$contenid0 .= "</div>";
$contenid0 .= "</div>";
}

//-----------------------------------------------------------------------------------------

$contenid0 .= "<table style='text-align: center;border-collapse: collapse;width: 100%;'>";
$contenid0 .= "<tr>";
$contenid0 .= "<td style='border: 0px solid #6F6F6F;'>";
$contenid0 .= "<div>
<img width='90px' src='".$baseFPR."'  alt='base' /></div>
        <div>".$PR."</div>
        </td>";
$contenid0 .= "</td>";
$contenid0 .= "<td style='border: 0px solid #6F6F6F;'>";
$contenid0 .= "<div>
<img width='90px' src='".$baseFPS."'  alt='base' /></div>
        <div>".$PS."</div>
        </td>";
$contenid0 .= "</td>";
$contenid0 .= "</tr>";
$contenid0 .= "</table>";

$contenid0 .= "</td>";
$contenid0 .= "</tr>";

}

$contenid0 .= "</table>";
}
$contenid0 .= "</div>";

$contenid0 .= "</div>";
$contenid0 .= "</body>";
$contenid0 .= "</html>";


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(768, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));

// Ponemos el PDF en el browser
$dompdf->stream('Reporte-Mantenimiento.pdf');
//------------------
mysqli_close($con);
//------------------