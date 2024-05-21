<?php
require('../../../../app/help.php');

$id = $_GET['id'];
$idestacion = $_GET['idestacion'];

$sql_lista = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$idestacion."' AND estado = 1 ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);


function Valida($id,$idDispensario,$con){

$sql = "SELECT * FROM tb_calibracion_equipos_dispensario WHERE id_calibracion = '".$id."' AND id_dispensario = '".$idDispensario."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

return $numero;
}
?>
<div class="modal-header">
<h4 class="modal-title">Agregar dispensario</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<div><h6>Dispensario:</h6></div>
<select class="form-control rounded-0" id="idDispensario">
<option></option>
<?php
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$Valida = Valida($id,$row_lista['id'],$con);

if($Valida == 0){
echo '<option value="'.$row_lista['id'].'">'.$row_lista['no_dispensario'].', '.$row_lista['marca'].', '.$row_lista['modelo'].', '.$row_lista['serie'].'</option>';
}

}
?>
</select>

</div>
  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Agregar(<?=$id;?>)">Agregar</button>
  </div>