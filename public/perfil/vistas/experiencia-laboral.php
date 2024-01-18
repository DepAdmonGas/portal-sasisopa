 <?php 
require('../../../app/help.php');

?>

<script type="text/javascript">
    
function modalExperienciaL(){
$('#ModalDatosExperienciaL').modal('show');
}


function agregarExperienciaL(){

$('#Empresadetalle').css('border','');
var Empresadetalle = $('#Empresadetalle').val();

if (Empresadetalle != "") {

  var parametros = {
    "idUsuario" : <?=$Session_IDUsuarioBD; ?>,
     "Empresadetalle" : Empresadetalle
    };

    alertify.confirm('',
    function(){

      $.ajax({
       data:  parametros,
       url:   'public/perfil/modelo/agregar/agregar-experiencia-laboral.php',
       type:  'post',
       beforeSend: function() {

       },
       complete: function(){

       },
       success:  function (response) {
       $('#ModalDatosExperienciaL').modal('hide');
       ExperienciaLaboral();
       alertify.success('Se agrego correctamente la información.');
       }
       });

    },
    function(){
    }).setHeader('Agregar Experiencia Laboral').set({transition:'zoom',message: '¿Desea agregar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{ $('#Empresadetalle').css('border','2px solid #A52525'); }

}
 

function eliminarExperienciaL(id){

  var parametros = {
    "id" : id
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   'public/perfil/modelo/eliminar/eliminar-experiencia-laboral.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     ExperienciaLaboral();
     alertify.success('Se elimino correctamente la información.');
     }
     });

  },
  function(){
  }).setHeader('Eliminar Experiencia Laboral').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

</script>
 
 
<!----- VISTA DATOS EXPERIENCIA LABORAL ----->
<div class="border-0 p-3"> 

<div class="row">
<div class="col-11"><h5>4. Experiencia laboral</h5> </div>

<div class="col-1">
<img class="float-end pointer" src="<?=RUTA_IMG_ICONOS."agregar.png";?>" onclick="modalExperienciaL()">
</div>

<div class="col-12"><h6>4.1 En otras empresas </h6> </div>
</div>

<hr>

<div class="row">
<div class="table-responsive">

<table class="table table-bordered table-striped table-sm">
  
  <thead class="navbar-bg">
  <tr class="text-center align-middle">
  <th >Nombre de la empresa</th>
  <th width="40px"><i class='fa-solid fa-trash'></i></th>
  </tr>
  </thead>

  <tbody style="font-size: .9em;">
  <?php
  $sql_e_laboral = "SELECT * FROM tb_usuarios_experiencia_laboral WHERE id_usuario = '".$Session_IDUsuarioBD."' ";
  $result_e_laboral = mysqli_query($con, $sql_e_laboral);
  $numero_e_laboral = mysqli_num_rows($result_e_laboral);
  if ($numero_e_laboral > 0) {
  while($row_laboral = mysqli_fetch_array($result_e_laboral, MYSQLI_ASSOC)){
  $idEL = $row_laboral['id'];
  echo "<tr class='align-middle text-center'>";
  echo "<td>".$row_laboral['detalle']."</td>";
  echo "<td width='40px'>
    <button type='button' class='btn btn-danger btn-circle' onclick='eliminarExperienciaL($idEL)'>
    <i class='fa-solid fa-trash'></i>
    </button>
    </td>";
  echo "</tr>";
  }
  }else{
  echo "<tr><td colspan='2' class='text-center text-secondary'>No se encontro información de experiencia laboral en otras empresas</td></tr>";
  }
  ?>
  </tbody>
</table>


</div>
</div>

</div>


<!----- MODAL DATOS EXPERIENCIA LABORAL ----->
<div class="modal" id="ModalDatosExperienciaL">
  <div class="modal-dialog modal-lg" style="margin-top: 83px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar experiencia laboral</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
      <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Empresa:</label>
      <textarea id="Empresadetalle" class="form-control rounded-0" placeholder="Nombre de la empresa"></textarea>
      </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="agregarExperienciaL()">Agregar</button>
      </div>
    </div>
  </div>
</div>
