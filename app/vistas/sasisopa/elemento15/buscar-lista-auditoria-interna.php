<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Auditoria.php";

$class_auditoria = new Auditoria();

$sql_auditoria = "SELECT * FROM tb_auditoria_interna WHERE id_estacion= '".$Session_IDEstacion."' ORDER BY id desc ";
$result_auditoria = mysqli_query($con, $sql_auditoria);
$numero_auditoria = mysqli_num_rows($result_auditoria);

?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<th class="text-center">#</th>
<th class="text-center">Fecha</th>
<th class="text-center">Auditor</th>
<th class="text-center" colspan="3">Fo.ADMONGAS.024 <small>(INFORME DE AUDITORÍA)</small></th>
<th class="text-center" >Anexos</th>
<th class="text-center" colspan="3">Fo.ADMONGAS.025 <small>(PLAN DE ATENCIÓN DE HALLAZGOS)</small></th>
<th class="text-center" >Anexos</th>
</thead>
<tbody>
<?php
if ($numero_auditoria > 0) {
while($row_auditoria = mysqli_fetch_array($result_auditoria, MYSQLI_ASSOC)){
$id = $row_auditoria['id'];
$fechahora = explode(" ", $row_auditoria['fechacreacion']);

$formato024 = $class_auditoria->formatos($id, 'formato024');
$formato025 = $class_auditoria->formatos($id, 'formato025');

if ($formato024 != "") {
$F024 = "<a target='_BLANK' href='".$formato024."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";	
}else{
$F024 = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";	
}

if ($formato025 != "") {
$F025 = "<a target='_BLANK' href='".$formato025."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";	
}else{
$F025 = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";	
}
 
echo "<tr>";
echo "<td class='text-center align-middle' id='td1".$id."'>".$id."</td>";
echo "<td class='text-center align-middle' id='td2".$id."'>".FormatoFecha($fechahora[0])."</td>";
echo "<td class='text-center align-middle' id='td3".$id."'>".$row_auditoria['auditor']."</td>";

echo "<td class='text-center align-middle' id='td4".$id."'><a href='".RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.024.doc' download><img src='".RUTA_IMG_ICONOS."descargar.png'></a></td>";
echo "<td class='text-center align-middle' id='td5".$id."'><a class='c-pointer' onclick='Modal024(".$id.")'><img src='".RUTA_IMG_ICONOS."subir.png'></a></td>";
echo "<td class='text-center align-middle' id='td6".$id."'>".$F024."</td>";
echo "<td class='text-center align-middle' id='td10".$id."'><a class='c-pointer' onclick='ModalAnexo(".$id.",24)'><img src='".RUTA_IMG_ICONOS."documento.png'></a></td>";

echo "<td class='text-center align-middle' id='td7".$id."'><a href='".RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.025.docx' download><img src='".RUTA_IMG_ICONOS."descargar.png'></a></td>";
echo "<td class='text-center align-middle' id='td8".$id."'><a class='c-pointer' onclick='Modal025(".$id.")'><img src='".RUTA_IMG_ICONOS."subir.png'></a></td>";
echo "<td class='text-center align-middle' id='td9".$id."'>".$F025."</td>";
echo "<td class='text-center align-middle' id='td11".$id."'><a class='c-pointer' onclick='ModalAnexo(".$id.",25)'><img src='".RUTA_IMG_ICONOS."documento.png'></a></td>";
echo "</tr>";

}
}else{
echo "<tr><td colspan='11' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>
</div>