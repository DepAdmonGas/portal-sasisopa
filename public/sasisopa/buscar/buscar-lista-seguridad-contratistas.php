<?php
require('../../../app/help.php');

$sql_lista = "SELECT * FROM tb_requisicion_obra WHERE id_estacion = '".$Session_IDEstacion."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);

function NomUsuario($id, $con){

$sql_lista = "SELECT * FROM tb_usuarios WHERE id = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$nombre = $row_lista['nombre'];	
}
return $nombre;
}

function Porcentaje($id,$con){
$sum1 = 1;

$sql_formato12 = "SELECT * FROM tb_requisicion_obra_formato_12 WHERE id_requisicion = '".$id."' ";
$result_formato12 = mysqli_query($con, $sql_formato12);
$numero_formato12 = mysqli_num_rows($result_formato12);

if ($numero_formato12 != 0) {
$sum2 = 1;
}

//--------------------------------------------------------------------------------------------------------

$sql_carta_r = "SELECT * FROM tb_requisicion_obra_carta_responsiva WHERE id_requisicion = '".$id."' ";
$result_carta_r = mysqli_query($con, $sql_carta_r);
$numero_carta_r = mysqli_num_rows($result_carta_r);

if ($numero_carta_r != 0) {
$sum3 = 1;
}
//---------------------------------------------------------------------------------
$sql_formato14 = "SELECT * FROM tb_requisicion_obra_formato_14 WHERE id_requisicion = '".$id."' ";
$result_formato14 = mysqli_query($con, $sql_formato14);
$numero_formato14 = mysqli_num_rows($result_formato14);

if ($numero_formato14 != 0) {
$sum4 = 1;
}
//---------------------------------------------------------------------------------
$sql_formato15 = "SELECT * FROM tb_requisicion_obra_formato_15 WHERE id_requisicion = '".$id."' ";
$result_formato15 = mysqli_query($con, $sql_formato15);
$numero_formato15 = mysqli_num_rows($result_formato15);

if ($numero_formato15 != 0) {
$sum5 = 1;
}

$Suma = $sum1 + $sum2 + $sum3 + $sum4 + $sum5;
$Porcentaje = $Suma * 20;

$resultado = '<div class="progress">
 <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: '.$Porcentaje.'%" aria-valuenow="'.$Porcentaje.'" aria-valuemin="0" aria-valuemax="100">'.$Porcentaje.'%</div>
</div>';
return $resultado;
}

function Formato14($id,$con){
$sql_formato14 = "SELECT * FROM tb_requisicion_obra_formato_14 WHERE id_requisicion = '".$id."' ";
$result_formato14 = mysqli_query($con, $sql_formato14);
$numero_formato14 = mysqli_num_rows($result_formato14);

if ($numero_formato14 == 0) {
$imgArchivo14 = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
}else{
while($row_formato14 = mysqli_fetch_array($result_formato14, MYSQLI_ASSOC)){
$urlArchivo14 = $row_formato14['archivo'];
}
$imgArchivo14 ="<a target='BLANK' href='".SERVIDOR.$urlArchivo14."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}

return $imgArchivo14;

}

function CartaR($id,$con){
$sql = "SELECT * FROM tb_requisicion_obra_carta_responsiva WHERE id_requisicion = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

if ($numero == 0) {
$img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
}else{
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$id = $row['id'];
}
$img ="<a onclick='DescargarCR(".$id.")'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}

return $img;

}

function Formato15($id,$con){
$sql = "SELECT * FROM tb_requisicion_obra_formato_15 WHERE id_requisicion = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

if ($numero == 0) {
$img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
}else{
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$idFormato = $row['id'];
}
$img ="<a onclick='DescargarLV(".$idFormato.")'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}

return $img;

}

function Formato12($id,$con){
$sql = "SELECT * FROM tb_requisicion_obra_formato_12 WHERE id_requisicion = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

if ($numero == 0) {
$img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
}else{
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$idFormato = $row['id'];
}
$img ="<a onclick='DescargarARTP(".$idFormato.")'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}

return $img;

}

?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<th class="text-center">Folio</th>
<th>Fecha</th>
<th>Solicitante</th>
<th class="text-center" colspan="2">Fo.ADMONGAS.012</th>
<th class="text-center" >Fo.ADMONGAS.0013</th>
<th class="text-center" colspan="2">Fo.ADMONGAS.014</th>
<th class="text-center" colspan="2">Fo.ADMONGAS.015</th>
<th class="text-center" colspan="2">Carta responsiva</th>
<th width="24px"></th>
<th width="24px"></th>
</thead>
<tbody>
<?php 
if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];
$fechahora = explode(" ", $row_lista['fecha']);

if ($row_lista['estado'] == 1) {
$estado = '<span class="badge badge-secondary">Pendiente</span>';
}else{
$estado = '<span class="badge badge-success">Finalizado</span>';	
}

?>
<tr style="cursor: pointer;">
<td id="td1-<?=$id;?>" class="align-middle text-center" onclick="Modaldetalle(<?=$id;?>)"><b><?="0".$row_lista['no_folio'];?></b></td>
<td id="td2-<?=$id;?>" class="align-middle" onclick="Modaldetalle(<?=$id;?>)"><?=FormatoFecha($fechahora[0]);?></td>
<td id="td3-<?=$id;?>" class="align-middle" onclick="Modaldetalle(<?=$id;?>)"><?=NomUsuario($row_lista['id_usuario'], $con);?></td>

<td class="text-center" width="100px"><a onclick="ModalAutorizacion(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></td>
<td class="text-center" width="100px"><?=Formato12($id,$con);?></td>

<td class="align-middle text-center" width="24px"><a onclick="Descargar(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>


<td class="text-center" width="100px"><a onclick="ModalFormato(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></td>
<td class="text-center" width="100px"><?=Formato14($id,$con);?></td>

<td class="text-center" width="100px"><a onclick="ModalFormato15(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></td>
<td class="text-center" width="100px"><a onclick=""><?=Formato15($id,$con);?></a></td>

<td class="text-center" width="100px"><a onclick="CartaResponsiva(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></td>
<td class="text-center" width="100px"><?=CartaR($id,$con);?></td>

<td class="text-center"><a onclick="ModalEditar(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."editar.png"; ?>"></a></td>
<td class="align-middle text-center"><a onclick="Eliminar(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."eliminar.png"; ?>"></a></td>
</tr>
<?php        
}
}else{
echo "<tr><td colspan='14' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>
</div>