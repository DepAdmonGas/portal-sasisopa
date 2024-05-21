<?php
require('app/help.php');
include_once "app/modelo/ControlActividadProceso.php";
$class_control_actividad_proceso = new ControlActividadProceso();

$sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$GET_ID."' ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);
$rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC);
$Folio = $rowCE['folio'];
$Fecha = $rowCE['fecha'];
$Hora = $rowCE['hora'];

$FechaTermino = $rowCE['fecha_termino'];
$HoraTermino = $rowCE['hora_termino'];

$Observaciones = $rowCE['observaciones'];
$Responsableveri = $rowCE['responsable_verificacion'];
$Estado = $rowCE['estado'];
$idestacion = $rowCE['id_estacion'];

if($rowCE['categoria'] ==  1){
$ordinaria = 'selected';
}else{
$ordinaria = '';
}

if($rowCE['categoria'] ==  2){
$extraordinaria = 'selected';
}else{
$extraordinaria = '';
}

$UV = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'Unidad de verificacion');
$NA = $class_control_actividad_proceso->detalleCalibracion($GET_ID,'No. de acreditacion');

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

  function regresarP(){
  window.history.back();
  }

  function EditarOtros(e,id,input){

    var parametros = {
      "accion" : "editar-calibracion-equipos-dispensario",
      "contenido" : e.value,
      "id" : id,
      "input" : input
    };

    $.ajax({
 data:  parametros,
 url:   '../app/controlador/ControlActividadProcesoControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

 }
 });

  }


  function Eliminar(id){

  alertify.confirm('',
function(){

var parametros = {
    "accion" : "eliminar-calibracion-equipos-dispensario",
      "Id" : id
    };

    $.ajax({
 data:  parametros,
 url:   '../app/controlador/ControlActividadProcesoControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {
  location.reload(); 
}
 });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el dispensario',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  function Modal(ID,idestacion){
  $('#Modal').modal('show');
  $('#Contenido').load('../app/vistas/sasisopa/elemento10/modal-agregar-dispensario-calibracion.php?id=' + ID + '&idestacion=' + idestacion);
  }

  function Agregar(id){

  let idDispensario = $('#idDispensario').val();
  if (idDispensario != "") {
  $('#idDispensario').css('border','');

  var parametros = {
    "accion" : "agregar-calibracion-equipos-dispensario",
      "Id" : id,
      "idDispensario" : idDispensario
    };

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/ControlActividadProcesoControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
      location.reload(); }
     });

  }else{
  $('#idDispensario').css('border','2px solid #A52525');
  }

  }

  function Finalizar(Id){

let Fecha = $('#Fecha').val();

if (Fecha != "") {
$('#Fecha').css('border','');

alertify.confirm('',
function(){

var parametros = {
    "accion" : "finalizar-calibracion-equipos",
      "Id" : Id,
      "Equipo" : 'Dispensario'
    };

    $.ajax({
 data:  parametros,
 url:   '../app/controlador/ControlActividadProcesoControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {
    window.history.back();
 }
 });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea finalizar la calibración de equipos',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
  $('#Fecha').css('border','2px solid #A52525');
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
      <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
    

    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
      <h4>Bitácora calibración de equipos (Dispensario)</h4>
    </div>


    </div>
    <div class="card-body">


<div class="row">
  <div class="col-3 text-secondary">
    <h6>Folio:</h6>
    <div><h6>00<?=$Folio;?></h6></div>
  </div>
  <div class="col-3">
    <div class="text-secondary"><h6>Fecha:</h6></div>
    <input type="date" class="form-control rounded-0" value="<?=$Fecha;?>" onchange="EditarOtros(this,<?=$GET_ID;?>,1)" id="Fecha">
  </div>

  <div class="col-3">
  <div class="text-secondary"><h6>Hora:</h6></div>
  <input type="time" class="form-control rounded-0" value="<?=$Hora;?>" onchange="EditarOtros(this,<?=$GET_ID;?>,2)">
  </div>

  <div class="col-3">
  <div class="text-secondary"><h6>Fecha termino:</h6></div>
  <input type="date" class="form-control rounded-0" value="<?=$FechaTermino;?>" onchange="EditarOtros(this,<?=$GET_ID;?>,12)">
  </div>

  <div class="col-3">
  <div class="text-secondary"><h6>Hora Termino:</h6></div>
  <input type="time" class="form-control rounded-0" value="<?=$HoraTermino;?>" onchange="EditarOtros(this,<?=$GET_ID;?>,13)">
  </div>

  <div class="col-3">
  <div class="text-secondary"><h6>Unidad de verificación:</h6></div>
  <input type="text" class="form-control rounded-0" value="<?=$UV;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,3)">
  </div>

  <div class="col-3">
  <div class="text-secondary"><h6>No. de acreditación:</h6></div>
  <input type="text" class="form-control rounded-0" value="<?=$NA;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,4)">
  </div>

  <div class="col-3">
  <div class="text-secondary"><h6>Tipo calibración:</h6></div>
  <select class="form-control rounded-0" onchange="EditarOtros(this,<?=$GET_ID;?>,11)">
  <option value="1" <?=$ordinaria;?> >Ordinaria</option>
  <option value="2" <?=$extraordinaria;?> >Extraordinaria</option>
  </select>
  </div>
  
  </div>

<div class="text-right">
<img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>" onclick="Modal(<?=$GET_ID;?>,<?=$idestacion;?>)">
</div>

<table class="table table-sm table-bordered mt-4">
<thead>
  <tr>
    <th>No Dispensario</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Serie</th>
    <th>¿Cumple con el error maximo tolerado?</th>
    <th>¿Cumple con la repetibilidad?</th>
    <th>Folio del holograma</th>
    <th>Distintivo empresarial</th>
    <th></th>
  </tr>
</thead>
<tbody>
<?php
$sql_lista = "SELECT
tb_calibracion_equipos_dispensario.id,
tb_calibracion_equipos_dispensario.id_calibracion,
tb_calibracion_equipos_dispensario.id_dispensario,
tb_calibracion_equipos_dispensario.resultado1,
tb_calibracion_equipos_dispensario.resultado2,
tb_calibracion_equipos_dispensario.resultado3,
tb_calibracion_equipos_dispensario.resultado4,
tb_dispensarios.no_dispensario,
tb_dispensarios.marca,
tb_dispensarios.modelo,
tb_dispensarios.serie
FROM tb_calibracion_equipos_dispensario 
INNER JOIN tb_dispensarios 
ON tb_calibracion_equipos_dispensario.id_dispensario = tb_dispensarios.id
WHERE tb_calibracion_equipos_dispensario.id_calibracion = '".$GET_ID."' ORDER BY tb_dispensarios.no_dispensario ASC ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

echo '<tr>';
echo '<td>'.$row_lista['no_dispensario'].'</td>';
echo '<td>'.$row_lista['marca'].'</td>';
echo '<td>'.$row_lista['modelo'].'</td>';
echo '<td>'.$row_lista['serie'].'</td>';
echo '<td class="p-0 m-0"><input type="text" class="form-control border-0 rounded-0" value="'.$row_lista['resultado1'].'" onkeyup="EditarOtros(this,'.$row_lista['id'].',7)"></td>';
echo '<td class="p-0 m-0"><input type="text" class="form-control border-0 rounded-0" value="'.$row_lista['resultado2'].'" onkeyup="EditarOtros(this,'.$row_lista['id'].',8)"></td>';
echo '<td class="p-0 m-0"><input type="text" class="form-control border-0 rounded-0" value="'.$row_lista['resultado3'].'" onkeyup="EditarOtros(this,'.$row_lista['id'].',9)"></td>';
echo '<td class="p-0 m-0"><input type="text" class="form-control border-0 rounded-0" value="'.$row_lista['resultado4'].'" onkeyup="EditarOtros(this,'.$row_lista['id'].',10)"></td>';
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='Eliminar(".$row_lista['id'].")'></td>";
echo '</tr>';
}
?>
</tbody>
</table>

 
<div class="row">
  <div class="col-6">
    <div class="text-secondary mt-2"><h6>Observaciones:</h6></div>
    <textarea class="form-control rounded-0" onkeyup="EditarOtros(this,<?=$GET_ID;?>,5)"><?=$Observaciones;?></textarea>
  </div>
  <div class="col-6">
    <div class="text-secondary mt-2"><h6>Responsable de la verificación:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$Responsableveri;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,6)">
  </div>
</div>

<?php  
if($Estado == 0){

echo '<div class="text-right">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Finalizar('.$GET_ID.')">Finalizar</button>
  </div>';

}else{
echo '<div class="text-right">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="regresarP()">Finalizar</button>
  </div>';  
}
?>
    </div>
    </div>
    </div>
    </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="Modal" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
<div id="Contenido"></div>
</div>
</div>
</div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
