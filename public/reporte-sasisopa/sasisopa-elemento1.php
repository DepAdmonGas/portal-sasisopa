<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

?>
<div class="text-end">
<a onclick="DescargarPolitica(<?= $Session_IDEstacion; ?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar 1. Politica">
<img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>">
</a>
</div>
<h4>1. POLÍTICA</h4>
<?php
$sql1 = "SELECT * FROM tb_politica_lista_comprobacion WHERE id_estacion = '" . $Session_IDEstacion . "' AND fecha BETWEEN '" . $FechaInicio . "' AND '" . $FechaTermino . "' ORDER BY fecha DESC ";
$result1 = mysqli_query($con, $sql1);
$numero1 = mysqli_num_rows($result1);

$sql2 = "SELECT * FROM tb_lista_asistencia WHERE id_estacion = '" . $Session_IDEstacion . "' AND punto_sasisopa = 1 AND fecha BETWEEN '" . $FechaInicio . "' AND '" . $FechaTermino . "' ";
$result2 = mysqli_query($con, $sql2);
$numero2 = mysqli_num_rows($result2);

echo '<div class="row">
<div class="col-6">
<h6>Fo.ADMONGAS.001 (Lista de comprobación)</h6>

<table class="table table-bordered table-striped table-sm pb-0 mb-0" style="font-size: .9em;">
<thead> 
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>';
$num = 1;
if ($numero1 > 0) {
    while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
        $id = $row1['id'];

        echo '<tr>
<td class="text-center">' . $num . '</td>
<td class="text-center">' . FormatoFecha($row1['fecha']) . '</td>
<td class="text-center align-middle" width="30"><img src="' . RUTA_IMG_ICONOS . 'pdf.png" style="cursor: pointer;" onclick="DescargarRegistro(' . $id . ')"></td>
</tr>';

        $num = $num + 1;
    }
} else {
    echo '<td colspan="3" class="text-center text-secondary" style="font-size: .8em;">No se encontró información para mostrar</td>';
}
echo '</tbody></table>';

echo '</div>';
//------------------------------------
//------------------------------------
echo '<div class="col-6">
<h6>Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h6>
<table class="table table-bordered table-striped table-sm pb-0 mb-0" style="font-size: .9em;">
<thead> 
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Hora</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>';

$num1 = 1;
if ($numero2 > 0) {
    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $id1 = $row2['id'];
        $estado = $row2['estado'];

        echo "<tr>
<td class='text-center'>" . $num1 . "</td>
<td class='text-center'>" . FormatoFecha($row2['fecha']) . "</td>
<td class='text-center'>" . date('g:i a', strtotime($row2['hora'])) . "</td>
<td class='text-center align-middle' width='30'><img src='" . RUTA_IMG_ICONOS . "pdf.png' style='cursor: pointer;' onclick='DescargarAsistencia(" . $id1 . ")'></td>
</tr>";

        $num1 = $num1 + 1;
    }
} else {
    echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}

echo '</tbody></table>';

echo '</div>';
echo '</div>';
?>
<hr>