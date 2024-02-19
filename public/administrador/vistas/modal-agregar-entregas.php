<?php
require('../../../app/help.php');

$sql = "SELECT * FROM tb_estaciones WHERE numlista <= 8 ORDER BY numlista ASC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
?>
<script type="text/javascript">
$('.selectize').selectize({
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

<h5 class="">Destinatario:</h5>
<input type="text" class="form-control rounded-0" id="Destinatario">

<h5 class="mt-2">Estación de envio:</h5>
<select class="selectize" placeholder="Estación" id="idEstacion">
<option value="">Estación</option>
<?php
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
echo '<option value="'.$row['razonsocial'].'">'.$row['razonsocial'].'</option>';
}
?>
<option value="Martin Quinzaños García">Martin Quinzaños García</option>
<option value="Aurelio Quinzaños Suarez">Aurelio Quinzaños Suarez</option>
<option value="Acueducto Guadalupe S.A. de C.V.">Acueducto Guadalupe S.A. de C.V.</option>
<option value="Wingate School S.C.">Wingate School S.C.</option>
<option value="Sabino Aguirre S.A. de C.V.">Sabino Aguirre S.A. de C.V.</option>
<option value="Servicio Lomas de las Palmas S.A. de C.V.">Servicio Lomas de las Palmas S.A. de C.V.</option>
</select>

<div class="text-right mt-3">
<button type="button" class="btn btn-primary rounded-0" onclick="Agregar()">Agregar</button>
</div>

</div>