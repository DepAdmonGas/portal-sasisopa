<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/InvestigacionIncidentesAccidentes.php";

$class_incidentes_accidentes = new InvestigacionIncidentesAccidentes();
$sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente WHERE id_estacion= '".$Session_IDEstacion."' ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);

?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<th class="text-center">#</th>
<th class="text-center">Fecha</th>
<th class="text-center">Nombre</th>
<th class="text-center">Puesto</th>
<th class="text-center">Descripción evento</th>
<th class="text-center">Tipo evento</th>
<th class="text-center">Muertes</th>
<th class="text-center" colspan="2"><span class="badge badge-pill badge-primary">1</span> Grupo interdiciplinario</th>
<th class="text-center" colspan="3"><span class="badge badge-pill badge-primary">2</span> Fo.ADMONGAS.026</th>
<th class="text-center"><span class="badge badge-pill badge-primary">3</span> Tercer Autorizado</th>
<th class="text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>
</thead>
<tbody>
<?php
$i = 1;
if ($numero_inv > 0) {
while($row_inv = mysqli_fetch_array($result_inv, MYSQLI_ASSOC)){
$id = $row_inv['id'];
$fechahora = explode(" ", $row_inv['fechacreacion']);
$Usuario = $class_incidentes_accidentes->usuario($row_inv['id_usuario']);

$formato026 = $class_incidentes_accidentes->formatos($id);

if ($row_inv['muertes'] == 0) {
$muertes = "NO";
}else{
$muertes = "SI";
}

if ($row_inv['tercer_autorizado'] == 0) {

$ArcF026 = "<a href='".RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.026.docx' download><img src='".RUTA_IMG_ICONOS."descargar.png'></a>";
$AgrF026 = "<a class='c-pointer' onclick='Modal026(".$id.")'><img src='".RUTA_IMG_ICONOS."subir.png'></a>";

if ($formato026 != "") {
$F026 = "<a target='_BLANK' href='".$formato026."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$F026 = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";	
}

$Tercer = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
}else{

$ArcF026 = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
$AgrF026 = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
$F026 = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";	

$Tercer = "<a class='c-pointer' onclick='ModalTercerA(".$id.")'><img src='".RUTA_IMG_ICONOS."autorizado.png'></a>";	
}

$Grupo = $class_incidentes_accidentes->grupo($id);

if ($Grupo > 0) {
$ImgGrupo = "<img src='".RUTA_IMG_ICONOS."correcto-16.png'>";
}else{
$ImgGrupo = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
}

 
echo "<tr>";
echo "<td class='text-center align-middle'>".$i."</td>";
echo "<td class='text-center align-middle'>".FormatoFecha($fechahora[0])."</td>";
echo "<td class='text-center align-middle'>".$Usuario['nombre']."</td>";
echo "<td class='text-center align-middle'>".$Usuario['puesto']."</td>";
echo "<td class='text-center align-middle'>".$row_inv['descripcion']."</td>";
echo "<td class='text-center align-middle font-weight-bold'>".$row_inv['tipo_evento']."</td>";
echo "<td class='text-center align-middle font-weight-bold'>".$muertes."</td>";
echo "<td class='text-center align-middle font-weight-bold' id='td7".$id."'>".$ImgGrupo."</td>";
echo "<td class='text-center align-middle font-weight-bold'><a class='c-pointer' onclick='GrupoInterdiciplinario(".$id.")'><img src='".RUTA_IMG_ICONOS."grupo-interdiciplinario.png'></a></td>";
echo "<td class='text-center align-middle'>".$ArcF026."</td>";
echo "<td class='text-center align-middle'>".$AgrF026."</td>";
echo "<td class='text-center align-middle' id='td11".$id."'>".$F026."</td>";
echo "<td class='text-center align-middle font-weight-bold'>".$Tercer."</td>";
echo '<td class="text-center align-middle" width="20px" onclick="Eliminar('.$id.')"><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></td>';
echo "</tr>";

$i++;
}
}else{
echo "<tr><td colspan='14' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>
</div>