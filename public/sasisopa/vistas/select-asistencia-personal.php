<?php
require('../../../app/help.php');
$idReporte = $_GET['idReporte'];

function ValidaUsuario($idReporte,$personal,$con){
$sql_lista = "SELECT * FROM tb_lista_asistencia_detalle WHERE id_lista_asistencia = '".$idReporte."' AND usuario = '".$personal."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}
?>

       <select class="form-control rounded-0" id="PersonalFirma">
       <option value="">Selecciona el personal</option>
        <?php
        $sql_lista = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND  estatus = 0 ";
        $result_lista = mysqli_query($con, $sql_lista);
        $numero_lista = mysqli_num_rows($result_lista);
        while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
        $Valida = ValidaUsuario($idReporte,$row_lista['nombre'],$con);
        if($Valida == 0){
        echo "<option value='".$row_lista['id']."'>".$row_lista['nombre']."</option>";
    	}
        }
        ?> 
      </select>