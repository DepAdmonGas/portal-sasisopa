<?php
set_time_limit(900);
ini_set('max_execution_time', 900);

require_once '../../dompdf/autoload.inc.php';
include_once "../../app/help.php";

use Dompdf\Dompdf;
// Inicializamos dompdf
$dompdf = new Dompdf();
// Le pasamos el html a dompdf

$selyear = $_GET['selyear'];
$selmes = $_GET['selmes'];


$sql_recepcion = "SELECT * FROM tb_recepcion_descargar WHERE id_estacion = '".$Session_IDEstacion."'
AND YEAR(fecha) = '".$selyear."' AND MONTH (fecha) = '".$selmes."' ORDER BY fecha DESC, hora_llegada DESC ";

$result_recepcion = mysqli_query($con, $sql_recepcion);
$numero_recepcion = mysqli_num_rows($result_recepcion);

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

       function NombreUsuario($idUsuario, $con){

        $sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$idUsuario."' ";
        $result_usuario = mysqli_query($con, $sql_usuario);
        while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
        $nomencargado = $row_usuario['nombre'];
        }

        return $nomencargado;

       }

       function DetalleTanque($idtanque, $con){
      $sql_tanque = "SELECT * FROM tb_tanque_almacenamiento WHERE id = '".$idtanque."' ";
      $result_tanque = mysqli_query($con, $sql_tanque);
      $numero_tanque = mysqli_num_rows($result_tanque);
      while($row_tanque = mysqli_fetch_array($result_tanque, MYSQLI_ASSOC)){

      $tanque = $row_tanque['no_tanque'];
      }

      return $tanque;
      }

        function Firmas($id,$tipoFirma,$con){

        $ruta = "https://portal.admongas.com.mx/bitacora-api-app/app/Recepcion/ImagenFirma/";

        $sql = "SELECT id_usuario,imagen_firma FROM tb_recepcion_descargar_firma WHERE id_recepcion_descarga = '".$id."'  AND tipo_firma = '".$tipoFirma."' ";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        if($numero != 0){
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $Nombre = NombreUsuario($row['id_usuario'], $con);

        $type = pathinfo($row['imagen_firma'], PATHINFO_EXTENSION);

        $Data = file_get_contents($ruta.$row['imagen_firma']);
        $base = 'data:image/' . $type . ';base64,' . base64_encode($Data);
        
        if($row['imagen_firma'] == ""){
        $Firma = "";
        }else{
        $Firma = "<img width='40px' src='".$base."' />";
         }
        
        }

        $array = array('Nombre' => $Nombre, 'Firma' => $Firma);

        }else{
        $array = array('Nombre' => "", 'Firma' => "");
        }
        
        return $array;
        }

        function Verificar($id,$verificar,$con){
        $sql = "SELECT verificar, resultado FROM tb_recepcion_descargar_sellos WHERE id_recepcion_descarga = '".$id."'  AND verificar = '".$verificar."' ";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $resultado = $row['resultado'];
        }

        return $resultado;
        }

        function DescargaTanques($id,$litroscompra,$con){

        $TotalII = 0;
        $TotalIF = 0;

        $return .= "<table class='table-bordered table-sm' width='100%'>";
        $return .= "<tr bgcolor='#F5F5F5'>";
        $return .= "<td ><b>No. Tanque</b></td>";
        $return .= "<td ><b>Inventario Inicial</b></td>";
        $return .= "<td ><b>Inventario Final</b></td>";
        $return .= "<td ><b>Aditivacón</b></td>";
        $return .= "</tr>";

        $sql = "SELECT * FROM tb_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$id."' ";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

        $idtanque = DetalleTanque($row['id_tanque'], $con);

        $return .= "<tr>";
        $return .= "<td ><b>".$idtanque."</b></td>";
        $return .= "<td >".number_format($row['inventario_inicial'],2)."</td>";
        $return .= "<td >".number_format($row['inventario_final'],2)."</td>";
        $return .= "<td >".$row['aditivacion']."</td>";
        $return .= "</tr>";

        $TotalII = $TotalII + $row['inventario_inicial'];
        $TotalIF = $TotalIF + $row['inventario_final'];

        }

        $sumacompra = $TotalII + $litroscompra;
        $Merma = $TotalIF - $sumacompra;

        $return .= "<tr>";
        $return .= "<td colspan='4' style='padding: 5px;text-align: center;'>Merma: <b>".number_format($Merma,2)."</b></td>";
        $return .= "</tr>";
        $return .= "</table>";
        
        return $return;
        }


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Reporte de Recepcion y Descarga del Producto</title>";
        $contenid0 .= '<style type="text/css">
@page {margin: 0.6cm 0.6cm; font-family: Arial, Helvetica, sans-serif;}

body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-weight: 400;
  line-height: 1;
  color: #212529;
  text-align: left;
  background-color: #fff;
}

.text-center {
  text-align: center !important;
}
.p-1 {
  padding: 0.25rem !important;
}
.mt-1 {
  margin-top: 0.25rem !important;
}

.mt-2,
.my-2 {
  margin-top: 0.5rem !important;
}

.mt-3 {
  margin-top: 1rem !important;
}
.mt-4 {
  margin-top: 1.5rem !important;
}
table {
  border-collapse: collapse;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
  background-color: transparent;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}

.table .table {
  background-color: #fff;
}

.table-sm th,
.table-sm td {
  padding: 0.3rem;
}

.table-bordered {
  border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}
.table-bordered {
  border: 1px solid #dee2e6;
}

.table-sm th,
.table-sm td {
  padding: 0.3rem;
}
.align-middle {
  vertical-align: middle !important;
}
small {
  font-size: 70%;
}
.table-active,
.table-active > th,
.table-active > td {
  background-color: rgba(0, 0, 0, 0.075);
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}

img {
  vertical-align: middle;
  border-style: none;
}
</style>';
    $contenid0 .= "</head>";
    $contenid0 .= "<body>";

    $RutaLogo = RUTA_IMG_LOGOS."Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/' . $type . ';base64,' . base64_encode($DataLogo);

    $contenid0 .= '<div class="text-center" style="margin-top: 30px;"><img src="'.$baseLogo.'" style="width: 200px;"></div>';
    $contenid0 .= '<div class="text-center" style="margin-top: 50px;"><b>Bitacora de operación (Recepción y Descarga del Producto)</b></div>';
    $contenid0 .= '<div class="text-center mt-1"><b>'.$Session_Permisocre.'</b></div>';
    $contenid0 .= '<div class="text-center mt-1">'.$Session_Razonsocial.'</div>';
    $contenid0 .= '<div class="text-center mt-1"><small>'.$Session_Direccion.'</small></div>';
    $contenid0 .= '<div class="text-center mt-1"><small>Código: DLES/SA/003</small></div>';
    $contenid0 .= '<div class="text-center mt-1" style="margin-bottom: 50px;">'.nombremes($selmes).' '.$selyear.'</div>';

    while($row_recepcion = mysqli_fetch_array($result_recepcion, MYSQLI_ASSOC)){

    $contenid0 .= "<table class='table-bordered table-sm mt-2' width='100%'>";
    $contenid0 .= '<thead>';
    $contenid0 .= "<tr class='table-active' style='font-size: .5em;'>";
    $contenid0 .= "<td class='text-center align-middle'><b>Folio</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>Fecha</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>Hora llegada</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>Hora salida</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>Tiempo descarga</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>Línea Transporte</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>No. de Remolque</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>Vehículo (Placas)</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>Operador</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>No. Factura</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>Litros de compra</b></td>";
    $contenid0 .= "<td class='text-center align-middle'><b>Producto</b></td>";
    $contenid0 .= "</tr>";
    $contenid0 .= '</thead>';
    $contenid0 .= '<tbody>';

        $id = $row_recepcion['id'];
        $folio = FormatFolio($row_recepcion['folio']);
        $explode = explode("-",$row_recepcion['fecha']);
        $fecha = $explode[2]."/".$explode[1]."/".$explode[0];
        $horallegada = date("g:i a",strtotime($row_recepcion['hora_llegada']));
        $horasalida = date("g:i a",strtotime($row_recepcion['hora_salida']));

        $lineaTransporte = $row_recepcion['linea_transporte'];
        $noRemolque = $row_recepcion['no_remolque'];
        $Placa = $row_recepcion['placa'];
        $Operador = $row_recepcion['operador'];

        $nofactura = $row_recepcion['no_factura'];
        $litroscompra = $row_recepcion['litros_compra'];
        $producto = $row_recepcion['producto'];
        $manometro = $row_recepcion['manometro'];
        $temperatura = $row_recepcion['temperatura'];
        $observaciones = $row_recepcion['observaciones'];
        $estado = $row_recepcion['estado'];
        $sellonoserie = $row_recepcion['sello_noserie'];
        $tiempodescarga = $row_recepcion['tiempo_descarga'];


        if ($producto == "G PREMIUM") {
            $colorP = "#BB1616";
        }else if ($producto == "G SUPER") {
            $colorP = "#16BB43";
        }else if ($producto == "G DIESEL") {
            $colorP = "#212121";
        }

        if ($estado == 0) {
            $ColorTR = "#FFE8E8";
        }else{
            $ColorTR = "";
        }


$FirmaPR = Firmas($id,'FPR',$con);
$NPR = $FirmaPR['Nombre'];
$FPR = $FirmaPR['Firma'];

$FirmaPR = Firmas($id,'FPS',$con);
$NPS = $FirmaPR['Nombre'];
$FPS = $FirmaPR['Firma'];

//-----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------

$resultado1 = Verificar($id,'Se encuentran en buen estado',$con);
$resultado2 = Verificar($id,'Sin rastro de sustancias aceitosas',$con);
$resultado3 = Verificar($id,'Nivel del producto está a más de 1.5 cm (+/-0.3 cm)',$con);
$DescargaTanques = DescargaTanques($id,$litroscompra,$con);


//-----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------

$contenid0 .= "<tr style='font-size: .5em;'>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'><b>".$folio."</b></td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'>".$fecha."</td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'>".$horallegada."</td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'>".$horasalida."</td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'>".$tiempodescarga."</td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'>".$lineaTransporte."</td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'>".$noRemolque."</td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'>".$Placa."</td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'>".$Operador."</td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'>".$nofactura."</td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;'><b>".number_format($litroscompra,2)."</b></td>";
        $contenid0 .= "<td class='text-center align-middle' style='background:$ColorTR;color:$colorP;'><b>".$producto."</b></td>";
        $contenid0 .= "</tr>";
        //------------------------------------------------------------------------------------------
        $contenid0 .= "<tr>";
        $contenid0 .= "<td colspan='12' style='padding: 0px; margin: 0px;' >";
        //----------------------------------------------------

        $contenid0 .= "<table width='100%'>";
        $contenid0 .= "<tr style='font-size: .5em;'>";

        //--------------------------------------- td uno

        $contenid0 .= "<td style='vertical-align: text-top;border: 0px;'>".$DescargaTanques."</td>";

        //------------------------ td dos

        $contenid0 .= "<td style='vertical-align: text-top;border: 0px;'>";
        $contenid0 .= "<table class='table-bordered table-sm' width='100%'>
        <tr><td colspan='2' style='background:#F5F5F5;text-align: center;'><b>Sellos</b></td></tr>
        <tr><td>Se encuentran en buen estado</td><td><b>".$resultado1."</b></td></tr>
        <tr><td>Sin rastro de sustancias aceitosas</td><td><b>".$resultado2."</b></td></tr>
        <tr><td colspan='2'><b>No. Serie:</b> ".$sellonoserie."</td></tr></table>";
        $contenid0 .= "</td>";

        //----------------------- td tres

        $contenid0 .= "<td style='vertical-align: text-top;border: 0px;'>";
        $contenid0 .= "<table class='table-bordered table-sm' width='100%'>
        <tr><td colspan='2' style='background:#F5F5F5;text-align: center;'><b>NICE</b></td></tr>
        <tr><td>Nivel del producto está a más de 1.5 cm (+/-0.3 cm)</td><td><b>".$resultado3."</b></td></tr>
        <tr><td>Manometro</td><td><b>".$manometro."</b></td></tr>
        <tr><td>Temperatura</td><td><b>".$temperatura."</b></td></tr></table>";
        $contenid0 .= "</td>";

        $contenid0 .= "<td style='vertical-align: text-top;border: 0px;'><div colspan='2' style='background:#F5F5F5;text-align: center;'><b>Observaciones</b></div><div class='mt-1'>".$observaciones."</td></td>";

        //--------------------------------------

        $contenid0 .= "<td style='vertical-align: text-top;border: 0px;'>
        <div colspan='2' style='background:#F5F5F5;text-align: center;'><b>Persona que recibe</b></div>
        <div class='mt-1 text-center'>".$FPR."</div>
        <div class='mt-1 text-center'>".$NPR."</div>
        </td>";
        $contenid0 .= "<td style='vertical-align: text-top;border: 0px;'>
        <div colspan='2' style='background:#F5F5F5;text-align: center;'><b>Persona que superviso</b></div>
        <div class='mt-1 text-center'>".$FPS."</div>
        <div class='mt-1 text-center'>".$NPS."</div>
        </td>";

        $contenid0 .= "</tr>";
        $contenid0 .= "</table>";

        //----------------------------------------------------
        $contenid0 .= "</td>";
        $contenid0 .= "</tr>";
        //------------------------------------------------------------------------------------------

    $contenid0 .= '</tbody>';
    $contenid0 .= "</table>";

        
    }

$contenid0 .= "</div>";
$contenid0 .= "</body>";
$contenid0 .= "</html>";

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
//$dompdf->get_canvas()->page_text(785, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('ReporteRecepcionDescargaProducto.pdf',array("Attachment" => true));
exit(0);
//------------------
mysqli_close($con);
//------------------
?>
