<?php
require('../../../app/help.php');
$idRequisito = $_GET['idRequisito'];

function Personal($idusuario,$con){

$sql = "SELECT * FROM tb_usuarios WHERE id = '".$idusuario."' ";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$nombre = $row['nombre'];
}
return $nombre;
}

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE id = '".$idRequisito."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$nivel_gobierno = $row['nivel_gobierno'];
$mun_alc_est = $row['mun_alc_est'];
$dependencia = $row['dependencia'];
$permiso = $row['permiso'];
$fundamento = $row['fundamento'];
$id_usuario = $row['id_usuario'];
$Responsable = Personal($row['id_usuario'],$con);
}

$sqlPersonal = "SELECT * FROM tb_usuarios WHERE id_puesto = 5 AND estatus = 0";
$resultPersonal = mysqli_query($con, $sqlPersonal);


$sql_ng = "SELECT * FROM rl_requisitos_legales_gobierno WHERE (id_estacion = '".$Session_IDEstacion."' OR id_estacion = 0) AND estado = 1 ORDER BY gobierno ASC ";
$result_ng = mysqli_query($con, $sql_ng);
$numero_ng = mysqli_num_rows($result_ng);

$sql_munalcest = "SELECT * FROM rl_requisitos_legales_munalcest WHERE (id_estacion = '".$Session_IDEstacion."' OR id_estacion = 0) AND estado = 1 ORDER BY mun_alc_est ASC ";
$result_munalcest = mysqli_query($con, $sql_munalcest);
$numero_munalcest = mysqli_num_rows($result_munalcest);

$sql_dep = "SELECT * FROM rl_requisitos_legales_dependencias WHERE (id_estacion = '".$Session_IDEstacion."' OR id_estacion = 0) AND estado = 1 ORDER BY dependencia ASC ";
$result_dep = mysqli_query($con, $sql_dep);
$numero_dep = mysqli_num_rows($result_dep);
?>
 <div class="modal-header">
  <h4 class="modal-title">Editar personal requisito legal</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">


  	 <div class="text-secondary mt-1">Nivel de gobierno:</div>  
    <select class="form-control rounded-0 mt-1" id="NivelG">
      <option value="<?=$nivel_gobierno;?>"><?=$nivel_gobierno;?></option>
      <?php
      while($row_ng = mysqli_fetch_array($result_ng, MYSQLI_ASSOC)){
      echo '<option value="'.$row_ng['gobierno'].'">'.$row_ng['gobierno'].'</option>';
      }
      ?>
    </select> 
    <div class="text-secondary mt-1">Municipio, Alcaldía y Estado:</div>  
    <select class="form-control rounded-0 mt-1" id="MuAlEs">
    <option value="<?=$mun_alc_est;?>"><?=$mun_alc_est;?></option>
      <?php
      while($row_munalcest = mysqli_fetch_array($result_munalcest, MYSQLI_ASSOC)){
      echo '<option value="'.$row_munalcest['mun_alc_est'].'">'.$row_munalcest['mun_alc_est'].'</option>';
      }
      ?>
    </select>
    <div class="text-secondary mt-1">Dependencias:</div>
    <select class="form-control rounded-0 mt-1" id="Dependencia">
      <option value="<?=$dependencia;?>"><?=$dependencia;?></option>
      <?php
      while($row_dep = mysqli_fetch_array($result_dep, MYSQLI_ASSOC)){
      echo '<option value="'.$row_dep['dependencia'].'">'.$row_dep['dependencia'].'</option>';
      }
      ?>
    </select>
    <div class="text-secondary mt-1">Permiso:</div>
  	<textarea class="form-control rounded-0 mt-1" id="Permiso"><?=$permiso;?></textarea>
   
<div class="text-secondary mt-1">Responsable:</div>

<select class="form-control rounded-0" id="IdPersonal">
<option value="<?=$id_usuario;?>"><?=$Responsable;?></option>
<?php 
while($rowPersonal = mysqli_fetch_array($resultPersonal, MYSQLI_ASSOC)){

echo '<option value="'.$rowPersonal['id'].'">'.$rowPersonal['nombre'].'</option>';
}
?>
</select>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="EditarPersonalRL(<?=$idRequisito;?>)">Editar</button>
</div>
