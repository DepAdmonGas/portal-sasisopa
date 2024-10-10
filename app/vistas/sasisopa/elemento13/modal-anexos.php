<?php
require('../../../../app/help.php');
$idProtocolo = $_GET['idProtocolo'];
?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Anexo protocolo de respuesta a emergencias
</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Nombre del Anexo:</small></div>
<input type="text" class="form-control rounded-0" id="NombreAnexo">

<div class="mb-2 mt-2"><small class="text-secondary">* Anexo:</small></div>

<div class="row">
<div class="col-10">
<input type="file" id="Anexo">
</div>
<div class="col-2">
<button type="button" class="btn btn-primary btn-sm border-0 rounded-0" onclick="AgegarAnexo(<?=$idProtocolo;?>)">Agregar anexo</button>
</div>
</div>
<div id="resultAnexo"></div>
<hr>

<?php
$sql_protocolo = "SELECT * FROM tb_protocolo_emergencias_anexo WHERE id_protocolo = '".$idProtocolo."' ORDER BY nombre_anexo asc";
$result_protocolo = mysqli_query($con, $sql_protocolo);
$numero_protocolo = mysqli_num_rows($result_protocolo);

?>
<table class="table table-bordered table-striped table-hover table-sm mt-2">
<thead>
<tr class="bg-primary text-white">
<th>Nombre</th>
<th>Fecha elaboración</th>
<th class="text-center" width="50px" style="font-size: .8em;">PDF</th>
<th class="text-center" width="50px" style="font-size: .8em;">Eliminar</th>
</tr>
</thead>	
<tbody>
<?php
if ($numero_protocolo > 0) {
while($row_protocolo = mysqli_fetch_array($result_protocolo, MYSQLI_ASSOC)){
$id = $row_protocolo['id'];
$imgPDF = "<a target='_blank' href='".$row_protocolo['archivo']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
$fechaHora = explode(" ", $row_protocolo['fechacreacion']);

echo "<tr>";
echo "<td>".$row_protocolo['nombre_anexo']."</td>";
echo "<td>".FormatoFecha($fechaHora[0])."</td>";
echo "<td class='text-center align-middle'>".$imgPDF."</td>";
echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='eliminaranexo(".$idProtocolo.",".$id.")'></td>";
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
