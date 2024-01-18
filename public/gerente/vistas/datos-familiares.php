<?php
require('../../../app/help.php');
$idUsuario = $_GET['idUsuario'];
?>
<script type="text/javascript"> 
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
function AgregarDatos(){
$('#ModalAgregarDatosF').modal('show');
}
function BtnADF(){
$('#NomFamiliar').css('border','');
var NomFamiliar = $('#NomFamiliar').val();

$('#Parentesco').css('border','');
var Parentesco = $('#Parentesco').val();

$('#Direccion').css('border','');
var Direccion = $('#Direccion').val();

$('#Telefono').css('border','');
var Telefono = $('#Telefono').val();

if (NomFamiliar != "") {
if (Parentesco != "") {
if (Direccion != "") {
if (Telefono != "") {

  var parametros = {
    "idUsuario" : <?php echo $idUsuario; ?>,
     "NomFamiliar" : NomFamiliar,
     "Parentesco" : Parentesco,
     "Direccion" : Direccion,
     "Telefono" : Telefono
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/agregar/agregar-datos-familiares.php',
     type:  'post',
     beforeSend: function() {
    $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
     },
     complete: function(){
    $('#Result').html("");
     },
     success:  function (response) {
     $('#ModalAgregarDatosF').modal('hide');
     window.setTimeout("DatosFamiliares()",1000);
     alertify.message('Se almaceno correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Agregar Datos Familiares').set({transition:'zoom',message: '¿Desea agregar la nueva información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{ $('#Telefono').css('border','2px solid #A52525'); }
}else{ $('#Direccion').css('border','2px solid #A52525'); }
}else{ $('#Parentesco').css('border','2px solid #A52525'); }
}else{ $('#NomFamiliar').css('border','2px solid #A52525'); }

}
function EliminarDP(id){
  var parametros = {
    "id" : id
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/eliminar/eliminar-datos-familiares.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     window.setTimeout("DatosFamiliares()",1000);
     alertify.message('Se elimino correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Eliminar').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}
</script>

<div class="border mt-3">
<div class="p-3">


<div class="row">

<div class="col-10">

<div style="font-size: 1.4em;">
2. Datos de familiares
</div>

</div>

<div class="col-2">
  <a class="float-right" onclick="AgregarDatos()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar">
  <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
</a>
</div>

</div>

<hr>

<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="font-size: 1.2em;">
  <thead>
  <tr>
    <th class="text-center">Nombre:</th>
    <th class="text-center">Parentesco:</th>
    <th class="text-center">Dirección:</th>
    <th class="text-center" colspan="2">Teléfono:</th>
  </tr>
  </thead>
  <tbody style="font-size: .9em;">
  <?php
  $sql_d_familiares = "SELECT * FROM tb_usuarios_familiares WHERE id_usuario = '".$idUsuario."' ";
  $result_d_familiares = mysqli_query($con, $sql_d_familiares);
  $numero_d_familiares = mysqli_num_rows($result_d_familiares);
  if ($numero_d_familiares > 0) {
    while($row_familiares = mysqli_fetch_array($result_d_familiares, MYSQLI_ASSOC)){
    $idDP = $row_familiares['id'];
    echo "<tr>";
    echo "<td>".$row_familiares['nombrecompleto']."</td>";
    echo "<td>".$row_familiares['parentesco']."</td>";
    echo "<td>".$row_familiares['domicilio']."</td>";
    echo "<td>".$row_familiares['telefono']."</td>";
    echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Eliminar' onclick='EliminarDP($idDP)'></td>";
    echo "</tr>";
    }
  }else{
    echo "<tr><td colspan='4' class='text-center text-secondary'>No se encontraron datos familiares</td></tr>";
  }

  ?>
  </tbody>
</table>
</div>

</div>
</div>

<div class="modal fade" id="ModalAgregarDatosF" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header">
        <h5 class="modal-title">Datos de familiares</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Nombre de mi familiar:</label>
      <input id="NomFamiliar" type="text" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar nombre">
      </div>
      <div class="form-group">
       <label class="text-secondary" style="font-size: .9em;">Parentesco:</label>
       <select id="Parentesco" class="form-control" style="border-radius: 0px;font-size: 1em;">
         <option value="">Seleccionar parentesco</option>
         <option value="Padre">Padre</option>
         <option value="Madre">Madre</option>
         <option value="Conyugue">Conyugue</option>
         <option value="Hijo">Hijo</option>
         <option value="Otro">Otro</option>
       </select>
     </div>
      <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Dirección completa:</label>
      <input id="Direccion" type="text" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar dirección">
      </div>
      <div class="form-group">
        <label class="text-secondary" style="font-size: .9em;">Teléfono:</label>
      <input id="Telefono" type="text" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar teléfono">
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;border: 0px;" onclick="BtnADF()">Agregar</button>
      </div>
    </div>
  </div>
</div>

