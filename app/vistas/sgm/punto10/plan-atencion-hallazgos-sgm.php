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

  function ValidaUsuario($idReporte,$personal,$con){
$sql_lista = "SELECT * FROM sgm_plan_atencion_hallazgos_responsables WHERE id_plan  = '".$idReporte."' AND id_responsable = '".$personal."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}

function validaAuditoria($id_estacion,$id_registro,$con){

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

$sql = "SELECT * FROM sgm_plan_atencion_hallazgos WHERE id_auditoria = '".$id_registro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

  $sql_insert = "INSERT INTO sgm_plan_atencion_hallazgos (
  id_auditoria,
  fecha,
  sitio_area,
  responsable,
  hallazgo,
  analisis_causa,
  acciones_hallazgos,
  fecha_complimiento,
  recursos_implementacion,
  fecha_atencion_hallazgos,
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
  '".$realizadopor."'
  )";
  mysqli_query($con, $sql_insert);

}

}
validaAuditoria($Session_IDEstacion,$GET_idRegistro,$con);

$sql = "SELECT * FROM sgm_plan_atencion_hallazgos WHERE id_auditoria = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$fecha = $row['fecha'];
$sitio_area = $row['sitio_area'];

$responsable = $row['responsable'];
$nom_responsable = usuario($row['responsable'],$con);

$hallazgo = $row['hallazgo'];
$analisis_causa = $row['analisis_causa'];
$acciones_hallazgos = $row['acciones_hallazgos'];
$fecha_complimiento = $row['fecha_complimiento'];
$recursos_implementacion = $row['recursos_implementacion'];
$fecha_atencion_hallazgos = $row['fecha_atencion_hallazgos'];

$responsable_sgm = $row['responsable_sgm']; 
$nom_responsable_sgm = usuario($row['responsable_sgm'],$con);

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

  ListaPersonalCumplimiento(<?=$id;?>)

  });

  function regresarP(){
  window.history.back();
  }

    function Editar(e,id,cate){

     var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-atencion-hallazgos.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

     }
     });

  }

  function EditarPersonalCumplimiento(e,id,cate){

  var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-atencion-hallazgos.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaPersonalCumplimiento(id)
     }
     });

  }

  function ListaPersonalCumplimiento(id){
    $('#ListaPersonalCumplimiento').load('../app/vistas/sgm/punto10/lista-personal-cumplimiento.php?id=' + id); 
  }

  function Eliminar(e,id,idPersonal,cate){

    var parametros = {
    "id" : idPersonal,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   '../app/vistas/sgm/punto10/editar-atencion-hallazgos.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaPersonalCumplimiento(id)
     }
     });

  }


  function Finalizar(){

  alertify.confirm('',
  function(){

    regresarP()
    
  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea finalizar el Plan de atencion de Hallazgos?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <div class="float-left"><h4>Plan de atencion de Hallazgos</h4></div>
    </div>
   
    <div class="card-body">

      <table class="table table-bordered table-sm">
        <tbody>
          <tr class="bg-secondary text-white">
            <td colspan="3"><b>I.  DATOS GENERALES DEL PERMISIONARIO</b></td>
          </tr>
          <tr>
            <td class="bg-light">NOMBRE, DENOMINACIÓN O RAZÓN SOCIAL:</td>
            <td class="bg-light">PERMISO CRE:</td>
            <td class="bg-light">FECHA DEL INFORME DE AUDITORÍA (Reporte de hallazgos de auditorias):</td>
          </tr>
          <tr>
            <td class="bg-light"><?=$Session_Razonsocial;?></td>
            <td class="bg-light"><?=$Session_Permisocre;?></td>
            <td class="p-0 m-0"><input type="date" class="form-control border-0 rounded-0" value="<?=$fecha;?>" onchange="Editar(this,<?=$id;?>,1)"></td>
          </tr>
          <tr>
            <td colspan="2" class="bg-light">SITIO/ÁREA:</td>
            <td class="bg-light">RESPONSABLE</td>
          </tr>
          <tr>
            <td class="p-0 m-0" colspan="2"><input type="text" class="form-control border-0 rounded-0" value="<?=$sitio_area;?>" onkeyup="Editar(this,<?=$id;?>,2)"></td>
            <td class="p-0 m-0">

               <select class="form-control rounded-0 rounded-0 border-0" onchange="Editar(this,<?=$id;?>,3)">
               <option value="<?=$responsable;?>"><?=$nom_responsable['nombre'];?></option>
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

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>II.  HALLAZGO: (DESCRIPCIÓN/EVIDENCIA/CRITERIO)</b></td>
          </tr>
          <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control rounded-0 border-0" onkeyup="Editar(this,<?=$id;?>,4)"><?=$hallazgo;?></textarea></td>
          </tr>

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>III. ANÁLISIS DE LA CAUSA RAÍZ</b></td>
          </tr>
          <tr>
             <td colspan="3" class="p-0 m-0"><textarea class="form-control rounded-0 border-0" onkeyup="Editar(this,<?=$id;?>,5)"><?=$analisis_causa;?></textarea></td>
          </tr>

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>IV. ACCIONES PARA LA ATENCIÓN DE LOS HALLAZGOS NO CONFORMES</b></td>
          </tr>
          <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control rounded-0 border-0" onkeyup="Editar(this,<?=$id;?>,6)"><?=$acciones_hallazgos;?></textarea></td>
          </tr>

          <tr>
            <td colspan="2" class="bg-secondary text-white align-middle">
            <b>V. NOMBRE DE LOS RESPONSABLES DEL CUMPLIMIENTO DE LAS ACCIONES</b>
            </td>
            <td class="p-0 m-0">
              <div id="ListaPersonalCumplimiento"></div>
            </td>
          </tr>

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>VI. FECHAS COMPROMISO PARA EL CUMPLIMIENTO DE LA IMPLEMENTACIÓN DE ACCIONES</b></td>
          </tr>
          <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control rounded-0 border-0" onkeyup="Editar(this,<?=$id;?>,7)"><?=$fecha_complimiento;?></textarea></td>
          </tr>

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>VII. RECURSOS ASIGNADOS PARA LA IMPLEMENTACIÓN DE ACCIONES</b></td>
          </tr>
          <tr>
            <td colspan="3" class="p-0 m-0"><textarea class="form-control rounded-0 border-0" onkeyup="Editar(this,<?=$id;?>,8)"><?=$recursos_implementacion;?></textarea></td>
          </tr>

        </tbody>
      </table>

      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td class="bg-light">FECHA DEL PLAN DE ATENCIÓN DE HALLAZGOS.:</td>
            <td class="p-0 m-0"><input type="date" class="form-control border-0 rounded-0" value="<?=$fecha_atencion_hallazgos;?>" onchange="Editar(this,<?=$id;?>,9)"></td>
          </tr>
          <tr>
            <td class="bg-light">RESPONSABLE DEL SGM:</td>
            <td class="p-0 m-0">
               <select class="form-control rounded-0 rounded-0 border-0" onchange="Editar(this,<?=$id;?>,10)">
               <option value="<?=$responsable_sgm;?>"><?=$nom_responsable_sgm['nombre'];?></option>
                <?php
                $sql_res_sgm = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
                $result_res_sgm = mysqli_query($con, $sql_res_sgm);
                $numero_res_sgm = mysqli_num_rows($result_res_sgm);
                while($row_res_sgm = mysqli_fetch_array($result_res_sgm, MYSQLI_ASSOC)){

                $nombre_sgm = $row_res_sgm['nombre'];
                
                echo "<option value='".$row_res_sgm['id']."'>".$nombre_sgm."</option>";

                }
                ?> 
              </select>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="text-right">
        <button class="btn btn-primary" onclick="Finalizar()">Finalizar Plan de atencion de Hallazgos</button>      
      </div>


    </div>
    </div>
    </div>
    </div>
    </div>

 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

