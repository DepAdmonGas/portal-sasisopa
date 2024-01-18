<?php
require('app/help.php');

$sql_reportecre = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' and mes = '".$idMes."' and year = '".$idYear."' ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);
while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
$idReporteCre = $row_reportecre['id'];
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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  ListaReporteEstadistico();
  });
  function regresarP(){
   window.location.href = '<?=RUTA_REPORTE_DIARIO."/".$idYear?>';
  }

  function ListaReporteEstadistico(){
    $('#DivReporteEstadistico').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
    $('#DivReporteEstadistico').load('../../public/gerente/vistas/lista-reporte-estadistico.php?idMes=<?=$idMes;?>&idYear=<?=$idYear;?>');
  }
 
  function Agregar(){
  window.location.href = '<?=RUTA_NEW_REPORTE_DIARIO;?>/<?=$idReporteCre;?>';
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
    <div class="float-left"><h4><?php echo nombremes($idMes)." ".$idYear; ?></h4></div>
    <div class="float-right">

    <a href="../../public/gerente/vistas/descargar-reporte-estadistico-diario.php?idMes=<?=$idMes;?>&idYear=<?=$idYear;?>" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>

    <a onclick="Agregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>    
    </div>
    </div>
    <div class="card-body">

    <div id="DivReporteEstadistico"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalPDF" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h5 class="modal-title">Agregar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
          <div class="row no-gutters">
             <div class="col-12">
               <input class="form-control input-style" type="text" id="Nombres" style="border-radius: 0px;" placeholder="Nombre Completo">
             </div>
             </div>
           </div>
           <div class="form-group">
           <div class="row no-gutters">
              <div class="col-6">
                <input class="form-control input-style" type="text" id="Telefono" style="border-radius: 0px;" placeholder="Telefono">
              </div>
              <div class="col-6">
                <input class="form-control input-style" type="email" id="Email" style="border-radius: 0px;" placeholder="Correo electronico">
              </div>
              </div>
            </div>

        <div class="form-group">
       <select class="form-control" id="Puesto" placeholder="Puesto" style="border-radius: 0px;">
         <option value="">Puesto</option>
         <?php
         $sql_puesto = "SELECT * FROM tb_puestos WHERE tipo_puesto <> 'Administrador' and tipo_puesto <> 'Gerente' and tipo_puesto <> 'Sistemas' and tipo_puesto <> 'Dirección' and tipo_puesto <> 'Comercializadora' and tipo_puesto <> 'Gestoria' and tipo_puesto <> 'Mantenimiento'";
         $result_puesto = mysqli_query($con, $sql_puesto);
         $numero_puesto = mysqli_num_rows($result_puesto);
         while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
           echo "<option value='".$row_puesto['id']."'>".$row_puesto['tipo_puesto']."</option>";
         }
         ?>
       </select>
     </div>
     <div class="form-group">
     <div class="row no-gutters">
          <div class="col-11">
          <input class="form-control input-style" type="text" id="NomUsuario" placeholder="Usuario" style="border-radius: 0px;">
          </div>
          <div class="col-1">
            <div class="text-center" style="margin-top: 5px;">
            <a onclick="UsuarioAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Usuario Aleatorio">
              <img src="<?php echo RUTA_IMG_ICONOS."aleatorio.png"; ?>">
            </a>
            </div>
          </div>
          </div>
        </div>


        <div class="row no-gutters">
           <div class="col-5">
             <input class="form-control input-style" type="text" id="PasswordOriginal" style="border-radius: 0px;" placeholder="Contraseña">
           </div>
           <div class="col-2">
             <div class="text-center" style="margin-top: 15px;">
             <a onclick="PasswordAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Contraseña Aleatoria">
               <img src="<?php echo RUTA_IMG_ICONOS."aleatorio.png"; ?>">
             </a>
             </div>
           </div>
           <div class="col-5">
             <input class="form-control input-style" type="password" id="PasswordCopia" style="border-radius: 0px;" placeholder="Repetir contraseña">
           </div>
           </div>
           <div class="" id="Result"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAgregarPersonal()">Guardar Cambios</button>
        </div>
      </div>
    </div>
    </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

