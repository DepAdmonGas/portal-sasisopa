<?php
require('../../../app/help.php');


function validaDocumento($id,$idEstacion,$con){

$sql_lista = "SELECT archivo FROM sgm_control_documental WHERE id_documento = '".$id."' AND id_estacion = '".$idEstacion."'  ORDER BY fecha DESC LIMIT 1";
  $result_lista = mysqli_query($con, $sql_lista);
	$numero_lista = mysqli_num_rows($result_lista);
  if($numero_lista > 0){
  	$row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC);
  	$array = array('total' => $numero_lista, 'archivo' => $row_lista['archivo']);
  }else{
  	$array = array('total' => 0, 'archivo' => 0);
  }
  
  return $array;
}


function listaDocumentos($idEstacion,$seccion,$con){

$contenido = '';
if($seccion == 3){

$sql = "SELECT * FROM sgm_documentos WHERE seccion = '".$seccion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$contenido .= '<table class="table table-sm table-bordered table-hover">';
$contenido .= '<tbody>';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$validaDocumento = validaDocumento($row['id'],$idEstacion,$con);

$documento = ($validaDocumento['total'] == 0) ? '<img src="'.RUTA_IMG_ICONOS.'eliminar.png">' : '<a href="'.RUTA_ARCHIVOS_SGM.$validaDocumento['archivo'].'" download><img src="'.RUTA_IMG_ICONOS.'descargar.png"></a>';

$contenido .= '<tr>
<td>'.$row['nombre'].'</td>
<td width="35"><a onclick="modalDocumento('.$idEstacion.','.$row['id'].')"><img src="'.RUTA_IMG_ICONOS.'subir.png"></a></td>
<td width="35">'.$documento.'</td>
</tr>';
}
$contenido .= '</tbody>';
$contenido .= '</table>';

}else{

$sql = "SELECT * FROM sgm_documentos WHERE seccion = '".$seccion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$titulo = ($seccion == 1) ? 'Manual de procedimientos del Sistema de Gestión de Medición
' : 'Formatos del Sistema de Gestión de Medición';

$contenido .= '<table class="table table-sm table-bordered table-hover">';
$contenido .= '<thead>
<tr>
<th class="text-center bg-light" colspan="6">'.$titulo.'</th>
</tr>
<tr>
<th>#</th>
<th>Codificación</th>
<th>Nombre</th>
<th>Fecha de aprobación</th>
<th width="35"><img src="'.RUTA_IMG_ICONOS.'subir.png"></th>
<th width="35"><img src="'.RUTA_IMG_ICONOS.'descargar.png"></th>
</tr>
</thead>';
$contenido .= '<tbody>';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$validaDocumento = validaDocumento($row['id'],$idEstacion,$con);

$documento = ($validaDocumento['total'] == 0) ? '<img src="'.RUTA_IMG_ICONOS.'eliminar.png">' : '<a href="'.RUTA_ARCHIVOS_SGM.$validaDocumento['archivo'].'" download><img src="'.RUTA_IMG_ICONOS.'descargar.png"></a>';

$contenido .= '<tr>
<td><b>'.$row['id'].'</b></td>
<td>'.$row['codificacion'].'</td>
<td>'.$row['nombre'].'</td>
<td>'.FormatoFecha($row['fecha_aprobacion']).'</td>
<td><a onclick="modalDocumento('.$idEstacion.','.$row['id'].')"><img src="'.RUTA_IMG_ICONOS.'subir.png"></a></td>
<td>'.$documento.'</td>
</tr>';
}
$contenido .= '</tbody>';
$contenido .= '</table>';

}

return $contenido;
}

echo listaDocumentos($_GET['idEstacion'],3,$con);
echo listaDocumentos($_GET['idEstacion'],1,$con);
echo listaDocumentos($_GET['idEstacion'],2,$con);
?>

