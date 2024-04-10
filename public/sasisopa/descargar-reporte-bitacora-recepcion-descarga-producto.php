<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
// Inicializamos dompdf
$dompdf = new Dompdf();
// Le pasamos el html a dompdf
$ruta = "http://portal.admongas.com.mx/api-bitacora-fulles/app/Recepcion/ImagenFirma/";
$year = date("Y");
$mes = date("m");

if ($selyear == "X" && $selmes == "X" && $inicio == "X" && $fin == "X") {

$sql_recepcion = "SELECT * FROM bi_recepcion_descargar WHERE id_estacion = '".$Session_IDEstacion."'
AND YEAR(fecha) = '".$year."' AND MONTH (fecha) = '".$mes."' ORDER BY fecha DESC, hora_llegada DESC ";

}else{


if ($selyear != "X") {

if ($selyear != "X" && $selmes != "X") {
$sql_recepcion = "SELECT * FROM bi_recepcion_descargar WHERE id_estacion = '".$Session_IDEstacion."'
AND YEAR(fecha) = '".$selyear."' AND MONTH (fecha) = '".$selmes."' ORDER BY fecha DESC, hora_llegada DESC ";
}else{
$sql_recepcion = "SELECT * FROM bi_recepcion_descargar WHERE id_estacion = '".$Session_IDEstacion."'
AND YEAR(fecha) = '".$selyear."' ORDER BY fecha DESC, hora_llegada DESC ";
}

}else{

$sql_recepcion = "SELECT * FROM bi_recepcion_descargar WHERE id_estacion = '".$Session_IDEstacion."'
AND (fecha BETWEEN '".$inicio."' AND '".$fin."') ORDER BY fecha DESC, hora_llegada DESC ";
}

}

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


       $RutaLogo = RUTA_IMG_LOGOS."Logo.png";
        $DataLogo = file_get_contents($RutaLogo);
        $baseLogo = 'data:image/' . $type . ';base64,' . base64_encode($DataLogo);


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Reporte de Recepcion y Descarga del Producto</title>";
    $contenid0 .= "<style>@page {margin: 0.5cm 1cm;}</style>";
    $contenid0 .= "</head>";
    $contenid0 .= "<body style='margin-top: 2px;margin-left:2px;margin-bottom: 2px;margin-right: 2px;'>";
    $contenid0 .= "<div style='width: 100%;'>";
    $contenid0 .= "<img src='".$baseLogo."' style='width: 200px;'>";

    $contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'><b>Bitacora de operación (Recepción y Descarga del Producto)</b></div>";
    $contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'><b>".$Session_Permisocre."</b></div>";
    $contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'>".$Session_Razonsocial."</div>";
    $contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'><small>".$Session_Direccion."</small></div>";

    while($row_recepcion = mysqli_fetch_array($result_recepcion, MYSQLI_ASSOC)){

    $contenid0 .= "<table style='text-align: center;border-collapse: collapse;font-family: Arial, Helvetica, sans-serif;margin-top: 20px;width: 100%;'>";
    $contenid0 .= "<tr bgcolor='#F5F5F5' style='font-size: 12px;'>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Folio</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Fecha</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Hora llegada</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Hora salida</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Tiempo descarga</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Línea Transporte</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>No. de Remolque</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Vehículo (Placas)</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Operador</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>No. Factura</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Litros de compra</b></td>";
    $contenid0 .= "<td style='border: 1px solid #6F6F6F;'><b>Producto</b></td>";
    $contenid0 .= "</tr>";

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

        $idtanque1 = 0;
        $inventarioinicial1 = 0;
        $inventariofinal1 = 0;

        $idtanque2 = 0;
        $inventarioinicial2 = 0;
        $inventariofinal2 = 0;

        $idtanque3 = 0;
        $inventarioinicial3 = 0;
        $inventariofinal3 = 0;

        $idtanque4 = 0;
        $inventarioinicial4 = 0;
        $inventariofinal4 = 0;

        $TotalII = 0;
        $TotalIF = 0;

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



$sql_imagen1 = "SELECT id_usuario,imagen_firma FROM bi_recepcion_descargar_firma WHERE id_recepcion_descarga = '".$id."'  AND tipo_firma = 'FPR' ";
$result_imagen1 = mysqli_query($con, $sql_imagen1);
$numero_imagen1 = mysqli_num_rows($result_imagen1);
while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){
$NombreRecibe = NombreUsuario($row_imagen1['id_usuario'], $con);
$FPR = $row_imagen1['imagen_firma'];
}

$sql_imagen2 = "SELECT id_usuario,imagen_firma FROM bi_recepcion_descargar_firma WHERE id_recepcion_descarga = '".$id."'  AND tipo_firma = 'FPS' ";
$result_imagen2 = mysqli_query($con, $sql_imagen2);
$numero_imagen2 = mysqli_num_rows($result_imagen2);
while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
$NombreSupervisa = NombreUsuario($row_imagen2['id_usuario'], $con);
$FPS = $row_imagen2['imagen_firma'];
}

$DataFPR = file_get_contents($ruta.$FPR);
$DataFPS = file_get_contents($ruta.$FPS);
$baseFPR = 'data:image/' . $type . ';base64,' . base64_encode($DataFPR);
$baseFPS = 'data:image/' . $type . ';base64,' . base64_encode($DataFPS);

//-----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------
$sql_verificar1 = "SELECT verificar, resultado FROM bi_recepcion_descargar_sellos WHERE id_recepcion_descarga = '".$id."'  AND verificar = 'Se encuentran en buen estado' ";
$result_verificar1 = mysqli_query($con, $sql_verificar1);
$numero_verificar1 = mysqli_num_rows($result_verificar1);
while($row_verificar1 = mysqli_fetch_array($result_verificar1, MYSQLI_ASSOC)){

$verificar1 = $row_verificar1['verificar'];
$resultado1 = $row_verificar1['resultado'];
}

$sql_verificar2 = "SELECT verificar, resultado FROM bi_recepcion_descargar_sellos WHERE id_recepcion_descarga = '".$id."'  AND verificar = 'Sin rastro de sustancias aceitosas' ";
$result_verificar2 = mysqli_query($con, $sql_verificar2);
$numero_verificar2 = mysqli_num_rows($result_verificar2);
while($row_verificar2 = mysqli_fetch_array($result_verificar2, MYSQLI_ASSOC)){

$verificar2 = $row_verificar2['verificar'];
$resultado2 = $row_verificar2['resultado'];
}

$sql_verificar3 = "SELECT verificar, resultado FROM bi_recepcion_descargar_sellos WHERE id_recepcion_descarga = '".$id."'  AND verificar = 'Nivel del producto está a más de 1.5 cm (+/-0.3 cm)' ";
$result_verificar3 = mysqli_query($con, $sql_verificar3);
$numero_verificar3 = mysqli_num_rows($result_verificar3);
while($row_verificar3 = mysqli_fetch_array($result_verificar3, MYSQLI_ASSOC)){

$verificar3 = $row_verificar3['verificar'];
$resultado3 = $row_verificar3['resultado'];
}

$sql_tanque1 = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$id."' AND idlista = '1' ";
$result_tanque1 = mysqli_query($con, $sql_tanque1);
$numero_tanque1 = mysqli_num_rows($result_tanque1);
while($row_tanque1 = mysqli_fetch_array($result_tanque1, MYSQLI_ASSOC)){

$idtanque1 = DetalleTanque($row_tanque1['id_tanque'], $con);
$inventarioinicial1 = number_format($row_tanque1['inventario_inicial'],2);
$inventariofinal1 = number_format($row_tanque1['inventario_final'],2);
$aditivacion1 = $row_tanque1['aditivacion'];
}

$sql_tanque2 = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$id."' AND idlista = '2' ";
$result_tanque2 = mysqli_query($con, $sql_tanque2);
$numero_tanque2 = mysqli_num_rows($result_tanque2);
while($row_tanque2 = mysqli_fetch_array($result_tanque2, MYSQLI_ASSOC)){

$idtanque2 = DetalleTanque($row_tanque2['id_tanque'], $con);
$inventarioinicial2 = number_format($row_tanque2['inventario_inicial'],2);
$inventariofinal2 = number_format($row_tanque2['inventario_final'],2);
$aditivacion2 = $row_tanque2['aditivacion'];
}

$sql_tanque3 = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$id."' AND idlista = '3' ";
$result_tanque3 = mysqli_query($con, $sql_tanque3);
$numero_tanque3 = mysqli_num_rows($result_tanque3);
while($row_tanque3 = mysqli_fetch_array($result_tanque3, MYSQLI_ASSOC)){

$idtanque3 = DetalleTanque($row_tanque3['id_tanque'], $con);
$inventarioinicial3 = number_format($row_tanque3['inventario_inicial'],2);
$inventariofinal3 = number_format($row_tanque3['inventario_final'],2);
$aditivacion3 = $row_tanque3['aditivacion'];
}

$sql_tanque4 = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$id."' AND idlista = '4' ";
$result_tanque4 = mysqli_query($con, $sql_tanque4);
$numero_tanque4 = mysqli_num_rows($result_tanque4);
while($row_tanque4 = mysqli_fetch_array($result_tanque4, MYSQLI_ASSOC)){

$idtanque4 = DetalleTanque($row_tanque4['id_tanque'], $con);
$inventarioinicial4 = number_format($row_tanque4['inventario_inicial'],2);
$inventariofinal4 = number_format($row_tanque4['inventario_final'],2);
$aditivacion4 = $row_tanque4['aditivacion'];
}

$sql_merma = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$id."' ";
$result_merma = mysqli_query($con, $sql_merma);
$numero_merma = mysqli_num_rows($result_merma);
while($row_merma = mysqli_fetch_array($result_merma, MYSQLI_ASSOC)){
$TotalII = $TotalII + $row_merma['inventario_inicial'];
$TotalIF = $TotalIF + $row_merma['inventario_final'];
}

$sumacompra = $TotalII + $litroscompra;
$Merma = $TotalIF - $sumacompra;

//-----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------


        $contenid0 .= "<tr>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'><b>".$folio."</b></td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'>".$fecha."</td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'>".$horallegada."</td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'>".$horasalida."</td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'>".$tiempodescarga."</td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'>".$lineaTransporte."</td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'>".$noRemolque."</td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'>".$Placa."</td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'>".$Operador."</td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'>".$nofactura."</td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;'><b>".number_format($litroscompra,2)."</b></td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;background:$ColorTR;color:$colorP;'><b>".$producto."</b></td>";
        $contenid0 .= "</tr>";
        //------------------------------------------------------------------------------------------
        $contenid0 .= "<tr>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;' colspan='12' >";
        //----------------------------------------------------

        $contenid0 .= "<table style='text-align: center;border-collapse: collapse;font-family: Arial, Helvetica, sans-serif;width: 100%;'>";
        $contenid0 .= "<tr>";

        //--------------------------------------- td uno

        if ($idtanque1 == "" && $inventarioinicial1 == "" && $inventariofinal1 == "") {

        }else{

        $contenid0 .= "<td style='border: 1px solid #6F6F6F;vertical-align: text-top;'>";
        $contenid0 .= "<table style='font-family: Arial, Helvetica, sans-serif;width: 100%;font-size: 11px;'>";
        $contenid0 .= "<tr bgcolor='#F5F5F5'>";
        $contenid0 .= "<td ><b>No. Tanque</b></td>";
        $contenid0 .= "<td ><b>Inventario Inicial</b></td>";
        $contenid0 .= "<td ><b>Inventario Final</b></td>";
        $contenid0 .= "<td ><b>Aditivacón</b></td>";
        $contenid0 .= "</tr>";

        $contenid0 .= "<tr>";
        $contenid0 .= "<td ><b>".$idtanque1."</b></td>";
        $contenid0 .= "<td >".$inventarioinicial1."</td>";
        $contenid0 .= "<td >".$inventariofinal1."</td>";
        $contenid0 .= "<td >".$aditivacion1."</td>";
        $contenid0 .= "</tr>";

        if ($idtanque2 != "" && $inventarioinicial2 != "" && $inventariofinal2 != "") {

        $contenid0 .= "<tr>";
        $contenid0 .= "<td ><b>".$idtanque2."</b></td>";
        $contenid0 .= "<td >".$inventarioinicial2."</td>";
        $contenid0 .= "<td >".$inventariofinal2."</td>";
        $contenid0 .= "<td >".$aditivacion2."</td>";
        $contenid0 .= "</tr>";

       }

if ($idtanque3 != "" && $inventarioinicial3 != "" && $inventariofinal3 != "") {

        $contenid0 .= "<tr>";
        $contenid0 .= "<td ><b>".$idtanque3."</b></td>";
        $contenid0 .= "<td >".$inventarioinicial3."</td>";
        $contenid0 .= "<td >".$inventariofinal3."</td>";
        $contenid0 .= "<td >".$aditivacion3."</td>";
        $contenid0 .= "</tr>";

    }

if ($idtanque4 != "" && $inventarioinicial4 != "" && $inventariofinal4 != "") {
        $contenid0 .= "<tr>";
        $contenid0 .= "<td ><b>".$idtanque4."</b></td>";
        $contenid0 .= "<td >".$inventarioinicial4."</td>";
        $contenid0 .= "<td >".$inventariofinal4."</td>";
        $contenid0 .= "<td >".$aditivacion4."</td>";
        $contenid0 .= "</tr>";
}

        $contenid0 .= "<tr>";
        $contenid0 .= "<td colspan='3' style='padding: 5px;text-align: right;'>Merma: <b>".number_format($Merma,2)."</b></td>";
        $contenid0 .= "</tr>";

        $contenid0 .= "</table>";
        $contenid0 .= "</td>";
        
    }

       

        //------------------------ td dos

        $contenid0 .= "<td style='border: 1px solid #6F6F6F;vertical-align: text-top;'>";
        $contenid0 .= "<table style='font-family: Arial, Helvetica, sans-serif;width: 100%;font-size: 11px;'>
        <tr><td colspan='2' style='background:#F5F5F5;font-size: 11px;text-align: center;'><b>Sellos</b></td></tr>
        <tr><td>".$verificar1."</td><td><b>".$resultado1."</b></td></tr>
        <tr><td>".$verificar2."</td><td><b>".$resultado2."</b></td></tr>
        <tr><td colspan='2'><div style='border-bottom: 1px solid #E5E5E5;width: 100%;'></div></td></tr>
        <tr><td colspan='2'><b>No. Serie:</b> ".$sellonoserie."</td></tr></table>";
        $contenid0 .= "</td>";

        //----------------------- td tres

        $contenid0 .= "<td style='border: 1px solid #6F6F6F;vertical-align: text-top;'>";
        $contenid0 .= "<table style='font-family: Arial, Helvetica, sans-serif;width: 100%;font-size: 11px;'>
         <tr><td colspan='2' style='background:#F5F5F5;font-size: 11px;text-align: center;'><b>NICE</b></td></tr>
        <tr><td>".$verificar3."</td><td><b>".$resultado3."</b></td></tr>
        <tr><td colspan='2'><div style='border-bottom: 1px solid #E5E5E5;width: 100%;'></div></td></tr>
        <tr><td>Manometro</td><td><b>".$manometro."</b></td></tr>
        <tr><td>Temperatura</td><td><b>".$temperatura."</b></td></tr></table>";
        $contenid0 .= "</td>";

        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;vertical-align: text-top;'><div colspan='2' style='background:#F5F5F5;font-size: 11px;text-align: center;'><b>Observaciones</b></div>".$observaciones."</td>";

        //--------------------------------------

         $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;vertical-align: text-top;'>
        <div colspan='2' style='background:#F5F5F5;font-size: 11px;text-align: center;'><b>Persona que recibe</b></div>
        <div><img width='90px' src='".$baseFPR."'  alt='base' /></div>
        <div style='font-size: 10px;'>".$NombreRecibe."</div>
        </td>";
        $contenid0 .= "<td style='border: 1px solid #6F6F6F;font-size: 11px;vertical-align: text-top;'>
        <div colspan='2' style='background:#F5F5F5;font-size: 11px;text-align: center;'><b>Persona que superviso</b></div>
        <div><img width='90px' src='".$baseFPS."'  alt='base' /></div>
        <div style='font-size: 10px;'>".$NombreSupervisa."</div>
        </td>";

        $contenid0 .= "</tr>";
        $contenid0 .= "</table>";

        //----------------------------------------------------
        $contenid0 .= "</td>";
        $contenid0 .= "</tr>";
        //------------------------------------------------------------------------------------------

    $contenid0 .= "</table>";

    }

$contenid0 .= "</div>";
$contenid0 .= "</body>";
$contenid0 .= "</html>";

$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();



// Ponemos el PDF en el browser
$dompdf->stream('ReporteRecepcionDescargaProducto.pdf');

//------------------
mysqli_close($con);
//------------------
?>
