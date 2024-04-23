<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

$sql = "SELECT * FROM se_quejas_sugerencias WHERE id = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$fecha = $row['fecha'];
$nombre = $row['nombre'];
$motivos_causas = $row['motivos_causas'];
$nombre_dirigido = $row['nombre_dirigido'];
$contacto = $row['contacto'];
$nombre_puesto = $row['nombre_puesto'];
$consecuencias = $row['consecuencias'];
$solucion = $row['solucion'];
$plazo = $row['plazo'];
$confirmacion = $row['confirmacion'];

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Quejas y sugerencias</title>";
        $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 1cm; font-family: Arial, Helvetica, sans-serif;}
*,
*::before,
*::after {
  box-sizing: border-box;
}

html {
  font-family: sans-serif;
  line-height: 1.15;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -ms-overflow-style: scrollbar;
  -webkit-tap-highlight-color: transparent;
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

h5, .h5 {
  font-size: 1.3rem;
}

hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}

</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);

    $contenid0 .= '<div style="text-align: center;margin-top: 30px;"><img src="'.$baseLogo.'" style="width: 250px;">';
    $contenid0 .= '<div style="text-align: center;font-size: 1.1em;">'.$Session_Permisocre.'</div>';
    $contenid0 .= '<div style="text-align: center;font-size: 1.1em;">'.$Session_Razonsocial.'</div>';
    $contenid0 .= '<div style="text-align: center;font-size: 1.1em;">'.$Session_Direccion.'</div>';

    $contenid0 .= '<h5>Quejas y sugerencias</h5>';

    $contenid0 .= '<div style="text-align: left;margin-top: 15px; margin-bottom: 15px;"><b>1. Datos para ser llenados por el cliente</b></div>';

    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;"><b>Fecha:</b> '.FormatoFecha($fecha).'</div>';

    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;margin-top: 10px;"><b>Nombre:</b> '.$nombre.'</div>';
    $contenid0 .= '<div style="text-align: left;margin-top: 10px;"><b>Exposición de los motivos y del hecho causante:</b></div>';
    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;margin-top: 10px;">'.$motivos_causas.'</div>';
    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;margin-top: 10px;"><b>Nombre de a quien va dirigida la queja:</b> '.$nombre_dirigido.'</div>';
    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;margin-top: 10px;"><b>Datos de contacto:</b> '.$contacto.'</div>';

    $contenid0 .= '<hr>';

    $contenid0 .= '<div style="text-align: left;margin-top: 15px; margin-bottom: 15px;"><b>2.  Datos a ser llenados por quien atiende la queja</b></div>';

    $contenid0 .= '<div style="text-align: left;margin-top: 10px;"><b>Nombre y puesto de quien atiende la queja:</b> </div>';
    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;margin-top: 10px;">'.$nombre_puesto.'</div>';
    $contenid0 .= '<div style="text-align: left;margin-top: 10px;"><b>Efectos o consecuencias de la queja:</b></div>';
    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;margin-top: 10px;">'.$consecuencias.'</div>';
    $contenid0 .= '<div style="text-align: left;margin-top: 10px;"><b>Solución propuesta y adoptada:</b></div>';
    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;margin-top: 10px;">'.$solucion.'</div>';
    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;margin-top: 10px;"><b>Plazo para llevarla a cabo:</b> '.$plazo.'</div>';
    $contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 5px;text-align: left;margin-top: 10px;"><b>Confirmación de la resolución:</b> '.$confirmacion.'</div>';
   

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(525, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));

// Ponemos el PDF en el browser
$dompdf->stream('Quejas y sugerencias.pdf');
//------------------
mysqli_close($con);
//------------------