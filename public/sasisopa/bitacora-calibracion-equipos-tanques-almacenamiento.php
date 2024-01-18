<?php
require('app/help.php');

$sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$GET_ID."' ";
$resultCE = mysqli_query($con, $sqlCE);
$numeroCE = mysqli_num_rows($resultCE);
while($rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC)){
$Folio = $rowCE['folio'];
$Fecha = $rowCE['fecha'];
$Hora = $rowCE['hora'];
$Observaciones = $rowCE['observaciones'];
$Responsableveri = $rowCE['responsable_verificacion'];
$Estado = $rowCE['estado'];
}

function Detalle($ID,$categoria,$con){
$sql = "SELECT * FROM tb_calibracion_equipos_detalle WHERE id_calibracion = '".$ID."' AND categoria = '".$categoria."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$resultado = $row['resultado'];
}

return $resultado;
}


$UV = Detalle($GET_ID,'Unidad de verificación', $con);
$NA = Detalle($GET_ID,'No. de acreditación', $con);
$MUC = Detalle($GET_ID,'Método usado para la calibración', $con);

function Tanque($idsonda, $con){
$sql = "SELECT * FROM tb_tanque_almacenamiento WHERE id = '".$idsonda."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$notanque = $row['no_tanque'];
$capacidad = $row['capacidad'];
$producto = $row['producto'];

}

$array = array('notanque' => $notanque, 'capacidad' => $capacidad, 'producto' => $producto);

return $array;
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
  background: url('../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
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
      "contenido" : e.value,
      "id" : id,
      "input" : input
    };

    $.ajax({
 data:  parametros,
 url:   '../public/sasisopa/actualizar/editar-calibracion-equipos-tanque-almacenamiento.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

 }
 });

  }

  function Finalizar(Id){

let Fecha = $('#Fecha').val();

if (Fecha != "") {
$('#Fecha').css('border','');

alertify.confirm('',
function(){

var parametros = {
"Id" : Id,
"Equipo" : 'Tanques de almacenamiento'
};

 $.ajax({
 data:  parametros,
 url:   '../public/sasisopa/actualizar/finalizar-calibracion-equipos.php',
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

  function Adjuntar(id){
  $('#Modal').modal('show');
  $('#ContenidoModal').load('../public/sasisopa/vistas/modal-agregar-resultados-calibracion-tanques.php?ID=' + id);
  }

  function AgregarR(id){

    var data = new FormData();
  var url = "../public/sasisopa/agregar/agregar-resultados-calibracion-tanque.php";

  var Archivo = document.getElementById("Archivo");
  var file = Archivo.files[0];
  var filePath = Archivo.value;
  var valpdf = filePath.split('.').pop();

  if (filePath != "") {
  $('#Archivo').css('border','');
  if (valpdf == "pdf") {
  $('#Archivo').css('border','');
  $('#DivResultadoPDF').html('');

  $(".LoaderPage").show();

  data.append('id', id);
  data.append('file', file);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

  $(".LoaderPage").hide();
  Adjuntar(id)

  });

  }else{
  $('#Archivo').css('border','2px solid #A52525');
  $('#DivResultadoPDF').html('<label class="text-danger">Solo acepta formato PDF</label>');
  }
  }else{
  $('#Archivo').css('border','2px solid #A52525');
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
      <h4>Bitácora calibración de equipos (Tanques de almacenamiento)</h4>
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
    <input type="time" class="form-control rounded-0" value="<?=$Hora;?>" onchange="EditarOtros(this,<?=$GET_ID;?>,2)" id="Fecha">
  </div>

    <div class="col-3">
    <div class="text-secondary"><h6>Unidad de verificación:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$UV;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,3)">
  </div>

  <div class="col-3 mt-2">
    <div class="text-secondary"><h6>No. de acreditación:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$NA;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,4)">
  </div>

  <div class="col-3 mt-2">
    <div class="text-secondary"><h6>Método usado para la calibración:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$MUC;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,5)">
  </div>


</div>


<table class="table table-sm table-bordered mt-4">
<thead>
  <tr>
    <th>No. Tanque</th>
    <th>Capacidad</th>
    <th>Producto</th>
    <th>Incertidumbre de calibración</th>
    <th>Cumple con los límites establecidos</th>
    <th width="24"></th>
  </tr>
</thead>
<tbody>
<?php
$sql_lista = "SELECT * FROM tb_calibracion_equipos_tanques WHERE id_calibracion = '".$GET_ID."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$Tanque = Tanque($row_lista['id_tanque'], $con);

if($row_lista['resultados'] == ""){
        $Adjuntar = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png" onclick="Adjuntar('.$row_lista['id'].')">';
        }else{
        $Adjuntar = '<img src="'.RUTA_IMG_ICONOS.'descargar.png" onclick="Adjuntar('.$row_lista['id'].')">';
        }

echo '<tr>';
echo '<td>'.$Tanque['notanque'].'</td>';
echo '<td>'.$Tanque['capacidad'].'</td>';
echo '<td>'.$Tanque['producto'].'</td>';
echo '<td class="p-0 m-0"><input type="text" class="form-control border-0 rounded-0" value="'.$row_lista['resultado1'].'" onkeyup="EditarOtros(this,'.$row_lista['id'].',8)"></td>';
echo '<td class="p-0 m-0"><input type="text" class="form-control border-0 rounded-0" value="'.$row_lista['resultado2'].'" onkeyup="EditarOtros(this,'.$row_lista['id'].',9)"></td>';
echo '<td class="align-middle text-center">'.$Adjuntar.'</td>';
echo '</tr>';
}
?>
</tbody>
</table>

 
<div class="row">
  <div class="col-6">
    <div class="text-secondary mt-2"><h6>Observaciones:</h6></div>
    <textarea class="form-control rounded-0" onkeyup="EditarOtros(this,<?=$GET_ID;?>,6)"><?=$Observaciones;?></textarea>
  </div>
  <div class="col-6">
    <div class="text-secondary mt-2"><h6>Responsable de la verificación:</h6></div>
    <input type="text" class="form-control rounded-0" value="<?=$Responsableveri;?>" onkeyup="EditarOtros(this,<?=$GET_ID;?>,7)">
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

<div class="modal fade bd-example-modal-lg" id="Modal" data-keyboard="false" data-backdrop="static">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
<div id="ContenidoModal"></div>

</div>
</div>
</div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
