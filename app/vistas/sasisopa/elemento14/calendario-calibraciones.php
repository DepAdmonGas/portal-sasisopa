<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/MonitoreoVerificacionEvaluacion.php";
$class_monitoreo_evaluacion = new MonitoreoVerificacionEvaluacion();

?>
<div class="text-right" style="margin-top: 6px;">
    <a onclick="DescargarCalendario()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>
    </div>

       <table class="table table-bordered table-sm mt-2 mb-2" style="font-size: .9em;">
      <tr>
      <td class="text-center align-middle"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 150px;"></td>
      <td colspan="2" class="text-center align-middle"><b>Calendario de calibraciones</b></td>
      <td class="text-center align-middle">Fo.ADMONGAS.020</td>
      </tr>
      <tr>
      <td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
      <td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
      <td class="text-center align-middle">Autorizado por: <?=$Session_ApoderadoLegal;?> </td>
      <td class="text-center align-middle">Fecha de autorizacion 01/10/2018</td>
      </tr>
      </table> 

        <table class="table table-bordered table-sm mt-2 mb-2" style="font-size: .9em;">
        <thead>
          <tr>
            <th class="text-center align-middle">Número de identificación</th>
            <th class="text-center align-middle">Nombre del equipo</th>
            <th class="text-center align-middle">Frecuencia de la calibración</th>
            <th class="text-center align-middle">Ene</th>
            <th class="text-center align-middle">Feb</th>
            <th class="text-center align-middle">Mar</th>
            <th class="text-center align-middle">Abr</th>
            <th class="text-center align-middle">May</th>
            <th class="text-center align-middle">Jun</th>
            <th class="text-center align-middle">Jul</th>
            <th class="text-center align-middle">Ago</th>
            <th class="text-center align-middle">Sep</th>
            <th class="text-center align-middle">Oct</th>
            <th class="text-center align-middle">Nov</th>
            <th class="text-center align-middle">Dic</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $sql_lista = "SELECT * FROM tb_calibracion_equipos WHERE id_estacion = '".$Session_IDEstacion."' AND categoria = 1 ORDER BY fecha DESC ";
        $result_lista = mysqli_query($con, $sql_lista);
        $numero_lista = mysqli_num_rows($result_lista);
        $i = 1;
        if ($numero_lista > 0) {
        while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

        if($row_lista['equipo'] == 'Dispensario'){
        $Frecuencia = 'Semestral';
        }else if($row_lista['equipo'] == 'Jarra patron'){
        $Frecuencia = 'Anual';
        }else if($row_lista['equipo'] == 'Tanques'){
        $Frecuencia = '10 años';
        }else if($row_lista['equipo'] == 'Sondas de medición'){
        $Frecuencia = '2 años';
        }else if($row_lista['equipo'] == 'Tanques de almacenamiento'){
        $Frecuencia = '10 años';
        }

        $explode = explode('-', $row_lista['fecha']);
        $Year = $explode[0];
        $Mes = $explode[1];

        $Ene = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 1,$row_lista['estado']);
        $Feb = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 2,$row_lista['estado']);
        $Mar = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 3,$row_lista['estado']);
        $Abr = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 4,$row_lista['estado']);
        $May = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 5,$row_lista['estado']);
        $Jun = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 6,$row_lista['estado']);
        $Jul = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 7,$row_lista['estado']);
        $Ago = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 8,$row_lista['estado']);
        $Sep = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 9,$row_lista['estado']);
        $Oct = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 10,$row_lista['estado']);
        $Nov = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 11,$row_lista['estado']);
        $Dic = $class_monitoreo_evaluacion->yearCol($Year, intval($Mes), 12,$row_lista['estado']);

        echo '<tr>';
        echo '<td class="align-middle text-center">'.$i.'</td>';
        echo '<td class="align-middle text-center">'.$row_lista['equipo'].'</td>';
        echo '<td class="align-middle text-center">'.$Frecuencia.'</td>';
        echo '<td class=" align-middle '.$Ene['Col'].'">'.$Ene['Year'].'</td>';
        echo '<td class=" align-middle '.$Feb['Col'].'">'.$Feb['Year'].'</td>';
        echo '<td class=" align-middle '.$Mar['Col'].'">'.$Mar['Year'].'</td>';
        echo '<td class=" align-middle '.$Abr['Col'].'">'.$Abr['Year'].'</td>';
        echo '<td class=" align-middle '.$May['Col'].'">'.$May['Year'].'</td>';
        echo '<td class=" align-middle '.$Jun['Col'].'">'.$Jun['Year'].'</td>';
        echo '<td class=" align-middle '.$Jul['Col'].'">'.$Jul['Year'].'</td>';
        echo '<td class=" align-middle '.$Ago['Col'].'">'.$Ago['Year'].'</td>';
        echo '<td class=" align-middle '.$Sep['Col'].'">'.$Sep['Year'].'</td>';
        echo '<td class=" align-middle '.$Oct['Col'].'">'.$Oct['Year'].'</td>';
        echo '<td class=" align-middle '.$Nov['Col'].'">'.$Nov['Year'].'</td>';
        echo '<td class=" align-middle '.$Dic['Col'].'">'.$Dic['Year'].'</td>';
        echo '</tr>';

        $i++;
        }
        }else{
        echo "<td colspan='16' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
        }
        ?>

        </tbody>
      </table>