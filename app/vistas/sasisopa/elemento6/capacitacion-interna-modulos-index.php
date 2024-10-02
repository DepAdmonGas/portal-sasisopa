<?php
require('app/help.php');
include_once "app/modelo/Cursos.php";
$class_cursos = new Cursos();
$query = $class_cursos->cursosTemas($idModulo);


?>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
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

  function ListaPersonal(idModulo,idTema){
    let targets = [7];
  $('#DivPersonal').html("<img src='<?=RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
  $('#DivPersonal').load('../app/vistas/sasisopa/elemento6/lista-personal-capacitacion-modulos.php?idModulo=' + idModulo + '&idTema=' + idTema, function() {
  $('#table-capacitacion-interna').DataTable({
    "language": {
    "url": "<?=RUTA_JS?>es-ES.json"
  },
  "stateSave": true,
    "lengthMenu": [30,40,50],
    "columnDefs": [
    { "orderable": false, "targets": targets },
    { "searchable": false, "targets": targets }
    ]
  });
  });  
  }

  function ProgramarFecha(idModulo,idTema, idUsuario){
  $('#ModalCapacitacion').modal('show');
  $('#Contenidomodal').load('../app/vistas/sasisopa/elemento6/formulario-agregar-capacitacion-interna.php?idModulo=' + idModulo + '&idTema=' + idTema + '&idUsuario=' + idUsuario);
  }

  function btnAgregar(idModulo,idTema, idUsuario){
  var FechaCurso = $('#FechaCurso').val();

  if (FechaCurso != "") {
  $('#FechaCurso').css('border',''); 

  var parametros = {
        "accion" : "agregar-capacitacion-interna",
        "idTema" : idTema,
        "idUsuario" : idUsuario,
        "FechaCurso" : FechaCurso
      };

  $.ajax({
   data:  parametros,
   url:   '../app/controlador/CursosControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   $('#ModalCapacitacion').modal('hide');
   alertify.success('Se programo el curso correctamente');
   ListaPersonal(idModulo,idTema);
   }
   });

 
  }else{
  $('#FechaCurso').css('border','2px solid #A52525');  
  }

  }

  function ListaFechas(idModulo,idTema,idUsuario){
  $('#ModalCapacitacion').modal('show');
  $('#Contenidomodal').load('../app/vistas/sasisopa/elemento6/lista-capacitacion-interna.php?idModulo=' + idModulo + '&idTema=' + idTema + '&idUsuario=' + idUsuario);
  }

  function Eliminar(Id,idModulo,idTema, idUsuario){
  var parametros = {
        "accion" : "eliminar-capacitacion-interna",
        "id" : Id
      };

  $.ajax({
   data:  parametros,
   url:   '../app/controlador/CursosControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
  $('#Contenidomodal').load('../app/vistas/sasisopa/elemento6/lista-capacitacion-interna.php?idModulo=' + idModulo + '&idTema=' + idTema + '&idUsuario=' + idUsuario);

  ListaPersonal(idModulo,idTema);
     }

   });
  }
  
  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

      <!-- Inicio -->
      <div aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-caret">
      <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-2);"><i class="fa-solid fa-house"></i> SASISOPA</li>
      <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP()">6. COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO</li>
      <li aria-current="page" class="breadcrumb-item active">CAPACITACIÓN INTERNA TEMAS</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>CAPACITACIÓN INTERNA TEMAS</h3>


    <div class="mt-3">
    <div class="row no-gutters">
    <?php
    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
      $idTema = $row['id'];
    ?>
    <!-- CARD - CAPACITACION EXTERNA -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2 mb-2 "> 
    <div class="" style="padding: 5px;" >
      <div class="card-cursos-float" onclick="ListaPersonal(<?=$idModulo;?>,<?=$idTema;?>)">
      <div class="card card-cursos-home" >
      <div class="card-body text-center">
      <h5><span class="badge badge-pill badge-secondary"><?=$row['num_tema'] ?></span> <?=$row['titulo']; ?></h5>
      </div>
      </div>
      </div>
    </div>
    </div>
    <?php
    }
    ?>
    </div>
    </div>

    <div class="bg-white p-3">

    <div id="DivPersonal">
    <div class="alert alert-secondary" role="alert">
    Selecciona el modulo para visualizar el programa
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
     <!---------- LIBRERIAS DEL DATATABLE ---------->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
  
  </body>
  </html>
