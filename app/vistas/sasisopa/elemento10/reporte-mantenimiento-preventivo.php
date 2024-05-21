<?php
require('../../../../app/help.php');
?>
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  });
</script>
<?php

$Selectequipo = $_POST['Selectequipo'];
$selyear = $_POST['selyear'];
$selmes = $_POST['selmes'];

$year = date("Y");
$mes = date("m");


if ($Selectequipo != "" && $selyear != "") {

?>

<div class="text-right mb-2">

<a class="ml-2" onclick="DescargarReporte('<?=$Selectequipo?>','<?=$selyear?>','<?=$selmes?>')" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Decargar PDF" >
<img src="<?php echo RUTA_IMG_ICONOS."archivo.png"; ?>">
</a>

<a class="ml-3" onclick="ListaMantenimiento()" id="Toltip" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Regresar" >
<img src="<?php echo RUTA_IMG_ICONOS."eliminar.png"; ?>">
</a>
</div>

<?php


if ($Selectequipo == 2 || $Selectequipo == 20 || $Selectequipo == 33 || $Selectequipo == 42 || $Selectequipo == 43) {

if($Selectequipo == 2 || $Selectequipo == 33 || $Selectequipo == 42){
echo ContenidoEquipo2($Session_IDEstacion,$Selectequipo,$selyear,$selmes,$con);   
}else if($Selectequipo == 20){
echo ContenidoEquipo3($Session_IDEstacion,$Selectequipo,$selyear,$selmes,$con);   
}else if($Selectequipo == 43){
echo ContenidoEquipo4($Session_IDEstacion,$Selectequipo,$selyear,$selmes,$con);  
}

}else{
echo ContenidoEquipo1($Session_IDEstacion,$Selectequipo,$selyear,$selmes,$con);
}

}else if($Selectequipo == "" && $selyear != ""){

if ($selmes != "") {
$BuscarMes = " AND MONTH (po_mantenimiento_verificar.fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}

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

?>

<div class="text-right mb-2">

<?php
if ($numeroV != 0) {
?>
<a class="ml-2" onclick="DescargarReporte('<?=$Selectequipo?>','<?=$selyear?>','<?=$selmes?>')" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Decargar PDF" >
<img src="<?php echo RUTA_IMG_ICONOS."archivo.png"; ?>">
</a>
<?php
}
?>
<a class="ml-3" onclick="ListaMantenimiento()" id="Toltip" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Regresar" >
<img src="<?php echo RUTA_IMG_ICONOS."eliminar.png"; ?>">
</a>
</div>

<?php


if ($numeroV > 0) {

while($rowV = mysqli_fetch_array($resultV, MYSQLI_ASSOC)){
$idequipo = $rowV['id_equipo'];

if ($idequipo == 2 || $idequipo == 20 || $idequipo == 33 || $idequipo == 42 || $idequipo == 43) {

if($idequipo == 2 || $idequipo == 33 || $idequipo == 42){
echo ContenidoEquipo2($Session_IDEstacion,$idequipo,$selyear,$selmes,$con);   
}else if($idequipo == 20){
echo ContenidoEquipo3($Session_IDEstacion,$idequipo,$selyear,$selmes,$con);   
}else if($idequipo == 43){
echo ContenidoEquipo4($Session_IDEstacion,$idequipo,$selyear,$selmes,$con);  
}

}else{
echo ContenidoEquipo1($Session_IDEstacion,$idequipo,$selyear,$selmes,$con);
}

}

}else{
    echo "<div class='text-center'><small>No se encontró información para mostrar</small></div>";
}

}

//-------------------------------------------------------------------------------------------

function ContenidoEquipo1($Session_IDEstacion,$idequipo,$selyear,$selmes,$con){

$rutaFirma = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";
$rutaTirilla = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenTirilla/";

if ($selmes != "") {
$BuscarMes = " AND MONTH (fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}

$imagentirilla = "";

$sqlvd = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = '".$Session_IDEstacion."' AND id_equipo = '".$idequipo."' AND YEAR(fechacreacion) = '".$selyear."' $BuscarMes AND estado >= 1 ORDER BY folio asc ";
$resultvd = mysqli_query($con, $sqlvd);
$numerovd = mysqli_num_rows($resultvd);

if ($numerovd > 0) {

if ($idequipo == 44) {
        $Titulo = "";
        }else{
        $Titulo = "Equipo:"; 
        }
        $resultado = "";
        $resultado .= "<div class='border p-2 mb-3'>";
        $resultado .= "<div class='border-bottom pb-2'>";
        $resultado .= "<div style='font-size: 1.2em;'>".$Titulo." <b>".NombreEquipo($idequipo,$con)."</b></div>";
        $resultado .= "</div>";
       
        $resultado .= "<table class='table table-bordered table-sm p-0 m-0 mt-2'>";
        $resultado .= "<thead>";
        $resultado .= "<tr>";
        $resultado .= "<th class='align-middle text-center'></th>";
        $resultado .= "<th class='align-middle text-center'>Folio</th>";
        $resultado .= "<th class='align-middle text-center'>Fecha</th>";
        $resultado .= "<th class='align-middle text-center' width='80px'>Hora</th>";  
        $resultado .= "<th class='align-middle text-center'>Equipo y Resultado</th>";       
        $resultado .= "<th class='align-middle text-center'>Observaciones</th>";
        $resultado .= "<th class='align-middle text-center' width='150px'>Trabajador que realiza la actividad</th>";
        $resultado .= "<th class='align-middle text-center' width='150px'>Trabajador que supervisa la actividad</th>";
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
        $NombreRecibe = $row_imagen1['nombre'];
        $FPR = "<img width='150px' src='".$rutaFirma.$row_imagen1['imagen_firma']."'>";
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

        $NombreResponsable = $row_imagen2['nombre'];
        $FPS = "<img width='150px' src='".$rutaFirma.$row_imagen2['imagen_firma']."'>";
        }
        }else{
        $NombreResponsable = "";
        $FPS = "";
        }      


        $resultado .= "<tr>";
        $resultado .= "<td class='".$estado." align-middle text-center' width='50px'><button type='button' class='btn btn-primary btn-sm' onclick='Evidencias(".$idverificar.")'>Evidencia</button></td>";
        $resultado .= "<td class='".$estado." align-middle text-center'><b>".$folio."</b></td>";
        $resultado .= "<td class='".$estado." align-middle text-center'>".$FechaHoraObservaciones['fechafin']."</td>";  
        $resultado .= "<td class='".$estado." align-middle text-center'>".$FechaHoraObservaciones['horafin']."</td>"; 

        $resultado .= "<td class='".$estado." text-center p-0'>"; 
        $resultado .= "<div>";        
        $resultado .= "<table class='table table-sm p-0 m-0'>";

        $sqlD = "SELECT * FROM po_mantenimiento_verificar_detalle WHERE id_verificar = '".$idverificar."'";
        $resultD = mysqli_query($con, $sqlD);
        $numeroD = mysqli_num_rows($resultD);
        while($rowD = mysqli_fetch_array($resultD, MYSQLI_ASSOC)){
        $resultado .= "<tr class='".$estado."'>";
        $resultado .= "<td class='align-middle'>".NombreVerificar($rowD['id_detalle'], $con)."</td>";
        $resultado .= "<td class='align-middle text-center'>".$rowD['resultado']."</td>";        
        $resultado .= "</tr>"; 
        }        
        $resultado .= "</table>";

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

        $resultado .= "</div>";
        $resultado .= "</td>"; 

        $resultado .= "<td class='".$estado." align-middle text-center'>".$FechaHoraObservaciones['observaciones']."</td>"; 
        $resultado .= "<td class='align-middle text-center' width='150px'>".$FPR."<div><small>".$NombreRecibe."</small></div></td>";
        $resultado .= "<td class='align-middle text-center' width='150px'>".$FPS."<div><small>".$NombreResponsable."</small></div></td>"; 

        $resultado .= "</tr>";  
        }  
          
        $resultado .= "</tbody>";
        $resultado .= "</table>";

        $resultado .= "</div>";

        return $resultado;

    }else{

        return "<div class='text-center'><small>No se encontró información para mostrar</small></div>";
    }
}

//--------------------------------------------------------------------------------------------------------------------

function ContenidoEquipo2($Session_IDEstacion,$idequipo,$selyear,$selmes,$con){

$rutaFirma = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";
$rutaTirilla = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenTirilla/";

if ($selmes != "") {
$BuscarMes = " AND MONTH (fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}

$sqlvd = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = '".$Session_IDEstacion."' AND id_equipo = '".$idequipo."' AND YEAR(fechacreacion) = '".$selyear."' $BuscarMes AND estado >= 1 ORDER BY folio asc ";
$resultvd = mysqli_query($con, $sqlvd);
$numerovd = mysqli_num_rows($resultvd);

if ($numerovd > 0) {
        $resultado = "";
        $resultado .= "<div class='border p-2 mb-3'>";
        $resultado .= "<div class='border-bottom pb-2'>";
        $resultado .= "<div style='font-size: 1.2em;'>Equipo: <b>".NombreEquipo($idequipo,$con)."</b></div>";
        $resultado .= "</div>";
       
        $resultado .= "<table class='table table-bordered table-sm p-0 m-0 mt-2'>";
        $resultado .= "<thead>";
        $resultado .= "<tr>";
        $resultado .= "<th class='align-middle text-center'></th>";
        $resultado .= "<th class='align-middle text-center'>Folio</th>";
        $resultado .= "<th class='align-middle text-center'>Fecha</th>";
        $resultado .= "<th class='align-middle text-center' width='80px'>Hora</th>";  
        $resultado .= "<th class='align-middle text-center'>Equipo y Resultado</th>";         
        $resultado .= "<th class='align-middle text-center'>Observaciones</th>";
        $resultado .= "<th class='align-middle text-center' width='150px'>Trabajador que realiza la actividad</th>";
        $resultado .= "<th class='align-middle text-center' width='150px'>Trabajador que supervisa la actividad</th>";
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
        $NombreRecibe = $row_imagen1['nombre'];
        $FPR = "<img width='150px' src='".$rutaFirma.$row_imagen1['imagen_firma']."'>";
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

        $NombreResponsable = $row_imagen2['nombre'];
        $FPS = "<img width='150px' src='".$rutaFirma.$row_imagen2['imagen_firma']."'>";
        }
        }else{
        $NombreResponsable = "";
        $FPS = "";
        }        

        $resultado .= "<tr>";
        $resultado .= "<td class='".$estado." align-middle text-center' width='50px'><button type='button' class='btn btn-primary btn-sm' onclick='Evidencias(".$idverificar.")'>Evidencia</button></td>";
        $resultado .= "<td class='".$estado." align-middle text-center'><b>".$folio."</b></td>";
        $resultado .= "<td class='".$estado." align-middle text-center'>".$FechaHoraObservaciones['fechafin']."</td>";  
        $resultado .= "<td class='".$estado." align-middle text-center'>".$FechaHoraObservaciones['horafin']."</td>"; 

        $resultado .= "<td class='".$estado." text-center'>"; 
        $resultado .= "<div>";
        $resultado .= "<table class='table table-sm ".$estado."'>";

        $resultado .= DetalleSublista($idverificar,$idequipo,$estado,$con);
        
        $resultado .= "</table>";
        $resultado .= "</div>";
        $resultado .= "</td>"; 

        $resultado .= "<td class='".$estado." align-middle text-center'>".$FechaHoraObservaciones['observaciones']."</td>"; 
        $resultado .= "<td class='align-middle text-center' width='150px'>".$FPR."<div><small>".$NombreRecibe."</small></div></td>";
        $resultado .= "<td class='align-middle text-center' width='150px'>".$FPS."<div><small>".$NombreResponsable."</small></div></td>"; 

        $resultado .= "</tr>";  
        }  
          

        $resultado .= "</tbody>";
        $resultado .= "</table>";

        $resultado .= "</div>";

        return $resultado;
         }else{

        return "<div class='text-center'><small>No se encontró información para mostrar</small></div>";
    }
}

//--------------------------------------------------------------------------------------------------------------------

function ContenidoEquipo3($Session_IDEstacion,$idequipo,$selyear,$selmes,$con){

$rutaFirma = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";

if ($selmes != "") {
$BuscarMes = " AND MONTH (fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}

$sqlvd = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = '".$Session_IDEstacion."' AND id_equipo = '".$idequipo."' AND YEAR(fechacreacion) = '".$selyear."' $BuscarMes AND estado >= 1 ORDER BY folio asc ";
$resultvd = mysqli_query($con, $sqlvd);
$numerovd = mysqli_num_rows($resultvd);

if ($numerovd > 0) {
        $resultado = "";
        $resultado .= "<div class='border p-2 mb-3'>";
        $resultado .= "<div class='border-bottom pb-2'>";
        $resultado .= "<div style='font-size: 1.2em;'>Equipo: <b>".NombreEquipo($idequipo,$con)."</b></div>";
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
        $NombreRecibe = $row_imagen1['nombre'];
        $FPR = "<img width='150px' src='".$rutaFirma.$row_imagen1['imagen_firma']."'>";
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

        $NombreResponsable = $row_imagen2['nombre'];
        $FPS = "<img width='150px' src='".$rutaFirma.$row_imagen2['imagen_firma']."'>";
        }
        }else{
        $NombreResponsable = "";
        $FPS = "";
        }        

        $resultado .= "<table class='table table-bordered table-sm p-0 m-0 mt-2'>";
        $resultado .= "<tr>";
        $resultado .= "<td class='".$estado." align-middle text-center' width='50px'><button type='button' class='btn btn-primary btn-sm' onclick='Evidencias(".$idverificar.")'>Evidencia</button></td>";
        $resultado .= "<td class='".$estado." align-middle text-center'>Folio: <b>".$folio."</b></td>";
        $resultado .= "<td class='".$estado." align-middle text-center'>Fecha: <b>".$FechaHoraObservaciones['fechafin']."</b></td>";
        $resultado .= "<td class='".$estado." align-middle text-center'>Hora: <b>".$FechaHoraObservaciones['horafin']."</b></td>";
        $resultado .= "<td class=' align-middle text-center'><b>Trabajador que realiza la actividad</b>".$FPR."<div><small>".$NombreRecibe."</small></div></td>";
        $resultado .= "<td class='align-middle text-center'><b>Trabajador que supervisa la actividad</b>".$FPS."<div><small>".$NombreResponsable."</small></div></td>"; 
        $resultado .= "</tr>";
        $resultado .= "</table>";

        $resultado .= "<table class='table table-bordered table-sm p-0 m-0'>";
        $resultado .= "<thead>";
        $resultado .= "<tr>";
        $resultado .= "<th class='".$estado." align-middle text-center'>No. De extintor</th>";
        $resultado .= "<th class='".$estado." align-middle text-center'>Ubicación</th>";
        $resultado .= "<th class='".$estado." align-middle text-center'>Fecha de ultima recarga</th>";  
        $resultado .= "<th class='".$estado." align-middle text-center'>Tipo de Extintor</th>";   
        $resultado .= "<th class='".$estado." align-middle text-center'>Peso Kg</th>";
        $resultado .= "<th class='".$estado." align-middle text-center'>Manómetro</th>";        
        $resultado .= "<th class='".$estado." align-middle text-center'>Boquilla de descarga</th>";
        $resultado .= "<th class='".$estado." align-middle text-center'>Manguera</th>";
        $resultado .= "<th class='".$estado." align-middle text-center'>Funcionalidad</th>";
        $resultado .= "<th class='".$estado." align-middle text-center'>Observaciones</th>";
        $resultado .= "</tr>";
        $resultado .= "</thead>";
        $resultado .= "<tbody>";

            $sql_detalle = "SELECT * FROM po_extintores_estacion_detalle WHERE id_verificar = '".$idverificar."' ";
            $result_detalle = mysqli_query($con, $sql_detalle);
            $numero_detalle = mysqli_num_rows($result_detalle);         
            while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){

            $DetalleExtintor = DetalleExtintor($row_detalle['id_extintor'],$con);

            $resultado .= "<tr>";
            $resultado .= "<td class='".$estado." align-middle text-center'><b>".$DetalleExtintor['noextintor']."</b></td>";
            $resultado .= "<td class='".$estado." align-middle text-center'>".$DetalleExtintor['ubicacion']."</td>";            
            $resultado .= "<td class='".$estado." align-middle text-center'>".FormatoFecha($row_detalle['ultima_recarga'])."</td>";
            $resultado .= "<td class='".$estado." align-middle text-center'>".$DetalleExtintor['tipoextintor']."</td>";
            $resultado .= "<td class='".$estado." align-middle text-center'>".$DetalleExtintor['pesokg']."</td>";
            $resultado .= "<td class='".$estado." align-middle text-center'>".$row_detalle['manometro']."</td>";
            $resultado .= "<td class='".$estado." align-middle text-center'>".$row_detalle['boquilla_descarga']."</td>";
            $resultado .= "<td class='".$estado." align-middle text-center'>".$row_detalle['manguera']."</td>";
            $resultado .= "<td class='".$estado." align-middle text-center'>".$row_detalle['funcionalidad']."</td>";
            $resultado .= "<td class='".$estado." align-middle text-center'>".$row_detalle['observaciones']."</td>";
            $resultado .= "</tr>";

            }
          

        $resultado .= "</tbody>";
        $resultado .= "</table><hr>";

        }
       
        $resultado .= "</div>";

        return $resultado;
         }else{

        return "<div class='text-center'><small>No se encontró información para mostrar</small></div>";
    }

}
//--------------------------------------------------------------------------------------------------------------------

function ContenidoEquipo4($Session_IDEstacion,$idequipo,$selyear,$selmes,$con){

$rutaFirma = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";
$rutaTirilla = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenTirilla/";

if ($selmes != "") {
$BuscarMes = " AND MONTH (fechacreacion) = ".$selmes;
}else{
$BuscarMes = "";
}

$imagentirilla = "";

$sqlvd = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = '".$Session_IDEstacion."' AND id_equipo = '".$idequipo."' AND YEAR(fechacreacion) = '".$selyear."' $BuscarMes AND estado >= 1 ORDER BY folio asc ";
$resultvd = mysqli_query($con, $sqlvd);
$numerovd = mysqli_num_rows($resultvd);

if ($numerovd > 0) {

if ($idequipo == 44) {
        $Titulo = "";
        }else{
        $Titulo = "Equipo:"; 
        }
        $resultado = "";
        $resultado .= "<div class='border p-2 mb-3'>";
        $resultado .= "<div class='border-bottom pb-2'>";
        $resultado .= "<div style='font-size: 1.2em;'>".$Titulo." <b>".NombreEquipo($idequipo,$con)."</b></div>";
        $resultado .= "</div>";
       
        $resultado .= "<table class='table table-bordered table-sm p-0 m-0 mt-2'>";
        $resultado .= "<thead>";
        $resultado .= "<tr>";
        $resultado .= "<th class='align-middle text-center'></th>";
        $resultado .= "<th class='align-middle text-center'>Folio</th>";
        $resultado .= "<th class='align-middle text-center'>Fecha</th>";
        $resultado .= "<th class='align-middle text-center' width='80px'>Hora</th>";  
        $resultado .= "<th class='align-middle text-center'>Equipo y Resultado</th>";       
        $resultado .= "<th class='align-middle text-center'>Observaciones</th>";
        $resultado .= "<th class='align-middle text-center' width='150px'>Trabajador que realiza la actividad</th>";
        $resultado .= "<th class='align-middle text-center' width='150px'>Trabajador que supervisa la actividad</th>";
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
        $NombreRecibe = $row_imagen1['nombre'];
        $FPR = "<img width='150px' src='".$rutaFirma.$row_imagen1['imagen_firma']."'>";
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

        $NombreResponsable = $row_imagen2['nombre'];
        $FPS = "<img width='150px' src='".$rutaFirma.$row_imagen2['imagen_firma']."'>";
        }
        }else{
        $NombreResponsable = "";
        $FPS = "";
        }      


        $resultado .= "<tr>";
        $resultado .= "<td class='".$estado." align-middle text-center' width='50px'><button type='button' class='btn btn-primary btn-sm' onclick='Evidencias(".$idverificar.")'>Evidencia</button></td>";
        $resultado .= "<td class='".$estado." align-middle text-center'><b>".$folio."</b></td>";
        $resultado .= "<td class='".$estado." align-middle text-center'>".$FechaHoraObservaciones['fechafin']."</td>";  
        $resultado .= "<td class='".$estado." align-middle text-center'>".$FechaHoraObservaciones['horafin']."</td>"; 

        $resultado .= "<td class='".$estado." text-center p-0'>"; 
        $resultado .= "<div>";
        $resultado .= "<table class='table table-sm p-0 m-0'>";

        $sqlD = "SELECT * FROM po_mantenimiento_verificar_tanque WHERE id_verificar = '".$idverificar."'";
        $resultD = mysqli_query($con, $sqlD);
        $numeroD = mysqli_num_rows($resultD);
        while($rowD = mysqli_fetch_array($resultD, MYSQLI_ASSOC)){
        $resultado .= "<tr class='".$estado."'>";
        $resultado .= "<td class='align-middle'>".$rowD['detalle']."</td>";
        $resultado .= "<td class='align-middle text-center'>".$rowD['resultado']."</td>";        
        $resultado .= "</tr>"; 
        }
        
        $resultado .= "</table>";
        $resultado .= "</div>";
        $resultado .= "</td>"; 

        $resultado .= "<td class='".$estado." align-middle text-center'>".$FechaHoraObservaciones['observaciones']."</td>"; 
        $resultado .= "<td class='align-middle text-center' width='150px'>".$FPR."<div><small>".$NombreRecibe."</small></div></td>";
        $resultado .= "<td class='align-middle text-center' width='150px'>".$FPS."<div><small>".$NombreResponsable."</small></div></td>"; 

        $resultado .= "</tr>";  
        }  
          
        $resultado .= "</tbody>";
        $resultado .= "</table>";

        $resultado .= "</div>";

        return $resultado;

    }else{

        return "<div class='text-center'><small>No se encontró información para mostrar</small></div>";
    }
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
        $resultado = "";
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
        $resultado .= "<td class='align-middle text-center font-weight-bold' colspan='2'>".$row_nomSub['detalle']."</td>";
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
//------------------
mysqli_close($con);
//------------------
?>