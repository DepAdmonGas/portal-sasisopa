<?php
require('../../../app/help.php');
$idUsuario = $_GET['idUsuario'];
?>
<script type="text/javascript">
function ModalFA(){
$('#ModalFA').modal('show');
} 

function BtnAFA(){
$('#NivelAcademico').css('border','');
$('#Institucion').css('border','');
var NivelAcademico = $('#NivelAcademico').val();
var Institucion = $('#Institucion').val();

if (NivelAcademico != "") {
if (Institucion != "") {

  var parametros = {
    "idUsuario" : <?php echo $idUsuario; ?>,
     "NivelAcademico" : NivelAcademico,
     "Institucion" : Institucion
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/agregar/agregar-formacion-academica.php',
     type:  'post',
     beforeSend: function() {
    $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
     },
     complete: function(){
    $('#Result').html("");
     },
     success:  function (response) {
     $('#ModalFA').modal('hide');
     window.setTimeout("FormacionAcademica()",1000);
     alertify.message('Se almaceno correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Agregar Formación académica').set({transition:'zoom',message: '¿Desea agregar la nueva información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{ $('#Institucion').css('border','2px solid #A52525'); }
}else{ $('#NivelAcademico').css('border','2px solid #A52525'); }

}

function EliminarFA(id){

  var parametros = {
    "id" : id
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/eliminar/eliminar-formacion-academica.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     window.setTimeout("FormacionAcademica()",1000);
     alertify.message('Se elimino correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Eliminar Formación académica').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}
</script>

<div class="border mt-3">
<div class="p-3">

<div class="row">

<div class="col-10">
<div style="font-size: 1.4em;">
3. Formación académica
</div>
</div>

<div class="col-2">
<a class="float-right" onclick="ModalFA()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a>
</div>

</div>

<hr>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="margin-top: 10px;font-size: 1.2em;">
  <thead>
  <tr>
    <th class="text-center">Nivel:</th>
    <th class="text-center" colspan="2">Institución:</th>
  </tr>
  </thead>
  <tbody style="font-size: .9em;">
  <?php
  $sql_f_academica = "SELECT * FROM tb_usuarios_formacion_academica WHERE id_usuario = '".$idUsuario."' ";
  $result_f_academica = mysqli_query($con, $sql_f_academica);
  $numero_f_academica = mysqli_num_rows($result_f_academica);
  if ($numero_f_academica > 0) {
  while($row_academica = mysqli_fetch_array($result_f_academica, MYSQLI_ASSOC)){
  $idFA = $row_academica['id'];
  echo "<tr>";
  echo "<td>".$row_academica['nivel']."</td>";
  echo "<td>".$row_academica['detalle']."</td>";
  echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Eliminar' onclick='EliminarFA($idFA)'></td>";
  echo "</tr>";
  }
  }else{
    echo "<tr><td colspan='4' class='text-center text-secondary'>No se encontraron información académica</td></tr>";
  }
  ?>
  </tbody>
</table>
</div>

</div>
</div>

<div class="modal fade" id="ModalFA" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header">
        <h5 class="modal-title">Formación académica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Nivel:</label>
      <select id="NivelAcademico" class="form-control" style="border-radius: 0px;font-size: 1.2em;">
        <option value="">Nivel</option>
        <option value="Primaria">Primaria</option>
        <option value="Secundaria">Secundaria</option>
        <option value="Bachillerato">Bachillerato</option>
        <option value="Licenciatura">Licenciatura</option>
      </select>
      </div>
      <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Institución:</label>
      <textarea id="Institucion" class="form-control" style="border-radius: 0px;font-size: 1.2em;" placeholder="Nombre de la institución"></textarea>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;border: 0px;" onclick="BtnAFA()">Agregar</button>
      </div>
    </div>
  </div>
</div>
