<?php
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];
$sql_estacion = "SELECT di_estado, di_municipio FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estacion = mysqli_query($con, $sql_estacion);
$numero_estacion = mysqli_num_rows($result_estacion);
while($row_estaciones = mysqli_fetch_array($result_estacion, MYSQLI_ASSOC)){
$diestado = $row_estaciones['di_estado'];
$dimunicipio = $row_estaciones['di_municipio'];
}

if($_GET['NG'] == "Municipal"){
$NG = ' AND mun_alc_est = "'.$dimunicipio.'" ';
}else if($_GET['NG'] == "Estatal"){
$NG = ' AND mun_alc_est = "'.$diestado.'" ';
}else if($_GET['NG'] == "Federal"){
$NG = '';
}else if($_GET['NG'] == "Varios"){
$NG = '';
}

$sql = "SELECT dependencia FROM rl_requisitos_legales_lista WHERE nivel_gobierno = '".$_GET['NG']."' $NG AND (id_estacion = '".$idEstacion."' OR id_estacion = 0) AND estado = 1 GROUP BY dependencia ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>
<script type="text/javascript">
$('.selectize').selectize({
sortField: 'text'
});
</script>
  <div class="modal-header">
  <h4 class="modal-title">Buscar requisito legal</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

<h5 class="">Dependencia</h5>
<select class="selectize" placeholder="Dependencia" id="Dependencia">
<option value="Todas">Todas</option>
  <?php
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

    echo "<option>".$row['dependencia']."</option>";

  }

  ?>
</select>




<hr>

  <div class="text-right mt-3">
  <button type="button" class="btn btn-primary rounded-0" onclick="BuscarRL('<?=$_GET['NG'];?>')">Buscar</button>
  </div>

  </div>