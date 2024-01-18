<?php
require('app/help.php');

$sql_estaciones = "SELECT nombre, razonsocial FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$estacion = $row_estaciones['nombre'];
}

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
  background: white;
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }

  .hovercolor:hover{
  background: rgba(0, 120, 238, .8) !important;
  }

  .cont-puntos{
    border-bottom: 3px solid #3399cc;
    box-shadow: 1px 1px 5px #EDEDED;
  }

  .titulo-punto{
    font-size: 1.25em;
  }

  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  

  });
  function regresarP(id){
  window.location.href = '../gestoria-nom-035/' + id;
  }

  function BTNarchivo(numarchivo){

    var ArchivoPdf;
    var ArchivoPdf_file;
    var ArchivoPdf_filePath;
    var ext;
    var idfile;

    var data = new FormData();
    var url = '../public/administrador/agregar/agregar-archivo-nom035-factoresriesgo.php';

    if(numarchivo == 1){

    ArchivoPdf = document.getElementById("Guia");
    ArchivoPdf_file = ArchivoPdf.files[0];
    ArchivoPdf_filePath = ArchivoPdf.value;
    ext = $("#Guia").val().split('.').pop();
    idfile = "Guia";

  }else if(numarchivo == 2){

    ArchivoPdf = document.getElementById("FormatoAC");
    ArchivoPdf_file = ArchivoPdf.files[0];
    ArchivoPdf_filePath = ArchivoPdf.value;
    ext = $("#FormatoAC").val().split('.').pop();
    idfile = "FormatoAC";
    
  }

  if (ArchivoPdf_filePath != "") {
    $('#' + idfile).css('border','');
    if (ext == "PDF" || ext == "pdf") {

    data.append('idEstacion',<?=$idEstacion;?>);
    data.append('numarchivo', numarchivo);
    data.append('ArchivoPdf_file', ArchivoPdf_file);

    $.ajax({
    url: url,
    type: 'POST',
    contentType: false,
    data: data,
    processData: false,
    cache: false
    }).done(function(data){

    $('#td3' + numarchivo).html('<a target="_BLANK" href="../'+data+'"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>');
    $("#" + idfile).val(null);

    });

  }else{
    $('#' + idfile).css('border','2px solid #A52525'); 
  }
  }else{
    $('#' + idfile).css('border','2px solid #A52525'); 
  }

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
      <a onclick="regresarP(<?=$idEstacion;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
    <div class="float-left"><h4><?=$estacion;?> NOM-035 (Factores de riesgo psicosocial) </h4></div>
    </div>

<div class="card-body">

<div class="row">   

<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mb-3 "> 

<div class="border p-3" style="font-size: 1.2em">
<b>¿Qué son los factores de riesgo psicosocial?</b><br>

Aquellos que pueden provocar trastornos de ansiedad, no orgánicos del ciclo sueño-vigilia y de estrés grave y de adaptación, derivado de la naturaleza de las funciones del puesto de trabajo, el tipo de jornada de trabajo y la exposición a acontecimientos traumáticos severos o a actos de violencia laboral al trabajador, por el trabajo desarrollado.
<div class="border-top mt-2 mb-2"></div>

<ul>
  <li>Condiciones peligrosas e inseguras en el ambiente de trabajo.</li>
  <li>Cargas de trabajo cuando exceden la capacidad del trabajador.</li>
  <li>Falta de control sobre el trabajo (posibilidad de influir en la organización y desarrollo del trabajo cuando el proceso lo permite).</li>
  <li>Jornadas de trabajo superiores a las previstas en la Ley Federal del Trabajo.</li>
  <li>Rotación de turnos sin períodos de recuperación y descanso.</li>
  <li>Interferencia en la relación trabajo-familia.</li>
  <li>Liderazgo negativo.</li>
  <li>Relaciones negativas en el trabajo.</li>
</ul>

<b>IMPORTANTE</b><br>

Recuerda que el cuestionario debe ser respondido por cada uno de los empleados del centro de trabajo.<br>

<u>Se deben responder todas las preguntas del cuestionario, sin dejar alguna sin contestar.</u><br><br>

<p class="font-weight-light">**De la pregunta 1 a la 43 responde todo el personal, preguntas 44, 45 y 46 únicamente responden los encargados, gerentes o jefes de turno.</p>


<?php
$sql_a_c = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Factores-riesgo-psicosocial' AND nom_archivo = 'guia-ii' ORDER BY id desc LIMIT 1";
      $result_a_c = mysqli_query($con, $sql_a_c);     
      $numero_a_c = mysqli_num_rows($result_a_c);
      if ($numero_a_c > 0) {
      while($row_a_c = mysqli_fetch_array($result_a_c, MYSQLI_ASSOC)){
      $acontecimiento_c = $row_a_c['archivo'];
      $imgcuestionario = '<a target="_BLANK" href="../'.$acontecimiento_c.'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
      }
      }else{
      $imgcuestionario = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png">';  
      }

      $sql_a_ts = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Factores-riesgo-psicosocial' AND nom_archivo = 'formato-a-c' ORDER BY id desc LIMIT 1";
      $result_a_ts = mysqli_query($con, $sql_a_ts);     
      $numero_a_ts = mysqli_num_rows($result_a_ts);
      if ($numero_a_ts > 0) {
      while($row_a_ts = mysqli_fetch_array($result_a_ts, MYSQLI_ASSOC)){
      $acontecimiento_ts = $row_a_ts['archivo'];
      $imgtriptico = '<a target="_BLANK" href="../'.$acontecimiento_ts.'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
      }
      }else{
      $imgtriptico = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png">';  
      }
?>   	


   </div>
    </div>


      <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12" style="overflow-y: hidden;"> 
          <table class="table table-bordered table-striped table-sm">
            <tr>
              <td class="align-middle"><b>Guía II</b></td>
              <td>
                <div class="form-inline">
                  

           <div class="row p-2">

                  <div class="col-12 mb-2">
                  <input type="file" style="font-size: .8em;" id="Guia">
                  </div>

                  <div class="col-12 text-right">
                  <button type="submit" class="btn btn-secondary btn-sm rounded-0 p-1" onclick="BTNarchivo(1)">Agregar PDF</button>
                </div>

                </div>

                </td>
              <td class="align-middle text-center" width="24" id="td31"><?=$imgcuestionario;?></td>
            </tr>
            <tr>
              <td class="align-middle"><b>Formato Acuerdo de conformidad</b></td>
              <td>
                <div class="form-inline">
                  
                  <div class="row p-2">

                  <div class="col-12 mb-2">
                  <input type="file" style="font-size: .8em;" id="FormatoAC">
                  </div>

                  <div class="col-12 text-right">
                  <button type="submit" class="btn btn-secondary btn-sm rounded-0 p-1" onclick="BTNarchivo(2)">Agregar PDF</button>
                </div>

                </div>


                </td>
              <td class="align-middle text-center" width="24" id="td32"><?=$imgtriptico;?></td>
            </tr>
          </table>
          </div>
         
        </div>

</div>

</div>
</div>
</div>
</div>


  </div>
  </div>
  </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
