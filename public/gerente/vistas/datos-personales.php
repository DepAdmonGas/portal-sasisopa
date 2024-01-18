<?php
require('../../../app/help.php');
$idUsuario = $_GET['idUsuario'];

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id = '".$idUsuario."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$nombres = $row_usuarios['nombre'];
$fecha_nacimiento = $row_usuarios['fecha_nacimiento'];
$estado_civil = $row_usuarios['estado_civil'];
$segurosocial = $row_usuarios['seguro_social'];
$domicilio = $row_usuarios['domicilio'];
$telefono = $row_usuarios['telefono'];
$email = $row_usuarios['email'];
$usuario = $row_usuarios['usuario'];
$password = $row_usuarios['password'];
$idpuesto = $row_usuarios['id_puesto'];

$sql_puesto = "SELECT * FROM us_puesto WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['puesto'];
}
}
?> 
<script type="text/javascript">

function nombres(){
  $('#Nombres').css('border','0px');
  var Nombres = $('#Nombres').val();

  var parametros = {
    "idUsuario" : <?php echo $idUsuario; ?>,
     "Nombres" : Nombres
    };

  if (Nombres != "") {

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/editar/editar-nombres.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {

     }
     });
  }else{$('#Nombres').css('border','2px solid #A52525'); }
}


function domicilio(){
  $('#DireccionCompleta').css('border','0px');
  var DireccionCompleta = $('#DireccionCompleta').val();

  var parametros = {
    "idUsuario" : <?php echo $idUsuario; ?>,
     "DireccionCompleta" : DireccionCompleta
    };

  if (DireccionCompleta != "") {

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/editar/editar-domicilio.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });
  }else{$('#DireccionCompleta').css('border','2px solid #A52525'); }
}

function fechan(){
  $('#FechaNac').css('border','0px');
  var FechaNac = $('#FechaNac').val();

  var parametros = {
    "idUsuario" : <?php echo $idUsuario; ?>,
     "FechaNac" : FechaNac
    };

  if (FechaNac != "") {

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/editar/editar-fechana.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });
  }else{$('#FechaNac').css('border','2px solid #A52525'); }
}

function estadocivil(){
  $('#EstadoCivil').css('border','0px');
  var EstadoCivil = $('#EstadoCivil').val();

  var parametros = {
    "idUsuario" : <?php echo $idUsuario; ?>,
     "EstadoCivil" : EstadoCivil
    };

  if (EstadoCivil != "") {

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/editar/editar-estadocivil.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });
  }else{$('#EstadoCivil').css('border','2px solid #A52525'); }
}

function segurosocial(){
  $('#NumeroSSocial').css('border','0px');
  var NumeroSSocial = $('#NumeroSSocial').val();

  var parametros = {
    "idUsuario" : <?php echo $idUsuario; ?>,
     "NumeroSSocial" : NumeroSSocial
    };

  if (NumeroSSocial != "") {

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/editar/editar-segurosocial.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });
  }else{$('#NumeroSSocial').css('border','2px solid #A52525'); }
}

function telefono(){
  $('#PerfilTelefono').css('border','0px');
  var Telefono = $('#PerfilTelefono').val();

  var parametros = {
    "idUsuario" : <?php echo $idUsuario; ?>,
     "Telefono" : Telefono
    };

    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/editar/editar-telefono.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {
     }
     });

}

function email(){
  $('#Email').css('border','0px');
  var Email = $('#Email').val();

  var parametros = {
    "idUsuario" : <?=$idUsuario;?>,
     "Email" : Email
    };


    $.ajax({
     data:  parametros,
     url:   '../public/perfil/modelo/editar/editar-email.php',
     type:  'post',
     beforeSend: function() {
    },
     complete: function(){
      },
     success:  function (response) {

     }
     });
}
</script>


<div class="border">
<div class="p-3">  

<div style="font-size: 1.4em;">1. Datos del personal</div>
<hr>

<div class="row" >

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2"> 
<input id="Nombres" type="text" class="form-control" name="" value="<?=$nombres;?>" onchange="nombres()" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar nombre completo">
<div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Nombre completo:</div>
</div>


<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2"> 
  <input id="DireccionCompleta" type="text" class="form-control" name="" value="<?=$domicilio;?>" onchange="domicilio()" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar domicilio completo">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Domicilio( Calle, Numero, Colonia, Municipio, Estado, C.P.):</div>
</div>


<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2"> 
  <input id="FechaNac" type="date" class="form-control" name="" value="<?=$fecha_nacimiento;?>" onchange="fechan()" style="border: 0px;border-radius: 0px;font-size: 1.2em;">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Fecha de nacimiento:</div>
</div>


<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2"> 
  <select id="EstadoCivil" class="form-control" style="border: 0px;border-radius: 0px;font-size: 1.2em;" onchange="estadocivil()">
    <?php if ($estado_civil == ""){echo "<option value=''>Agregar estado civil</option>";}else{echo "<option value=''>$estado_civil</option>";} ?>
    <?php if ($estado_civil == "Soltero(a)"){}else{echo "<option value='Soltero(a)'>Soltero(a)</option>"; } ?>
    <?php if ($estado_civil == "Casado(a)"){}else{echo "<option value='Casado(a)'>Casado(a)</option>"; } ?>
    <?php if ($estado_civil == "Divorciado(a)"){}else{echo "<option value='Divorciado(a)'>Divorciado(a)</option>"; } ?>
    <?php if ($estado_civil == "Viudo(a)"){}else{echo "<option value='Viudo(a)'>Viudo(a)</option>"; } ?>
  </select>
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Estado civil:</div>
</div>


<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 
  <input id="NumeroSSocial" type="text" class="form-control" name="" value="<?=$segurosocial;?>" onchange="segurosocial()" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar numero de seguro social">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">No. De seguro social:</div>
</div>


<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 
  <input id="PerfilTelefono" type="text" class="form-control" name="" value="<?=$telefono;?>" onchange="telefono()" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar telefono de contacto">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Telefono:</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 
  <input id="Email" type="text" class="form-control" name="" value="<?=$email;?>" onchange="email()" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar correo electrónico">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Correo electrónico:</div>
</div>

</div>

</div>
</div>


