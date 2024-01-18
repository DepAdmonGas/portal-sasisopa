<?php
require('../../../app/help.php');
$idUsuario = $_GET['idusuario'];

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id = '".$idUsuario."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$nombres = $row_usuarios['nombre'];
$telefono = $row_usuarios['telefono'];
$email = $row_usuarios['email'];
$usuario = $row_usuarios['usuario'];
$password = $row_usuarios['password'];
$idpuesto = $row_usuarios['id_puesto'];

$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}
}
?>
<script type="text/javascript">
function EditUsuarioAleatorio()
{
  long=parseInt(10);
  var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
  var contraseña = "";
  for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  $('#EditNomUsuario').val(contraseña);
}

function EditPasswordAleatorio(){
  long=parseInt(10);
  var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
  var contraseña = "";
  for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  $('#EditPasswordOriginal').val(contraseña);
  $('#EditPasswordCopia').val(contraseña);
}

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

function btnEditarPersonal(idUsuario){

  var EditNombres = $('#EditNombres').val();
  var EditTelefono = $('#EditTelefono').val();
  var EditEmail = $('#EditEmail').val();
  var EditPuesto = $('#EditPuesto').val();
  var EditNomUsuario = $('#EditNomUsuario').val();
  var EditPasswordOriginal = $('#EditPasswordOriginal').val();
  var EditPasswordCopia = $('#EditPasswordCopia').val();


  var parametros = {
    "EditidUsuario" : idUsuario,
    "EditNombres" : EditNombres,
     "EditEmail" : EditEmail,
     "EditPuesto" : EditPuesto,
     "EditTelefono" : EditTelefono,
     "EditNomUsuario" : EditNomUsuario,
     "EditPasswordOriginal" : EditPasswordOriginal
    };

    alertify.confirm('',
    function(){

    $.ajax({
     data:  parametros,
     url:   'public/gerente/editar/edit-usuario.php',
     type:  'post',
     beforeSend: function() {
    $('#ResultEdit').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 0px;' />");
     },
     complete: function(){
       $('#ResultEdit').html("");
     },
     success:  function (response) {
       $('#myModalEditar').modal('hide');
       window.setTimeout("ListaPersonal()",1000);
       alertify.message('El usuario fue editado');
     }
     });
 
    },
    function(){
    }).setHeader('Editar Usuario').set({transition:'zoom',message: 'Desea editar el siguiente usuario',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}
</script>
<div class="modal-body">
<div class="text-right" style="width: 100%;padding-bottom: 10px;">
  <button type="button" class="btn btn-sm btn-outline-info" style="border-radius: 0px;" onclick="VerFicha(<?=$idUsuario; ?>)">Ver ficha del usuario</button>
</div>

  <div class="form-group">
  <div class="row no-gutters">
     <div class="col-12">
       <label class="text-secondary" style="font-size: .9em;">Nombre Completo:</label>
       <input class="form-control input-style" type="text" id="EditNombres" style="border-radius: 0px;" placeholder="Nombres" value="<?=$nombres; ?>">
     </div>
     </div>
   </div>

   <div class="form-group">
   <div class="row no-gutters">
      
      <div class=" col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
        <label class="text-secondary" style="font-size: .9em;">Telefono:</label>
        <input class="form-control input-style" type="text" id="EditTelefono" style="border-radius: 0px;" placeholder="Telefono" value="<?=$telefono; ?>">
      </div>

              <div class=" col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
        <label class="text-secondary" style="font-size: .9em;">Correo electrónico:</label>
        <input class="form-control input-style" type="email" id="EditEmail" style="border-radius: 0px;" placeholder="Correo electrónico" value="<?=$email;?>">
      </div>
      </div>

    </div>

<div class="form-group">
<label class="text-secondary" style="font-size: .9em;">Puesto:</label>
<select class="form-control" id="EditPuesto" placeholder="Puesto" style="border-radius: 0px;">
  <option value="<?=$idpuesto; ?>"><?=$puesto;?></option>
 <?php
 $sql_puesto = "SELECT * FROM tb_puestos WHERE id <> $idpuesto and tipo_puesto <> 'Administrador' and tipo_puesto <> 'Sistemas' and tipo_puesto <> 'Gestoria' and tipo_puesto <> 'Comercializadora' and tipo_puesto <> 'Dirección' and tipo_puesto <> 'Mantenimiento' ";
 $result_puesto = mysqli_query($con, $sql_puesto);
 $numero_puesto = mysqli_num_rows($result_puesto);
 while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
   echo "<option value='".$row_puesto['id']."'>".$row_puesto['tipo_puesto']."</option>";
 }
 ?>
</select>
</div>
<div class="form-group">
<div class="row no-gutters">
  <div class="col-11">
  <label class="text-secondary" style="font-size: .9em;">Usuario:</label>
  <input class="form-control input-style" type="text" id="EditNomUsuario" placeholder="Usuario" style="border-radius: 0px;" value="<?=$usuario; ?>">
  </div>
  <div class="col-1">
    <div class="text-center" style="margin-top: 35px;">
    <a class="align-middle" onclick="EditUsuarioAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Usuario Aleatorio">
      <img src="<?php echo RUTA_IMG_ICONOS."aleatorio.png"; ?>">
    </a>
    </div>
  </div>
  </div>
</div>


<div class="row no-gutters">
   <div class="col-5">
     <label class="text-secondary" style="font-size: .9em;">Contraseña:</label>
     <input class="form-control input-style" type="text" id="EditPasswordOriginal" style="border-radius: 0px;" placeholder="Contraseña" value="<?=$password;?>">
   </div>
   <div class="col-2">
    <div class="text-center" style="margin-top: 35px;">
     <a onclick="EditPasswordAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Contraseña Aleatoria">
       <img src="<?php echo RUTA_IMG_ICONOS."aleatorio.png"; ?>">
     </a>
     </div>
   </div>
   <div class="col-5">
     <label class="text-secondary" style="font-size: .9em;">Repetir contraseña:</label>
     <input class="form-control input-style" type="password" id="EditPasswordCopia" style="border-radius: 0px;" placeholder="Repetir contraseña" value="<?=$password;?>">
   </div>
   </div>
   <div id="ResultEdit"></div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnEditarPersonal(<?=$idUsuario;?>)">Guardar Cambios</button>
</div>
