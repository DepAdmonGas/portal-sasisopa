<?php
require('app/help.php');

$sql_estaciones = "SELECT nombre, razonsocial FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$estacion = $row_estaciones['nombre'];
}

$sql_estaciones = "SELECT politica FROM tb_nom_035_politica WHERE id_estacion = '".$idEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$politica = $row_estaciones['politica'];
}

/*
$sql_espo = "SELECT id, nombre, razonsocial FROM tb_estaciones WHERE nombre <> 'Todas' ";
$result_espo = mysqli_query($con, $sql_espo);
$numero_espo = mysqli_num_rows($result_espo);
while($row_espo = mysqli_fetch_array($result_espo, MYSQLI_ASSOC)){
$id = $row_espo['id'];
$razonsocial = $row_espo['razonsocial'];

$mipolitica = '
<p>En relaci&oacute;n con la prevenci&oacute;n de la violencia laboral, los factores de riesgo psicosocial y la promoci&oacute;n de un entorno organizacional favorable la empresa '.$razonsocial.' asume los siguientes compromisos:</p>
<ol>
<li>La empresa se compromete a dar cabal cumplimiento a la NOM-035 STPS-2018 y dem&aacute;s normatividad aplicable relacionada con los factores de riesgo psicosocial.</li>
<li>Se aplicar&aacute;n medidas encaminadas a mejorar el entorno organizacional, fomentar el sentido de pertenencia de cada uno de los trabajadores y prevenir factores de riesgo psicosocial.</li>
<li>Se capacita al personal de acuerdo a las actividades que realiza, as&iacute; mismo se les informa acerca de los peligros a los que pudieran estar expuestos</li>
<li>Se permite la expresi&oacute;n de todos los trabajadores para denunciar actos contrarios a esta pol&iacute;tica, as&iacute; como las sugerencias de mejora.</li>
<li>El departamento de gesti&oacute;n se encargar&aacute; de vigilar el cumplimiento de esta pol&iacute;tica.</li>
</ol>';

$sql_insert = "INSERT INTO tb_nom_035_politica (
id_estacion,
politica
)
VALUES 
(
'".$id."', 
'".$mipolitica."'
)";
mysqli_query($con, $sql_insert);

}
*/
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
    var url = '../public/administrador/agregar/agregar-archivo-nom035.php';

  	if(numarchivo == 1){

	  ArchivoPdf = document.getElementById("Cuerpo");
	  ArchivoPdf_file = ArchivoPdf.files[0];
	  ArchivoPdf_filePath = ArchivoPdf.value;
	  ext = $("#Cuerpo").val().split('.').pop();
	  idfile = "Cuerpo";

	}else if(numarchivo == 2){

	  ArchivoPdf = document.getElementById("Politica");
	  ArchivoPdf_file = ArchivoPdf.files[0];
	  ArchivoPdf_filePath = ArchivoPdf.value;
	  ext = $("#Politica").val().split('.').pop();
	  idfile = "Politica";
		
	}else if(numarchivo == 3){

	  ArchivoPdf = document.getElementById("Triptico");
	  ArchivoPdf_file = ArchivoPdf.files[0];
	  ArchivoPdf_filePath = ArchivoPdf.value;
	  ext = $("#Triptico").val().split('.').pop();
	  idfile = "Triptico";
		
	}else if(numarchivo == 4){

	  ArchivoPdf = document.getElementById("Acta");
	  ArchivoPdf_file = ArchivoPdf.files[0];
	  ArchivoPdf_filePath = ArchivoPdf.value;
	  ext = $("#Acta").val().split('.').pop();
	  idfile = "Acta";
		
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
    <div class="float-left"><h4><?=$estacion;?> NOM-035 (Política) </h4></div>
    </div>
    <div class="card-body">

    	<div class="container">

    		<?php

			$sql_pac = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Politica' AND nom_archivo = 'politica-cuerpo' ORDER BY id desc LIMIT 1";
			$result_pac = mysqli_query($con, $sql_pac);			
			$numero_pac = mysqli_num_rows($result_pac);
			if ($numero_pac > 0) {
			while($row_pac = mysqli_fetch_array($result_pac, MYSQLI_ASSOC)){
			$pac = $row_pac['archivo'];
			$imgcuerpo = '<a target="_BLANK" href="../'.$pac.'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
			}
			}else{
			$imgcuerpo = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png">';	
			}

			$sql_pa = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Politica' AND nom_archivo = 'politica-archivo' ORDER BY id desc LIMIT 1";
			$result_pa = mysqli_query($con, $sql_pa);			
			$numero_pa = mysqli_num_rows($result_pa);
			if ($numero_pa > 0) {
			while($row_pa = mysqli_fetch_array($result_pa, MYSQLI_ASSOC)){
			$pa = $row_pa['archivo'];
			$imgpolitica = '<a target="_BLANK" href="../'.$pa.'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
			}
			}else{
			$imgpolitica = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png">';	
			}

			$sql_pat = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Politica' AND nom_archivo = 'politica-triptico' ORDER BY id desc LIMIT 1";
			$result_pat = mysqli_query($con, $sql_pat);			
			$numero_pat = mysqli_num_rows($result_pat);
			if ($numero_pat > 0) {
			while($row_pat = mysqli_fetch_array($result_pat, MYSQLI_ASSOC)){
			$pat = $row_pat['archivo'];
			$imgtriptico = '<a target="_BLANK" href="../'.$pat.'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
			}
			}else{
			$imgtriptico = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png">';	
			}

			$sql_pacta = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '".$idEstacion."' AND categoria = 'Politica' AND nom_archivo = 'politica-acta' ORDER BY id desc LIMIT 1";
			$result_pacta = mysqli_query($con, $sql_pacta);			
			$numero_pacta = mysqli_num_rows($result_pacta);
			if ($numero_pacta > 0) {
			while($row_pacta = mysqli_fetch_array($result_pacta, MYSQLI_ASSOC)){
			$pacta = $row_pacta['archivo'];
			$imgacta = '<a target="_BLANK" href="../'.$pacta.'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
			}
			}else{
			$imgacta = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png">';	
			}
			

    		?>

<div class="row">



  <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mb-3 "> 
  <div class="border p-3" style="font-size: 1.2em">

  <?=$politica;?>
                
  </div>
  </div>


<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12" style="overflow-y: hidden;">

    			<table class="table table-bordered table-striped table-sm">
    				<tr>
    					<td class="align-middle"><b>Cuerpo PDF</b></td>
    					

              <td>
    						<div class="form-inline">
    							
                  <div class="row p-2">

                  <div class="col-12 mb-2">
    							<input type="file" style="font-size: .8em;" id="Cuerpo">
                  </div>

                  <div class="col-12 text-right">
    							<button type="submit" class="btn btn-secondary btn-sm rounded-0 p-1" onclick="BTNarchivo(1)">Agregar PDF</button>
                  </div>

                  </div>
    							</div>
    						</td>

    					<td class="align-middle text-center" width="24" id="td31"><?=$imgcuerpo;?></td>
    				</tr>



    				<tr>
    					<td class="align-middle"><b>Política PDF</b></td>
    					<td>
    						<div class="form-inline">
    							
                 <div class="row p-2">

             <div class="col-12 mb-2">
                 <input type="file" style="font-size: .8em;" id="Politica">
    				        </div>

                  <div class="col-12 text-right">
    							<button type="submit" class="btn btn-secondary btn-sm rounded-0 p-1" onclick="BTNarchivo(2)">Agregar PDF</button>
    							</div>

                </div>
    						</td>

    					<td class="align-middle text-center" width="24" id="td32"><?=$imgpolitica;?></td>
    				</tr>


    				<tr>
    					<td class="align-middle"><b>Triptico</b></td>
    					<td>
    						<div class="form-inline">
    				
            <div class="row p-2"> 
             <div class="col-12 mb-2">
    					<input type="file" style="font-size: .8em;" id="Triptico">
    				 </div>

                  <div class="col-12 text-right">
    							<button type="submit" class="btn btn-secondary btn-sm rounded-0 p-1" onclick="BTNarchivo(3)">Agregar PDF</button>
    							</div>

    						</td>
    					<td class="align-middle text-center" width="24" id="td33"><?=$imgtriptico;?></td>
    				</tr>



    				<tr>
    					<td class="align-middle"><b>Acta PDF</b></td>
    					<td>
    						<div class="form-inline">
    				
            <div class="row p-2">
             <div class="col-12 mb-2">
    							<input type="file" style="font-size: .8em;" id="Acta">
    						    </div>

                                      <div class="col-12 text-right">
    							<button type="submit" class="btn btn-secondary btn-sm rounded-0 p-1" onclick="BTNarchivo(4)">Agregar PDF</button>
    							</div>
    						</td>
    					<td class="align-middle text-center" width="24" id="td34"><?=$imgacta;?></td>
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

