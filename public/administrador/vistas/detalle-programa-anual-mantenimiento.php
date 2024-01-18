<?php
require('../../../app/help.php');
$year = date("Y");
$idReporte = $_GET['idReporte'];
$idEstacion = $_GET['idEstacion'];

$sql_estaciones = "SELECT * FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$permisocre = $row_estaciones['permisocre'];
$razonsocial = $row_estaciones['razonsocial'];
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

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-sm">
  
<tr>
    <td colspan="2" class="align-middle text-center">Permiso CRE: <b><?=$permisocre;?></b></b></td>
        <td colspan="2" class="align-middle text-center">Razón Social: <b><?=$razonsocial;?></b></td>


</tr>


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
          <td class="text-center font-weight-bold align-middle">#</td>
          <td class="text-center font-weight-bold align-middle">Equipo o instalación</td>
          <td class="text-center font-weight-bold align-middle">Enero</td>
          <td class="text-center font-weight-bold align-middle">Febrero</td>
          <td class="text-center font-weight-bold align-middle">Marzo</td>
          <td class="text-center font-weight-bold align-middle">Abril</td>
          <td class="text-center font-weight-bold align-middle">Mayo</td>
          <td class="text-center font-weight-bold align-middle">Junio</td>
          <td class="text-center font-weight-bold align-middle">Julio</td>
          <td class="text-center font-weight-bold align-middle">Agosto</td>
          <td class="text-center font-weight-bold align-middle">Septiembre</td>
          <td class="text-center font-weight-bold align-middle">Octubre</td>
          <td class="text-center font-weight-bold align-middle">Noviembre</td>
          <td class="text-center font-weight-bold align-middle">Diciembre</td>
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
                
        </tr>
        <?php
        }

      }else{
        echo "<tr><td colspan='15'>
        <div class='text-center mt-1'><small>No se encontró información para mostrar</small></div> 
        </td></tr>";
      }
?>
  </table>
</div>


  