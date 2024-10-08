<?php
require('../../../app/help.php');
?>
<script type="text/javascript">
function ModalEL(){
$('#ModalEL').modal('show');
}
function BtnAEL(){
$('#Empresadetalle').css('border','');
var Empresadetalle = $('#Empresadetalle').val();

if (Empresadetalle != "") {

  var parametros = {
    "idUsuario" : <?php echo $Session_IDUsuarioBD; ?>,
     "Empresadetalle" : Empresadetalle
    };

    alertify.confirm('',
    function(){

      $.ajax({
       data:  parametros,
       url:   'public/perfil/agregar/agregar-esperiencia-laboral.php',
       type:  'post',
       beforeSend: function() {
      $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
       },
       complete: function(){
      $('#Result').html("");
       },
       success:  function (response) {
       $('#ModalEL').modal('hide');
       window.setTimeout("EsperienciaLaboral()",1000);
       alertify.message('Se almaceno correctamente la información');
       }
       });

    },
    function(){
    }).setHeader('Agregar Experiencia Laboral').set({transition:'zoom',message: '¿Desea agregar la nueva información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{ $('#Empresadetalle').css('border','2px solid #A52525'); }

}

function EliminarEL(id){

  var parametros = {
    "id" : id
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   'public/perfil/eliminar/eliminar-experiencia-laboral.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     window.setTimeout("EsperienciaLaboral()",1000);
     alertify.message('Se elimino correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Eliminar Experiencia Laboral').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}
</script>

<div class="border mt-3">
<div class="p-3">
<div class="row">

<div class="col-12" style="font-size: 1.4em;">
4. Experiencia laboral
</div>

<div class="col-10">
<div class="mt-2 ml-3" style="font-size: 1.2em;">
4.1 En otras empresas
</div>
</div>


<div class="col-2 mt-2">
  <a class="float-right" onclick="ModalEL()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar">
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
  </a>
</div>
</div>

<hr>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="margin-top: 10px;font-size: 1.2em;">
  <tbody style="font-size: .9em;">
  <?php
  $sql_e_laboral = "SELECT * FROM tb_usuarios_experiencia_laboral WHERE id_usuario = '".$Session_IDUsuarioBD."' ";
  $result_e_laboral = mysqli_query($con, $sql_e_laboral);
  $numero_e_laboral = mysqli_num_rows($result_e_laboral);
  if ($numero_e_laboral > 0) {
  while($row_laboral = mysqli_fetch_array($result_e_laboral, MYSQLI_ASSOC)){
  $idEL = $row_laboral['id'];
  echo "<tr>";
  echo "<td>".$row_laboral['detalle']."</td>";
  echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Eliminar' onclick='EliminarEL($idEL)'></td>";
  echo "</tr>";
  }
  }else{
  echo "<tr><td colspan='' class='text-center text-secondary'>No se encontro información de experiencia laboral en otras empresas</td></tr>";
  }
  ?>
  </tbody>
</table>
</div>


<div class="modal fade" id="ModalEL" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header">
        <h5 class="modal-title">Experiencia laboral</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Empresa:</label>
      <textarea id="Empresadetalle" class="form-control" style="border-radius: 0px;font-size: 1.2em;" placeholder="Nombre de la empresa"></textarea>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;border: 0px;" onclick="BtnAEL()">Agregar</button>
      </div>
    </div>
  </div>
</div>

  </div>
</div>
