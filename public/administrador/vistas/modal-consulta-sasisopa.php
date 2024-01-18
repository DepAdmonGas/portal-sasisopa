<?php 
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];

  $sql_lista = "SELECT * FROM tb_sasisopa WHERE id_estacion = '".$idEstacion."' ORDER BY id DESC ";
  $result_lista = mysqli_query($con, $sql_lista);
  $numero_lista = mysqli_num_rows($result_lista);
?>

<div class="row">
  



  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-2">
  <div class="mb-1">
    <small class="text-secondary">Versión:</small>
    <input type="text" class="form-control rounded-0" id="version">

  </div>  
  </div>

  <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mb-2">
 
  <div class="mb-1"><small class="text-secondary">Documento:</small></div>
  <input type="file" id="documento">


  <button type="button" class="btn btn-primary btn-sm float-right ml-3" style="border-radius: 0;font-size: .9em;" onclick="GuardarSasisopa(<?=$idEstacion;?>)">Guardar</button>

  </div>
 
 </div>
 
  <hr>

  <div class="12" style="overflow-y: hidden;">
  <table class="table table-bordered table-striped table-sm" style="font-size: 0.9em;">
  <thead> 
  <tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Versión</th>
  <th class="text-center align-middle" width="16px"><img src="<?=RUTA_IMG_ICONOS."pdf-16.png"; ?>"></th>
  <th class="text-center align-middle" width="16px"><img src="<?=RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></th>
  </tr>
  </thead>
  <tbody>
  <?php
 
  if ($numero_lista > 0) {
  while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
  $id = $row_lista['id'];
  echo '<tr>';
  echo '<td class="text-center">'.$row_lista['id'].'</td>';
  echo '<td class="text-center">'.$row_lista['version'].'</td>';
  echo '<td class="text-center align-middle"><a href="'.$row_lista['documento'].'" download><img src="'.RUTA_IMG_ICONOS.'pdf-16.png"></a></td>';
   echo '<td class="text-center align-middle"><a onclick="Eliminar('.$id.','.$idEstacion.')"><img src="'.RUTA_IMG_ICONOS.'eliminar-red-16.png"></a></td>';
  echo '</tr>';


  }
  }else{
  echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
  }
  ?>
  </tbody>
  </table>
  </div>

</div>

<?php

//------------------
mysqli_close($con);
//------------------
