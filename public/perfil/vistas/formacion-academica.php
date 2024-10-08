 <?php 
require('../../../app/help.php');

?>

<script type="text/javascript">

function modalFormacionA(){
$('#ModalFormacionA').modal('show');
}
 

function agregarFormacionA(){

$('#NivelAcademico').css('border','');
$('#Institucion').css('border','');
var NivelAcademico = $('#NivelAcademico').val();
var Institucion = $('#Institucion').val();

if (NivelAcademico != "") {
if (Institucion != "") {

  var parametros = {
    "idUsuario" : <?=$Session_IDUsuarioBD; ?>,
     "NivelAcademico" : NivelAcademico,
     "Institucion" : Institucion
    };

  alertify.confirm('',
  function(){
 
    $.ajax({
     data:  parametros,
     url:   'public/perfil/modelo/agregar/agregar-formacion-academica.php',
     type:  'post',
     beforeSend: function() {
 
     },
     complete: function(){

     },
     success:  function (response) {
     $('#ModalFormacionA').modal('hide');
     FormacionAcademica();
     alertify.success('Se agrego correctamente la información.');
     }
     });

  },
  function(){
  }).setHeader('Agregar Formación académica').set({transition:'zoom',message: '¿Desea agregar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{ $('#Institucion').css('border','2px solid #A52525'); }
}else{ $('#NivelAcademico').css('border','2px solid #A52525'); } 

}


function eliminarFormacionA(id){

  var parametros = {
    "id" : id
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   'public/perfil/modelo/eliminar/eliminar-formacion-academica.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     FormacionAcademica();
     alertify.success('Se elimino correctamente la información.');
     }
     });

  },
  function(){
  }).setHeader('Eliminar Formación académica').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

</script>


<!-- VISTA DATOS PERSONALES-->

<div class="border-0 p-3"> 

<div class="row">
<div class="col-11"><h5>3. Formación académica</h5> </div>

<div class="col-1">
<img class="float-end pointer" src="<?=RUTA_IMG_ICONOS."agregar.png";?>" onclick="modalFormacionA()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar">
</div>
</div> 

<hr>


<div class="row">
<div class="table-responsive">

<table class="table table-bordered table-striped table-sm">
  <thead class="navbar-bg">
  <tr class="text-center align-middle">
    <th>Nivel</th>
    <th>Institución</th>
    <th width="40px"><i class='fa-solid fa-trash'></i></th>
  </tr>
  </thead>
  <tbody style="font-size: .9em;">
  <?php
  $sql_f_academica = "SELECT * FROM tb_usuarios_formacion_academica WHERE id_usuario = '".$Session_IDUsuarioBD."' ";
  $result_f_academica = mysqli_query($con, $sql_f_academica);
  $numero_f_academica = mysqli_num_rows($result_f_academica);
  if ($numero_f_academica > 0) {
  while($row_academica = mysqli_fetch_array($result_f_academica, MYSQLI_ASSOC)){
  $idFA = $row_academica['id'];
  echo "<tr class='text-center align-middle'>";
  echo "<td>".$row_academica['nivel']."</td>";
  echo "<td>".$row_academica['detalle']."</td>";
 


  echo "<td class='align-middle text-center' width='40px'>
  <button type='button' class='btn btn-danger btn-circle' onclick='eliminarFormacionA($idFA)'>
    <i class='fa-solid fa-trash'></i>
    </button>
    </td>";
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


<!-- MODAL FORMACION ACADEMICA -->
<div class="modal" id="ModalFormacionA">
  <div class="modal-dialog modal-lg" style="margin-top: 83px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar formación académica</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
        <div class="form-group mb-2">
      <label class="text-secondary" style="font-size: .9em;">Nivel:</label>
      <select id="NivelAcademico" class="form-control rounded-0">
        <option value="">Selecciona el nivel académico...</option>
        <option value="Primaria">Primaria</option>
        <option value="Secundaria">Secundaria</option>
        <option value="Bachillerato">Bachillerato</option>
        <option value="Licenciatura">Licenciatura</option>
      </select>
      </div>

     <div class="form-group">
      <label class="text-secondary" style="font-size: .9em;">Institución:</label>
      <textarea id="Institucion" class="form-control rounded-0"  placeholder="Nombre de la institución"></textarea>
      </div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="agregarFormacionA()">Agregar</button>
      </div>
    </div>
  </div>
</div>