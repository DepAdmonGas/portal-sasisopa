<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/SeguridadContratistas.php";
$class_seguridad_contratistas = new SeguridadContratistas();

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

?>
<div class="text-end mb-3">
<a class="mr-2" onclick="btnAgregar()" style="cursor: pointer;">
<img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
</a>
</div>

<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0" id="table-seguridad-contratistas">
<thead>
<tr class="bg-primary text-white">
<th class="text-center">Folio</th>
<th class="align-middle">Fecha</th>
<th class="align-middle">Solicitante</th>
<th class="align-middle text-center" colspan="2">Fo.ADMONGAS.012</th>
<th class="align-middle text-center" >Fo.ADMONGAS.0013</th>
<th class="align-middle text-center" colspan="2">Fo.ADMONGAS.014</th>
<th class="align-middle text-center" colspan="2">Fo.ADMONGAS.015</th>
<th class="align-middle text-center" colspan="2">Carta responsiva</th>
<th class="text-center align-middle" width="35px"><i class="fas fa-ellipsis-v"></i></th>
</tr>
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

<td class="align-middle text-center" width="100px"><a onclick="ModalAutorizacion(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></td>
<td class="align-middle text-center" width="100px"><?=$class_seguridad_contratistas->formato12($id);?></td>

<td class="align-middle text-center" width="24px"><a onclick="Descargar(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>

<td class="align-middle text-center" width="100px"><a onclick="ModalFormato(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></td>
<td class="align-middle text-center" width="100px"><?=$class_seguridad_contratistas->formato14($id);?></td>

<td class="align-middle text-center" width="100px"><a onclick="ModalFormato15(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></td>
<td class="align-middle text-center" width="100px"><a onclick=""><?=$class_seguridad_contratistas->formato15($id,$con);?></a></td>

<td class="align-middle text-center" width="100px"><a onclick="CartaResponsiva(<?=$id;?>)"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></td>
<td class="align-middle text-center" width="100px"><?=$class_seguridad_contratistas->cartaResponsiva($id);?></td>

<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" onclick="ModalEditar(<?=$id;?>)"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
    <a class="dropdown-item" onclick="Eliminar(<?=$id;?>)"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
  </div>
  </div>
  </td>

</tr>
<?php        
}
}
?>
</tbody>
</table>