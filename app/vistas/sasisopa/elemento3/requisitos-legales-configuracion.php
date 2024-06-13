<?php
require('../../../../app/help.php');
?>
    <div class="row">
    <?php
    $sql = "SELECT id, gobierno FROM rl_requisitos_legales_gobierno WHERE (id_estacion = '".$Session_IDEstacion."' OR id_estacion = 0) AND estado = 1 ORDER BY id ASC ";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

    if($row['gobierno'] == "Municipal"){
    $NG = ' AND mun_alc_est = "'.$Session_DiMunicipio.'" ';
    }else if($row['gobierno'] == "Estatal"){
    $NG = ' AND mun_alc_est = "'.$Session_DiEstado.'" ';
    }else if($row['gobierno'] == "Federal"){
    $NG = '';
    }else if($row['gobierno'] == "Varios"){
    $NG = '';
    }

    $sql_RL = "SELECT id, dependencia, permiso, fundamento FROM rl_requisitos_legales_lista WHERE nivel_gobierno = '".$row['gobierno']."' $NG AND (id_estacion = '".$Session_IDEstacion."' OR id_estacion = 0) AND estado = 1 ORDER BY dependencia ASC ";
    $result_RL = mysqli_query($con, $sql_RL);
    $numero_RL = mysqli_num_rows($result_RL);

    echo 
    '<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-1 p-2">   
    <div class="bg-white border-0">
    <div class="p-2 bg-light">
    <div class="float-left"><h5>'.$row['gobierno'].'</h5></div>
    <div class="float-right">
    <a onclick="ModalPermiso(\''.$row['gobierno']. '\')"><img src="'.RUTA_IMG_ICONOS.'agregar.png"></a>
    </div>
    <br>
    </div>
    ';
    echo '<div class="p-3">';
    echo  '<div style="overflow-y: hidden;">';
    echo '<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0">';
    echo '<thead><tr>
    <th>Dependencia</th>
    <th>Permiso</th>
    <th width="400px">Fundamento</th>
    <td class="text-center align-middle"><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></td>
    </tr></thead>';
    while($row_RL = mysqli_fetch_array($result_RL, MYSQLI_ASSOC)){
    	$id = $row_RL['id'];
      if($row_RL['dependencia'] == ""){
        $dependencia = "S/I";
      }else{
      $dependencia = $row_RL['dependencia'];
      }

    echo '<tr>
    <td class="align-middle">'.$dependencia.'</td>
    <td class="align-middle"><b>'.$row_RL['permiso'].'</b></td>
    <td class="align-middle"><small>'.$row_RL['fundamento'].'</small></td>
    <td class="text-center align-middle" style="cursor: pointer;"><img src="'.RUTA_IMG_ICONOS.'eliminar.png" onclick="EliminarRL('.$id.')"></td>
			
    </tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '</div></div></div>';
    }
    ?>      
    </div>