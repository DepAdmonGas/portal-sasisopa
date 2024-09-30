<?php
require('../../../../app/help.php');

function validaEqupo($idEstacion,$id_equipo,$con){

$sql = "SELECT * FROM sgm_programa_anual_calibracion_verificacion WHERE id_estacion = '".$idEstacion."' AND id_equipo = '".$id_equipo."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
return $numero;
}

if($_GET['formato'] == 14){
$consulta = "categoria <> 'Equipo sometido a verificación'";
}else if($_GET['formato'] == 15){
$consulta = "categoria = 'Equipo sometido a verificación'";
}
?>
     <div class="modal-header">
       <h4 class="modal-title">Agregar</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">

    <b>Instrumentos de medida o Patrones de medida </b>
    <select class="form-control mt-2" id="IdEquipo">
        <option></option>
        <?php 

        $sql = "SELECT * FROM sgm_patrones_instrumentos WHERE $consulta ";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $validar = validaEqupo($Session_IDEstacion,$row['id'],$con);
        if($validar == 0){
          echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';  
        }
        }
        ?>
    </select>

    <div class="mt-2">
    <b>Fecha programada</b>
    <input type="date" class="form-control mt-2" id="Fecha">
    </div>

    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" id="btnGuardar" onclick="Guardar(<?=$_GET['year'];?>,<?=$_GET['formato'];?>)">Guardar</button>
	</div>