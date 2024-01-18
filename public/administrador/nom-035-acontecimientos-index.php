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
    var url = '../public/administrador/agregar/agregar-archivo-nom035-acontecimientos.php';

    if(numarchivo == 5){

    ArchivoPdf = document.getElementById("Guia");
    ArchivoPdf_file = ArchivoPdf.files[0];
    ArchivoPdf_filePath = ArchivoPdf.value;
    ext = $("#Guia").val().split('.').pop();
    idfile = "Guia";

  }else if(numarchivo == 6){

    ArchivoPdf = document.getElementById("TripticoATS");
    ArchivoPdf_file = ArchivoPdf.files[0];
    ArchivoPdf_filePath = ArchivoPdf.value;
    ext = $("#TripticoATS").val().split('.').pop();
    idfile = "TripticoATS";
    
  }else if(numarchivo == 7){

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
    <div class="float-left"><h4><?=$estacion;?> NOM-035 (Acontecimientos traumáticos severos) </h4></div>
    </div>


<div class="card-body">

<div class="row">

<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mb-3">
<div class="border p-3" style="font-size: 1.2em">

<b>¿Qué son los acontecimientos traumáticos severos?</b>
<br>
Son aquellos sucesos que se presentan de manera repentina y que, por su gravedad pueden ocasionar daños a las instalaciones o al personal.
<br>
<b>¿Cuándo se debe aplicar la Guía I?</b>
<br>
Al menos un mes después de que ocurra un acontecimiento traumático severo.


<div class="border-top mt-2 mb-2"></div>
<b>¿A quién se aplica la Guía I?</b><br>

Se aplica a los trabajadores involucrados en el acontecimiento.
<br>
<b>IMPORTANTE</b>
<br>
Ten en cuenta que cada pregunta habla de los efectos de los eventos traumáticos severos ocurridos en tus actividades laborales.

</div>
</div>


      <?php
      $sql_a_c = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Acontecimientos-t-s' AND nom_archivo = 'acontecimientos-cuestionario' ORDER BY id desc LIMIT 1";
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

      $sql_a_ts = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Acontecimientos-t-s' AND nom_archivo = 'acontecimientos-triptico' ORDER BY id desc LIMIT 1";
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

      $sql_aa = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Acontecimientos-t-s' AND nom_archivo = 'acontecimientos-acuerdo' ORDER BY id desc LIMIT 1";
      $result_aa = mysqli_query($con, $sql_aa);     
      $numero_aa = mysqli_num_rows($result_aa);
      if ($numero_aa > 0) {
      while($row_aa = mysqli_fetch_array($result_aa, MYSQLI_ASSOC)){
      $acontecimientoa = $row_aa['archivo'];
      $imgacuerdo = '<a target="_BLANK" href="../'.$acontecimientoa.'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
      }
      }else{
      $imgacuerdo = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png">';  
      }

      $sql_rc = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Acontecimientos-t-s' AND nom_archivo = 'acontecimientos-resultado-cuestionario' ORDER BY id desc LIMIT 1";
      $result_rc = mysqli_query($con, $sql_rc);     
      $numero_rc = mysqli_num_rows($result_rc);
      if ($numero_rc > 0) {
      while($row_rc = mysqli_fetch_array($result_rc, MYSQLI_ASSOC)){
      $acontecimientorc = $row_rc['archivo'];
      $imgresultadocuestionario = '<a target="_BLANK" href="../'.$acontecimientorc.'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
      }
      }else{
      $imgresultadocuestionario = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png">';  
      }

    
      ?>
    	
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12" style="overflow-y: hidden;">

          <table class="table table-bordered table-striped table-sm">
           
            <tr>
              <td class="align-middle"><b>Guía I. Cuestionario para identificar a los trabajadores que fueron sujetos a acontecimientos traumáticos severos (II.1)</b></td>
              
              <td class="align-middle">
                <div class="form-inline">
                  
               <div class="row p-2"> 
                
                <div class="col-12 mb-2">
                  <input type="file" style="font-size: .8em;" id="Guia">
                </div>
                  
                <div class="col-12 text-right">
                  <button type="submit" class="btn btn-secondary btn-sm rounded-0" onclick="BTNarchivo(5)">Agregar PDF</button>
                   </div>

                  </div>

                  </div>
                </td>

              <td class="align-middle text-center" width="24" id="td35"><?=$imgcuestionario;?></td>
            </tr>



            <tr>
              <td class="align-middle"><b>Tríptico Acontecimientos traumáticos severos</b></td>
              <td>
                
                <div class="form-inline">
                  
                    <div class="row p-2"> 
                    <div class="col-12 mb-2">
                  <input type="file" style="font-size: .8em;" id="TripticoATS">
                    </div>

                    <div class="col-12 text-right">
                  <button type="submit" class="btn btn-secondary btn-sm rounded-0" onclick="BTNarchivo(6)">Agregar PDF</button>
                  </div>
                  </div>
                </div>

                </td>

              <td class="align-middle text-center" width="24" id="td36"><?=$imgtriptico;?></td>
            </tr>



            <tr>
              <td class="align-middle"><b>Formato Acuerdo de conformidad</b></td>
              <td class="align-middle">
                <div class="form-inline">
                  
                <div class="row p-2"> 
                    
                 <div class="col-12 mb-2">   
                  <input type="file" style="font-size: .8em;" id="FormatoAC">
                </div>
                    
                  <div class="col-12 text-right">
                  <button type="submit" class="btn btn-secondary btn-sm rounded-0 p-1" onclick="BTNarchivo(7)">Agregar PDF</button>
                  </div>

               </div>
              </div>

                </td>

              <td class="align-middle text-center" width="24" id="td37"><?=$imgacuerdo;?></td>
            </tr>
          </table>


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



