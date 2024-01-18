<?php
require('app/help.php');

$sql = "SELECT * FROM tb_cursos_temas  WHERE id_modulo = '".$idModulo."' ";
$query = mysqli_query($con, $sql);
 
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
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap-select.css">
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

#Trabajadores{
  display: none;
}

.card-cursos-home{
border: 0px;
border-radius: 0;
box-shadow: 1px 1px 5px #EDEDED;
margin: 0px;
border-bottom: 4px solid #2975C1;
}
.card-cursos-disabled{

border: 0px;
border-radius: 0;
box-shadow: 1px 1px 5px #EDEDED;
margin: 0px;
border-bottom: 4px solid #979797;
background: rgba(204, 204, 204, 0.35);

}

.grayscale {
filter: grayscale(100%); 
}

.card-cursos-float:hover{
  cursor: pointer;
  color: #2975C1;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  });
  function regresarP(){
  window.history.back();
  }

  function ListaPersonal(idTema){
  $('#DivPersonal').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
  $('#DivPersonal').load('../public/sasisopa/vistas/lista-personal-capacitacion-modulos.php?idModulo=<?=$idModulo;?>&idTema=' + idTema);
  }


  function ProgramarFecha(idTema, idUsuario){

  $('#ModalCapacitacion').modal('show');
  $('#Contenidomodal').load('../public/sasisopa/vistas/formulario-agregar-capacitacion-interna.php?idTema=' + idTema + '&idUsuario=' + idUsuario);
  }

  function btnAgregar(idTema, idUsuario){
  var FechaCurso = $('#FechaCurso').val();

  if (FechaCurso != "") {
  $('#FechaCurso').css('border',''); 

  var parametros = {
        "idTema" : idTema,
        "idUsuario" : idUsuario,
        "FechaCurso" : FechaCurso
      };

  $.ajax({
   data:  parametros,
   url:   '../public/sasisopa/agregar/agregar-capacitacion-interna.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   $('#ModalCapacitacion').modal('hide');
   alertify.success('Se programo el curso correctamente');
   ListaPersonal(idTema);
   }
   });

 
  }else{
  $('#FechaCurso').css('border','2px solid #A52525');  
  }

  }

  function ListaFechas(idTema,idUsuario){

$('#ModalCapacitacion').modal('show');
  $('#Contenidomodal').load('../public/sasisopa/vistas/lista-capacitacion-interna.php?idTema=' + idTema + '&idUsuario=' + idUsuario);
  }

  function Eliminar(Id,idTema, idUsuario){
  var parametros = {
        "id" : Id
      };

  $.ajax({
   data:  parametros,
   url:   '../public/sasisopa/eliminar/eliminar-capacitacion-interna.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
  $('#Contenidomodal').load('../public/sasisopa/vistas/lista-capacitacion-interna.php?idTema=' + idTema + '&idUsuario=' + idUsuario);

  ListaPersonal(idTema);
     }

   });



  }

  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal">
    <div class="row no-gutters">
    <div class="col-12">
    <div class="card adm-card" style="border: 0;">
    <div class="adm-car-title">
      <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
      <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>

  <!-- TITULO / ENCABEZADO -->

    <div class="float-left">
      <h4>CAPACITACIÓN INTERNA TEMAS</h4>
    </div>

    </div>
    <div class="card-body">

    <div class="row no-gutters">
<?php
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){

  $idTema = $row['id'];
  
?>

<!-- CARD - CAPACITACION EXTERNA -->
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2 mb-2 "> 

<div class="" style="padding: 5px;" >
  <div class="card-cursos-float" onclick="ListaPersonal(<?php echo $idTema; ?>)">
  <div class="card card-cursos-home" >
  <div class="card-body text-center">
  <h6 class="" data-toggle="tooltip" data-placement="top" title="<?php echo $row['titulo']; ?>"><span class="badge badge-pill badge-secondary"><?php echo $row['num_tema'] ?></span> <?php echo $row['titulo']; ?></h6>
  </div>
  </div>
  </div>
</div>

</div>
 <?php
 }
 ?>
</div>


<div id="DivPersonal">
<div class="alert alert-secondary" role="alert">
Selecciona el modulo para visualizar el programa
</div>
</div>

    </div>
    </div>
    </div>
    </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="ModalCapacitacion" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
<div id="Contenidomodal"></div>

</div>
</div>
</div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
