<?php
require('../../../../app/help.php');

$NG = $_GET['NG'];

if($_GET['NG'] == "Municipal"){
$MA = $Session_DiMunicipio;
}else if($_GET['NG'] == "Estatal"){
$MA = $Session_DiEstado;
}else if($_GET['NG'] == "Federal"){
$MA = 'NA';
}else if($_GET['NG'] == "Varios"){
$MA = 'NA';
}

$sql_dep = "SELECT dependencia FROM rl_requisitos_legales_dependencias WHERE (id_estacion = '".$Session_IDEstacion."' OR id_estacion = 0) AND estado = 1 ORDER BY dependencia ASC ";
$result_dep = mysqli_query($con, $sql_dep);
$numero_dep = mysqli_num_rows($result_dep);

?>
<script type="text/javascript">
$('.selectize').selectize({
sortField: 'text'
});
</script>
  <div class="modal-header rounded-0 head-modal">
  <h4 class="modal-title text-white">Agregar requisito legal</h4>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">

    <div class="text-secondary mt-1">Dependencias:</div>
    <select class="selectize" placeholder="Dependencias" id="Dependencia">
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

  <hr>
  <div class="text-right mt-3">
  <button type="button" class="btn btn-primary rounded-0" onclick="AgregarRL('<?=$NG;?>','<?=$MA;?>')">Agregar</button>
  </div>

  </div>