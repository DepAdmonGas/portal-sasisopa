<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Asistencia.php";

$idReporte = $_GET['idReporte'];
$class_asistencia = new Asistencia();

?>
       <select class="form-control rounded-0" id="PersonalFirma">
       <option value="">Selecciona el personal</option>
        <?php
        $sql_lista = "SELECT id, nombre FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND  estatus = 0 ";
        $result_lista = mysqli_query($con, $sql_lista);
        $numero_lista = mysqli_num_rows($result_lista);
        while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
        $Valida = $class_asistencia->validaUsuario($idReporte,$row_lista['nombre']);
        if($Valida == 0){
        echo "<option value='".$row_lista['id']."'>".$row_lista['nombre']."</option>";
    	}
        }
        ?> 
      </select>