<?php
include_once "app/help.php";
require_once 'dompdf/autoload.inc.php';


use Dompdf\Dompdf;
$dompdf = new Dompdf();

$contenid0 = "";

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>POLÍTICA</title>";
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
  font-size: 1.55rem;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

  $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
  $DataLogo = file_get_contents($RutaLogo);
  $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);

    $contenid0 .= '<div style="text-align: center;margin-top: 30px;"><img src="'.$baseLogo.'" style="width: 300px;">';
    $contenid0 .= '<div style="text-align: center;font-size: 1.1em;">'.$Session_Permisocre.'</div>';
    $contenid0 .= '<div style="text-align: center;font-size: 1.1em;">'.$Session_Razonsocial.'</div>';
    $contenid0 .= '<div style="text-align: center;font-size: 1.1em;">'.$Session_Direccion.'</div>';

$contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 20px;margin-top: 30px;border-bottom: 4px solid #005993;">
              <div style="color: #1A71BD;text-align: left;"><h5>Politica:</h5></div>
              <div style="font-size: 1.4em;text-align: justify;">'.$Session_Politica.'</div>
              </div>';

$contenid0 .= '<div style="page-break-after:always;"></div>';

$contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 20px;margin-top: 30px;border-bottom: 4px solid #005993;">
              <div style="color: #1A71BD;text-align: left;"><h5>Misión:</h5></div>
              <div style="font-size: 1.4em;text-align: justify;">'.$Session_Mision.'</div>
              </div>';

$contenid0 .= '<div style="border: 1px solid rgba(0, 0, 0, 0.125);padding: 20px;margin-top: 30px;border-bottom: 4px solid #005993;">
              <div style="color: #1A71BD;text-align: left;"><h5>Visión:</h5></div>
              <div style="font-size: 1.4em;text-align: justify;">'.$Session_Vision.'</div>
              </div>';


$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(525, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));
$dompdf->stream('POLÍTICA.pdf');
