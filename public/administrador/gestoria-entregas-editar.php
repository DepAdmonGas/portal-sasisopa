<?php
require('app/help.php');

    function Estacion($idEstacion, $con){
    $sql = "SELECT permisocre,razonsocial,direccioncompleta FROM tb_estaciones WHERE id = '".$idEstacion."'";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $razonsocial = $row['razonsocial'];
    $direccion = $row['direccioncompleta'];
    }
     $return = array('razonsocial' => $razonsocial, 'direccion' => $direccion);
    return $return;
    }

    function Documentos($idEntrega, $con){
      $sql = "SELECT id_entrega, id_estacion FROM tb_entregas_documentos WHERE id_entrega = '".$idEntrega."' GROUP BY id_estacion";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      return $numero;
      }

    $sql = "SELECT * FROM tb_entregas WHERE id = '".$GET_ID."' ";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $Estacion = $row['estacion'];
    $direccion = $Estacion['direccion'];
    $destinatario = $row['destinatario'];
    $fecha = $row['fecha'];
    $estatus = $row['estatus'];
    }

    $sqlLista = "SELECT * FROM tb_entregas_documentos WHERE id_entrega = '".$GET_ID."' ";
    $resultLista = mysqli_query($con, $sqlLista);
    $numeroLista = mysqli_num_rows($resultLista);

    $Documento = Documentos($GET_ID, $con);

    

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" ></script>
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>selectize.css">
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
  .grayscale {
    filter: opacity(50%); 
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");

  $('.selectize').selectize({
  sortField: 'text'
  }); 

  ListaContenido(<?=$GET_ID;?>);
 
  });

  function regresarP(){
   window.history.back();
  }

  function ListaContenido(id){
    $('#Contenido').load('../public/administrador/vistas/lista-entregas-documentos.php?id=' + id);  
      
    }

    function Modal(id){
    $('#ModalDetalle').modal('show');    
    $('#ContenidoModal').load('../public/administrador/vistas/modal-agregar-entregas-documentos.php?id=' + id);
    }

    function Agregar(id){

    let Estacion = $('#Estacion').val();
    let Documento = $('#Documento').val();
    let Fecha = $('#FechaOficio').val();
    let OriginalCopia = $('#OriginalCopia').val();

    var parametros = {
    "id" : id,
    "idEstacion" : Estacion,
    "Documento" : Documento,
    "Fecha" : Fecha,
    "OriginalCopia" : OriginalCopia
    };

    if(Documento != ""){
    $('#Documento').css('border',''); 
    if(Fecha != ""){
    $('#Fecha').css('border',''); 
    if(OriginalCopia != ""){
    $('#OriginalCopia').css('border',''); 
    
    $.ajax({
    data:  parametros,
    url:   '../public/administrador/agregar/agregar-entregas-documento.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {
    if(response != 0){
      $('#ModalDetalle').modal('hide'); 
      ListaContenido(id)
    }else{
    }
    }
    });

    }else{
    $('#OriginalCopia').css('border','2px solid #A52525');  
    }
    }else{
    $('#Fecha').css('border','2px solid #A52525');  
    }
    }else{
    $('#Documento').css('border','2px solid #A52525');  
    }

    }

    function Eliminar(idEntrega,id){
  
    alertify.confirm('',
 function(){

  var parametros = {
      "id" : id
      };

  $.ajax({
   data:  parametros,
   url:   '../public/administrador/eliminar/eliminar-entregas-documento.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    ListaContenido(idEntrega)
   }
   });

    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el documento',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show(); 

    }

    function Acuse(idEntrega,id){
    $('#ModalDetalle').modal('show');    
    $('#ContenidoModal').load('../public/administrador/vistas/modal-agregar-entregas-evidencia.php?idEntrega=' + idEntrega + '&id=' + id);
    }

    function AgregarAcuse(idEntrega,id){

    var Imagen = document.getElementById("Imagen");
    var Imagen_file = Imagen.files[0];
    var Imagen_filePath = Imagen.value;

    var URL = "../public/administrador/agregar/agregar-entregas-evidencia.php";
    var data = new FormData();
    
    data.append('id', id);
    data.append('Imagen_file', Imagen_file);

    $.ajax({
    url: URL,
    type: 'POST',
    contentType: false,
    data: data,
    processData: false,
    cache: false
    }).done(function(data){
      Acuse(idEntrega,id)
      ListaContenido(idEntrega)
    });

    }

    function Finalizar(id){

    let Fecha = $('#Fecha').val();
    let Destinatario = $('#Destinatario').val();
    let idEstacion = $('#idEstacion').val();

    alertify.confirm('',
 function(){

  var parametros = {
    "Action" : 1,
    "id" : id,
      "Fecha" : Fecha,
      "Destinatario" : Destinatario,
      "idEstacion" : idEstacion
      };

  $.ajax({
   data:  parametros,
   url:   '../public/administrador/editar/finalizar-entrega.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    regresarP()
   }
   });

    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea finalizar la entrega',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show(); 

    }

    function FinalizarEntrega(id){

      let Recibe = $('#Recibe').val();

      if (Recibe != "") {
  $('#Recibe').css('border','');

    alertify.confirm('',
 function(){

  var parametros = {
    "Action" : 2,
    "id" : id,
    "Recibe" : Recibe
      };

  $.ajax({
   data:  parametros,
   url:   '../public/administrador/editar/finalizar-entrega.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    regresarP()
   }
   });

    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea finalizar la entrega',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show(); 

    }else{
    $('#Recibe').css('border','2px solid #A52525');
    }

    }
 
  </script>
  </head>
  <body>

  <div class="LoaderPage"></div>
  <div class="fixed-top navbar-admin">
  <?php require('public/componentes/header.menu.php'); ?>
  </div>
  <div id="DivPrincipal">
  <div class="divcontenedor">
  <div class="divbody">
  <div class="magir-top-principal">

    <div class="magir-top-principal">

    <div class="row no-gutters">
    <div class="col-12">
    <div class="card adm-card" style="border: 0;">

    <div class="adm-car-title">
      <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
        <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
      <div class="float-left"><h4>Editar</h4></div>
    </div>

    <div class="card-body">

    <div class="row">
    <div class="col-12 col-sm-4">
    <div class="mt-2"><small class="text-secondary">Fecha:</small></div>
    <input type="date" value="<?=$fecha;?>" class="form-control rounded-0 mt-1" id="Fecha"/>
    </div>
    <div class="col-12 col-sm-4">
    <div class="mt-2"><small class="text-secondary">Destinatario:</small></div>
    <input type="text" value="<?=$destinatario;?>" class="form-control rounded-0 mt-1" id="Destinatario"/>
    </div>
    <div class="col-12 col-sm-4">
    <div class="mt-2 mb-1"><small class="text-secondary">Estación de envio:</small></div>
    <select class="selectize" placeholder="Estación" id="idEstacion">
    <option value="<?=$Estacion;?>"><?=$Estacion;?></option>
    <?php
    $sqlEs = "SELECT * FROM tb_estaciones WHERE numlista <= 8 ORDER BY numlista ASC";
    $resultEs = mysqli_query($con, $sqlEs);
    $numeroEs = mysqli_num_rows($resultEs);
    while($rowEs = mysqli_fetch_array($resultEs, MYSQLI_ASSOC)){
    echo '<option value="'.$rowEs['razonsocial'].'">'.$rowEs['razonsocial'].'</option>';
    }
    ?>
    </select>
    </div>
    </div>

    <?php if($estatus == 0){ ?>
    <div class="text-right mt-3">
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>" onclick="Modal(<?=$GET_ID;?>)">  
    </div>
    <?php } ?>
    
    <h5 class="pt-3 pb-2">Documentos:</h5>
    <div id="Contenido"></div>

    <div class="mt-2">Nombre de quien recibe:</div>
    <div><input type="text" class="form-control rounded-0 mt-2" id="Recibe" /></div>

    <div class="text-right mt-3">
    <?php if($estatus == 0){
    echo '<button type="button" class="btn btn-primary rounded-0" onclick="Finalizar('.$GET_ID.')">Finalizar</button>';
    }else if($estatus == 1){
    echo '<button type="button" class="btn btn-primary rounded-0" onclick="FinalizarEntrega('.$GET_ID.')">Finalizar entrega</button>';
    } ?>
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

  <div class="modal fade bd-example-modal-lg" id="ModalDetalle" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="ContenidoModal"></div>
  </div>
  </div>
  </div>

<script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>
</html>
