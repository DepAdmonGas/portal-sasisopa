<?php
require('app/help.php');

function usuario($usuario,$con){

  if($usuario == 0){
    $array = array('nombre' => "", 'puesto' => "", 'firma' => "");
  }else{

    $sql = "SELECT tb_usuarios.nombre,
    tb_usuarios.firma, 
    tb_puestos.tipo_puesto
    FROM tb_usuarios
    INNER JOIN tb_puestos
    ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$usuario."' ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $Nombre = $row['nombre'];
      $puesto = $row['tipo_puesto'];
      $firma = $row['firma'];
      $array = array('nombre' => $Nombre, 'puesto' => $puesto, 'firma' => $firma);

  }
  
  return $array;
  }

function validahallazgoAuditoria($id_estacion,$id_registro,$con){

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

$sql = "SELECT * FROM sgm_hallazgo_auditoria WHERE id_auditoria = '".$id_registro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql_insert = "INSERT INTO sgm_hallazgo_auditoria (
id_auditoria,
fecha,
fecha_ubicacion,
objetivo_auditoria,
alcance_auditoria,
comentarios,
nota,
motivos,
conclusiones,
lugar_fecha,
auditor_lider,
responsable_sgm,
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
  0,
  0,
  '".$realizadopor."'
  )";
  mysqli_query($con, $sql_insert);

}

}

function validaResultados($id_registro,$con){

$sql = "SELECT * FROM sgm_hallazgo_auditoria_resultado WHERE id_hallazgo = '".$id_registro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql_sgme = "SELECT id FROM sgm_elementos ";
$result_sgme = mysqli_query($con, $sql_sgme);
$numero_sgme = mysqli_num_rows($result_sgme);
while($row_sgme = mysqli_fetch_array($result_sgme, MYSQLI_ASSOC)){

$sql_insert = "INSERT INTO sgm_hallazgo_auditoria_resultado (
id_hallazgo,
id_elemento,
resultado
  )
  VALUES (
  '".$id_registro."',
  '".$row_sgme['id']."',
  ''
  )";
  mysqli_query($con, $sql_insert);

}

}
}


validahallazgoAuditoria($Session_IDEstacion,$GET_idRegistro,$con);


$sql = "SELECT * FROM sgm_hallazgo_auditoria WHERE id_auditoria = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$fecha = $row['fecha'];
$fecha_ubicacion = $row['fecha_ubicacion'];
$objetivo_auditoria = $row['objetivo_auditoria'];
$alcance_auditoria = $row['alcance_auditoria'];
$comentarios = $row['comentarios'];
$nota = $row['nota'];
$motivos = $row['motivos'];
$conclusiones = $row['conclusiones'];
$lugar_fecha = $row['lugar_fecha'];
$auditor_lider = $row['auditor_lider'];
$responsable_sgm = $row['responsable_sgm'];
$realizadopor = $row['realizadopor'];

$nom_auditor = usuario($auditor_lider,$con);
$nom_responsable = usuario($responsable_sgm, $con);

validaResultados($id,$con);
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
  ListaPersonalEntrevistado(<?=$id;?>);
  ListaEquipoAuditor(<?=$id;?>);
  ListaHallazgoConforme(<?=$id;?>);
  ListaMejoras(<?=$id;?>);

  });

  function regresarP(){
  window.history.back();
  }

    function ListaPersonalResponsable(id){
    $('#ListaPersonalResponsable').load('../app/vistas/sgm/punto10/lista-hallazgo-personal-responsable.php?id=' + id); 
  }

  function Editar(e,id,cate){

     var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-hallazgo-auditoria.php',
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
     url:   '../app/vistas/sgm/punto10/editar-hallazgo-auditoria.php',
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
     url:   '../app/vistas/sgm/punto10/editar-hallazgo-auditoria.php',
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

  //------------------------------------------------------------------

  function ListaPersonalEntrevistado(id){
    $('#ListaPersonalEntrevistado').load('../app/vistas/sgm/punto10/lista-personal-entrevistado.php?id=' + id); 
  }
  function modalEntrevistado(id){
    $('#modalPrincipal').modal('show'); 
    $('#ContenidoModal').load('../app/vistas/sgm/punto10/modal-agregar-personal-entrevistado.php?id=' + id);
  }

  function GuardarEntrvistador(id){

    let dato1 = $('#dato1').val();
    let dato2 = $('#dato2').val();
    let dato3 = $('#dato3').val();

  if (dato1 != "") {
  $('#dato1').css('border','');
  if (dato2 != "") {
  $('#dato2').css('border','');
  if (dato3 != "") {
  $('#dato3').css('border','');

    var parametros = {
    "id" : id,
    "cate" : 1,
    "dato1" : dato1,
    "dato2" : dato2,
    "dato3" : dato3
    };

     $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/agregar-hallazgo-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      ListaPersonalEntrevistado(id)
      $('#modalPrincipal').modal('hide'); 

     }
     });
  
  }else{
  $('#dato3').css('border','2px solid #A52525'); 
  }
  }else{
  $('#dato2').css('border','2px solid #A52525'); 
  }
  }else{
  $('#dato1').css('border','2px solid #A52525'); 
  }

  }

  function EliminarEntrevistador(e,id,idEntrevistador,cate){

    var parametros = {
    "id" : idEntrevistador,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-hallazgo-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaPersonalEntrevistado(id)
     }
     });

  }

  //--------------------------------------------------------------------------------------

  function ListaEquipoAuditor(id){
    $('#ListaEquipoAuditor').load('../app/vistas/sgm/punto10/lista-equipo-auditor.php?id=' + id); 
  }
  function modalEquipoAuditor(id){
    $('#modalPrincipal').modal('show'); 
    $('#ContenidoModal').load('../app/vistas/sgm/punto10/modal-agregar-equipo-auditor.php?id=' + id);
  }

  function GuardarAuditor(id){

   let dato1 = $('#dato1').val();
    let dato2 = $('#dato2').val();

  if (dato1 != "") {
  $('#dato1').css('border','');
  if (dato2 != "") {
  $('#dato2').css('border','');
  
    var parametros = {
    "id" : id,
    "cate" : 2,
    "dato1" : dato1,
    "dato2" : dato2,
    };

     $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/agregar-hallazgo-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      ListaEquipoAuditor(id)
      $('#modalPrincipal').modal('hide'); 

     }
     });
  
  }else{
  $('#dato2').css('border','2px solid #A52525'); 
  }
  }else{
  $('#dato1').css('border','2px solid #A52525'); 
  }

  }

  function EliminarAuditor(e,id,idEntrevistador,cate){

    var parametros = {
    "id" : idEntrevistador,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-hallazgo-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaEquipoAuditor(id)
     }
     });

  }

  //-----------------------------------------------------------------------------
  function ListaHallazgoConforme(id){
 $('#ListaHallazgoConforme').load('../app/vistas/sgm/punto10/lista-hallazgo-conforme.php?id=' + id); 
}
  function modalHallazgoConforme(id){
$('#modalPrincipal').modal('show'); 
$('#ContenidoModal').load('../app/vistas/sgm/punto10/modal-agregar-hallazgo-conforme.php?id=' + id);
  }

function GuardarHallazgoConforme(id){
    let dato1 = $('#dato1').val();
    let dato2 = $('#dato2').val();
    let dato3 = $('#dato3').val();

  if (dato1 != "") {
  $('#dato1').css('border','');
  if (dato2 != "") {
  $('#dato2').css('border','');
  if (dato3 != "") {
  $('#dato3').css('border','');

    var parametros = {
    "id" : id,
    "cate" : 3,
    "dato1" : dato1,
    "dato2" : dato2,
    "dato3" : dato3
    };

     $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/agregar-hallazgo-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      ListaHallazgoConforme(id)
      $('#modalPrincipal').modal('hide'); 

     }
     });
  
  }else{
  $('#dato3').css('border','2px solid #A52525'); 
  }
  }else{
  $('#dato2').css('border','2px solid #A52525'); 
  }
  }else{
  $('#dato1').css('border','2px solid #A52525'); 
  }
}

  function EliminarConformes(e,id,idEntrevistador,cate){

    var parametros = {
    "id" : idEntrevistador,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-hallazgo-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaHallazgoConforme(id)
     }
     });

  }

  //---------------------------------------------------------------------

  function ListaMejoras(id){
    $('#ListaMejoras').load('../app/vistas/sgm/punto10/lista-mejoras.php?id=' + id); 
  }

  function modalMejoras(id){
  $('#modalPrincipal').modal('show'); 
  $('#ContenidoModal').load('../app/vistas/sgm/punto10/modal-agregar-mejoras.php?id=' + id);
  }

  function GuardarMejora(id){

    let dato1 = $('#dato1').val();

  if (dato1 != "") {
  $('#dato1').css('border','');

    var parametros = {
    "id" : id,
    "cate" : 4,
    "dato1" : dato1
    };

     $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/agregar-hallazgo-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      ListaMejoras(id)
      $('#modalPrincipal').modal('hide'); 

     }
     });
  
  }else{
  $('#dato1').css('border','2px solid #A52525'); 
  }

  }

  function EliminarMejora(e,id,idEntrevistador,cate){

    var parametros = {
    "id" : idEntrevistador,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-hallazgo-auditoria.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaMejoras(id)
     }
     });

  }


  //---------------------------------------------------------------------

  function Finalizar(){
  alertify.confirm('',
  function(){
    regresarP()
   },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea finalizar el Reporte e Hallazgos de Auditoria?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
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
    <div class="float-left"><h4>Reporte e Hallazgos de Auditoria</h4></div>
    </div>
   
    <div class="card-body">

      <table class="table table-bordered table-sm mb-0">
        <tbody>
          <tr>
            <td colspan="3" class="bg-secondary text-white"><b>I. DATOS GENERALES DEL PERMISIONARIO</b></td>
          </tr>
          <tr>
            <td class="bg-light">NOMBRE, DENOMINACIÓN O RAZÓN SOCIAL:</td>
            <td class="bg-light">PERMISO CRE:</td>
            <td class="bg-light">FECHA DE ELABORACIÓN:</td>
          </tr>
          <tr>
            <td class="bg-light"><?=$Session_Razonsocial;?></td>
            <td class="bg-light"><?=$Session_Permisocre;?></td>
            <td class="p-0 m-0"><input type="date" class="form-control border-0 rounded-0" value="<?=$fecha;?>" onchange="Editar(this,<?=$id;?>,1)"></td>
          </tr>

          <tr>
            <td class="align-middle bg-light">NOMBRES DEL RESPONSABLE DEL SGM:</td>
            <td colspan="2" class="p-0 m-0">
              <div id="ListaPersonalResponsable"></div>
            </td>
          </tr>
        </tbody>
      </table>

      <table class="table table-sm table-bordered mb-0">
        <tbody>
        <tr>
          <td colspan="2" class="bg-secondary text-white"><b>I.  DATOS DE LA AUDITORÍA</b></td>
        </tr>
        <tr>
          <td class="bg-light">FECHA Y UBICACIÓN DE LA AUDITORÍA:</td>
          <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$fecha_ubicacion;?>" onkeyup="Editar(this,<?=$id;?>,2)"></td>
        </tr>
        <tr>
          <td class="bg-light">OBJETIVO DE LA AUDITORÍA:</td>
          <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$objetivo_auditoria;?>" onkeyup="Editar(this,<?=$id;?>,3)"></td>
        </tr>
        <tr>
          <td class="bg-light">ALCANCE DE LA AUDITORÍA:</td>
          <td class="p-0 m-0"><input type="text" class="form-control border-0" value="<?=$alcance_auditoria;?>" onkeyup="Editar(this,<?=$id;?>,4)"></td>
        </tr>
        </tbody>
      </table>

      <div class="text-right mt-3 mb-3"><a onclick="modalEntrevistado(<?=$id;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar registro"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></div>

      <div id="ListaPersonalEntrevistado"></div>

      <div class="text-right mt-3 mb-3"><a onclick="modalEquipoAuditor(<?=$id;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar registro"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></div>

      <div id="ListaEquipoAuditor"></div>

     <table class="table table-sm table-bordered mb-0">
      <tbody>
        <tr>
            <td colspan="3" class="bg-secondary text-white"><b>II.  RESULTADO DE LA AUDITORÍA</b></td>
          </tr>
          <tr>
            <td colspan="3" class="bg-light text-center">
              ¿Durante la auditoría se revisaron los siguientes elementos?<br>
              Marcar el resultado como C= Conforme, NC= No Conforme, OM= Oportunidad de Mejora
            </td>
          </tr>
          <tr class="bg-light">
            <td>No.</td>
            <td>CRITERIO:</td>
            <td>RESULTADO:</td>
          </tr>
          <?php 
          $resultado = '';
          $sql_sgme = "SELECT
          sgm_hallazgo_auditoria_resultado.id,
          sgm_hallazgo_auditoria_resultado.id_elemento,
          sgm_hallazgo_auditoria_resultado.resultado,
          sgm_elementos.no,
          sgm_elementos.criterio
          FROM sgm_hallazgo_auditoria_resultado 
          INNER JOIN sgm_elementos 
          ON sgm_hallazgo_auditoria_resultado.id_elemento = sgm_elementos.id
           WHERE sgm_hallazgo_auditoria_resultado.id_hallazgo = '".$id."' ";
          $result_sgme = mysqli_query($con, $sql_sgme);
          $numero_sgme = mysqli_num_rows($result_sgme);
          while($row_sgme = mysqli_fetch_array($result_sgme, MYSQLI_ASSOC)){

            if($row_sgme['resultado'] == 'C'){
              $resultado = 'C= Conforme';
            }else if($row_sgme['resultado'] == 'NC'){
              $resultado = 'NC= No Conforme';
            }else if($row_sgme['resultado'] == 'OM'){
              $resultado = 'OM= Oportunidad de Mejora';
            }

          echo '<tr>
          <td>'.$row_sgme['no'].'</td>
          <td>'.$row_sgme['criterio'].'</td>
          <td class="m-0 p-0">
          <select class="form-control rounded-0 rounded-0 border-0" onchange="Editar(this,'.$row_sgme['id'].',16)">
          <option value="'.$row_sgme['resultado'].'">'.$resultado.'</option>
          <option value="C">C= Conforme</option>
          <option value="NC">NC= No Conforme</option>
          <option value="OM">OM= Oportunidad de Mejora</option>
          </select>
          </td>
          </tr>';
          }

          ?>
        
      </tbody>
    </table>

    <div class="text-right mt-3 mb-3"><a onclick="modalHallazgoConforme(<?=$id;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar registro"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></div>

    <div id="ListaHallazgoConforme"></div>


    <div class="text-right mt-3 mb-3"><a onclick="modalMejoras(<?=$id;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar registro"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a></div>

    <div id="ListaMejoras"></div>


    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td colspan="2" class="bg-secondary text-white"><b>V. COMENTARIOS</b></td>
        </tr>
        <tr><td colspan="2" class="p-0 m-0">
          <textarea class="form-control border-0" onkeyup="Editar(this,<?=$id;?>,5)"><?=$comentarios;?></textarea>
        </td></tr>

        <tr>
          <td colspan="2" class="bg-light">NOTA: EN CASO DE QUE DURANTE LA AUDITORÍA, EL EQUIPO AUDITOR DETECTE UNA SITUACIÓN DE RIESGO PARA LA SEGURIDAD INDUSTRIAL, SEGURIDAD OPERATIVA O PARA EL MEDIO AMBIENTE EN LAS INSTALACIONES DEL REGULADO, DEBERÁ REPORTARLA EN ESTA SECCIÓN.</td>
        </tr>
        <tr><td colspan="2" class="p-0 m-0">
          <textarea class="form-control border-0" onkeyup="Editar(this,<?=$id;?>,6)"><?=$nota;?></textarea>
        </td></tr>

        <tr>
          <td colspan="2" class="bg-light">MOTIVOS DE FINALIZACIÓN DE AUDITORÍA ANTES DE TIEMPO (SI APLICA):</td>
        </tr>
        <tr><td colspan="2" class="p-0 m-0">
          <textarea class="form-control border-0" onkeyup="Editar(this,<?=$id;?>,7)"><?=$motivos;?></textarea>
        </td></tr>

        <tr>
          <td colspan="2" class="bg-secondary text-white"><b>VI.  CONCLUSIONES</b></td>
        </tr>
        <tr><td colspan="2" class="p-0 m-0">
          <textarea class="form-control border-0" onkeyup="Editar(this,<?=$id;?>,8)"><?=$conclusiones;?></textarea>
        </td></tr>
      </tbody>      
    </table>

    <table class="table table-sm table-bordered">
      <tbody>
        <tr class="bg-light">
          <td>Lugar y fecha</td>
          <td>Auditor lider</td>
          <td>Responsable del SGM</td>
        </tr>
        <tr>
          <td class="p-0 m-0">
            <input type="text" class="form-control border-0" value="<?=$lugar_fecha;?>" onkeyup="Editar(this,<?=$id;?>,9)">
          </td>
          <td class="p-0 m-0">
              <select class="form-control rounded-0 rounded-0 border-0" onchange="Editar(this,<?=$id;?>,10)">
               <option value="<?=$auditor_lider;?>"><?=$nom_auditor['nombre'];?></option>
                <?php
                $sql_auditor = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
                $result_auditor = mysqli_query($con, $sql_auditor);
                $numero_auditor = mysqli_num_rows($result_auditor);
                while($row_auditor = mysqli_fetch_array($result_auditor, MYSQLI_ASSOC)){

                $nom_auditor = $row_auditor['nombre'];
                
                echo "<option value='".$row_auditor['id']."'>".$nom_auditor."</option>";

                }
                ?> 
              </select>
          </td>
           <td class="p-0 m-0">
              <select class="form-control rounded-0 rounded-0 border-0" onchange="Editar(this,<?=$id;?>,11)">
               <option value="<?=$responsable_sgm;?>"><?=$nom_responsable['nombre'];?></option>
                <?php
                $sql_res = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
                $result_res = mysqli_query($con, $sql_res);
                $numero_res = mysqli_num_rows($result_res);
                while($row_res = mysqli_fetch_array($result_res, MYSQLI_ASSOC)){

                $nombre = $row_res['nombre'];
                
                echo "<option value='".$row_res['id']."'>".$nombre."</option>";

                }
                ?> 
              </select>
          </td>
        </tr>
      </tbody>
    </table>

                <div class="text-right">
        <button class="btn btn-primary" onclick="Finalizar()">Finalizar Reporte e Hallazgos de Auditoria</button>      
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

 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

