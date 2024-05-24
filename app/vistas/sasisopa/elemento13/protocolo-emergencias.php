<?php
require('../../../../app/help.php');

$sql_protocolo = "SELECT * FROM tb_protocolo_emergencias WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY fechacreacion desc";
$result_protocolo = mysqli_query($con, $sql_protocolo);
$numero_protocolo = mysqli_num_rows($result_protocolo);

?>

<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm mt-2">
<thead>
<th class="text-center align-middle">Fecha elaboración</th>
<th class="text-center align-middle" width="50px" style="font-size: .8em;">PDF</th>
<th class="text-center align-middle" width="50px" style="font-size: .8em;">Anexo</th>
<th class="text-center align-middle" width="50px" style="font-size: .8em;">Editar</th>
<th class="text-center align-middle" width="50px" style="font-size: .8em;">Eliminar</th>
</thead>	
<tbody>
<?php
if ($numero_protocolo > 0) {
while($row_protocolo = mysqli_fetch_array($result_protocolo, MYSQLI_ASSOC)){
$id = $row_protocolo['id'];

if($row_protocolo['archivo'] != ""){
    $imgPDF = "<a target='_blank' href='".$row_protocolo['archivo']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";	
    }else{
    $imgPDF = "<img src='".RUTA_IMG_ICONOS."eliminar-red-16.png'>";
    }

echo "<tr>";
echo "<td class='text-center align-middle'>".FormatoFecha($row_protocolo['fechacreacion'])."</td>";
echo "<td class='text-center align-middle'>".$imgPDF."</td>";
echo "<td class='text-center align-middle' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."ojo-black-16.png' onclick='anexos(".$id.")'></td>";
echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' onclick='editarprotocolo(".$id.")'></td>";
echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='eliminarprotocolo(".$id.")'></td>";
echo "</tr>";
}
}else{
echo "<tr><td colspan='4' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>
</div>

<?php
//------------------
mysqli_close($con);
//------------------
?>