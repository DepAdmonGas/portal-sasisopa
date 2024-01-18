 <?php 
require('../../../app/help.php');

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id = '".$Session_IDUsuarioBD."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$usuarioPerfil = $row_usuarios['usuario'];
$passwordPerfil = $row_usuarios['password'];
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
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();

$('#mostrar_usuario').click(function () {

         var type = $("#UsuarioPerfil").attr("type");

         if (type === "password") {
           $('#UsuarioPerfil').attr('type', 'text');
         }else{
           $('#UsuarioPerfil').attr('type', 'password');
         }


       });

         $('#mostrar_password').click(function () {

         var type = $("#PasswordPerfil").attr("type");

         if (type === "password") {
           $('#PasswordPerfil').attr('type', 'text');
         }else{
           $('#PasswordPerfil').attr('type', 'password');
         }


       });

});

function editarUsuario(){
$('#ModalEditarUsuarioPassword').modal('show');
}

function UsuarioAleatorio()
{
  long=parseInt(10);
  var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
  var contraseña = "";
  for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  $('#NomUsuario').val(contraseña);
}

function PasswordAleatorio(){
  long=parseInt(10);
  var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
  var contraseña = "";
  for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  $('#PasswordOriginal').val(contraseña);
  $('#PasswordCopia').val(contraseña);
}

function BtnGcambios(){

  $('#NomUsuario').css('border','');
  $('#PasswordOriginal').css('border','');
  $('#PasswordCopia').css('border','');
  var NomUsuario = $('#NomUsuario').val();
  var PasswordOriginal = $('#PasswordOriginal').val();
  var PasswordCopia = $('#PasswordCopia').val();

  if (NomUsuario != "") {
  if (PasswordOriginal != "") {
  if (PasswordCopia != "") {
  if (PasswordOriginal == PasswordCopia) {

    var parametros = {
      "idUsuario" : <?=$Session_IDUsuarioBD; ?>,
       "NomUsuario" : NomUsuario,
       "PasswordOriginal" : PasswordOriginal
      };

      alertify.confirm('',
      function(){

        $.ajax({
         data:  parametros,
         url:   'public/perfil/modelo/editar/editar-usuario.php',
         type:  'post',
         beforeSend: function() {
        $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
         },
         complete: function(){
        $('#Result').html("");
         },
         success:  function (response) {
         $('#ModalEditarUsuarioPassword').modal('hide');
         window.setTimeout("DatosUsuario()",1000);
         alertify.message('El usuario y contraseña fueron editados');
         window.location.href = "<?=RUTA_SALIR2?>salir"; 
         }
         });

      }, 
      function(){
      }).setHeader('Editar Usuario o Contraseña').set({transition:'zoom',message: '¿Desea editar el nombre de usuario y contraseña?, si da clic en el botón aceptar tendrá que iniciar una nueva sesión por seguridad.',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


  }else{
    $('#PasswordOriginal').css('border','2px solid #A52525');
    $('#PasswordCopia').css('border','2px solid #A52525');
    $('#ResultPassword').html('<div class="text-center text-danger" style="padding: 10px;">Verifique que las contraseñas coincidan</div>');
  }
  }else{
  $('#PasswordCopia').css('border','2px solid #A52525');
  }
  }else{
  $('#PasswordOriginal').css('border','2px solid #A52525');
  }
  }else{
  $('#NomUsuario').css('border','2px solid #A52525');
  }
}
</script>


<!----- VISTA DATOS USUARIO ----->

<div class="border-0 p-3"> 

<div class="row">
<div class="col-12">

<a class="float-end pointer" onclick="editarUsuario()" >
<img src="<?php echo RUTA_IMG_ICONOS."editar.png"; ?>">
</a>

</div>
</div> 
<hr>

<div class="row align-center">

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-2">
      <div class="text-muted" style="font-size: .9em;">Puesto:</div>
      <div style="font-size: 1.2em;border: 0;">
      <?php echo $puesto; ?>
      </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-2">
    <div class="text-muted" style="font-size: .9em;">Usuario:</div>
    <div>
    <a id="mostrar_usuario" style="cursor: pointer;padding: 5px;" data-toggle="tooltip" data-placement="left" title="Ver Usuario">
    <img src="<?php echo RUTA_IMG_ICONOS."ojo.png"; ?>">
    </a>
    <input type="password" id="UsuarioPerfil" style="font-size: 1.2em;border: 0;" value="<?php echo $usuarioPerfil; ?>" readonly />
    </div>
  </div>

    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-2">
    <div class="text-muted" style="font-size: .8em;">Contraseña:</div>
    <div>
    <a id="mostrar_password" style="cursor: pointer;padding: 5px;" data-toggle="tooltip" data-placement="left" title="Ver Password">
    <img src="<?php echo RUTA_IMG_ICONOS."ojo.png"; ?>">
    </a>
    <input type="password" id="PasswordPerfil" style="font-size: 1.2em; border: 0;" value="<?php echo $passwordPerfil; ?>" readonly />
    </div>
  </div>
</div>

</div>


<div class="modal fade" id="ModalEditarUsuarioPassword" >
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header">
        <h5 class="modal-title">Editar Usuario o Contraseña</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="form-group">
        <div class="row no-gutters">
             <div class="col-10 mb-3">
             <input class="form-control input-style" type="text" id="NomUsuario" value="<?=$usuarioPerfil;?>" placeholder="Usuario" style="border-radius: 0px;">
             </div>
             <div class="col-2 mb-3">
               <div class="text-center" style="margin-top: 5px;">
               <a onclick="UsuarioAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Usuario Aleatorio">
                 <img src="<?php echo RUTA_IMG_ICONOS."aleatorio.png"; ?>">
               </a>
               </div>
             </div>
             </div>
           </div>

        <div class="row">
           
           <div class="col-10 col-md-5 mb-2">
             <input class="form-control input-style" type="text" id="PasswordOriginal" value="<?=$passwordPerfil;?>" style="border-radius: 0px;" placeholder="Contraseña">
           </div>

           <div class="col-2 col-md-2 mb-2">
             <div class="text-center" style="margin-top: 15px;">
             <a onclick="PasswordAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Contraseña Aleatoria">
               <img src="<?php echo RUTA_IMG_ICONOS."aleatorio.png"; ?>">
             </a>
             </div>
           </div>
           <div class="col-12 col-md-5 mb-2">
          <input class="form-control input-style" type="password" id="PasswordCopia" value="<?=$passwordPerfil;?>" style="border-radius: 0px;" placeholder="Repetir contraseña">
           </div>
           </div>

           <div id="Result"></div>

      </div>
     

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal" style="border-radius: 0px;border: 0px;">Cancelar</button>
     <button type="button" class="btn btn-primary" onclick="BtnGcambios()" style="border-radius: 0px;border: 0px;">Guardar cambios</button>
  </div>


    </div>
  </div>
</div>