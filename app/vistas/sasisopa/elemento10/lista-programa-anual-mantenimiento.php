<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ControlActividadProceso.php";
$class_control_actividad_proceso = new ControlActividadProceso();

$idReporte = $_GET['idReporte'];
$year = $class_control_actividad_proceso->yearProgramaAnual($idReporte);
$yearAnterior = $year - 1;
$class_control_actividad_proceso->validaMesAnterior($Session_IDEstacion, $idReporte, $yearAnterior);
?>
<!-- TABLA - APROBACION -->
<div style="overflow-y: hidden;">

  <table class="table table-bordered table-sm">
    <tr style="font-size: 1.2em;">
      <td class="align-middle text-center"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS . "Logo.png"; ?>" style="width: 300px;"></td>
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

<div style="overflow-y: hidden;">
  <table id="programa-mantenimiento" class="table table-bordered table-sm pb-0 mb-0">
    <thead>
      <tr class="bg-primary text-white">
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
        <th class="text-center align-middle" width="35px"><i class="fas fa-ellipsis-v"></i></th>
      </tr>
    </thead>
    <tbody>


      <?php
      $sql_mantenimiento_lista = "SELECT po_mantenimiento_lista.id, po_mantenimiento_lista.detalle, po_mantenimiento_lista.periodicidad, 
        po_programa_anual_mantenimiento_detalle.id AS idreporte, po_programa_anual_mantenimiento_detalle.id_programa_fecha, po_programa_anual_mantenimiento_detalle.enero,po_programa_anual_mantenimiento_detalle.febrero,po_programa_anual_mantenimiento_detalle.marzo,po_programa_anual_mantenimiento_detalle.abril,po_programa_anual_mantenimiento_detalle.mayo,po_programa_anual_mantenimiento_detalle.junio,po_programa_anual_mantenimiento_detalle.julio,po_programa_anual_mantenimiento_detalle.agosto,po_programa_anual_mantenimiento_detalle.septiembre,po_programa_anual_mantenimiento_detalle.octubre,po_programa_anual_mantenimiento_detalle.noviembre,po_programa_anual_mantenimiento_detalle.diciembre
        FROM po_mantenimiento_lista
        INNER JOIN po_programa_anual_mantenimiento_detalle
        ON po_mantenimiento_lista.id = po_programa_anual_mantenimiento_detalle.id_mantenimiento WHERE po_programa_anual_mantenimiento_detalle.id_programa_fecha = '" . $idReporte . "' ORDER BY po_mantenimiento_lista.id asc ";
      $result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
      $numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
      if ($numero_mantenimiento_lista > 0) {

        while ($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)) {
          $eliminar = '<a class="dropdown-item" onclick="EliminarM(' . $row_mantenimiento_lista['idreporte'] . ')"><i class="fa-regular fa-trash-can"></i> Eliminar</a>';
          if ($row_mantenimiento_lista['periodicidad'] == 'Semanal') {
            $enero = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 1);
            $febrero = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 2);
            $marzo = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 3);
            $abril = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 4);
            $mayo = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 5);
            $junio = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 6);
            $julio = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 7);
            $agosto = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 8);
            $septiembre = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 9);
            $octubre = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 10);
            $noviembre = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 11);
            $diciembre = $class_control_actividad_proceso->buscaFechaSemanal($Session_IDEstacion, $row_mantenimiento_lista['id'], $year, 12);

            $editar = '<a class="dropdown-item grayscale"><i class="fa-solid fa-pencil"></i> Editar</a>';
            
          } else {
            $enero = $row_mantenimiento_lista['enero'];
            $febrero = $row_mantenimiento_lista['febrero'];
            $marzo = $row_mantenimiento_lista['marzo'];
            $abril = $row_mantenimiento_lista['abril'];
            $mayo = $row_mantenimiento_lista['mayo'];
            $junio = $row_mantenimiento_lista['junio'];
            $julio = $row_mantenimiento_lista['julio'];
            $agosto = $row_mantenimiento_lista['agosto'];
            $septiembre = $row_mantenimiento_lista['septiembre'];
            $octubre = $row_mantenimiento_lista['octubre'];
            $noviembre = $row_mantenimiento_lista['noviembre'];
            $diciembre = $row_mantenimiento_lista['diciembre'];

            $editar = '
            <a class="dropdown-item" onclick="EditarM(' . $row_mantenimiento_lista['idreporte'] . ')" ><i class="fa-solid fa-pencil"></i> Editar</a>';
          }

          $txt_enero = $class_control_actividad_proceso->txtFecha($enero);
          $color_enero = $class_control_actividad_proceso->ColorTD($enero);
          $txt_color_enero = $class_control_actividad_proceso->txtColor($enero);

          $txt_febrero = $class_control_actividad_proceso->txtFecha($febrero);
          $color_febrero = $class_control_actividad_proceso->ColorTD($febrero);
          $txt_color_febrero = $class_control_actividad_proceso->txtColor($febrero);

          $txt_marzo = $class_control_actividad_proceso->txtFecha($marzo);
          $color_marzo = $class_control_actividad_proceso->ColorTD($marzo);
          $txt_color_marzo = $class_control_actividad_proceso->txtColor($marzo);

          $txt_abril = $class_control_actividad_proceso->txtFecha($abril);
          $color_abril = $class_control_actividad_proceso->ColorTD($abril);
          $txt_color_abril = $class_control_actividad_proceso->txtColor($abril);

          $txt_mayo = $class_control_actividad_proceso->txtFecha($mayo);
          $color_mayo = $class_control_actividad_proceso->ColorTD($mayo);
          $txt_color_mayo = $class_control_actividad_proceso->txtColor($mayo);

          $txt_junio = $class_control_actividad_proceso->txtFecha($junio);
          $color_junio = $class_control_actividad_proceso->ColorTD($junio);
          $txt_color_junio = $class_control_actividad_proceso->txtColor($junio);

          $txt_julio = $class_control_actividad_proceso->txtFecha($julio);
          $color_julio = $class_control_actividad_proceso->ColorTD($julio);
          $txt_color_julio = $class_control_actividad_proceso->txtColor($julio);

          $txt_agosto = $class_control_actividad_proceso->txtFecha($agosto);
          $color_agosto = $class_control_actividad_proceso->ColorTD($agosto);
          $txt_color_agosto = $class_control_actividad_proceso->txtColor($agosto);

          $txt_septiembre = $class_control_actividad_proceso->txtFecha($septiembre);
          $color_septiembre = $class_control_actividad_proceso->ColorTD($septiembre);
          $txt_color_septiembre = $class_control_actividad_proceso->txtColor($septiembre);

          $txt_octubre = $class_control_actividad_proceso->txtFecha($octubre);
          $color_octubre = $class_control_actividad_proceso->ColorTD($octubre);
          $txt_color_octubre = $class_control_actividad_proceso->txtColor($octubre);

          $txt_noviembre = $class_control_actividad_proceso->txtFecha($noviembre);
          $color_noviembre = $class_control_actividad_proceso->ColorTD($noviembre);
          $txt_color_noviembre = $class_control_actividad_proceso->txtColor($noviembre);

          $txt_diciembre = $class_control_actividad_proceso->txtFecha($diciembre);
          $color_diciembre = $class_control_actividad_proceso->ColorTD($diciembre);
          $txt_color_diciembre = $class_control_actividad_proceso->txtColor($diciembre);

      ?>
          <tr>
            <td class="align-middle fw-bold"><?= $row_mantenimiento_lista['id']; ?></td>
            <td class="align-middle"><?= $row_mantenimiento_lista['detalle']; ?></td>
            <td class="align-middle text-center <?= $txt_color_enero; ?>" <?= $color_enero; ?> style="font-size: .8em;padding: 10px;"><?= $txt_enero; ?></td>
            <td class="align-middle text-center <?= $txt_color_febrero; ?>" <?= $color_febrero; ?> style="font-size: .8em;padding: 10px;"><?= $txt_febrero; ?></td>
            <td class="align-middle text-center <?= $txt_color_marzo; ?>" <?= $color_marzo; ?> style="font-size: .8em;padding: 10px;"><?= $txt_marzo; ?></td>
            <td class="align-middle text-center <?= $txt_color_abril; ?>" <?= $color_abril; ?> style="font-size: .8em;padding: 10px;"><?= $txt_abril; ?></td>
            <td class="align-middle text-center <?= $txt_color_mayo; ?>" <?= $color_mayo; ?> style="font-size: .8em;padding: 10px;"><?= $txt_mayo; ?></td>
            <td class="align-middle text-center <?= $txt_color_junio; ?>" <?= $color_junio; ?> style="font-size: .8em;padding: 10px;"><?= $txt_junio; ?></td>
            <td class="align-middle text-center <?= $txt_color_julio; ?>" <?= $color_julio; ?> style="font-size: .8em;padding: 10px;"><?= $txt_julio; ?></td>
            <td class="align-middle text-center <?= $txt_color_agosto; ?>" <?= $color_agosto; ?> style="font-size: .8em;padding: 10px;"><?= $txt_agosto; ?></td>
            <td class="align-middle text-center <?= $txt_color_septiembre; ?>" <?= $color_septiembre; ?> style="font-size: .8em;padding: 10px;"><?= $txt_septiembre; ?></td>
            <td class="align-middle text-center <?= $txt_color_octubre; ?>" <?= $color_octubre; ?> style="font-size: .8em;padding: 10px;"><?= $txt_octubre; ?></td>
            <td class="align-middle text-center <?= $txt_color_noviembre; ?>" <?= $color_noviembre; ?> style="font-size: .8em;padding: 10px;"><?= $txt_noviembre; ?></td>
            <td class="align-middle text-center <?= $txt_color_diciembre; ?>" <?= $color_diciembre; ?> style="font-size: .8em;padding: 10px;"><?= $txt_diciembre; ?></td>
            <td class="text-center align-middle" width="20px" style="cursor: pointer;">
              <div class="dropdown dropstart">
                <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <?= $editar; ?>
                  <?= $eliminar; ?>
                </div>
              </div>
            </td>
          </tr>
      <?php
        }
      } else {
        echo "<div class='text-center mt-1 fw-bold'><small>No se encontró información, de clic en el siguiente botón para crear el Programa anual de mantenimiento</small></div> 
        <div class='text-center'> <button type='button' class='btn btn-primary btn-sm mt-3 mb-1' onclick='BtnAgregar()'>Agregar equipo o instalación</button> </div>";
      }
      ?>
    </tbody>
  </table>
</div>