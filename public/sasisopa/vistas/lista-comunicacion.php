<?php
require('../../../app/help.php');

if($_GET['Year'] == 0){
$Query = " id_estacion = '".$Session_IDEstacion."' ORDER BY no_comunicacion desc ";
}else{
$Query = " id_estacion = '".$Session_IDEstacion."' AND YEAR(fecha) = '".$_GET['Year']."' ORDER BY no_comunicacion desc ";
}

$sql_comunicado = "SELECT * FROM se_comunicacion_i_e WHERE $Query ";
$result_comunicado = mysqli_query($con, $sql_comunicado);
$numero_comunicado = mysqli_num_rows($result_comunicado);


?>
<script type="text/javascript">
function BtnDetalle(id){
$('#myModalDetalle').modal('show');
$('#DivDetalle').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;' />");
$('#DivDetalle').load('public/sasisopa/vistas/detalle-comunicacion.php?idcomunicado='+id);  
}
</script>

<div class="mb-1" style="overflow-y: hidden;">
<table class="table table-bordered table-sm">
<tr>
<td class="text-center align-middle"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 200px;"></td>
<td colspan="2" class="text-center align-middle"><b>Registro de la atención y el seguimiento a la comunicación interna y externa.</b></td>
<td class="text-center align-middle">Fo.ADMONGAS.010</td>
</tr>
<tr>
<td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
<td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
<td class="text-center align-middle">Autorizado por: Tomas Tarno Quinzaños </td>
<td class="text-center align-middle">Fecha de autorizacion 01/10/2018</td>
</tr>
</table>
</div>

<div class="text-right mb-2">
	
	<a onclick="Descargar(<?=$_GET['Year']?>,<?=$Session_IDEstacion;?>,0)" style="cursor: pointer;">
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>

    <a onclick="ModalBuscar()" style="cursor: pointer;">
    <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
    </a>

    <a onclick="btnNuevo()" style="cursor: pointer;">
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
</div>

<div class="" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="font-size: .9em;">
<thead>	
<tr class="table-primary">
<th class="text-center align-middle">No.</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Tema a comunicar</th>
<th class="text-center align-middle">Encargado de la comunicación</th>
<th class="text-center align-middle">Tipo de comunicación</th>
<th class="text-center align-middle">Material utilizado para la comunicación</th>
<th class="text-center align-middle">Seguimiento de la comunicación</th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php
if ($numero_comunicado > 0) {
while($row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC)){


$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row_comunicado['encargado_comunicacion']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
}

echo "<tr style='cursor: pointer'>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$row_comunicado['no_comunicacion']."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".FormatoFecha($row_comunicado['fecha'])."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".substr($row_comunicado['tema'],0,60)."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$nomencargado."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$row_comunicado['tipo_comunicacion']."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$row_comunicado['material']."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$row_comunicado['seguimiento']."</td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."subir.png' style='cursor: pointer;' onclick='ModalEvidencia(".$row_comunicado['id'].")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='Descargar(".$_GET['Year'].",0,".$row_comunicado['id'].")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."editar.png' style='cursor: pointer;' onclick='Editar(".$row_comunicado['id'].")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='Eliminar(".$row_comunicado['id'].")'></td>";
echo "</tr>";
}
}else{
echo "<td colspan='10' class='text-center text-secondary' style='font-size: .8em;'>No se encontro comunicacion interna o externa</td>";
}
?>
</tbody>
</table>
</div>

 <div class="modal fade bd-example-modal-lg" id="myModalDetalle" data-backdrop="static">
 <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
 <div class="modal-content" style="border-radius: 0px;border: 0px;">

 <div id="DivDetalle"></div>  

 </div>
 </div>
 </div> 
	 					 		 		 	
