<?php 
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];
$id = $_GET['id'];

$sql = "SELECT * FROM sgm_documentos WHERE id = '".$_GET['id']."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$codificacion = $row['codificacion'];
$nombre = $row['nombre'];

$sql_lista = "SELECT * FROM sgm_control_documental WHERE id_documento = '".$id."' AND id_estacion = '".$idEstacion."'  ORDER BY fecha DESC ";
  $result_lista = mysqli_query($con, $sql_lista);
  $numero_lista = mysqli_num_rows($result_lista);
?>
<h5><?=$codificacion.' '.$nombre;?></h5>

<div class="row">

  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2">
  <div class="mb-1"><small class="text-secondary">Documento:</small></div>
  <input type="file" id="documento">
  <button type="button" class="btn btn-primary btn-sm float-right ml-3" style="border-radius: 0;font-size: .9em;" onclick="GuardarDocumento(<?=$idEstacion;?>,<?=$id;?>)">Guardar documento</button>
  </div>
  </div>

<hr>

  <div class="12" style="overflow-y: hidden;">
  <table class="table table-bordered table-striped table-sm" style="font-size: 0.9em;">
  <thead> 
  <tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Fecha</th>
  <th class="text-center align-middle" width="16px"><img src="<?=RUTA_IMG_ICONOS."descargar.png"; ?>"></th>
  <th class="text-center align-middle" width="16px"><img src="<?=RUTA_IMG_ICONOS."eliminar.png"; ?>"></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $num = 1;
  if ($numero_lista > 0) {
  while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
  $idDocumento = $row_lista['id'];
  echo '<tr>';
  echo '<td class="text-center">'.$num.'</td>';
  echo '<td class="text-center">'.FormatoFecha($row_lista['fecha']).'</td>';
  echo '<td class="text-center align-middle"><a href="'.RUTA_ARCHIVOS_SGM.$row_lista['archivo'].'" download><img src="'.RUTA_IMG_ICONOS.'descargar.png"></a></td>';
   echo '<td class="text-center align-middle"><a onclick="Eliminar('.$id.','.$idEstacion.','.$idDocumento.')"><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></a></td>';
  echo '</tr>';
  $num++;
  }
  }else{
  echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
  }
  ?>
  </tbody>
  </table>
  </div>




<?php

//------------------
mysqli_close($con);
//------------------
