<?php
require('../../../app/help.php');

$id = $_GET['id'];

function Estacion($idEstacion, $con){
    $sql = "SELECT permisocre,razonsocial,direccioncompleta FROM tb_estaciones WHERE id = '".$idEstacion."'";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $razonsocial = $row['razonsocial'];
    $direccion = $row['direccioncompleta'];
    }
     $return = array('razonsocial' => $razonsocial, 'direccion' => $direccion);
    return $return;
    }

$sql = "SELECT * FROM tb_entregas WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$id_estacion = $row['id_estacion'];
$Estacion = Estacion($id_estacion, $con);
$razonsocial = $Estacion['razonsocial'];
}

$sql = "SELECT * FROM tb_estaciones WHERE numlista <= 8 ORDER BY numlista ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
?>
<script type="text/javascript">
$('.selectize2').selectize({
sortField: 'text'
});
</script>


  <div class="modal-header">
  <h4 class="modal-title">Agregar entrega</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

<h5 class="mt-2">Estación de envio:</h5>
<select class="selectize selectize2" placeholder="Estación" id="Estacion">
<option value="<?=$id_estacion;?>"><?=$razonsocial;?></option>
<?php
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
echo '<option value="'.$row['id'].'">'.$row['razonsocial'].'</option>';
}
?>
</select>

<h5 class="">Documento:</h5>
<textarea class="form-control rounded-0" id="Documento"></textarea>

<h5 class="">Fecha del oficio:</h5>
<input type="date" class="form-control rounded-0" id="FechaOficio">

<h5 class="">Original y/o copia</h5>
<select class="form-control rounded-0" id="OriginalCopia">
<option value=""></option>
<option value="Original">Original</option>
<option value="Copia">Copia</option>
</select>


<div class="text-right mt-3">
<button type="button" class="btn btn-primary rounded-0" onclick="Agregar(<?=$id;?>)">Agregar</button>
</div>

</div>