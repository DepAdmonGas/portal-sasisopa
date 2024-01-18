	<?php
require('../../../app/help.php');

$sql_sasisopa = "SELECT
sa_sasisopa_estaciones.id,
sa_sasisopa_estaciones.id_sasisopa,
sa_sasisopa.numero_sasisopa,
sa_sasisopa.nombre,
sa_sasisopa_estaciones.estado
FROM sa_sasisopa_estaciones
INNER JOIN sa_sasisopa ON sa_sasisopa_estaciones.id_sasisopa = sa_sasisopa.id 
WHERE sa_sasisopa_estaciones.id_estacion = '".$Session_IDEstacion."' ";
$result_sasisopa = mysqli_query($con, $sql_sasisopa);
$numero_sasisopa = mysqli_num_rows($result_sasisopa);

$sql_noticias = "SELECT * FROM no_noticias WHERE id_usuario = '".$Session_IDUsuarioBD."' AND estado = 0 ";
$result_noticias = mysqli_query($con, $sql_noticias);
$numero_noticias = mysqli_num_rows($result_noticias);
?>
<div class="text-center" style="">
<img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 80%;">
</div>
<div class="list-group" role="tablist" style="font-size: .9em;">
<a class="list-group-item d-flex justify-content-between align-items-center list-group-item-action active" style="border: 1px solid #f0f0f0;border-radius: 0px;" href="" data-toggle="list" onclick="PuntosSasisopa()">SASISOPA
<span class="badge badge-light badge-pill"><?=$numero_sasisopa;?></span></a>
<a class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;" onclick="Noticias()" >NOTICIAS <span class="badge badge-success badge-pill"><?=$numero_noticias;?></span></a>
          <a class="list-group-item list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;" onclick="Comunicados()">COMUNICADOS</a>
      <a class="list-group-item list-group-item-action" style="border: 1px solid #f0f0f0;border-radius: 0px;" onclick="ConsultaSasisopa()"><img src='<?php echo RUTA_IMG_ICONOS; ?>noactivo.png' /> CONSULTA TU SASISOPA</a>
  <a class="list-group-item list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;" onclick="ProgramaImplementacion()"><img src='<?php echo RUTA_IMG_ICONOS; ?>noactivo.png' /> PROGRAMA DE IMPLEMENTACION</a>
          <a class="list-group-item list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;" onclick="ReporteCRE()"><img src='<?php echo RUTA_IMG_ICONOS; ?>noactivo.png' /> REPORTE ESTADÍSTICO DE LA CRE </a>
          <a class="list-group-item list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;" onclick="ProgramaAnualM()">PROGRAMA ANUAL DE MANTENIMIENTO</a>
          <a class="list-group-item list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;">PERMISOS</a>
          <a class="list-group-item list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;">PROGRAMA ANUAL DE CAPACITACIÓN</a>
          <a class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" href="" data-toggle="list" onclick="btnMisCursos()" style="border: 1px solid #f0f0f0;border-radius: 0px;">MIS CURSOS
          <span class="badge badge-light badge-pill"></span></a></a>
          <a class="list-group-item list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;" onclick="Personal()">PERSONAL</a>
          <a class="list-group-item list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;">PROCEDIMIENTOS</a>
          <a class="list-group-item list-group-item-action" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;"  onclick="CambioPrecio()">CAMBIO DE PRECIO</a>
          <a class="list-group-item list-group-item-action bg-info text-white" href="" data-toggle="list" style="border: 1px solid #f0f0f0;border-radius: 0px;"  onclick="Nom035()">NOM-035</a>
                    </div>