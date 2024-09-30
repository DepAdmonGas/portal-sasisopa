<?php
require('../../../../app/help.php');

function auditor($id_plan,$cate,$con){

$return = '';

$sql = "SELECT * FROM sgm_plan_auditoria_auditor WHERE id_plan = '".$id_plan."' AND categoria = '".$cate."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$return .= '<tr>
<td class="align-middle">'.$row['categoria'].'</td>
<td class="align-middle">'.$row['nombre'].'</td>
<td class="align-middle">'.$row['area_actividad'].'</td>
<td class="text-center align-middle"><img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="EliminarAuditor(0,'.$id_plan.','.$row['id'].',16)"></td>
</tr>';

}

return $return;

}

?>
<table class="table table-bordered table-sm">
<tbody>
    <tr class="bg-secondary text-white">
    <td colspan="4"><b>II. DATOS DEL AUDITOR</b></td>
    </tr>
    <tr class="bg-light">
    <td>EQUIPO AUDITOR</td>
    <td>NOMBRE:</td>
    <td>ÁREA/PROCESO/ACTIVIDAD QUE AUDITA:</td>
    <td width="32"></td>
    </tr>
    <?php
    echo auditor($_GET['id'],'AUDITOR LÍDER',$con);
    echo auditor($_GET['id'],'AUDITOR',$con);
    ?>


</tbody>
</table>


 