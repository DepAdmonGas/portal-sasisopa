<?php 
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
// Inicializamos dompdf
$dompdf = new Dompdf();
// Le pasamos el html a dompdf

//-------------------------------------------------------------------------------------------

function ContenidoEquipo1($Session_IDEstacion,$idequipo,$selyear,$selmes,$con){

$rutaFirma = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";
$rutaTirilla = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenTirilla/";

if ($selmes != "X") {
$BuscarMes = " AND MONTH (fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}

$imagentirilla = "";

if ($idequipo == 44) {
        $Titulo = "";
        }else{
        $Titulo = "Equipo:"; 
        }

        $resultado .= "<div style='border: 1px solid #DAD9D9;padding: 10px;margin-bottom: 20px;margin-top: 20px;font-family: Arial, Helvetica, sans-serif;'>";
        $resultado .= "<div style='padding-bottom: 10px;border-bottom: 1px solid #DAD9D9;'>";
        $resultado .= "<div style='font-size: 1.1em;'>".$Titulo." <b>".NombreEquipo($idequipo,$con)."</b></div>";
        $resultado .= "</div>";
       
        $resultado .= "<table class='table table-bordered table-sm mt-4' style='font-size: .7em;'>";
        $resultado .= "<thead>";
        $resultado .= "<tr>";
        $resultado .= "<th class='align-middle' width='65px'>Folio</th>";
        $resultado .= "<th class='align-middle' width='100px'>Fecha</th>";
        $resultado .= "<th class='align-middle' width='80px'>Hora</th>";  
        $resultado .= "<th class='align-middle' >Equipo y Resultado</th>";        
        $resultado .= "<th class='align-middle' width='200px'>Observaciones</th>";
        $resultado .= "<th class='align-middle' width='100px'>Trabajador que realiza la actividad</th>";
        $resultado .= "<th class='align-middle' width='100px'>Trabajador que supervisa la actividad</th>";
        $resultado .= "</tr>";
        $resultado .= "</thead>";
        $resultado .= "<tbody>";

        $sqlV = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = '".$Session_IDEstacion."' AND id_equipo = '".$idequipo."' AND YEAR(fechacreacion) = '".$selyear."' $BuscarMes AND estado >= 1 ORDER BY folio asc ";
        $resultV = mysqli_query($con, $sqlV);
        $numeroV = mysqli_num_rows($resultV);
        while($rowV = mysqli_fetch_array($resultV, MYSQLI_ASSOC)){
        $idverificar = $rowV['id'];
        $folio = FormatFolio($rowV['folio']);
        $FechaHoraObservaciones = FechaHoraObservaciones($idverificar,$con);

        if ($rowV['estado'] == 2) {
        $estado = "table-danger";
        }else{
        $estado = "";
        }

          $sql_imagen1 = "SELECT nombre,tipo_firma,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idverificar."'  AND tipo_firma = 'FPR' ";
        $result_imagen1 = mysqli_query($con, $sql_imagen1);
        $numero_imagen1 = mysqli_num_rows($result_imagen1);
        if ($numero_imagen1 > 0) {        
        while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){
             $DataFPR = file_get_contents($rutaFirma.$row_imagen1['imagen_firma']);
             $baseFPR = 'data:image/' . $type . ';base64,' . base64_encode($DataFPR);
        $NombreRecibe = $row_imagen1['nombre'];
        $FPR = "<img width='100px' src='".$baseFPR."' alt='base'>";
        }
        }else{
        $NombreRecibe = "";
        $FPR = "";  
        }
        

        $sql_imagen2 = "SELECT nombre,tipo_firma,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idverificar."'  AND tipo_firma = 'FPS' ";
        $result_imagen2 = mysqli_query($con, $sql_imagen2);
        $numero_imagen2 = mysqli_num_rows($result_imagen2);
        if ($numero_imagen2 > 0) {
        while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
        $DataFPS = file_get_contents($rutaFirma.$row_imagen2['imagen_firma']);
        $baseFPS = 'data:image/' . $type . ';base64,' . base64_encode($DataFPS);
        $NombreResponsable = $row_imagen2['nombre'];
        $FPS = "<img width='100px' src='".$baseFPS."' alt='base'>";
        }
        }else{
        $NombreResponsable = "";
        $FPS = "";
        }      

        $sql_tirilla = "SELECT * FROM po_mantenimiento_verificar_tirilla_inventario WHERE id_verificar = '".$idverificar."' ";
        $result_tirilla = mysqli_query($con, $sql_tirilla);
        $numero_tirilla = mysqli_num_rows($result_tirilla);    
        if ($numero_tirilla > 0) {     
        while($row_tirilla = mysqli_fetch_array($result_tirilla, MYSQLI_ASSOC)){
        $DataTirilla = file_get_contents($rutaTirilla.$row_tirilla['imagen_tirilla']);
        $imagentirilla = 'data:image/' . $type . ';base64,' . base64_encode($DataTirilla);
        }
        }else{
        $imagentirilla = ""; 
        }

       $resultado .= "<tr>";
        $resultado .= "<td class='align-middle text-center ".$estado."'><b>".$folio."</b></td>";
        $resultado .= "<td class='align-middle text-center ".$estado."'>".$FechaHoraObservaciones['fechafin']."</td>";  
        $resultado .= "<td class='align-middle text-center ".$estado."'>".$FechaHoraObservaciones['horafin']."</td>"; 

        $resultado .= "<td class='".$estado."' style='vertical-align: text-top;'>"; 
        $resultado .= "<div>";
        $resultado .= "<table class='table table-bordered table-sm'>";

        $sqlD = "SELECT * FROM po_mantenimiento_verificar_detalle WHERE id_verificar = '".$idverificar."'";
        $resultD = mysqli_query($con, $sqlD);
        $numeroD = mysqli_num_rows($resultD);
        while($rowD = mysqli_fetch_array($resultD, MYSQLI_ASSOC)){
        $resultado .= "<tr ".$estado.">";
        $resultado .= "<td class='".$estado."' style='text-align: center;vertical-align: text-top;'>".NombreVerificar($rowD['id_detalle'], $con)."</td>";
        $resultado .= "<td class='".$estado."' style='text-align: center;vertical-align: text-top;'>".$rowD['resultado']."</td>";        
        $resultado .= "</tr>"; 
        }
        
        $resultado .= "</table>";
        $resultado .= "</div>";


        if($idequipo == 46){

            $resultado .= "<table class='table table-bordered table-sm p-0 m-0'>";
            $resultado .= "<tr>";
            $resultado .= "<th class='align-middle text-center'>Fecha</th>";
            $resultado .= "<th class='align-middle text-center'>Hora inicio</th>";
            $resultado .= "<th class='align-middle text-center'>Hora termino</th>";
            $resultado .= "<th class='align-middle text-center'>Tanque</th>";
            $resultado .= "<th class='align-middle text-center'>Producto</th>";
            $resultado .= "<th class='align-middle text-center'>Resultado</th>";
            $resultado .= "</tr>";
            $sql_detalle = "SELECT * FROM po_mantenimiento_prueba_hermeticidad WHERE id_verificar = '".$idverificar."' ";
            $result_detalle = mysqli_query($con, $sql_detalle);
            $numero_detalle = mysqli_num_rows($result_detalle);         
            while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){

            $Tanque = Tanque($row_detalle['id_tanque'],$con);

            $resultado .= "<tr>";
            $resultado .= "<td class='align-middle'>".$row_detalle['fecha']."</td>";
            $resultado .= "<td class='align-middle'>".$row_detalle['hora_inicio']."</td>";
            $resultado .= "<td class='align-middle'>".$row_detalle['hora_termino']."</td>";
            $resultado .= "<td class='align-middle text-center'>".$Tanque['notanque']."</td>";
            $resultado .= "<td class='align-middle'>".$Tanque['producto']."</td>";
            $resultado .= "<td class='align-middle'>".$row_detalle['resultado']."</td>";
            $resultado .= "</tr>";

            }
            $resultado .= "</table>";
        }

        $resultado .= "</td>"; 

        $resultado .= "<td class='align-middle text-center ".$estado."'>".$FechaHoraObservaciones['observaciones']."</td>"; 
        $resultado .= "<td class='align-middle text-center' width='120px'>".$FPR."<div style='font-size: .8em'><small>".$NombreRecibe."</small></div></td>";
        $resultado .= "<td class='align-middle text-center' width='120px'>".$FPS."<div style='font-size: .8em'><small>".$NombreResponsable."</small></div></td>"; 

        $resultado .= "</tr>";  

//-----------------------------------------------------------------------------

$sql_evidencia = "SELECT * FROM po_mantenimiento_verificar_evidencias WHERE id_mantenimiento = '".$idverificar."'";
$result_evidencia = mysqli_query($con, $sql_evidencia);
$numero_evidencia = mysqli_num_rows($result_evidencia);
if ($numero_evidencia > 0) {
$resultado .= "<tr style='font-size: 10px;'>";
$resultado .= "<td colspan='7'>";
$resultado .= "<div style='margin-top: 10px;'><small><b>Evidencias:</b></small></div>";
$resultado .= "<div style='margin-top: 10px;'>";
while($row_evidencia = mysqli_fetch_array($result_evidencia, MYSQLI_ASSOC)){
$url = $row_evidencia['url'];

$Evidencia = file_get_contents($url);
$baseEvidencia = 'data:image/' . $type . ';base64,' . base64_encode($Evidencia);
$resultado .= "<img style='width: 335px;height: 335px;padding: 5px;' src='".$baseEvidencia."' />";

}
$resultado .= "</div>";
$resultado .= "</td>";
$resultado .= "</tr>";
}
//--------------------------------------------------------------------------------------

}        

        $resultado .= "</tbody>";
        $resultado .= "</table>";

        $resultado .= "</div>";

return $resultado;
}

//--------------------------------------------------------------------------------------------------------------------

function ContenidoEquipo2($Session_IDEstacion,$idequipo,$selyear,$selmes,$con){

$rutaFirma = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";
$rutaTirilla = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenTirilla/";

if ($selmes != "X") {
$BuscarMes = " AND MONTH (fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}

        $resultado .= "<div style='border: 1px solid #DAD9D9;padding: 10px;margin-bottom: 20px;margin-top: 20px;font-family: Arial, Helvetica, sans-serif;'>";
        $resultado .= "<div style='padding-bottom: 10px;border-bottom: 1px solid #DAD9D9;'>";
        $resultado .= "<div style='font-size: 1.1em;'>Equipo: <b>".NombreEquipo($idequipo,$con)."</b></div>";
        $resultado .= "</div>";
       
        $resultado .= "<table class='table table-bordered table-sm' style='font-size: .7em;'>";
        $resultado .= "<thead>";
        $resultado .= "<tr>";
        $resultado .= "<th class='align-middle' width='65px'>Folio</th>";
        $resultado .= "<th class='align-middle' width='100px'>Fecha</th>";
        $resultado .= "<th class='align-middle' width='80px'>Hora</th>";  
        $resultado .= "<th class='align-middle' >Equipo y Resultado</th>";         
        $resultado .= "<th class='align-middle' width='200px'>Observaciones</th>";
        $resultado .= "<th class='align-middle' width='100px'>Trabajador que realiza la actividad</th>";
        $resultado .= "<th class='align-middle' width='100px'>Trabajador que supervisa la actividad</th>";
        $resultado .= "</tr>";
        $resultado .= "</thead>";
        $resultado .= "<tbody>";

        $sqlV = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = '".$Session_IDEstacion."' AND id_equipo = '".$idequipo."' AND YEAR(fechacreacion) = '".$selyear."' $BuscarMes AND estado >= 1 ORDER BY folio asc ";
        $resultV = mysqli_query($con, $sqlV);
        $numeroV = mysqli_num_rows($resultV);
        while($rowV = mysqli_fetch_array($resultV, MYSQLI_ASSOC)){
        $idverificar = $rowV['id'];
        $folio = FormatFolio($rowV['folio']);
        $FechaHoraObservaciones = FechaHoraObservaciones($idverificar,$con);

        if ($rowV['estado'] == 2) {
        $estado = "table-danger";
        }else{
        $estado = "";
        }

          $sql_imagen1 = "SELECT nombre,tipo_firma,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idverificar."'  AND tipo_firma = 'FPR' ";
        $result_imagen1 = mysqli_query($con, $sql_imagen1);
        $numero_imagen1 = mysqli_num_rows($result_imagen1);
        if ($numero_imagen1 > 0) {        
        while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){
             $DataFPR = file_get_contents($rutaFirma.$row_imagen1['imagen_firma']);
             $baseFPR = 'data:image/' . $type . ';base64,' . base64_encode($DataFPR);
        $NombreRecibe = $row_imagen1['nombre'];
        $FPR = "<img width='100px' src='".$baseFPR."' alt='base'>";
        }
        }else{
        $NombreRecibe = "";
        $FPR = "";  
        }
        

        $sql_imagen2 = "SELECT nombre,tipo_firma,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idverificar."'  AND tipo_firma = 'FPS' ";
        $result_imagen2 = mysqli_query($con, $sql_imagen2);
        $numero_imagen2 = mysqli_num_rows($result_imagen2);
        if ($numero_imagen2 > 0) {
        while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
        $DataFPS = file_get_contents($rutaFirma.$row_imagen2['imagen_firma']);
        $baseFPS = 'data:image/' . $type . ';base64,' . base64_encode($DataFPS);
        $NombreResponsable = $row_imagen2['nombre'];
        $FPS = "<img width='100px' src='".$baseFPS."' alt='base'>";
        }
        }else{
        $NombreResponsable = "";
        $FPS = "";
        }      

        $resultado .= "<tr>";
        $resultado .= "<td class='align-middle text-center ".$estado."'><b>".$folio."</b></td>";
        $resultado .= "<td class='align-middle text-center ".$estado."'>".$FechaHoraObservaciones['fechafin']."</td>";  
        $resultado .= "<td class='align-middle text-center ".$estado."'>".$FechaHoraObservaciones['horafin']."</td>"; 

        $resultado .= "<td class='".$estado."'>"; 
        $resultado .= "<div>";
        $resultado .= "<table class='table table-bordered table-sm ".$estado."'>";

        $resultado .= DetalleSublista($idverificar,$idequipo,$estado,$con);
        
        $resultado .= "</table>";
        $resultado .= "</div>";
        $resultado .= "</td>"; 

        $resultado .= "<td class='align-middle text-center ".$estado."'>".$FechaHoraObservaciones['observaciones']."</td>"; 
        $resultado .= "<td class='align-middle text-center' width='120px'>".$FPR."<div style='font-size: .7em'><small>".$NombreRecibe."</small></div></td>";
        $resultado .= "<td class='align-middle text-center' width='120px'>".$FPS."<div style='font-size: .7em'><small>".$NombreResponsable."</small></div></td>"; 

        $resultado .= "</tr>";  

//-----------------------------------------------------------------------------
$sql_evidencia = "SELECT * FROM po_mantenimiento_verificar_evidencias WHERE id_mantenimiento = '".$idverificar."'";
$result_evidencia = mysqli_query($con, $sql_evidencia);
$numero_evidencia = mysqli_num_rows($result_evidencia);
if ($numero_evidencia > 0) {
$resultado .= "<tr style='font-size: 10px;'>";
$resultado .= "<td colspan='7'>";
$resultado .= "<div style='margin-top: 10px;'><small><b>Evidencias:</b></small></div>";
$resultado .= "<div style='margin-top: 10px;'>";
while($row_evidencia = mysqli_fetch_array($result_evidencia, MYSQLI_ASSOC)){
$url = $row_evidencia['url'];
$Evidencia = file_get_contents($url);
$baseEvidencia = 'data:image/' . $type . ';base64,' . base64_encode($Evidencia);
$resultado .= "<img style='width: 335px;height: 335px;padding: 5px;' src='".$baseEvidencia."' />";
}
$resultado .= "</div>";
$resultado .= "</td>";
$resultado .= "</tr>"; 
}

//--------------------------------------------------------------------------------------
}  
          

        $resultado .= "</tbody>";
        $resultado .= "</table>";

        $resultado .= "</div>";

        return $resultado;
}

//--------------------------------------------------------------------------------------------------------------------

function ContenidoEquipo3($Session_IDEstacion,$idequipo,$selyear,$selmes,$con){

$rutaFirma = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";

if ($selmes != "X") {
$BuscarMes = " AND MONTH (fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}


        $resultado .= "<div style='border: 1px solid #DAD9D9;padding: 10px;margin-bottom: 20px;margin-top: 20px;font-family: Arial, Helvetica, sans-serif;'>";
        $resultado .= "<div style='padding-bottom: 10px;border-bottom: 1px solid #DAD9D9;'>";
        $resultado .= "<div style='font-size: 1.1em;'>Equipo: <b>".NombreEquipo($idequipo,$con)."</b></div>";
        $resultado .= "</div>";

        $sqlV = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = '".$Session_IDEstacion."' AND id_equipo = '".$idequipo."' AND YEAR(fechacreacion) = '".$selyear."' $BuscarMes AND estado >= 1 ORDER BY folio asc ";
        $resultV = mysqli_query($con, $sqlV);
        $numeroV = mysqli_num_rows($resultV);
        while($rowV = mysqli_fetch_array($resultV, MYSQLI_ASSOC)){
        $idverificar = $rowV['id'];
        $folio = FormatFolio($rowV['folio']);
        $FechaHoraObservaciones = FechaHoraObservaciones($idverificar,$con);

        if ($rowV['estado'] == 2) {
        $estado = "table-danger";
        }else{
        $estado = "";
        }

          $sql_imagen1 = "SELECT nombre,tipo_firma,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idverificar."'  AND tipo_firma = 'FPR' ";
        $result_imagen1 = mysqli_query($con, $sql_imagen1);
        $numero_imagen1 = mysqli_num_rows($result_imagen1);
        if ($numero_imagen1 > 0) {        
        while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){
             $DataFPR = file_get_contents($rutaFirma.$row_imagen1['imagen_firma']);
             $baseFPR = 'data:image/' . $type . ';base64,' . base64_encode($DataFPR);
        $NombreRecibe = $row_imagen1['nombre'];
        $FPR = "<img width='100px' src='".$baseFPR."' alt='base'>";
        }
        }else{
        $NombreRecibe = "";
        $FPR = "";  
        }
        

        $sql_imagen2 = "SELECT nombre,tipo_firma,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idverificar."'  AND tipo_firma = 'FPS' ";
        $result_imagen2 = mysqli_query($con, $sql_imagen2);
        $numero_imagen2 = mysqli_num_rows($result_imagen2);
        if ($numero_imagen2 > 0) {
        while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
        $DataFPS = file_get_contents($rutaFirma.$row_imagen2['imagen_firma']);
        $baseFPS = 'data:image/' . $type . ';base64,' . base64_encode($DataFPS);
        $NombreResponsable = $row_imagen2['nombre'];
        $FPS = "<img width='100px' src='".$baseFPS."' alt='base'>";
        }
        }else{
        $NombreResponsable = "";
        $FPS = "";
        }      

        $resultado .= "<table class='table table-bordered table-sm' style='font-size: .7em;'>";
        $resultado .= "<tr>";
        $resultado .= "<td class='align-middle text-center ".$estado."'>Folio: <b>".$folio."</b></td>";
        $resultado .= "<td class='align-middle text-center ".$estado."'>Fecha: <b>".$FechaHoraObservaciones['fechafin']."</b></td>";
        $resultado .= "<td class='align-middle text-center ".$estado."'>Hora: <b>".$FechaHoraObservaciones['horafin']."</b></td>";
        $resultado .= "<td class='align-middle text-center'>
        <b>Trabajador que realiza la actividad</b> <div>".$FPR."</div>
        <div style='font-size: .6em'><small>".$NombreRecibe."</small></div></td>";
        $resultado .= "<td class='align-middle text-center'><b>Trabajador que supervisa la actividad</b> <div>".$FPS."</div><div style='font-size: .6em'><small>".$NombreResponsable."</small></div></td>"; 
        $resultado .= "</tr>";
        $resultado .= "</table>";

        $resultado .= "<table class='table table-bordered table-sm' style='font-size: .7em;'>";
        $resultado .= "<thead>";
        $resultado .= "<tr>";
        $resultado .= "<th class='align-middle text-center ".$estado."'>No. De extintor</th>";
        $resultado .= "<th class='align-middle text-center ".$estado."'>Ubicación</th>";
        $resultado .= "<th class='align-middle text-center ".$estado."'>Fecha de ultima recarga</th>";  
        $resultado .= "<th class='align-middle text-center ".$estado."'>Tipo de Extintor</th>";   
        $resultado .= "<th class='align-middle text-center ".$estado."'>Peso Kg</th>";
        $resultado .= "<th class='align-middle text-center ".$estado."'>Manómetro</th>";        
        $resultado .= "<th class='align-middle text-center ".$estado."'>Boquilla de descarga</th>";
        $resultado .= "<th class='align-middle text-center ".$estado."'>Manguera</th>";
        $resultado .= "<th class='align-middle text-center ".$estado."'>Funcionalidad</th>";
        $resultado .= "<th class='align-middle text-center ".$estado."'>Observaciones</th>";
        $resultado .= "</tr>";
        $resultado .= "</thead>";
        $resultado .= "<tbody>";

            $sql_detalle = "SELECT * FROM po_extintores_estacion_detalle WHERE id_verificar = '".$idverificar."' ";
            $result_detalle = mysqli_query($con, $sql_detalle);
            $numero_detalle = mysqli_num_rows($result_detalle);         
            while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){

            $DetalleExtintor = DetalleExtintor($row_detalle['id_extintor'],$con);

            $resultado .= "<tr>";
            $resultado .= "<td class='align-middle text-center ".$estado."'><b>".$DetalleExtintor['noextintor']."</b></td>";
            $resultado .= "<td class='align-middle text-center ".$estado."'>".$DetalleExtintor['ubicacion']."</td>";            
            $resultado .= "<td class='align-middle text-center ".$estado."'>".FormatoFecha($row_detalle['ultima_recarga'])."</td>";
            $resultado .= "<td class='align-middle text-center ".$estado."'>".$DetalleExtintor['tipoextintor']."</td>";
            $resultado .= "<td class='align-middle text-center ".$estado."'>".$DetalleExtintor['pesokg']."</td>";
            $resultado .= "<td class='align-middle text-center ".$estado."'>".$row_detalle['manometro']."</td>";
            $resultado .= "<td class='align-middle text-center ".$estado."'>".$row_detalle['boquilla_descarga']."</td>";
            $resultado .= "<td class='align-middle text-center ".$estado."'>".$row_detalle['manguera']."</td>";
            $resultado .= "<td class='align-middle text-center ".$estado."'>".$row_detalle['funcionalidad']."</td>";
            $resultado .= "<td class='align-middle text-center ".$estado."'>".$row_detalle['observaciones']."</td>";
            $resultado .= "</tr>";

            }
          
//-----------------------------------------------------------------------------
$sql_evidencia = "SELECT * FROM po_mantenimiento_verificar_evidencias WHERE id_mantenimiento = '".$idverificar."'";
$result_evidencia = mysqli_query($con, $sql_evidencia);
$numero_evidencia = mysqli_num_rows($result_evidencia);
if ($numero_evidencia > 0) {
$resultado .= "<tr style='font-size: 10px;'>";
$resultado .= "<td colspan='7'>";
$resultado .= "<div style='margin-top: 10px;'><small><b>Evidencias:</b></small></div>";
$resultado .= "<div style='margin-top: 10px;'>";
while($row_evidencia = mysqli_fetch_array($result_evidencia, MYSQLI_ASSOC)){
$url = $row_evidencia['url'];
$Evidencia = file_get_contents($url);
$baseEvidencia = 'data:image/' . $type . ';base64,' . base64_encode($Evidencia);
$resultado .= "<img style='width: 335px;height: 335px;padding: 5px;' src='".$baseEvidencia."' />";
}
$resultado .= "</div>";
$resultado .= "</td>";
$resultado .= "</tr>";  
}

//--------------------------------------------------------------------------------------
        $resultado .= "</tbody>";
        $resultado .= "</table>";

        }
       
        $resultado .= "</div>";

        return $resultado;

}

//-------------------------------------------------------------------------------------------

function ContenidoEquipo4($Session_IDEstacion,$idequipo,$selyear,$selmes,$con){

$rutaFirma = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";
$rutaTirilla = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenTirilla/";

if ($selmes != "X") {
$BuscarMes = " AND MONTH (fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}

$imagentirilla = "";

if ($idequipo == 44) {
        $Titulo = "";
        }else{
        $Titulo = "Equipo:"; 
        }

        $resultado .= "<div style='border: 1px solid #DAD9D9;padding: 10px;margin-bottom: 20px;margin-top: 20px;font-family: Arial, Helvetica, sans-serif;'>";
        $resultado .= "<div style='padding-bottom: 10px;border-bottom: 1px solid #DAD9D9;'>";
        $resultado .= "<div style='font-size: 1.1em;'>".$Titulo." <b>".NombreEquipo($idequipo,$con)."</b></div>";
        $resultado .= "</div>";
       
        $resultado .= "<table class='table table-bordered table-sm mt-4' style='font-size: .7em;'>";
        $resultado .= "<thead>";
        $resultado .= "<tr>";
        $resultado .= "<th class='align-middle' width='65px'>Folio</th>";
        $resultado .= "<th class='align-middle' width='100px'>Fecha</th>";
        $resultado .= "<th class='align-middle' width='80px'>Hora</th>";  
        $resultado .= "<th class='align-middle' >Equipo y Resultado</th>";        
        $resultado .= "<th class='align-middle' width='200px'>Observaciones</th>";
        $resultado .= "<th class='align-middle' width='100px'>Trabajador que realiza la actividad</th>";
        $resultado .= "<th class='align-middle' width='100px'>Trabajador que supervisa la actividad</th>";
        $resultado .= "</tr>";
        $resultado .= "</thead>";
        $resultado .= "<tbody>";

        $sqlV = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = '".$Session_IDEstacion."' AND id_equipo = '".$idequipo."' AND YEAR(fechacreacion) = '".$selyear."' $BuscarMes AND estado >= 1 ORDER BY folio asc ";
        $resultV = mysqli_query($con, $sqlV);
        $numeroV = mysqli_num_rows($resultV);
        while($rowV = mysqli_fetch_array($resultV, MYSQLI_ASSOC)){
        $idverificar = $rowV['id'];
        $folio = FormatFolio($rowV['folio']);
        $FechaHoraObservaciones = FechaHoraObservaciones($idverificar,$con);

        if ($rowV['estado'] == 2) {
        $estado = "table-danger";
        }else{
        $estado = "";
        }

          $sql_imagen1 = "SELECT nombre,tipo_firma,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idverificar."'  AND tipo_firma = 'FPR' ";
        $result_imagen1 = mysqli_query($con, $sql_imagen1);
        $numero_imagen1 = mysqli_num_rows($result_imagen1);
        if ($numero_imagen1 > 0) {        
        while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){
             $DataFPR = file_get_contents($rutaFirma.$row_imagen1['imagen_firma']);
             $baseFPR = 'data:image/' . $type . ';base64,' . base64_encode($DataFPR);
        $NombreRecibe = $row_imagen1['nombre'];
        $FPR = "<img width='100px' src='".$baseFPR."' alt='base'>";
        }
        }else{
        $NombreRecibe = "";
        $FPR = "";  
        }
        

        $sql_imagen2 = "SELECT nombre,tipo_firma,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idverificar."'  AND tipo_firma = 'FPS' ";
        $result_imagen2 = mysqli_query($con, $sql_imagen2);
        $numero_imagen2 = mysqli_num_rows($result_imagen2);
        if ($numero_imagen2 > 0) {
        while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
        $DataFPS = file_get_contents($rutaFirma.$row_imagen2['imagen_firma']);
        $baseFPS = 'data:image/' . $type . ';base64,' . base64_encode($DataFPS);
        $NombreResponsable = $row_imagen2['nombre'];
        $FPS = "<img width='100px' src='".$baseFPS."' alt='base'>";
        }
        }else{
        $NombreResponsable = "";
        $FPS = "";
        }      

        $sql_tirilla = "SELECT * FROM po_mantenimiento_verificar_tirilla_inventario WHERE id_verificar = '".$idverificar."' ";
        $result_tirilla = mysqli_query($con, $sql_tirilla);
        $numero_tirilla = mysqli_num_rows($result_tirilla);    
        if ($numero_tirilla > 0) {     
        while($row_tirilla = mysqli_fetch_array($result_tirilla, MYSQLI_ASSOC)){
        $DataTirilla = file_get_contents($rutaTirilla.$row_tirilla['imagen_tirilla']);
        $imagentirilla = 'data:image/' . $type . ';base64,' . base64_encode($DataTirilla);
        }
        }else{
        $imagentirilla = ""; 
        }

       $resultado .= "<tr>";
        $resultado .= "<td class='align-middle text-center ".$estado."'><b>".$folio."</b></td>";
        $resultado .= "<td class='align-middle text-center ".$estado."'>".$FechaHoraObservaciones['fechafin']."</td>";  
        $resultado .= "<td class='align-middle text-center ".$estado."'>".$FechaHoraObservaciones['horafin']."</td>"; 

        $resultado .= "<td class='".$estado."' style='vertical-align: text-top;'>"; 
        $resultado .= "<div>";
        $resultado .= "<table class='table table-bordered table-sm'>";

        $sqlD = "SELECT * FROM po_mantenimiento_verificar_tanque WHERE id_verificar = '".$idverificar."'";
        $resultD = mysqli_query($con, $sqlD);
        $numeroD = mysqli_num_rows($resultD);
        while($rowD = mysqli_fetch_array($resultD, MYSQLI_ASSOC)){
        $resultado .= "<tr ".$estado.">";
        $resultado .= "<td class='".$estado."' style='text-align: center;vertical-align: text-top;'>".$rowD['detalle']."</td>";
        $resultado .= "<td class='".$estado."' style='text-align: center;vertical-align: text-top;'>".$rowD['resultado']."</td>";        
        $resultado .= "</tr>"; 
        }
        
        $resultado .= "</table>";
        $resultado .= "</div>";
        $resultado .= "</td>"; 

        $resultado .= "<td class='align-middle text-center ".$estado."'>".$FechaHoraObservaciones['observaciones']."</td>"; 
        $resultado .= "<td class='align-middle text-center' width='120px'>".$FPR."<div style='font-size: .8em'><small>".$NombreRecibe."</small></div></td>";
        $resultado .= "<td class='align-middle text-center' width='120px'>".$FPS."<div style='font-size: .8em'><small>".$NombreResponsable."</small></div></td>"; 

        $resultado .= "</tr>";  

//-----------------------------------------------------------------------------

$sql_evidencia = "SELECT * FROM po_mantenimiento_verificar_evidencias WHERE id_mantenimiento = '".$idverificar."'";
$result_evidencia = mysqli_query($con, $sql_evidencia);
$numero_evidencia = mysqli_num_rows($result_evidencia);
if ($numero_evidencia > 0) {
$resultado .= "<tr style='font-size: 10px;'>";
$resultado .= "<td colspan='7'>";
$resultado .= "<div style='margin-top: 10px;'><small><b>Evidencias:</b></small></div>";
$resultado .= "<div style='margin-top: 10px;'>";
while($row_evidencia = mysqli_fetch_array($result_evidencia, MYSQLI_ASSOC)){
$url = $row_evidencia['url'];

$Evidencia = file_get_contents($url);
$baseEvidencia = 'data:image/' . $type . ';base64,' . base64_encode($Evidencia);
$resultado .= "<img style='width: 300px;height: 300px;padding: 5px;' src='".$baseEvidencia."' />";

}
$resultado .= "</div>";
$resultado .= "</td>";
$resultado .= "</tr>";
}
//--------------------------------------------------------------------------------------

}        

        $resultado .= "</tbody>";
        $resultado .= "</table>";

        $resultado .= "</div>";

return $resultado;
}
//--------------------------------------------------------------------------------------------------------------------

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

    function FechaHoraObservaciones($id,$con){
    $sql_equipo = "SELECT * FROM po_mantenimiento_verificar_fechafin WHERE id_verificar = '".$id."' ";
    $result_equipo = mysqli_query($con, $sql_equipo);
    $numero_equipo = mysqli_num_rows($result_equipo);
    while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
    $fechafin = FormatoFecha($row_equipo['fechafin']);
    $horafin = date("g:i a",strtotime($row_equipo['horafin']));
    $observaciones = $row_equipo['observaciones'];
    }   

    $arrayName = array(
    'fechafin' => $fechafin,
    'horafin' => $horafin,
    'observaciones' => $observaciones );
    return $arrayName;
    }

    function NombreVerificar($iddetalle, $con){
    $sql_detalle = "SELECT detalle FROM po_mantenimiento_detalle WHERE id = '".$iddetalle."' ";
    $result_detalle = mysqli_query($con, $sql_detalle);
    $numero_detalle = mysqli_num_rows($result_detalle);
    while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
    $detalle = $row_detalle['detalle'];
    }
    return $detalle;
    }

 function NombreUsuario($idUsuario, $con){

        $sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$idUsuario."' ";
        $result_usuario = mysqli_query($con, $sql_usuario);
        while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
        $nomencargado = $row_usuario['nombre'];
        }

        return $nomencargado;

       }

        function DetalleSublista($idMantenimiento,$idequipo,$estado,$con){

       $sql_detalle = "SELECT id_lista,id_sublista FROM po_mantenimiento_detalle WHERE id_lista = '".$idequipo."' GROUP BY id_sublista ";
        $result_detalle = mysqli_query($con, $sql_detalle);
        $numero_detalle = mysqli_num_rows($result_detalle);
        while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){

        $idsublista = $row_detalle['id_sublista'];

        $sql_nomSub = "SELECT detalle FROM po_mantenimiento_sub_lista WHERE id = '".$idsublista."' ";
        $result_nomSub = mysqli_query($con, $sql_nomSub);
        $numero_nomSub = mysqli_num_rows($result_nomSub);
        while($row_nomSub = mysqli_fetch_array($result_nomSub, MYSQLI_ASSOC)){
    
        $resultado .= "<tr class='".$estado."'>";
        $resultado .= "<td class='text-center' colspan='2'><b>".$row_nomSub['detalle']."</b></td>";
        $resultado .= "</tr>";

        $sql_DM = "SELECT * FROM po_mantenimiento_detalle WHERE id_lista = '".$idequipo."' AND id_sublista = '".$idsublista."' ";
    $result_DM = mysqli_query($con, $sql_DM);
    $numero_DM = mysqli_num_rows($result_DM);
    while($row_DM = mysqli_fetch_array($result_DM, MYSQLI_ASSOC)){

    $resultado .= "<tr class='".$estado."'>";
    $resultado .= "<td class='align-middle'>".$row_DM['detalle']."</td>";
    $resultado .= "<td class='align-middle text-center font-weight-bold'>".ResultadoVerificacion($idMantenimiento,$row_DM['id'],$con)."</td>";
    $resultado .= "</tr>";

    }

        }

        }

        return $resultado;

    }

    function ResultadoVerificacion($idMantenimiento,$idDetalle,$con){

            $sql_detalle = "SELECT * FROM po_mantenimiento_verificar_detalle WHERE id_verificar = '".$idMantenimiento."' AND id_detalle = '".$idDetalle."' ";
            $result_detalle = mysqli_query($con, $sql_detalle);
            $numero_detalle = mysqli_num_rows($result_detalle);         
            while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
        
            if ($row_detalle['resultado'] == "") {
            $TxtResultado = "X";
            }else{
            $TxtResultado = $row_detalle['resultado'];
            }
            
            } 

            return $TxtResultado;

    }

    function DetalleExtintor($id,$con){

        $sql_detalle = "SELECT * FROM po_extintores_estacion WHERE id = '".$id."' ";
            $result_detalle = mysqli_query($con, $sql_detalle);
            $numero_detalle = mysqli_num_rows($result_detalle);         
            while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
            $noextintor = $row_detalle['no_extintor'];
            $ubicacion = $row_detalle['ubicacion'];
            $tipoextintor = $row_detalle['tipo_extintor'];
            $pesokg = $row_detalle['peso_kg'];
            }

            $arrayName = array(
            'noextintor' => $noextintor,
            "ubicacion" => $ubicacion,
            "tipoextintor" => $tipoextintor,
            "pesokg" => $pesokg);

            return $arrayName;
    }

    function Tanque($idTanque,$con){

    $sql_detalle = "SELECT no_tanque, producto FROM tb_tanque_almacenamiento WHERE id = '".$idTanque."' ";
    $result_detalle = mysqli_query($con, $sql_detalle);
    $numero_detalle = mysqli_num_rows($result_detalle);         
    while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
    $notanque = $row_detalle['no_tanque'];
    $producto = $row_detalle['producto'];
    }

    $array = array('notanque' => $notanque, 'producto' => $producto);
    return $array;

    }

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Reporte de Mantenimiento Preventivo</title>";
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

article, aside, dialog, figcaption, figure, footer, header, hgroup, main, nav, section {
  display: block;
}
body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
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

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}
.table-sm th,
.table-sm td {
  padding: 0.3rem;
}
.align-middle {
  vertical-align: middle !important;
}
small {
  font-size: 80%;
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
.table-danger,
.table-danger > th,
.table-danger > td {
  background-color: #f5c6cb;
}
</style>';
    $contenid0 .= "</head>";
    $contenid0 .= "<body>";

    $RutaLogo = RUTA_IMG_LOGOS."Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/png;base64,' . base64_encode($DataLogo);

    $contenid0 .= "<div class='text-center'><img src='".$baseLogo."' style='width: 300px;'></div>";    
    $contenid0 .= "<div class='text-center'><b>Mantenimiento Preventivo</b></div>";
    $contenid0 .= "<div class='text-center'><b>".$Session_Permisocre."</b></div>";
    $contenid0 .= "<div class='text-center'>".$Session_Razonsocial."</div>";
    $contenid0 .= "<div class='text-center'><small>".$Session_Direccion."</small></div>";
    $contenid0 .= "<div class='text-center'><small>Código: DLES/SA/002</small></div>";

if ($Selectequipo != "X" && $selyear != "X") {

if ($Selectequipo == 2 || $Selectequipo == 20 || $Selectequipo == 33 || $Selectequipo == 42 || $Selectequipo == 43) {

if($Selectequipo == 2 || $Selectequipo == 33 || $Selectequipo == 42){
$contenid0 .= ContenidoEquipo2($Session_IDEstacion,$Selectequipo,$selyear,$selmes,$con);   
}else if($Selectequipo == 20){
$contenid0 .= ContenidoEquipo3($Session_IDEstacion,$Selectequipo,$selyear,$selmes,$con);   
}else if($Selectequipo == 43){
$contenid0 .= ContenidoEquipo4($Session_IDEstacion,$Selectequipo,$selyear,$selmes,$con);   
}

}else{
$contenid0 .= ContenidoEquipo1($Session_IDEstacion,$Selectequipo,$selyear,$selmes,$con);
}

}else if($Selectequipo == "X" && $selyear != "X"){

if ($selmes != "X") {
$BuscarMes = " AND MONTH (po_mantenimiento_verificar.fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}

$int = 1;
$sqlV = "SELECT 
po_mantenimiento_verificar.id, 
po_mantenimiento_verificar.folio,
po_mantenimiento_verificar.id_estacion,
po_mantenimiento_verificar.id_equipo,
po_mantenimiento_verificar.fechacreacion,
po_mantenimiento_verificar.estado,
po_mantenimiento_lista.id as idEquipo,
po_mantenimiento_lista.num_lista
FROM po_mantenimiento_verificar
INNER JOIN po_mantenimiento_lista ON po_mantenimiento_verificar.id_equipo = po_mantenimiento_lista.id
WHERE po_mantenimiento_verificar.id_estacion = '".$Session_IDEstacion."' AND 
YEAR(po_mantenimiento_verificar.fechacreacion) = '".$selyear."' $BuscarMes AND 
po_mantenimiento_verificar.estado >= 1 
GROUP BY po_mantenimiento_lista.id
ORDER BY po_mantenimiento_lista.num_lista asc";
$resultV = mysqli_query($con, $sqlV);
$numeroV = mysqli_num_rows($resultV);
while($rowV = mysqli_fetch_array($resultV, MYSQLI_ASSOC)){
$idequipo = $rowV['id_equipo'];

if ($idequipo == 2 || $idequipo == 20 || $idequipo == 33 || $idequipo == 42 || $idequipo == 43) {

if($idequipo == 2 || $idequipo == 33 || $idequipo == 42){
$contenid0 .= ContenidoEquipo2($Session_IDEstacion,$idequipo,$selyear,$selmes,$con);  
if ($int < $numeroV) {
$contenid0 .= '<div style="page-break-before: always;"> </div>';
}
$int = $int + 1;
}else if($idequipo == 20){
$contenid0 .= ContenidoEquipo3($Session_IDEstacion,$idequipo,$selyear,$selmes,$con);   
if ($int < $numeroV) {
$contenid0 .= '<div style="page-break-before: always;"> </div>';
}
$int = $int + 1;
}else if($idequipo == 43){
$contenid0 .= ContenidoEquipo4($Session_IDEstacion,$idequipo,$selyear,$selmes,$con);
if ($int < $numeroV) {
$contenid0 .= '<div style="page-break-before: always;"> </div>';
}
$int = $int + 1;
}

}else{
$contenid0 .= ContenidoEquipo1($Session_IDEstacion,$idequipo,$selyear,$selmes,$con);
if ($int < $numeroV) {
$contenid0 .= '<div style="page-break-before: always;"> </div>';
}
$int = $int + 1;
}
}

}

$contenid0 .= "</body>";
$contenid0 .= "</html>";

$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("LEGAL", "landscape");
// Escribimos el html en el PDF
$dompdf->render();

$canvas = $dompdf->get_canvas();
$canvas->page_text(930, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));

// Ponemos el PDF en el browser
$dompdf->stream('ReporteMantenimiento Preventivo.pdf');

//------------------
mysqli_close($con);
//------------------
?>
