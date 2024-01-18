<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

function NomUsuario($id, $con){
  $sql_lista = "SELECT * FROM tb_usuarios WHERE id = '".$id."' ";
  $result_lista = mysqli_query($con, $sql_lista);
  $numero_lista = mysqli_num_rows($result_lista);
  while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
  $nombre = $row_lista['nombre']; 
  }
  return $nombre;
  }

  function Formato12($id,$con){
  $sql = "SELECT * FROM tb_requisicion_obra_formato_12 WHERE id_requisicion = '".$id."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  if ($numero == 0) {
  $img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
  }else{
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $idFormato = $row['id'];
  }
  $img ="<a onclick='DescargarARTP(".$idFormato.")'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
  }
  return $img;
  }

  function Formato14($id,$con){
  $sql_formato14 = "SELECT * FROM tb_requisicion_obra_formato_14 WHERE id_requisicion = '".$id."' ";
  $result_formato14 = mysqli_query($con, $sql_formato14);
  $numero_formato14 = mysqli_num_rows($result_formato14);
  if ($numero_formato14 == 0) {
  $imgArchivo14 = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
  }else{
  while($row_formato14 = mysqli_fetch_array($result_formato14, MYSQLI_ASSOC)){
  $urlArchivo14 = $row_formato14['archivo'];
  }
  $imgArchivo14 ="<a target='BLANK' href='".SERVIDOR.$urlArchivo14."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
  }
  return $imgArchivo14;
  }

  function Formato15($id,$con){
  $sql = "SELECT * FROM tb_requisicion_obra_formato_15 WHERE id_requisicion = '".$id."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  if ($numero == 0) {
  $img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
  }else{
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $idFormato = $row['id'];
  }
  $img ="<a onclick='DescargarLV(".$idFormato.")'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
  }
  return $img;
  }

  function CartaR($id,$con){
  $sql = "SELECT * FROM tb_requisicion_obra_carta_responsiva WHERE id_requisicion = '".$id."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  if ($numero == 0) {
  $img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
  }else{
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $id = $row['id'];
  }
  $img ="<a onclick='DescargarCR(".$id.")'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
  }
  return $img;
  }

?>
<h4>12. SEGURIDAD DE CONTRATISTAS</h4>
<?php 

$sql_lista = "SELECT * FROM tb_requisicion_obra WHERE id_estacion = '".$Session_IDEstacion."' AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);

echo '<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
<thead>
<th class="text-center">Folio</th>
<th>Fecha</th>
<th>Solicitante</th>
<th class="text-center">Fo.ADMONGAS.012</th>
<th class="text-center">Fo.ADMONGAS.0013</th>
<th class="text-center">Fo.ADMONGAS.014</th>
<th class="text-center">Fo.ADMONGAS.015</th>
<th class="text-center">Carta responsiva</th>
</thead>
<tbody>';
if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$id = $row_lista['id'];
$fechahora = explode(" ", $row_lista['fecha']);

echo '<tr>
<td class="text-center"><b>0'.$row_lista['no_folio'].'</b></td>
<td>'.FormatoFecha($fechahora[0]).'</td>
<td>'.NomUsuario($row_lista['id_usuario'], $con).'</td>
<td class="text-center">'.Formato12($id,$con).'</td>
<td class="text-center"><a onclick="DescargarF13('.$id.')"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></td>
<td class="text-center">'.Formato14($id,$con).'</td>
<td class="text-center">'.Formato15($id,$con).'</td>
<td class="text-center">'.CartaR($id,$con).'</td>
</tr>';
}
}else{
echo "<tr><td colspan='8' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
}
echo '</tbody>
</table>';

?>
<hr>