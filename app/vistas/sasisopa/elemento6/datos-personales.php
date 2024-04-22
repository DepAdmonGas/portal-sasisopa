<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Personal.php";

$class_personal = new Personal();
$idUsuario = $_GET['idUsuario'];

$row_usuarios = $class_personal->buscarPersonal($idUsuario);
$nombres = $row_usuarios['nombre'];
$fecha_nacimiento = $row_usuarios['fecha_nacimiento'];
$estado_civil = $row_usuarios['estado_civil'];
$segurosocial = $row_usuarios['seguro_social'];
$domicilio = $row_usuarios['domicilio'];
$telefono = $row_usuarios['telefono'];
$email = $row_usuarios['email'];
$usuario = $row_usuarios['usuario'];
$password = $row_usuarios['password'];
$puesto = $row_usuarios['tipo_puesto'];

?> 

<div class="border">
<div class="p-3">  

<div style="font-size: 1.4em;">1. Datos del personal</div>
<hr>

<div class="row" >

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2"> 
<input id="Nombres" type="text" class="form-control" name="" value="<?=$nombres;?>" onchange="nombres(<?=$idUsuario;?>)" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar nombre completo">
<div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Nombre completo:</div>
</div>


<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 mb-2"> 
  <input id="DireccionCompleta" type="text" class="form-control" name="" value="<?=$domicilio;?>" onchange="domicilio(<?=$idUsuario;?>)" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar domicilio completo">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Domicilio( Calle, Numero, Colonia, Municipio, Estado, C.P.):</div>
</div>


<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2"> 
  <input id="FechaNac" type="date" class="form-control" name="" value="<?=$fecha_nacimiento;?>" onchange="fechan(<?=$idUsuario;?>)" style="border: 0px;border-radius: 0px;font-size: 1.2em;">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Fecha de nacimiento:</div>
</div>


<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2"> 
  <select id="EstadoCivil" class="form-control" style="border: 0px;border-radius: 0px;font-size: 1.2em;" onchange="estadocivil(<?=$idUsuario;?>)">
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
  <input id="NumeroSSocial" type="text" class="form-control" name="" value="<?=$segurosocial;?>" onchange="segurosocial(<?=$idUsuario;?>)" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar numero de seguro social">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">No. De seguro social:</div>
</div>


<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 
  <input id="PerfilTelefono" type="text" class="form-control" name="" value="<?=$telefono;?>" onchange="telefono(<?=$idUsuario;?>)" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar telefono de contacto">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Telefono:</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 
  <input id="Email" type="text" class="form-control" name="" value="<?=$email;?>" onchange="email(<?=$idUsuario;?>)" style="border: 0px;border-radius: 0px;font-size: 1.2em;" placeholder="Agregar correo electrónico">
  <div style="border-bottom: 1px solid #f0f0f0;"></div>
<div class="text-secondary" style="padding-left: 10px;padding-right: 10px;padding-top:5px;font-size: .9em;">Correo electrónico:</div>
</div>

</div>

</div>
</div>


