<?php
require('../../../app/help.php');
$idUsuario = $_GET['idUsuario'];
?>
<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
function mayus(e) {
 e.value = e.value.toUpperCase();
 }
function ModalEE(){
$('#ModalEE').modal('show');
}
 
function BtnEE(){

  $('#RazonSocial').css('border','');
  var RazonSocial = $('#RazonSocial').val();

  $('#Puesto').css('border','');
  var Puesto = $('#Puesto').val();

  $('#FechaInicio').css('border','');
  var FechaInicio = $('#FechaInicio').val();

  $('#FechaFin').css('border','');
  var FechaFin = $('#FechaFin').val();

if (RazonSocial != "") {
if (Puesto != "") {
if (FechaInicio != "") {

  var parametros = {
    "idUsuario" : <?php echo $idUsuario; ?>,
     "RazonSocial" : RazonSocial,
     "Puesto" : Puesto,
     "FechaInicio" : FechaInicio,
     "FechaFin" : FechaFin
    };

    alertify.confirm('',
    function(){

      $.ajax({
       data:  parametros,
       url:   '../public/perfil/modelo/agregar/agregar-experiencia-empresa.php',
       type:  'post',
       beforeSend: function() {
      $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
       },
       complete: function(){
      $('#Result').html("");
       },
       success:  function (response) {
       $('#ModalEE').modal('hide');
       window.setTimeout("EsperienciaEmpresa()",1000);
       alertify.message('Se almaceno correctamente la información');
       }
       });

    },
    function(){
    }).setHeader('Agregar Experiencia laboral en la empresa').set({transition:'zoom',message: '¿Desea agregar la nueva información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{$('#FechaInicio').css('border','2px solid #A52525'); }
}else{$('#Puesto').css('border','2px solid #A52525'); }
}else{$('#RazonSocial').css('border','2px solid #A52525'); }

}
function EliminarEE(id){
  var parametros = {
    "id" : id
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/eliminar/eliminar-experiencia-empresa.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     window.setTimeout("EsperienciaEmpresa()",1000);
     alertify.message('Se elimino correctamente la información');
     }
     });

  },
  function(){
  }).setHeader('Eliminar').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function ModalEditarEE(idUsuario,id){
$('#ModalEditarEE').modal('show');
$('#ContenidoModal').load('../public/gerente/vistas/modal-experiencia-empresa-editar.php?id=' + id + '&idUsuario=' + idUsuario);

}

function BtnEditarEE(idUsuario,id){

var RazonSocial = $('#EditRazonSocial').val();
var Puesto = $('#EditPuesto').val();
var FechaInicio = $('#EditFechaInicio').val();
var FechaFin = $('#EditFechaFin').val();

var parametros = {
    "idUsuario" : idUsuario,
    "id" : id,
     "RazonSocial" : RazonSocial,
     "Puesto" : Puesto,
     "FechaInicio" : FechaInicio,
     "FechaFin" : FechaFin
    };

    alertify.confirm('',
    function(){

      $.ajax({
       data:  parametros,
       url:   '../public/perfil/modelo/editar/editar-experiencia-empresa.php',
       type:  'post',
       beforeSend: function() {
      $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
       },
       complete: function(){
      $('#Result').html("");
       },
       success:  function (response) {
       $('#ModalEditarEE').modal('hide');
       window.setTimeout("EsperienciaEmpresa()",1000);
       alertify.message('Se almaceno correctamente la información');
       }
       });

    },
    function(){
    }).setHeader('Editar Experiencia laboral en la empresa').set({transition:'zoom',message: '¿Desea editar la información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}
</script>


<div class="border mt-3">
<div class="p-3">

<div class="row">

<div class="col-10">
<div class="mt-2 ml-3" style="font-size: 1.2em;">
4.2 En la empresa
</div>
</div>


<div class="col-2 mt-2">

<a class="float-right" onclick="ModalEE()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
</a>

</div>


</div>

<hr>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="margin-top: 10px;font-size: 1.2em;">
  <thead>
  <tr>
    <th class="text-center align-middle" rowspan="2">Razón social</th>
    <th class="text-center align-middle" rowspan="2">Puesto</th>
    <th colspan="4" class="text-center">Periodo</th>
  </tr>
<tr>
    <th class="text-center">Inicio</th>
    <th class="text-center" colspan="3">Termino</th>
  </tr>
  </thead>
  <tbody style="font-size: .9em;">
  <?php
  $sql_e_grupo = "SELECT * FROM tb_usuarios_experiencia_empresa_grupo WHERE id_usuario = '".$idUsuario."' ";
  $result_e_grupo = mysqli_query($con, $sql_e_grupo);
  $numero_e_grupo = mysqli_num_rows($result_e_grupo);
  if ($numero_e_grupo > 0) {
  while($row_grupo = mysqli_fetch_array($result_e_grupo, MYSQLI_ASSOC)){
  $idEE = $row_grupo['id'];

  if($row_grupo['periodo_fin'] == '0000-00-00'){
  $PeriodoFin = 'S/I';
  }else{
  $PeriodoFin = FormatoFecha($row_grupo['periodo_fin']);
  }

  echo "<tr>";
  echo "<td class='text-center'>".$row_grupo['razon_social']."</td>";
  echo "<td class='text-center'>".$row_grupo['puesto']."</td>";
  echo "<td class='text-center'>".FormatoFecha($row_grupo['periodo_inicio'])."</td>";
  echo "<td class='text-center'>".$PeriodoFin."</td>";
  echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Editar' onclick='ModalEditarEE(".$idUsuario.",".$idEE.")'></td>";
    echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Eliminar' onclick='EliminarEE($idEE)'></td>";
  echo "</tr>";
  }
  }else{
    echo "<tr><td colspan='4' class='text-center text-secondary'>No se encontro información de experiencia laboral en esta empresa</td></tr>";
  }
  ?>
  </tbody>
</table>

</div>
</div>
</div>

<div class="modal fade" id="ModalEE" >
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
        <label class="text-secondary" style="font-size: .9em;">Razón social:</label>
        <input id="RazonSocial" type="text" class="form-control" name="" onkeyup="mayus(this)" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar Razón social">
        </div>

        <div class="form-group">
        <label class="text-secondary" style="font-size: .9em;">Puesto:</label>
        <input id="Puesto" type="text" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" placeholder="Agregar Puesto">
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
            <label class="text-secondary" style="font-size: .9em;">Fecha de inicio</label>
            <input id="FechaInicio" type="date" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" >
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
            <label class="text-secondary" style="font-size: .9em;">Fecha de fin:</label>
            <input id="FechaFin" type="date" class="form-control" name="" style="border-radius: 0px;font-size: 1em;" >
            </div>
          </div>
        </div>
        <div id="Result"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;border: 0px;" onclick="BtnEE()">Agregar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalEditarEE" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div id="ContenidoModal"></div>
    </div>
  </div>
</div>