 <?php 
require('../../../app/help.php');

?>

<script type="text/javascript">

function modalDatosF(){
$('#ModalDatosFamiliares').modal('show');
} 


//----- ELIMINAR REGISTRO -----//
function EliminarDatosF(id){
  var parametros = {
    "id" : id
    };
 
  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   'public/perfil/modelo/eliminar/eliminar-datos-familiares.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     DatosFamiliares();
     alertify.success('Se elimino correctamente la información.');
     }
     });

  },
  function(){
  }).setHeader('Eliminar').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}


function agregarDatosF(){

$('#NomFamiliar').css('border','');
var NomFamiliar = $('#NomFamiliar').val();

$('#Parentesco').css('border','');
var Parentesco = $('#Parentesco').val();

$('#Direccion').css('border','');
var Direccion = $('#Direccion').val();

$('#TelefonoF').css('border','');
var TelefonoF = $('#TelefonoF').val();

if (NomFamiliar != "") {
if (Parentesco != "") {
if (Direccion != "") {
if (TelefonoF != "") {

  var parametros = {
    "idUsuario" : <?=$Session_IDUsuarioBD; ?>,
     "NomFamiliar" : NomFamiliar,
     "Parentesco" : Parentesco,
     "Direccion" : Direccion,
     "Telefono" : TelefonoF
    };

  alertify.confirm('',
  function(){

    $.ajax({
     data:  parametros,
     url:   'public/perfil/modelo/agregar/agregar-datos-familiares.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){

     },
     success:  function (response) {
     $('#ModalDatosFamiliares').modal('hide');
     DatosFamiliares();
     alertify.success('Se agrego correctamente la información.');
     }
     });

  },
  function(){
  }).setHeader('Agregar Datos Familiares').set({transition:'zoom',message: '¿Desea agregar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{ $('#TelefonoF').css('border','2px solid #A52525'); }
}else{ $('#Direccion').css('border','2px solid #A52525'); }
}else{ $('#Parentesco').css('border','2px solid #A52525'); }
}else{ $('#NomFamiliar').css('border','2px solid #A52525'); }
   
}

</script>

 
 
<!----- VISTA DATOS PERSONALES ----->
<div class="border-0 p-3"> 

<div class="row">
<div class="col-11"><h5>2. Datos de familiares</h5> </div>

<div class="col-1">
<img class="float-end pointer" src="<?=RUTA_IMG_ICONOS."agregar.png";?>" onclick="modalDatosF()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar">
</div>
</div>

<hr>

<div class="row">

<div class="table-responsive">

<table class="table table-bordered table-striped table-sm" >
  <thead class="navbar-bg">
  <tr class="text-center align-middle">
    <th >Nombre</th>
    <th >Parentesco</th>
    <th >Dirección</th>
    <th >Teléfono</th>
    <th ><i class='fa-solid fa-trash'></i></th>
  </tr>
  </thead>
  <tbody style="font-size: .9em;">
  <?php
  $sql_d_familiares = "SELECT * FROM tb_usuarios_familiares WHERE id_usuario = '".$Session_IDUsuarioBD."' ";
  $result_d_familiares = mysqli_query($con, $sql_d_familiares);
  $numero_d_familiares = mysqli_num_rows($result_d_familiares);
  if ($numero_d_familiares > 0) {
    while($row_familiares = mysqli_fetch_array($result_d_familiares, MYSQLI_ASSOC)){
    $idDP = $row_familiares['id'];
    echo "<tr class='text-center align-middle'>";
    echo "<td>".$row_familiares['nombrecompleto']."</td>";
    echo "<td>".$row_familiares['parentesco']."</td>";
    echo "<td>".$row_familiares['domicilio']."</td>";
    echo "<td>".$row_familiares['telefono']."</td>";
    echo "<td class='align-middle text-center' width='40px'>
    <button type='button' class='btn btn-danger btn-circle' onclick='EliminarDatosF($idDP)'>
    <i class='fa-solid fa-trash'></i>
    </button>
    </td>";
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


<!----- MODAL DATOS FAMILIARES ----->
<div class="modal" id="ModalDatosFamiliares">
  <div class="modal-dialog modal-lg" style="margin-top: 83px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar datos familiares</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       

      <div class="form-group mb-2">
      <label class="text-secondary" style="font-size: .9em;">Nombre de mi familiar:</label>
      <input id="NomFamiliar" type="text" class="form-control rounded-0"  placeholder="Agregar nombre">
      </div>

     <div class="form-group mb-2">
       <label class="text-secondary" style="font-size: .9em;">Parentesco:</label>
       <select id="Parentesco" class="form-control rounded-0" >
         <option value="">Seleccionar parentesco...</option>
         <option value="Padre">Padre</option>
         <option value="Madre">Madre</option>
         <option value="Conyugue">Conyugue</option>
         <option value="Hijo">Hijo</option>
         <option value="Otro">Otro</option>
       </select>
     </div>


      <div class="form-group mb-2">
      <label class="text-secondary" style="font-size: .9em;">Dirección completa:</label>
      <input id="Direccion" type="text" class="form-control rounded-0"  placeholder="Agregar dirección">
      </div>
      
      <div class="form-group ">
        <label class="text-secondary" style="font-size: .9em;">Teléfono:</label>
      <input id="TelefonoF" type="text" class="form-control rounded-0"  placeholder="Agregar teléfono">
      </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="agregarDatosF()">Agregar</button>
      </div>
    </div>
  </div>
</div>


