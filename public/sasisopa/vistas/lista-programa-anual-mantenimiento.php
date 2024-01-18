<?php
require('../../../app/help.php');
$year = date("Y");
$idReporte = $_GET['idReporte'];

$yearAnterior = $year - 1;
$sql_programa = "SELECT * FROM po_programa_anual_mantenimiento WHERE id_estacion = '".$Session_IDEstacion."' AND year = '".$yearAnterior."' ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);
if ($numero_programa == 1) {
while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
$idYearAnte = $row_programa['id'];
}
CreaPrograma($idYearAnte, $idReporte, $con);
}

function CreaPrograma($idYearAnte, $idReporte, $con){

$sql_mantenimiento_lista = "SELECT po_mantenimiento_lista.id, po_mantenimiento_lista.detalle, po_mantenimiento_lista.periodicidad, po_programa_anual_mantenimiento_detalle.id AS idreporte, po_programa_anual_mantenimiento_detalle.id_programa_fecha, po_programa_anual_mantenimiento_detalle.enero,po_programa_anual_mantenimiento_detalle.febrero,po_programa_anual_mantenimiento_detalle.marzo,po_programa_anual_mantenimiento_detalle.abril,po_programa_anual_mantenimiento_detalle.mayo,po_programa_anual_mantenimiento_detalle.junio,po_programa_anual_mantenimiento_detalle.julio,po_programa_anual_mantenimiento_detalle.agosto,po_programa_anual_mantenimiento_detalle.septiembre,po_programa_anual_mantenimiento_detalle.octubre,po_programa_anual_mantenimiento_detalle.noviembre,po_programa_anual_mantenimiento_detalle.diciembre FROM po_mantenimiento_lista INNER JOIN po_programa_anual_mantenimiento_detalle ON po_mantenimiento_lista.id = po_programa_anual_mantenimiento_detalle.id_mantenimiento WHERE po_programa_anual_mantenimiento_detalle.id_programa_fecha = '".$idYearAnte."' ";

$result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
$numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
        
while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){
$idMantenimiento = $row_mantenimiento_lista['id'];
$periodicidad = $row_mantenimiento_lista['periodicidad'];

$enero = $row_mantenimiento_lista['enero'];
$febrero = $row_mantenimiento_lista['febrero'];
$marzo = $row_mantenimiento_lista['marzo'];
$abril = $row_mantenimiento_lista['abril'];
$mayo = $row_mantenimiento_lista['mayo'];
$junio = $row_mantenimiento_lista['junio'];
$julio = $row_mantenimiento_lista['julio'];
$agosto = $row_mantenimiento_lista['agosto'];
$septiembre = $row_mantenimiento_lista['septiembre'];
$octubre = $row_mantenimiento_lista['octubre'];
$noviembre = $row_mantenimiento_lista['noviembre'];
$diciembre = $row_mantenimiento_lista['diciembre'];

$sql_programa = "SELECT * FROM po_programa_anual_mantenimiento_detalle WHERE id_programa_fecha = '".$idReporte."' AND id_mantenimiento = '".$idMantenimiento."' ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);

if ($numero_programa == 0) {

if ($periodicidad == "Mensual" || $periodicidad == "Trimestral" || $periodicidad == "Cuatrimestral" || $periodicidad == "Semestral" || $periodicidad == "Anual" || $periodicidad == "Determinado por el Representante Legal") {

if ($enero == "0000-00-00") {
$mes1 = "0000-00-00";
}else{
$mes1 = date("Y-m-d",strtotime($enero."+ 1 year"));

}

if ($febrero == "0000-00-00") {
$mes2 = "0000-00-00";
}else{
$mes2 = date("Y-m-d",strtotime($febrero."+ 1 year"));
}

if ($marzo == "0000-00-00") {
$mes3 = "0000-00-00";
}else{
$mes3 = date("Y-m-d",strtotime($marzo."+ 1 year"));
}

if ($abril == "0000-00-00") {
$mes4 = "0000-00-00";
}else{
$mes4 = date("Y-m-d",strtotime($abril."+ 1 year"));
}

if ($mayo == "0000-00-00") {
$mes5 = "0000-00-00";
}else{
$mes5 = date("Y-m-d",strtotime($mayo."+ 1 year"));
}

if ($junio == "0000-00-00") {
$mes6 = "0000-00-00";
}else{
$mes6 = date("Y-m-d",strtotime($junio."+ 1 year"));
}

if ($julio == "0000-00-00") {
$mes7 = "0000-00-00";
}else{
$mes7 = date("Y-m-d",strtotime($julio."+ 1 year"));
}

if ($agosto == "0000-00-00") {
$mes8 = "0000-00-00";
}else{
$mes8 = date("Y-m-d",strtotime($agosto."+ 1 year"));
}

if ($septiembre == "0000-00-00") {
$mes9 = "0000-00-00";
}else{
$mes9 = date("Y-m-d",strtotime($septiembre."+ 1 year"));
}

if ($octubre == "0000-00-00") {
$mes10 = "0000-00-00";
}else{
$mes10 = date("Y-m-d",strtotime($octubre."+ 1 year"));
}

if ($noviembre == "0000-00-00") {
$mes11 = "0000-00-00";
}else{
$mes11 = date("Y-m-d",strtotime($noviembre."+ 1 year"));
}

if ($diciembre == "0000-00-00") {
$mes12 = "0000-00-00";
}else{
$mes12 = date("Y-m-d",strtotime($diciembre."+ 1 year"));
}

$sql_insert = "INSERT INTO po_programa_anual_mantenimiento_detalle (id_programa_fecha,id_mantenimiento,ultimafecha,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,estado)
VALUES (
'".$idReporte."',
'".$idMantenimiento."',
'',
'".$mes1."',
'".$mes2."',
'".$mes3."',
'".$mes4."',
'".$mes5."',
'".$mes6."',
'".$mes7."',
'".$mes8."',
'".$mes9."',
'".$mes10."',
'".$mes11."',
'".$mes12."',
1
)";
mysqli_query($con, $sql_insert);

}else if ($periodicidad == "Bianual") {

if ($enero == "0000-00-00") {
$mes1 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $enero);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes1 = $enero;
}else if($YearNu > $YearAn){
$mes1 = date("Y-m-d",strtotime($enero."+ 2 year"));
}
}

if ($febrero == "0000-00-00") {
$mes2 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $febrero);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes2 = $febrero;
}else if($YearNu > $YearAn){
$mes2 = date("Y-m-d",strtotime($febrero."+ 2 year"));
}
}

if ($marzo == "0000-00-00") {
$mes3 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $marzo);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes3 = $marzo;
}else if($YearNu > $YearAn){
$mes3 = date("Y-m-d",strtotime($marzo."+ 2 year"));
}
}

if ($abril == "0000-00-00") {
$mes4 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $abril);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes4 = $abril;
}else if($YearNu > $YearAn){
$mes4 = date("Y-m-d",strtotime($abril."+ 2 year"));
}
}

if ($mayo == "0000-00-00") {
$mes5 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $mayo);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes5 = $mayo;
}else if($YearNu > $YearAn){
$mes5 = date("Y-m-d",strtotime($mayo."+ 2 year"));
}
}

if ($junio == "0000-00-00") {
$mes6 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $junio);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes6 = $junio;
}else if($YearNu > $YearAn){
$mes6 = date("Y-m-d",strtotime($junio."+ 2 year"));
}
}

if ($julio == "0000-00-00") {
$mes7 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $julio);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes7 = $julio;
}else if($YearNu > $YearAn){
$mes7 = date("Y-m-d",strtotime($julio."+ 2 year"));
}
}

if ($agosto == "0000-00-00") {
$mes8 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $agosto);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes8 = $agosto;
}else if($YearNu > $YearAn){
$mes8 = date("Y-m-d",strtotime($agosto."+ 2 year"));
}
}

if ($septiembre == "0000-00-00") {
$mes9 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $septiembre);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes9 = $septiembre;
}else if($YearNu > $YearAn){
$mes9 = date("Y-m-d",strtotime($septiembre."+ 2 year"));
}
}

if ($octubre == "0000-00-00") {
$mes10 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $octubre);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes10 = $octubre;
}else if($YearNu > $YearAn){
$mes10 = date("Y-m-d",strtotime($octubre."+ 2 year"));
}
}

if ($noviembre == "0000-00-00") {
$mes11 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $noviembre);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes11 = $noviembre;
}else if($YearNu > $YearAn){
$mes11 = date("Y-m-d",strtotime($noviembre."+ 2 year"));
}
}

if ($diciembre == "0000-00-00") {
$mes12 = "0000-00-00";
}else{
$ExplodeAn = explode("-", $diciembre);
$YearAn = $ExplodeAn[0];
$YearNu = date("Y");

if ($YearAn == $YearNu) {
$mes12 = $diciembre;
}else if($YearNu > $YearAn){
$mes12 = date("Y-m-d",strtotime($diciembre."+ 2 year"));
}
}

$sql_insert = "INSERT INTO po_programa_anual_mantenimiento_detalle (id_programa_fecha,id_mantenimiento,ultimafecha,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,estado)
VALUES (
'".$idReporte."',
'".$idMantenimiento."',
'',
'".$mes1."',
'".$mes2."',
'".$mes3."',
'".$mes4."',
'".$mes5."',
'".$mes6."',
'".$mes7."',
'".$mes8."',
'".$mes9."',
'".$mes10."',
'".$mes11."',
'".$mes12."',
1
)";
mysqli_query($con, $sql_insert);

}

}


}
}



function txtFecha($fecha){
if($fecha == "0000-00-00"){
$resultado == "";
}else{
$formato_fecha = explode("-",$fecha);
$resultado = "<b>".$formato_fecha[2]."</b>.".substr(nombremes($formato_fecha[1]),0,3).".".substr($formato_fecha[0],-2,2);
}
return $resultado;
}

function ColorTD($fecha){
$fecha_del_dia = date("Y-m-d");

if($fecha == "0000-00-00"){
$resultado = "table-secondary";
}else{

$nuevafecha = strtotime ( '-3 day' , strtotime ($fecha)) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha);

if ($fecha_del_dia == $fecha) 
{
$resultado = "table-danger";
}
else if ($fecha_del_dia > $fecha) 
{
$resultado = "table-success";  
}
else if ($fecha_del_dia >= $nuevafecha) 
{
$resultado = "table-warning";  
}else{
  $resultado = "table-active";
}


}

return $resultado;  
}

function txtColor($fecha){
$fecha_del_dia = date("Y-m-d");

$nuevafecha = strtotime ( '-3 day' , strtotime ($fecha)) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha);

if ($fecha_del_dia == $fecha) 
{
$resultado = "text-danger";
}
else if ($fecha_del_dia > $fecha) 
{
$resultado = "text-secondary";
}
else if ($fecha_del_dia >= $nuevafecha) 
{
$resultado = "text-danger";  
}else{
  $resultado = "text-black";
}

return $resultado;  
}

?>


<!-- TABLA - APROBACION -->
<div class="mb-2" style="overflow-y: hidden;">

<table class="table table-bordered table-sm">
        <tr style="font-size: 1.2em;">
          <td class="align-middle text-center"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 300px;"></td>
          <td colspan="2" class="align-middle text-center font-weight-bold">Programa Anual de Mantenimiento </td>
          <td class="align-middle text-center font-weight-bold">Fo. ADMONGAS.011</td>
        </tr>
        <tr style="font-size: 1.2em;">
          <td class="align-middle text-center">Elaborado por: Nelly Estrada Garcia/Francisco Ibarra Alcántara </td>
          <td class="align-middle text-center">Revisado por: Eduardo Galicia Flores</td>
          <td class="align-middle text-center">Aprobado por: Tomas Tarno Quinzaños</td>
          <td class="align-middle text-center">Fecha de Aprobación 01-oct-18</td>
        </tr>
      </table>
</div>


  <div class="mb-2" style="overflow-y: hidden;">
  <table class="table table-bordered table-sm">
        <tr class="table-primary">
          <td class="text-center font-weight-bold">#</td>
          <td class="text-center font-weight-bold">Equipo o instalación</td>
          <td class="text-center font-weight-bold">Enero</td>
          <td class="text-center font-weight-bold">Febrero</td>
          <td class="text-center font-weight-bold">Marzo</td>
          <td class="text-center font-weight-bold">Abril</td>
          <td class="text-center font-weight-bold">Mayo</td>
          <td class="text-center font-weight-bold">Junio</td>
          <td class="text-center font-weight-bold">Julio</td>
          <td class="text-center font-weight-bold">Agosto</td>
          <td class="text-center font-weight-bold">Septiembre</td>
          <td class="text-center font-weight-bold">Octubre</td>
          <td class="text-center font-weight-bold">Noviembre</td>
          <td class="text-center font-weight-bold">Diciembre</td>
          <td colspan="2"></td>
        </tr>
<?php
$sql_mantenimiento_lista = "SELECT po_mantenimiento_lista.id, po_mantenimiento_lista.detalle, 
po_programa_anual_mantenimiento_detalle.id AS idreporte, po_programa_anual_mantenimiento_detalle.id_programa_fecha, po_programa_anual_mantenimiento_detalle.enero,po_programa_anual_mantenimiento_detalle.febrero,po_programa_anual_mantenimiento_detalle.marzo,po_programa_anual_mantenimiento_detalle.abril,po_programa_anual_mantenimiento_detalle.mayo,po_programa_anual_mantenimiento_detalle.junio,po_programa_anual_mantenimiento_detalle.julio,po_programa_anual_mantenimiento_detalle.agosto,po_programa_anual_mantenimiento_detalle.septiembre,po_programa_anual_mantenimiento_detalle.octubre,po_programa_anual_mantenimiento_detalle.noviembre,po_programa_anual_mantenimiento_detalle.diciembre
FROM po_mantenimiento_lista
INNER JOIN po_programa_anual_mantenimiento_detalle
ON po_mantenimiento_lista.id = po_programa_anual_mantenimiento_detalle.id_mantenimiento WHERE po_programa_anual_mantenimiento_detalle.id_programa_fecha = '".$idReporte."' ORDER BY po_mantenimiento_lista.id asc ";
        $result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
        $numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
        if ($numero_mantenimiento_lista > 0) {

        while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){

        $txt_enero = txtFecha($row_mantenimiento_lista['enero']);
        $color_enero = ColorTD($row_mantenimiento_lista['enero']);
        $txt_color_enero = txtColor($row_mantenimiento_lista['enero']);

        $txt_febrero = txtFecha($row_mantenimiento_lista['febrero']);
        $color_febrero = ColorTD($row_mantenimiento_lista['febrero']);
        $txt_color_febrero = txtColor($row_mantenimiento_lista['febrero']);

        $txt_marzo = txtFecha($row_mantenimiento_lista['marzo']);
        $color_marzo = ColorTD($row_mantenimiento_lista['marzo']);
        $txt_color_marzo = txtColor($row_mantenimiento_lista['marzo']);

        $txt_abril = txtFecha($row_mantenimiento_lista['abril']);
        $color_abril = ColorTD($row_mantenimiento_lista['abril']);
        $txt_color_abril = txtColor($row_mantenimiento_lista['abril']);

        $txt_mayo = txtFecha($row_mantenimiento_lista['mayo']);
        $color_mayo = ColorTD($row_mantenimiento_lista['mayo']);
        $txt_color_mayo = txtColor($row_mantenimiento_lista['mayo']);

        $txt_junio = txtFecha($row_mantenimiento_lista['junio']);
        $color_junio = ColorTD($row_mantenimiento_lista['junio']);
        $txt_color_junio = txtColor($row_mantenimiento_lista['junio']);

        $txt_julio = txtFecha($row_mantenimiento_lista['julio']);
        $color_julio = ColorTD($row_mantenimiento_lista['julio']);
        $txt_color_julio = txtColor($row_mantenimiento_lista['julio']);

        $txt_agosto = txtFecha($row_mantenimiento_lista['agosto']);
        $color_agosto = ColorTD($row_mantenimiento_lista['agosto']);
        $txt_color_agosto = txtColor($row_mantenimiento_lista['agosto']);
      
        $txt_septiembre = txtFecha($row_mantenimiento_lista['septiembre']);
        $color_septiembre = ColorTD($row_mantenimiento_lista['septiembre']);
        $txt_color_septiembre = txtColor($row_mantenimiento_lista['septiembre']);

        $txt_octubre = txtFecha($row_mantenimiento_lista['octubre']);
        $color_octubre = ColorTD($row_mantenimiento_lista['octubre']);
        $txt_color_octubre = txtColor($row_mantenimiento_lista['octubre']);

        $txt_noviembre = txtFecha($row_mantenimiento_lista['noviembre']);
        $color_noviembre = ColorTD($row_mantenimiento_lista['noviembre']);
        $txt_color_noviembre = txtColor($row_mantenimiento_lista['noviembre']);

        $txt_diciembre = txtFecha($row_mantenimiento_lista['diciembre']);
        $color_diciembre = ColorTD($row_mantenimiento_lista['diciembre']);
        $txt_color_diciembre = txtColor($row_mantenimiento_lista['diciembre']);
        
        ?>
        <tr>
        <td class="align-middle"><?=$row_mantenimiento_lista['id'];?></td>
        <td class="align-middle"><?=$row_mantenimiento_lista['detalle'];?></td>
        <td class="align-middle text-center <?=$color_enero;?> <?=$txt_color_enero;?>" style="font-size: .8em;padding: 10px;"><?=$txt_enero;?></td>
        <td class="align-middle text-center <?=$color_febrero;?> <?=$txt_color_febrero;?>" style="font-size: .8em;padding: 10px;"><?=$txt_febrero;?></td>
        <td class="align-middle text-center <?=$color_marzo;?> <?=$txt_color_marzo;?>" style="font-size: .8em;padding: 10px;"><?=$txt_marzo;?></td>
        <td class="align-middle text-center <?=$color_abril;?> <?=$txt_color_abril;?>" style="font-size: .8em;padding: 10px;"><?=$txt_abril;?></td>
         <td class="align-middle text-center <?=$color_mayo;?> <?=$txt_color_mayo;?>" style="font-size: .8em;padding: 10px;"><?=$txt_mayo;?></td>
         <td class="align-middle text-center <?=$color_junio;?> <?=$txt_color_junio;?>" style="font-size: .8em;padding: 10px;"><?=$txt_junio;?></td>
          <td class="align-middle text-center <?=$color_julio;?> <?=$txt_color_julio;?>" style="font-size: .8em;padding: 10px;"><?=$txt_julio;?></td>
          <td class="align-middle text-center <?=$color_agosto;?> <?=$txt_color_agosto;?>" style="font-size: .8em;padding: 10px;"><?=$txt_agosto;?></td>
          <td class="align-middle text-center <?=$color_septiembre;?> <?=$txt_color_septiembre;?>" style="font-size: .8em;padding: 10px;"><?=$txt_septiembre;?></td>
          <td class="align-middle text-center <?=$color_octubre;?> <?=$txt_color_octubre;?>" style="font-size: .8em;padding: 10px;"><?=$txt_octubre;?></td>
          <td class="align-middle text-center <?=$color_noviembre;?> <?=$txt_color_noviembre;?>" style="font-size: .8em;padding: 10px;"><?=$txt_noviembre;?></td>
          <td class="align-middle text-center <?=$color_diciembre;?> <?=$txt_color_diciembre;?>" style="font-size: .8em;padding: 10px;"><?=$txt_diciembre;?></td>
          <td class="align-middle text-center">
             <a onclick="EditarM(<?=$row_mantenimiento_lista['idreporte'];?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
            <img src="<?php echo RUTA_IMG_ICONOS."edit-black-16.png"; ?>">
            </a>
          </td>
          <td class="align-middle text-center">
             <a onclick="EliminarM(<?=$row_mantenimiento_lista['idreporte'];?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
            <img src="<?php echo RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>">
            </a>
          </td>

       
        </tr>
        <?php
        }

      }else{
        echo "<tr><td colspan='15'>
        <div class='text-center mt-1'><small>No se encontró información, de clic en el siguiente botón para crear el Programa anual de mantenimiento</small></div> 
        <div class='text-center'> <button type='button' class='btn btn-secondary btn-sm mt-3 mb-1' onclick='BtnAgregar()'>Agregar equipo o instalación</button> </div>
        </td></tr>";
      }
?>
  </table>
  </div>

  