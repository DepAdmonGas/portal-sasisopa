<?php
require('app/help.php');

function validaPlanAuditoria($id_estacion,$id_registro,$con){

$sql_personal = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$id_estacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result_personal = mysqli_query($con, $sql_personal);
$numero_personal = mysqli_num_rows($result_personal);
if ($numero_personal > 0) {
$row_personal = mysqli_fetch_array($result_personal, MYSQLI_ASSOC);
$realizadopor = $row_personal['id_usuario'];
}else{
$realizadopor = 0;
}

$sql = "SELECT * FROM sgm_plan_auditoria WHERE id_auditoria = '".$id_registro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql_insert = "INSERT INTO sgm_plan_auditoria (
id_auditoria,
fecha,
nom_director,
ubicacion_instalacion,
objetivo_auditoria,
alcance_auditoria,
fecha_programada,
sitio,
metodo_auditoria,
ajuste_plan,
asignacion_recursos,
preparativos_logisticos,
acciones,
realizadopor
  )
  VALUES (
  '".$id_registro."',
  '',
  '',
  '',
  '',
  '',
  '',
  '',
  '',
  '',
  '',
  '',
  '',
  '".$realizadopor."'
  )";
  mysqli_query($con, $sql_insert);

}

}
validaPlanAuditoria($Session_IDEstacion,$GET_idRegistro,$con);

$sql = "SELECT * FROM sgm_plan_auditoria WHERE id_auditoria = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$fecha = $row['fecha'];
$nom_director = $row['nom_director'];
$ubicacion_instalacion = $row['ubicacion_instalacion'];
$objetivo_auditoria = $row['objetivo_auditoria'];
$alcance_auditoria = $row['alcance_auditoria'];
$fecha_programada = $row['fecha_programada'];
$sitio = $row['sitio'];
$metodo_auditoria = $row['metodo_auditoria'];
$ajuste_plan = $row['ajuste_plan'];
$asignacion_recursos = $row['asignacion_recursos'];
$preparativos_logisticos = $row['preparativos_logisticos'];
$acciones = $row['acciones'];
$realizadopor = $row['realizadopor'];

?> 
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SGM</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaPersonalResponsable(<?=$id;?>);
  ListaAuditor(<?=$id;?>);
  ListaAuxiliar(<?=$id;?>);
  ListaAgenda(<?=$id;?>);
  });

  function regresarP(){
  window.history.back();
  }

  function ListaPersonalResponsable(id){
    $('#ListaPersonalResponsable').load('../app/vistas/sgm/punto10/lista-personal-responsable.php?id=' + id); 
  }

  function ListaAuditor(id){
     $('#ListaAuditor').load('../app/vistas/sgm/punto10/lista-auditor.php?id=' + id); 
  }

  function ListaAuxiliar(id){
    $('#ListaAuxiliar').load('../app/vistas/sgm/punto10/lista-auxiliar.php?id=' + id); 
  }

  function ListaAgenda(id){
    $('#ListaAgenda').load('../app/vistas/sgm/punto10/lista-agenda.php?id=' + id); 
  }

     function Editar(e,id,cate){

     var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-plan-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

     }
     });

  }

  function AgregarPersonalResponsable(e,id,cate){

  var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-plan-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaPersonalResponsable(id)
     }
     });

  }

    function Eliminar(e,id,idPersonal,cate){

    var parametros = {
    "id" : idPersonal,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-plan-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaPersonalResponsable(id)
     }
     });

  }

  function modalEquipo(id,cate){

  if(cate == 1){
  $('#modalPrincipal').modal('show'); 
  $('#ContenidoModal').load('../app/vistas/sgm/punto10/modal-agregar-auditor.php?id=' + id);
  }else if(cate == 2){
  $('#modalPrincipal').modal('show'); 
  $('#ContenidoModal').load('../app/vistas/sgm/punto10/modal-agregar-auxiliar.php?id=' + id);
  }
  
  }

  function GuardarAuditor(id){
    let auditor1 = $('#auditor1').val();
    let auditor2 = $('#auditor2').val();
    let auditor3 = $('#auditor3').val();

  if (auditor1 != "") {
  $('#auditor1').css('border','');
  if (auditor2 != "") {
  $('#auditor2').css('border','');
  if (auditor3 != "") {
  $('#auditor3').css('border','');

    var parametros = {
    "id" : id,
    "cate" : 1,
    "auditor1" : auditor1,
    "auditor2" : auditor2,
    "auditor3" : auditor3
    };

     $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/agregar-agenda-sgm.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      ListaAuditor(id)
      $('#modalPrincipal').modal('hide'); 

     }
     });
  
  }else{
  $('#auditor3').css('border','2px solid #A52525'); 
  }
  }else{
  $('#auditor2').css('border','2px solid #A52525'); 
  }
  }else{
  $('#auditor1').css('border','2px solid #A52525'); 
  }

  }

    function EliminarAuditor(e,id,idAuditor,cate){

    var parametros = {
    "id" : idAuditor,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-plan-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaAuditor(id)
      ListaAuxiliar(id)
     }
     });

  }


function GuardarAuxiliar(id){
  let auditor1 = $('#auditor1').val();
    let auditor2 = $('#auditor2').val();

  if (auditor1 != "") {
  $('#auditor1').css('border','');
  if (auditor2 != "") {
  $('#auditor2').css('border','');


    var parametros = {
    "id" : id,
    "cate" : 2,
    "auditor1" : auditor1,
    "auditor2" : auditor2
    };

     $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/agregar-agenda-sgm.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      ListaAuxiliar(id)
      $('#modalPrincipal').modal('hide'); 

     }
     });
  
  }else{
  $('#auditor2').css('border','2px solid #A52525'); 
  }
  }else{
  $('#auditor1').css('border','2px solid #A52525'); 
  }

}



  function modalAgenda(id){
   $('#modalPrincipal').modal('show'); 
   $('#ContenidoModal').load('../app/vistas/sgm/punto10/modal-agregar-agenda.php?id=' + id);
  }

  function GuardarAgenda(id){

  let agenda1 = $('#agenda1').val();
  let agenda2 = $('#agenda2').val();
  let agenda3 = $('#agenda3').val();
  let agenda4 = $('#agenda4').val();
  let agenda5 = $('#agenda5').val();
  let agenda6 = $('#agenda6').val();

  if (agenda1 != "") {
  $('#agenda1').css('border','');
  if (agenda2 != "") {
  $('#agenda2').css('border','');
  if (agenda3 != "") {
  $('#agenda3').css('border','');
  if (agenda4 != "") {
  $('#agenda4').css('border','');
  if (agenda5 != "") {
  $('#agenda5').css('border','');
  if (agenda6 != "") {
  $('#agenda6').css('border','');

    var parametros = {
    "id" : id,
    "cate" : 3,
    "agenda1" : agenda1,
    "agenda2" : agenda2,
    "agenda3" : agenda3,
    "agenda4" : agenda4,
    "agenda5" : agenda5,
    "agenda6" : agenda6
    };

     $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/agregar-agenda-sgm.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      ListaAgenda(id)
      $('#modalPrincipal').modal('hide'); 

     }
     });
  
  }else{
  $('#agenda6').css('border','2px solid #A52525'); 
  }
  }else{
  $('#agenda5').css('border','2px solid #A52525'); 
  }
  }else{
  $('#agenda4').css('border','2px solid #A52525'); 
  }
  }else{
  $('#agenda3').css('border','2px solid #A52525'); 
  }
  }else{
  $('#agenda2').css('border','2px solid #A52525'); 
  }
  }else{
  $('#agenda1').css('border','2px solid #A52525'); 
  }

  }


  function EliminarAgenda(e,id,idAgenda,cate){

    var parametros = {
    "id" : idAgenda,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-plan-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaAgenda(id)
     }
     });

  }

    function Finalizar(){

  alertify.confirm('',
  function(){

    regresarP()
    
  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea finalizar el Plan de Auditoria?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <div class="float-left"><h4>Plan de Auditoria</h4></div>
    </div>
   
    <div class="card-body">

      <table class="table table-bordered table-sm mb-0">
        <tbody>
          <tr class="bg-secondary text-white">
            <td colspan="3"><b>I. DATOS GENERALES DEL PERMISIONARIO</b></td>
          </tr>
          <tr>
            <td class="align-middle bg-light">NOMBRE, DENOMINACIÓN O RAZÓN SOCIAL:</td>
            <td class="align-middle bg-light">Permiso CRE:</td>
            <td class="align-middle bg-light">FECHA DE ELABORACIÓN:</td>
          </tr>
          <tr>
            <td class="align-middle bg-light"><?=$Session_Razonsocial;?></td>
            <td class="align-middle bg-light"><?=$Session_Permisocre;?></td>
            <td class="p-0 m-0"><input type="date" class="form-control border-0" value="<?=$fecha;?>" onchange="Editar(this,<?=$id;?>,1)"></td>
          </tr>
          <tr>
            <td class="align-middle bg-light">NOMBRE DEL DIRECTOR (ALTA DIRECCIÓN):</td>
            <td colspan="2" class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$nom_director;?>" onkeyup="Editar(this,<?=$id;?>,2)"></td>
          </tr>

          <tr>
            <td class="align-middle bg-light">NOMBRE DEL(LOS) RESPONSABLE DEL SGM</td>
            <td colspan="2" class="p-0 m-0">
               <div id="ListaPersonalResponsable"></div>
            </td>
          </tr>

           <tr>
            <td class="align-middle bg-light">UBICACIÓN DE LA INSTALACIÓN</td>
            <td colspan="2" class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$ubicacion_instalacion;?>" onkeyup="Editar(this,<?=$id;?>,3)"></td>
          </tr>
        </tbody>
      </table>

      <div class="text-right mt-3 mb-3"><a onclick="modalEquipo(<?=$id;?>,1)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar registro"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></div>

      <div id="ListaAuditor"></div>

      <div class="text-right mt-3 mb-3"><a onclick="modalEquipo(<?=$id;?>,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar registro"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></div>

      <div id="ListaAuxiliar"></div>

          <table class="table table-sm table-bordered mb-0">
            <tbody>
           <tr class="bg-secondary text-white">
            <td colspan="3"><b>IV Auditoria</b></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">OBJETIVOS DE LA AUDITORÍA.</td>
          </tr>
          <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control border-0 rounded-0" onkeyup="Editar(this,<?=$id;?>,4)"><?=$objetivo_auditoria;?></textarea></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">ALCANCE DE LA AUDITORÍA. </td>
          </tr>
          <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control border-0 rounded-0" onkeyup="Editar(this,<?=$id;?>,5)"><?=$alcance_auditoria;?></textarea></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">FECHA PROGRAMADA DE AUDITORIA</td>
          </tr>
          <tr>
            <td class="p-0 m-0"><input type="date" class="form-control border-0" value="<?=$fecha_programada;?>" onchange="Editar(this,<?=$id;?>,6)"></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">SITIO</td>
          </tr>
          <tr>
            <td colspan="3" class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$sitio;?>" onchange="Editar(this,<?=$id;?>,7)"></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">MÉTODOS DE AUDITORÍA:</td>
          </tr>
          <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control border-0 rounded-0" onkeyup="Editar(this,<?=$id;?>,8)"><?=$metodo_auditoria;?></textarea></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">AJUSTES AL PLAN:</td>
          </tr>
           <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control border-0 rounded-0" onkeyup="Editar(this,<?=$id;?>,9)"><?=$ajuste_plan;?></textarea></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">ASIGNACIÓN DE RECURSOS APROPIADOS PARA LAS ÁREAS CRÍTICAS, CUANDO APLIQUE:</td>
          </tr>
           <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control border-0 rounded-0" onkeyup="Editar(this,<?=$id;?>,10)"><?=$asignacion_recursos;?></textarea></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">PREPARATIVOS LOGÍSTICOS Y DE COMUNICACIONES (Requisitos para el ingreso a las instalaciones, medidas de seguridad, números de emergencia, lugar de reunión de apertura, lugar de reunión de cierre, transporte y otros requerimientos del Equipo Auditor, como hospedaje, alimentos, entre otros):</td>
          </tr>
           <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control border-0 rounded-0" onkeyup="Editar(this,<?=$id;?>,11)"><?=$preparativos_logisticos;?></textarea></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">ACCIONES DE SEGUIMIENTO A PARTIR DE LA INFORMACIÓN GENERADA EN AUDITORÍAS PREVIAS.</td>
          </tr>
           <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control border-0 rounded-0" onkeyup="Editar(this,<?=$id;?>,12)"><?=$acciones;?></textarea></td>
          </tr>

        </tbody>
      </table>

      <div class="text-right mt-3 mb-3"><a onclick="modalAgenda(<?=$id;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar registro"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></div>

      <table class="table table-sm table-bordered mb-0">
        <tbody>
          <tr>
            <td colspan="4" class="bg-secondary text-white"><b>V. AGENDA.</b><br>
            <small>Nota: Elaborar una Agenda para cada sitio a ser auditado.</small>
            </td>
          </tr>
        </tbody>        
      </table>
      <div id="ListaAgenda"></div>


            <div class="text-right">
        <button class="btn btn-primary" onclick="Finalizar()">Finalizar Plan de Auditoria</button>      
      </div>

    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalPrincipal" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div id="ContenidoModal"></div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalPrincipal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div id="ContenidoModal"></div>
      </div>
    </div>
  </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
