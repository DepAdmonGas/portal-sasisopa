<?php
require('../../../app/help.php');

$idEntrega = $_GET['idEntrega'];
$id = $_GET['id'];

$sql = "SELECT * FROM tb_entregas_documentos WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$documento = $row['documento'];
$archivo = $row['archivo'];

if($row['archivo'] != ""){
$Imagen = '<img style="width: 80%;" src="../archivos/entregas/'.$row['archivo'].'">';
}
}

?>


  <div class="modal-header">
  <h4 class="modal-title">Agregar acuse</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

<h4><?=$documento;?></h4>
<h5 class="mt-2">Imagen:</h5>
<input type="file" id="Imagen">

<div class="mt-3 text-center"><?=$Imagen;?></div>

<div class="text-right mt-3">
<button type="button" class="btn btn-primary rounded-0" onclick="AgregarAcuse(<?=$idEntrega;?>,<?=$id;?>)">Guardar</button>
</div>



</div>