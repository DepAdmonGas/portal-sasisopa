 <?php 
require('../../../app/help.php');
?>

<script type="text/javascript">
function mayus(e) {
e.value = e.value.toUpperCase();
} 

function modalDatosExpE(){
$('#ModalExperienciaEmp').modal('show');
}





function EliminarDatosExpE(id){
  var parametros = {
    "id" : id
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   'public/perfil/modelo/eliminar/eliminar-experiencia-empresa.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     ExperienciaEmpresa();
     alertify.success('Se elimino correctamente la información.');
     }
     });

  },
  function(){
  }).setHeader('Eliminar').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}


function agregarDatosExpE(){

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
if (FechaFin != "") {

  var parametros = {
    "idUsuario" : <?=$Session_IDUsuarioBD;?>,
     "RazonSocial" : RazonSocial,
     "Puesto" : Puesto,
     "FechaInicio" : FechaInicio,
     "FechaFin" : FechaFin
    };

    alertify.confirm('',
    function(){

      $.ajax({
       data:  parametros,
       url:   'public/perfil/modelo/agregar/agregar-experiencia-empresa.php',
       type:  'post',
       beforeSend: function() {
     
       },
       complete: function(){

       },
       success:  function (response) {
       $('#ModalExperienciaEmp').modal('hide');
       ExperienciaEmpresa()
       alertify.success('Se agrego correctamente la información.');
       }
       });

    },
    function(){
    }).setHeader('Agregar Experiencia laboral en la empresa').set({transition:'zoom',message: '¿Desea agregar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{$('#FechaFin').css('border','2px solid #A52525'); }
}else{$('#FechaInicio').css('border','2px solid #A52525'); }
}else{$('#Puesto').css('border','2px solid #A52525'); }
}else{$('#RazonSocial').css('border','2px solid #A52525'); }


}




</script>



<!----- VISTA DATOS EXPERIENCIA EMPRESA ----->
<div class="border-0 p-3"> 

<div class="row">
<div class="col-11"><h6>4.2 En la empresa</h6> </div>

<div class="col-1">
<img class="float-end pointer" src="<?=RUTA_IMG_ICONOS."agregar.png";?>" onclick="modalDatosExpE()">
</div>
</div>
<hr>


<div class="table-responsive">
 
<table class="table table-bordered table-striped table-sm" >
  <thead class="navbar-bg">
  <tr class="text-center align-middle">
    <th rowspan="2">Razón social</th>
    <th rowspan="2">Puesto</th>
    <th colspan="2" >Periodo</th>
    <th rowspan="3" width='40px'><i class='fa-solid fa-trash'></i></th>
  </tr>
<tr>
    <th class="text-center">Inicio</th>
    <th class="text-center">Termino</th>
  </tr>
  </thead>
  <tbody style="font-size: .9em;">
  <?php
  $sql_e_grupo = "SELECT * FROM tb_usuarios_experiencia_empresa_grupo WHERE id_usuario = '".$Session_IDUsuarioBD."' ";
  $result_e_grupo = mysqli_query($con, $sql_e_grupo);
  $numero_e_grupo = mysqli_num_rows($result_e_grupo);
  if ($numero_e_grupo > 0) {
  while($row_grupo = mysqli_fetch_array($result_e_grupo, MYSQLI_ASSOC)){
  $idEE = $row_grupo['id'];
  echo "<tr>";
  echo "<td class='text-center align-middle'>".$row_grupo['razon_social']."</td>";
  echo "<td class='text-center align-middle'>".$row_grupo['puesto']."</td>";
  echo "<td class='text-center align-middle'>".FormatoFecha($row_grupo['periodo_inicio'])."</td>";
  echo "<td class='text-center align-middle'>".FormatoFecha($row_grupo['periodo_fin'])."</td>";
   
 echo "<td class='align-middle text-center' width='40px'>
    <button type='button' class='btn btn-danger btn-circle' onclick='EliminarDatosExpE($idEE)'>
    <i class='fa-solid fa-trash'></i>
    </button>
    </td>";
  echo "</tr>";
  }
  }else{
    echo "<tr><td colspan='6' class='text-center text-secondary'>No se encontro información de experiencia laboral en esta empresa</td></tr>";
  }
  ?>
  </tbody>
</table>

</div>

</div>


<!----- MODAL EXPERIENCIA EMPRESA ----->
<div class="modal" id="ModalExperienciaEmp">
  <div class="modal-dialog modal-lg" style="margin-top: 83px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Experiencia laboral</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="form-group mb-2">
        <label class="text-secondary" style="font-size: .9em;">Razón social:</label>
        <input id="RazonSocial" type="text" class="form-control rounded-0" onkeyup="mayus(this)"  placeholder="Agregar Razón social">
        </div>

        <div class="form-group mb-2">
        <label class="text-secondary" style="font-size: .9em;">Puesto:</label>
        <input id="Puesto" type="text" class="form-control rounded-0" placeholder="Agregar Puesto">
        </div>

        <div class="row">
          
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-2">
            <div class="form-group">
            <label class="text-secondary" style="font-size: .9em;">Fecha de inicio</label>
            <input id="FechaInicio" type="date" class="form-control rounded-0">
            </div>
          </div>
        
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-2">
            <div class="form-group">
            <label class="text-secondary" style="font-size: .9em;">Fecha de fin:</label>
            <input id="FechaFin" type="date" class="form-control rounded-0">
            </div>
          </div>

        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="agregarDatosExpE()">Agregar</button>
      </div>
    </div>
  </div>
</div>
