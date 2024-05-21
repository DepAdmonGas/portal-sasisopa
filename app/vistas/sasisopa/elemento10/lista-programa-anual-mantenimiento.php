<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ControlActividadProceso.php";
$class_control_actividad_proceso = new ControlActividadProceso();

$year = date("Y");
$idReporte = $_GET['idReporte'];
$yearAnterior = $year - 1;
$class_control_actividad_proceso->validaMesAnterior($Session_IDEstacion,$idReporte,$yearAnterior);
?>
<!-- TABLA - APROBACION -->
<div class="mb-2" style="overflow-y: hidden;">

<table class="table table-bordered table-sm">
        <tr style="font-size: 1.2em;">
          <td class="align-middle text-center"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 300px;"></td>
          <td colspan="2" class="align-middle text-center font-weight-bold">Programa Anual de Mantenimiento </td>
          <td class="align-middle text-center font-weight-bold">Fo. ADMONGAS.011</td>
        </tr>
        <tr style="font-size: 1.2em;">
          <td class="align-middle text-center">Elaborado por: Nelly Estrada Garcia/Francisco Ibarra Alcántara </td>
          <td class="align-middle text-center">Revisado por: Eduardo Galicia Flores</td>
          <td class="align-middle text-center">Aprobado por: Tomas Tarno Quinzaños</td>
          <td class="align-middle text-center">Fecha de Aprobación 01-oct-18</td>
        </tr>
      </table>
</div>

  <div class="mb-2" style="overflow-y: hidden;">
  <table class="table table-bordered table-sm">
        <tr class="table-primary">
          <td class="text-center font-weight-bold">#</td>
          <td class="text-center font-weight-bold">Equipo o instalación</td>
          <td class="text-center font-weight-bold">Enero</td>
          <td class="text-center font-weight-bold">Febrero</td>
          <td class="text-center font-weight-bold">Marzo</td>
          <td class="text-center font-weight-bold">Abril</td>
          <td class="text-center font-weight-bold">Mayo</td>
          <td class="text-center font-weight-bold">Junio</td>
          <td class="text-center font-weight-bold">Julio</td>
          <td class="text-center font-weight-bold">Agosto</td>
          <td class="text-center font-weight-bold">Septiembre</td>
          <td class="text-center font-weight-bold">Octubre</td>
          <td class="text-center font-weight-bold">Noviembre</td>
          <td class="text-center font-weight-bold">Diciembre</td>
          <td class="text-center align-middle"><img src="<?php echo RUTA_IMG_ICONOS."edit-black-16.png"; ?>"></td>
          <td class="text-center align-middle"><img src="<?php echo RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></td>
        </tr>
<?php
$sql_mantenimiento_lista = "SELECT po_mantenimiento_lista.id, po_mantenimiento_lista.detalle, 
po_programa_anual_mantenimiento_detalle.id AS idreporte, po_programa_anual_mantenimiento_detalle.id_programa_fecha, po_programa_anual_mantenimiento_detalle.enero,po_programa_anual_mantenimiento_detalle.febrero,po_programa_anual_mantenimiento_detalle.marzo,po_programa_anual_mantenimiento_detalle.abril,po_programa_anual_mantenimiento_detalle.mayo,po_programa_anual_mantenimiento_detalle.junio,po_programa_anual_mantenimiento_detalle.julio,po_programa_anual_mantenimiento_detalle.agosto,po_programa_anual_mantenimiento_detalle.septiembre,po_programa_anual_mantenimiento_detalle.octubre,po_programa_anual_mantenimiento_detalle.noviembre,po_programa_anual_mantenimiento_detalle.diciembre
FROM po_mantenimiento_lista
INNER JOIN po_programa_anual_mantenimiento_detalle
ON po_mantenimiento_lista.id = po_programa_anual_mantenimiento_detalle.id_mantenimiento WHERE po_programa_anual_mantenimiento_detalle.id_programa_fecha = '".$idReporte."' ORDER BY po_mantenimiento_lista.id asc ";
        $result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
        $numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
        if ($numero_mantenimiento_lista > 0) {

        while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){

        $txt_enero = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['enero']);
        $color_enero = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['enero']);
        $txt_color_enero = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['enero']);

        $txt_febrero = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['febrero']);
        $color_febrero = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['febrero']);
        $txt_color_febrero = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['febrero']);

        $txt_marzo = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['marzo']);
        $color_marzo = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['marzo']);
        $txt_color_marzo = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['marzo']);

        $txt_abril = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['abril']);
        $color_abril = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['abril']);
        $txt_color_abril = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['abril']);

        $txt_mayo = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['mayo']);
        $color_mayo = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['mayo']);
        $txt_color_mayo = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['mayo']);

        $txt_junio = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['junio']);
        $color_junio = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['junio']);
        $txt_color_junio = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['junio']);

        $txt_julio = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['julio']);
        $color_julio = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['julio']);
        $txt_color_julio = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['julio']);

        $txt_agosto = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['agosto']);
        $color_agosto = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['agosto']);
        $txt_color_agosto = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['agosto']);
      
        $txt_septiembre = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['septiembre']);
        $color_septiembre = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['septiembre']);
        $txt_color_septiembre = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['septiembre']);

        $txt_octubre = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['octubre']);
        $color_octubre = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['octubre']);
        $txt_color_octubre = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['octubre']);

        $txt_noviembre = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['noviembre']);
        $color_noviembre = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['noviembre']);
        $txt_color_noviembre = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['noviembre']);

        $txt_diciembre = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['diciembre']);
        $color_diciembre = $class_control_actividad_proceso->ColorTD($row_mantenimiento_lista['diciembre']);
        $txt_color_diciembre = $class_control_actividad_proceso->txtColor($row_mantenimiento_lista['diciembre']);
        
        ?>
        <tr>
        <td class="align-middle"><?=$row_mantenimiento_lista['id'];?></td>
        <td class="align-middle"><?=$row_mantenimiento_lista['detalle'];?></td>
        <td class="align-middle text-center <?=$color_enero;?> <?=$txt_color_enero;?>" style="font-size: .8em;padding: 10px;"><?=$txt_enero;?></td>
        <td class="align-middle text-center <?=$color_febrero;?> <?=$txt_color_febrero;?>" style="font-size: .8em;padding: 10px;"><?=$txt_febrero;?></td>
        <td class="align-middle text-center <?=$color_marzo;?> <?=$txt_color_marzo;?>" style="font-size: .8em;padding: 10px;"><?=$txt_marzo;?></td>
        <td class="align-middle text-center <?=$color_abril;?> <?=$txt_color_abril;?>" style="font-size: .8em;padding: 10px;"><?=$txt_abril;?></td>
         <td class="align-middle text-center <?=$color_mayo;?> <?=$txt_color_mayo;?>" style="font-size: .8em;padding: 10px;"><?=$txt_mayo;?></td>
         <td class="align-middle text-center <?=$color_junio;?> <?=$txt_color_junio;?>" style="font-size: .8em;padding: 10px;"><?=$txt_junio;?></td>
          <td class="align-middle text-center <?=$color_julio;?> <?=$txt_color_julio;?>" style="font-size: .8em;padding: 10px;"><?=$txt_julio;?></td>
          <td class="align-middle text-center <?=$color_agosto;?> <?=$txt_color_agosto;?>" style="font-size: .8em;padding: 10px;"><?=$txt_agosto;?></td>
          <td class="align-middle text-center <?=$color_septiembre;?> <?=$txt_color_septiembre;?>" style="font-size: .8em;padding: 10px;"><?=$txt_septiembre;?></td>
          <td class="align-middle text-center <?=$color_octubre;?> <?=$txt_color_octubre;?>" style="font-size: .8em;padding: 10px;"><?=$txt_octubre;?></td>
          <td class="align-middle text-center <?=$color_noviembre;?> <?=$txt_color_noviembre;?>" style="font-size: .8em;padding: 10px;"><?=$txt_noviembre;?></td>
          <td class="align-middle text-center <?=$color_diciembre;?> <?=$txt_color_diciembre;?>" style="font-size: .8em;padding: 10px;"><?=$txt_diciembre;?></td>
          <td class="align-middle text-center">
             <a onclick="EditarM(<?=$row_mantenimiento_lista['idreporte'];?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
            <img src="<?php echo RUTA_IMG_ICONOS."edit-black-16.png"; ?>">
            </a>
          </td>
          <td class="align-middle text-center">
             <a onclick="EliminarM(<?=$row_mantenimiento_lista['idreporte'];?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
            <img src="<?php echo RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>">
            </a>
          </td>
        </tr>
        <?php
        }

      }else{
        echo "<tr><td colspan='15'>
        <div class='text-center mt-1'><small>No se encontró información, de clic en el siguiente botón para crear el Programa anual de mantenimiento</small></div> 
        <div class='text-center'> <button type='button' class='btn btn-secondary btn-sm mt-3 mb-1' onclick='BtnAgregar()'>Agregar equipo o instalación</button> </div>
        </td></tr>";
      }
    ?>
  </table>
  </div>