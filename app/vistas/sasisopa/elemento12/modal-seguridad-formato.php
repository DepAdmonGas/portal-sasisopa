<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/SeguridadContratistas.php";

$class_seguridad_contratistas = new SeguridadContratistas();

function NomUsuario($id, $con){

$sql_lista = "SELECT * FROM tb_usuarios WHERE id = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$nombre = $row_lista['nombre'];	
}
return $nombre;
}
 
$sql_lista = "SELECT * FROM tb_requisicion_obra WHERE id = '".$_GET['id']."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
$row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC);
$NumFolio = "0".$row_lista['no_folio'];
$fechahora = explode(" ", $row_lista['fecha']);
$fecha = FormatoFecha($fechahora[0]);
$NombreUsuario = NomUsuario($row_lista['id_usuario'], $con);
$descripcion = $row_lista['descripcion'];
$justificacion = $row_lista['justificacion'];

$formato_14 = $class_seguridad_contratistas->formato14($_GET['id']);
?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Fo. ADMONGAS.014
</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

  <div class="row mt-2">
  
  <div class="col-12 col-md-4">
  <div class="mb-2">
    <small class="text-secondary">No. De folio:</small>
  </div>
  
  <input class="form-control input-style rounded-0 border-0" value="<?=$NumFolio;?>" type="text" id="folio" disabled>  </div>

  <div class="col-12 col-md-8">
  <div class="mb-2"><small class="text-secondary">Fecha:</small></div>
  <input class="form-control input-style rounded-0 border-0" value="<?=$fecha;?>" type="text" disabled>  
  </div>

  </div>

  <div class="row mt-2">
  <div class="col-12 col-md-4">
  <div class="mb-2"><small class="text-secondary">Nombre del solicitante:</small></div>
  <input class="form-control input-style rounded-0 border-0" value="<?=$NombreUsuario;?>" type="text" disabled>        
  </div>
  <div class="col-12 col-md-8">
  <div class="mb-2"><small class="text-secondary">Empresa solicitante:</small></div>
  <input class="form-control input-style rounded-0 border-0" value="<?=$Session_Razonsocial;?>" type="text" disabled>        
  </div>
  </div>

    <div class="row mt-2">
  <div class="col-12 col-md-12">
  <div class="mb-2"><small class="text-secondary">Descripcion detallada del servicio que requiere:</small></div>
  <div class="border p-2"><?=$descripcion;?></div>     
  </div>
  </div>

    <div class="row mt-2">
  <div class="col-12 col-md-12">
  <div class="mb-2"><small class="text-secondary">Justificacion del servicio solicitado:</small></div>
  <div class="border p-2"><?=$justificacion;?></div>   
  </div>
  </div>

 
  <div class="font-weight-bold border-bottom pb-2 mt-2">Entrega de información al contratista Fo. ADMONGAS.014</div>
<div class="pt-1 pb-1"><small> Descarga el archivo, vacia la informacion que te solicita y adjunta el archivo en formato PDF.</small></div>
  
<div class="mt-2" style="overflow-y: hidden;">
  <table class="table table-bordered table-striped table-sm">
  <tr>

  <td class="align-middle text-center" width="24">
    <a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.014.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></a>
  </td> 

  <td class="align-middle text-center">
 
  <div class="row">

 <div class="col-12 mb-3">
  <input class="mt-2" type="file" style="font-size: .8em;" id="Archivoformato14">
</div>

 <div class="col-12">
  <button type="button" class="rounded-0 btn btn-success mb-2" style="font-size: .8em;" onclick="agregarFormato14(<?=$_GET['id'];?>)">Guardar archivo</button>
</div>
</div>

  </td>
  <td width="24" class="align-middle text-center"><?=$formato_14;?></td>
  </tr>
  </table>
</div>

  <div id="result"></div>

</div>