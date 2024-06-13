<?php
require('app/help.php');

$YearFin = date("Y") + 1;

$Explode = explode("-", $Session_Autorizacion);
$Years = ($fecha_year + 1) - $Explode[0];

$Bianual = $Years / 2;

if($Session_Autorizacion != '0000-00-00'){

Interna($Session_Autorizacion,$Session_IDEstacion,$Years,$con);

if (($Bianual % 2) == 0) {
Externa($Session_Autorizacion,$Session_IDEstacion,$Bianual,$con);
}else{
$NewBianual = $Bianual - 1;
Externa($Session_Autorizacion,$Session_IDEstacion,$NewBianual,$con);
}

}


function Interna($Autorizacion,$IDEstacion,$Years,$con){

$iteracciones = $Years * 2;

for ($i=1; $i <= $iteracciones; $i++) { 

$Meses = $i * 6;
$FechaCalensario = date("Y-m-d",strtotime($Autorizacion."+ $Meses month")).'<br>'; 

$sqlFV = "SELECT id FROM tb_programa_auditorias WHERE id_estacion = '".$IDEstacion."' AND tipo_auditoria = 'Interna' AND fecha = '".$FechaCalensario."' ";
$resultFV = mysqli_query($con, $sqlFV);
$numeroFV = mysqli_num_rows($resultFV);
if($numeroFV == 0){

$sql_insert1 = "INSERT INTO tb_programa_auditorias (
id_estacion,
tipo_auditoria,
responsable,
periodicidad,
fecha
)
VALUES 
(
'".$IDEstacion."',
'Interna',
'Gerente/Depto. gestión',
'Semestral',
'".$FechaCalensario."'
)";
mysqli_query($con, $sql_insert1);

}
}

}

function Externa($Autorizacion,$IDEstacion,$Bianual,$con){

for ($i=1; $i <= $Bianual; $i++) { 

$year = $i * 2;
$FechaCalensario = date("Y-m-d",strtotime($Autorizacion."+ $year year")).'<br>'; 

$sqlFV = "SELECT id FROM tb_programa_auditorias WHERE id_estacion = '".$IDEstacion."' AND tipo_auditoria = 'Externa' AND fecha = '".$FechaCalensario."' ";
$resultFV = mysqli_query($con, $sqlFV);
$numeroFV = mysqli_num_rows($resultFV);
if($numeroFV == 0){

$sql_insert1 = "INSERT INTO tb_programa_auditorias (
id_estacion,
tipo_auditoria,
responsable,
periodicidad,
fecha
)
VALUES 
(
'".$IDEstacion."',
'Externa',
'Tercer acreditado',
'Bianual',
'".$FechaCalensario."'
)";
mysqli_query($con, $sql_insert1);

}
}
}

$sql = "SELECT * FROM tb_programa_auditorias WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fecha) >= '".$fecha_year."' ORDER BY fecha ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);


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
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  });
  function regresarP(){
  window.history.back();
  }

function btnDescargar(YearInicio,YearFin){
window.location = "descargar-programa-auditorias-internas-externas/" + YearInicio + "/" + YearFin; 
}

function btnModal(){
$('#ModalBuscar').modal('show');
}

function btnBuscar(){

let FechaInicio = $('#FechaInicio').val();
let FechaTermino = $('#FechaTermino').val();

if (FechaInicio != "") {
$('#FechaInicio').css('border','');
if (FechaTermino != "") {
$('#FechaTermino').css('border','');

$('#DivContenido').load('app/vistas/sasisopa/elemento15/lista-programa-auditoria-interna-externa.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);
$('#ModalBuscar').modal('hide');

}else{
$('#FechaTermino').css('border','2px solid #A52525');
}
}else{
$('#FechaInicio').css('border','2px solid #A52525');
}

}

  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
        <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
        </div>
        <div class="float-left">
        <h4>Formato Programa de auditorias (Internas y externas)</h4>
        </div>
      </div>
    </div>

    <div class="mt-4 bg-white p-3">

    <div style="overflow-y: hidden;">
    <table class="table table-bordered table-sm mb-0 pb-0" style="font-size: .9em;">
    <tr>
    <td class="text-center align-middle"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 200px;"></td>
    <td colspan="2" class="text-center align-middle"><b>Formato Programa de auditorias (Internas y externas) </b></td>
    <td class="text-center align-middle">Fo.ADMONGAS.023</td>
    </tr>
    <tr>
    <td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
    <td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
    <td class="text-center align-middle">Autorizado por: <?=$Session_ApoderadoLegal;?> </td>
    <td class="text-center align-middle">Fecha de autorizacion 01-Oct-2018</td>
    </tr>
    </table>
    </div>

    <div style="overflow-y: hidden;">
    <div class="mt-3" id="DivContenido">

    <div class="text-right mb-2">
    <img src="<?php echo RUTA_IMG_ICONOS."lupa.png"; ?>" onclick="btnModal()">
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>" onclick="btnDescargar(<?=$fecha_year;?>,<?=$YearFin;?>)">
    </div>

    <table class="table table-bordered table-sm" style="">
    <thead>
    <tr>
    <th class="text-center align-middle">Tipo de auditoria</th>
    <th class="text-center align-middle">Responsable</th>
    <th class="text-center align-middle">Periodicidad</th>

    <?php
    $TR = 0;
    for ($i = $fecha_year; $i <= $YearFin; $i++) {
    echo '<td class="text-center align-middle"><b>'.$i.'</b></td>';
    $TR = $TR + 1;
    }
    ?>
    </tr>
    </thead>
    <tbody>
    <?php  

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo "<tr>";
    echo '<td>'.$row['tipo_auditoria'].'</td>';
    echo '<td>'.$row['responsable'].'</td>';
    echo '<td>'.$row['periodicidad'].'</td>';

    $ExplodeF = explode("-", $row['fecha']);
    for ($mes = $fecha_year; $mes <= $YearFin; $mes++) {

    if($row['tipo_auditoria'] == 'Interna'){

    if($ExplodeF[0] == $mes){
    $Color = 'table-primary';
    $Titulo = nombremes($ExplodeF[1]);
    }else{
    $Color = ''; 
    $Titulo = '';
    }

    }else if($row['tipo_auditoria'] == 'Externa'){

    if($ExplodeF[0] == $mes){
    $Color = 'table-success';
    $Titulo = nombremes($ExplodeF[1]);
    }else{
    $Color = ''; 
    $Titulo = '';
    }

    }
    echo '<td class="text-center align-middle '.$Color.'">'.$Titulo.'</td>';
    }
    echo "</tr>";  
    }
    ?>
    </tbody>
    </table>
    </div>
    </div>

      <div class="mt-2 text-center">
      <small>*Las auditorias al SA se realizaran por personal interno de la empresa, que puede ser el gerente de la estación de servicio, el Representante legal, el departamento de gestión, entre otras y las auditorias externas se realizaran por un tercer acreditado (cada dos años de acuerdo a las DACG expendio de petrolíferos) ante la Agencia de Seguridad Energía y Ambiente, tercer acreditado que tendrá que tener vigente su autorización ante la Agencia y el personal podrá elegir. </small>
      </div>

    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalBuscar" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Buscar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

          <div class="mb-2"><small class="text-secondary">Fecha inicio:</small></div>
          <input class="form-control input-style rounded-0" type="date" id="FechaInicio">

          <div class="mb-2"><small class="text-secondary">Fecha termino:</small></div>
          <input class="form-control input-style rounded-0" type="date" id="FechaTermino"> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnBuscar()">Buscar</button>
        </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
