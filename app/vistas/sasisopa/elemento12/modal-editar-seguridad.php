<?php
require('../../../../app/help.php');

function NomUsuario($id, $con){
$sql_lista = "SELECT nombre FROM tb_usuarios WHERE id = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
$row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC);
$nombre = $row_lista['nombre'];  
return $nombre;
}

$sql_lista = "SELECT * FROM tb_requisicion_obra WHERE id = '".$_GET['id']."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
$row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC);
$NumFolio = "0".$row_lista['no_folio'];
$fechahora = explode(" ", $row_lista['fecha']);
$fecha = $fechahora[0];
$NombreUsuario = NomUsuario($row_lista['id_usuario'], $con);
$descripcion = $row_lista['descripcion'];
$justificacion = $row_lista['justificacion'];

?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Editar requisición de obra o servicio
</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

  <div class="row mt-2">

  <div class="col-12 col-md-4">
  <div class="mb-2">
    <small class="text-secondary">No. De folio:</small>
  </div>

  <input class="form-control input-style rounded-0 border-0" value="<?=$NumFolio;?>" type="text" id="folio" disabled>        
  </div>

  <div class="col-12 col-md-8">
  <div class="mb-2"><small class="text-secondary">Fecha:</small></div>
  <input class="form-control input-style rounded-0" value="<?=$fecha;?>" type="date" id="EditFecha">  
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
    <textarea class="form-control rounded-0" id="EditDescripcion"><?=$descripcion;?></textarea>    
  </div>

  </div>

  <div class="row mt-2">
  <div class="col-12 col-md-12">
  <div class="mb-2"><small class="text-secondary">Justificacion del servicio solicitado:</small></div>
  <textarea class="form-control rounded-0" id="EditJustificacion"><?=$justificacion;?></textarea>  
  </div>
  </div>

</div>

 <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnEditarServicio(<?=$_GET['id'];?>)">Editar</button>
        </div>