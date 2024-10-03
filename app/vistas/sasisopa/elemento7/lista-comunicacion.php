<?php
require('../../../../app/help.php');
require('../../../../app/modelo/ComunicacionParticipacionConsulta.php');

$class_comunicacion = new ComunicacionParticipacionConsulta();
$result_comunicado = $class_comunicacion->listaComunicacion($Session_IDEstacion,$_GET['Year']);
$numero_comunicado = mysqli_num_rows($result_comunicado);

?>

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

<div class="text-end mb-2">
    <?php if($_GET['Year'] != 0){ ?>
    <a class="mr-2" onclick="DescargarCompleto(<?=$_GET['Year']?>,<?=$Session_IDEstacion;?>,0)" style="cursor: pointer;">
    Reporte completo
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>
    <?php } ?>
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


<table class="table table-bordered table-striped table-sm pb-0 mb-0" style="font-size: .9em;" id="table-comunicacion-participacion-consulta">
<thead>	
<tr class="bg-primary text-white">
<th class="text-center align-middle">No.</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Tema a comunicar</th>
<th class="text-center align-middle">Encargado de la comunicación</th>
<th class="text-center align-middle">Tipo de comunicación</th>
<th class="text-center align-middle">Material utilizado para la comunicación</th>
<th class="text-center align-middle">Seguimiento de la comunicación</th>
<th class="text-center align-middle" width="35px"><i class="fas fa-ellipsis-v"></i></th>
</tr>
</thead>
<tbody>
<?php
if ($numero_comunicado > 0) {
while($row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC)){
$nomencargado = $row_comunicado['nombre'];

if($row_comunicado['asistencia'] == 0){
$Descargar = '<a class="dropdown-item" onclick="Descargar('.$_GET['Year'].',0,'.$row_comunicado['id'].')"><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>';
}else{
$Descargar = '<a class="dropdown-item" onclick="DescargarAsistencia('.$row_comunicado['asistencia'].')"><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>';  
}

echo "<tr style='cursor: pointer'>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$row_comunicado['no_comunicacion']."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".FormatoFecha($row_comunicado['fecha'])."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".substr($row_comunicado['tema'],0,60)."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$nomencargado."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$row_comunicado['tipo_comunicacion']."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$row_comunicado['material']."</td>";
echo "<td class='text-center align-middle' onclick='BtnDetalle(".$row_comunicado['id'].")'>".$row_comunicado['seguimiento']."</td>";

echo '<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
  <a class="dropdown-item" onclick="ModalEvidencia('.$row_comunicado['id'].')"><i class="fa-regular fa-file-zipper"></i> Evidencia</a>
  <a class="dropdown-item" onclick="Editar('.$row_comunicado['id'].')"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
  '.$Descargar.'
  <a class="dropdown-item" onclick="Eliminar('.$row_comunicado['id'].')"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
  </div>
  </div>
  </td>';

echo "</tr>";
}
}
?>
</tbody>
</table>

	 					 		 		 	
