<?php
require('app/help.php');
?>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>alertify.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap-select.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
      <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  ListaPersonal(2);
  });
  function regresarP(){
   window.history.back();
  }

  function AgregarUsuario(){
  $('#myModalAgregar').modal('show');
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

  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }

  function btnAgregarPersonal(){
    $('#Nombres').css('border','');
    $('#Telefono').css('border','');
    $('#Email').css('border','');
    $('#Puesto').css('border','');
    $('#NomUsuario').css('border','');
    $('#PasswordOriginal').css('border','');
    $('#PasswordCopia').css('border','');

    var Nombres = $('#Nombres').val();
    var Telefono = $('#Telefono').val();
    var Email = $('#Email').val();
    var Puesto = $('#Puesto').val();
    var NomUsuario = $('#NomUsuario').val();
    var PasswordOriginal = $('#PasswordOriginal').val();
    var PasswordCopia = $('#PasswordCopia').val();
    var FechaIngreso = $('#FechaIngreso').val();

    if (Nombres != "") {
    if (validateEmail(Email)) {
    if (Puesto != "") {
    if (NomUsuario != "") {
    if (PasswordOriginal != "") {
    if (PasswordCopia != "") {
    if (PasswordOriginal == PasswordCopia) {

      var parametros = {
        "idEstacion" : <?php echo $Session_IDEstacion; ?>,
        "Nombres" : Nombres,
         "Email" : Email,
         "Puesto" : Puesto,
         "Telefono" : Telefono,
         "NomUsuario" : NomUsuario,
         "PasswordOriginal" : PasswordOriginal,
         "FechaIngreso" : FechaIngreso
        };

  alertify.confirm('',
  function(){

  $.ajax({
   data:  parametros,
   url:   'public/gerente/agregar/agregar-usuario.php',
   type:  'post',
   beforeSend: function() {
  $('#Result').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
   },
   complete: function(){
  $('#Result').html("");
   },
   success:  function (response) {
   $('#myModalAgregar').modal('hide');
   ListaPersonal(2);
   alertify.message('El usuario fue agregado');
   Limpiar();
   }
   });


  },
  function(){
  }).setHeader('Agregar Personal').set({transition:'zoom',message: 'Desea agregar el siguiente usuario al personal de la estación',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    }else{
    $('#Puesto').css('border','2px solid #A52525');
    }
    }else{
    $('#Email').css('border','2px solid #A52525');
    }
    }else{
    $('#Nombres').css('border','2px solid #A52525');
    }

  }
  function Limpiar(){
    $('#Nombres').val('');
    $('#ApellidoP').val('');
    $('#ApellidoM').val('');
    $('#Telefono').val('');
    $('#Email').val('');
    $('#Puesto').val('');
    $('#NomUsuario').val('');
    $('#PasswordOriginal').val('');
    $('#PasswordCopia').val('');
  }

  function ListaPersonal(cate){
    $('#DivPersonal').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
    $('#DivPersonal').load('public/gerente/vistas/lista-personal-estacion.php?categoria=' + cate);
  }
  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
      <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
    <div class="float-left"><h4>PERSONAL</h4></div>

    <div class="float-right">
    <a onclick="AgregarUsuario()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar usuario" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>

    <div class="float-right" style="padding-right: 20px;">

      <?php 
      if($session_nomestacion == 'Interlomas'){
        $descarga = "FORMATO DE RENUNCIA INTERLOMAS.docx";
      }else if($session_nomestacion == 'Palo Solo'){
        $descarga = "FORMATO DE RENUNCIA PALO SOLO.docx";
      }else if($session_nomestacion == 'San Agustin'){
        $descarga = "FORMATO DE RENUNCIA SAN AGUSTIN.docx";
      }else if($session_nomestacion == 'Gasomira'){
        $descarga = "FORMATO DE RENUNCIA GASOMIRA.docx";
      }else if($session_nomestacion == 'Valle de Guadalupe'){
        $descarga = "FORMATO DE RENUNCIA VALLE.docx";
      }else if($session_nomestacion == 'Esmegas'){
        $descarga = "FORMATO DE RENUNCIA ESMEGAS.docx";
      }else if($session_nomestacion == 'Xochimilco'){
        $descarga = "FORMATO DE RENUNCIA XOCHIMILCO.docx";
      }


       ?>

    <a class="mr-2" href="<?=RUTA_ARCHIVOS;?>renuncia/<?=$descarga;?>" download style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar formato de renuncia" >
    <img src="<?php echo RUTA_IMG_ICONOS."descargar.png"; ?>">
    </a>

    <div class="btn-group dropleft">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Buscar
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" onclick="ListaPersonal(1)">Todos</a>
      <a class="dropdown-item" onclick="ListaPersonal(2)">Activos</a>
      <a class="dropdown-item" onclick="ListaPersonal(3)">Eliminados</a>
    </div>
  </div>
    </div>

    <div class="bg-white mt-5 p-3">
    <div id="DivPersonal"></div>
    </div>


    </div>

    <div class="modal fade bd-example-modal-lg" id="myModalAgregar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h5 class="modal-title">Agregar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
          <div class="row no-gutters">
             
             <div class="col-12">
               <input class="form-control input-style" type="text" id="Nombres" style="border-radius: 0px;" placeholder="Nombre Completo">
             </div>
             </div>

           </div>


           <div class="form-group">
           
           <div class="row no-gutters">
              <div class=" col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                <input class="form-control input-style" type="text" id="Telefono" style="border-radius: 0px;" placeholder="Telefono">
              </div>

              <div class=" col-xl-6 col-lg-6 col-md-6 col-12">
                <input class="form-control input-style" type="email" id="Email" style="border-radius: 0px;" placeholder="Correo electronico">
              </div>
              </div>

            </div>

            <div><b>Fecha de Ingreso:</b></div>
            <input type="date" class="form-control rounded-0 mb-3" placeholder="Fecha de ingreso" id="FechaIngreso">

        <div class="form-group">
       <select class="form-control" id="Puesto" placeholder="Puesto" style="border-radius: 0px;">
         <option value="">Puesto</option>
         <?php
         $sql_puesto = "SELECT * FROM tb_puestos WHERE tipo_puesto <> 'Administrador' and tipo_puesto <> 'Gerente' and tipo_puesto <> 'Sistemas' and tipo_puesto <> 'Dirección' and tipo_puesto <> 'Comercializadora' and tipo_puesto <> 'Gestoria' and tipo_puesto <> 'Mantenimiento'";
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
          <input class="form-control input-style" type="text" id="NomUsuario" placeholder="Usuario" style="border-radius: 0px;">
          </div>
          <div class="col-1">
            
            <div class="text-center ml-2" style="margin-top: 5px;">
            <a onclick="UsuarioAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Usuario Aleatorio">
              <img src="<?php echo RUTA_IMG_ICONOS."aleatorio.png"; ?>">
            </a>
            </div>
          </div>
 
          </div>
        </div>
 

        <div class="row no-gutters">
           <div class="col-5">
             <input class="form-control input-style" type="text" id="PasswordOriginal" style="border-radius: 0px;" placeholder="Contraseña">
           </div>
           <div class="col-2">
             
             <div class="text-center align-middle" style="margin-top: 10px;">
             <a onclick="PasswordAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Contraseña Aleatoria">
               <img src="<?php echo RUTA_IMG_ICONOS."aleatorio.png"; ?>">
             </a>
             </div>

           </div>
           <div class="col-5">
             <input class="form-control input-style" type="password" id="PasswordCopia" style="border-radius: 0px;" placeholder="Repetir contraseña">
           </div>
           </div>

           <div class="" id="Result"></div>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAgregarPersonal()">Guardar Cambios</button>
        </div>

      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
