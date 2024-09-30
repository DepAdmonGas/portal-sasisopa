<?php
require('../../../../app/help.php');

function auditor($id_plan,$cate,$con){

$return = '';

$sql = "SELECT * FROM sgm_plan_auditoria_auditor WHERE id_plan = '".$id_plan."' AND categoria = '".$cate."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$return .= '<ul class="list-group list-group-flush">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$return .= '<li class="list-group-item d-flex justify-content-between align-items-center p-2">
<small>'.$row['nombre'].'</small>
<img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="EliminarAuditor(0,'.$id_plan.','.$row['id'].',16)">
</li>';
}
$return .= '</ul>';

return $return;

}

?>
<table class="table table-bordered table-sm">
<tbody>
    <tr class="bg-secondary text-white">
    <td colspan="4"><b>III DATOS DEL EQUIPO AUXILIAR DEL AUDITOR </b></td>
    </tr>
    <tr class="bg-light">
    <td>GUÍAS:</td>
    <td>OBSERVADORES:</td>
    <td colspan="2">EXPERTO(S) TÉCNICO(S)</td>
    </tr>
    <?php
    echo '<tr>';
    echo '<td>'.auditor($_GET['id'],'GUÍAS',$con).'</td>';
    echo '<td>'.auditor($_GET['id'],'OBSERVADORES',$con).'</td>';
    echo '<td>'.auditor($_GET['id'],'EXPERTO(S) TÉCNICO(S)',$con).'</td>';
    echo '</tr>';
    ?>

</tbody>
</table>


 