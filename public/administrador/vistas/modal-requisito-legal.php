<?php
require('../../../app/help.php');

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
  <h4 class="modal-title">Requisitos Legales</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
<div class="modal-body"> 

    <div class="text-secondary mt-1">Nivel de gobierno:</div>  
    <select class="form-control rounded-0 mt-1" id="NivelG">
      <option value="">Selecciona</option>
      <?php
      while($row_ng = mysqli_fetch_array($result_ng, MYSQLI_ASSOC)){
      echo '<option value="'.$row_ng['gobierno'].'">'.$row_ng['gobierno'].'</option>';
      }
      ?>
    </select> 
    <div class="text-secondary mt-1">Municipio, Alcaldía y Estado:</div>  
    <select class="form-control rounded-0 mt-1" id="MuAlEs">
    <option value="">Selecciona</option>
      <?php
      while($row_munalcest = mysqli_fetch_array($result_munalcest, MYSQLI_ASSOC)){
      echo '<option value="'.$row_munalcest['mun_alc_est'].'">'.$row_munalcest['mun_alc_est'].'</option>';
      }
      ?>
    </select>
    <div class="text-secondary mt-1">Dependencias:</div>
    <select class="form-control rounded-0 mt-1" id="Dependencia">
      <option value="">Selecciona</option>
      <?php
      while($row_dep = mysqli_fetch_array($result_dep, MYSQLI_ASSOC)){
      echo '<option value="'.$row_dep['dependencia'].'">'.$row_dep['dependencia'].'</option>';
      }
      ?>
    </select>
    <div class="text-secondary mt-1">Permiso:</div>
    <textarea class="form-control rounded-0 mt-1" id="Permiso"></textarea>
    <div class="text-secondary mt-1">Fundamento:</div>
    <textarea class="form-control rounded-0 mt-1" id="Fundamento"></textarea>

  <div class="text-right mt-3">
  <button type="button" class="btn btn-primary rounded-0" onclick="AgregarRL()">Agregar</button>
  </div>

  </div>