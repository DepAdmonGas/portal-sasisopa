<?php
require('../../../app/help.php');

   $sql_reporte = "SELECT id FROM tb_implementacion_sasisopa ORDER BY id desc LIMIT 1";
   $result_reporte = mysqli_query($con, $sql_reporte);
   $numero_reporte = mysqli_num_rows($result_reporte);

   if ($numero_reporte == 0) {
   $idReporte = 1;
   }else{
   while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
   $idReporte = $row_reporte['id'] + 1;
   }
   }

$sql_insert = "INSERT INTO tb_implementacion_sasisopa (
id,
id_estacion,
id_usuario
)
VALUES 
(
'".$idReporte."',
'".$_POST['idEstacion']."',
'".$_POST['idUsuario']."'
)";
mysqli_query($con, $sql_insert);


   $sql_reporteP = "SELECT id FROM tb_implementacion_sasisopa_procedimientos ORDER BY id desc LIMIT 1";
   $result_reporteP = mysqli_query($con, $sql_reporteP);
   $numero_reporteP = mysqli_num_rows($result_reporteP);

$procedimientos = "INSERT INTO tb_implementacion_sasisopa_procedimientos (id_reporte,fecha_implementacion,procedimiento,descripcion,informacion,observaciones)
   VALUES
   ('".$idReporte."','','I. Política.','','',''),
   ('".$idReporte."','','II. Identificación de peligros y aspectos ambientales, análisis de riesgo y evaluación de impactos ambientales.','','',''),
   ('".$idReporte."','','III. Requisitos legales.','','',''),
   ('".$idReporte."','','IV. Objetivos, metas, indicadores.','','',''),
   ('".$idReporte."','','V. Funciones, responsabilidades y autoridad.','','',''),
   ('".$idReporte."','','VI. Competencia del personal, capacitación y entrenamiento','','',''),
   ('".$idReporte."','','VII. Comunicación, participación y consulta.','','',''),
   ('".$idReporte."','','VIII. Control de documentos y registros.','','',''),
   ('".$idReporte."','','IX. Mejores prácticas y estándares.','','',''),
   ('".$idReporte."','','X. Control de actividades y procesos.','','',''),
   ('".$idReporte."','','XI. Integridad mecánica y aseguramiento de la calidad.','','',''),
   ('".$idReporte."','','XII. Seguridad de contratistas.','','',''),
   ('".$idReporte."','','XIII. Preparación y respuesta a emergencias.','','',''),
   ('".$idReporte."','','XIV. Monitoreo, verificación y evaluación.','','',''),
   ('".$idReporte."','','XV. Auditorias.','','',''),
   ('".$idReporte."','','XVI. Investigación de incidentes y accidentes.','','',''),
   ('".$idReporte."','','XVII. Revisión de resultados.','','',''),
   ('".$idReporte."','','XVIII. Informes de desempeño.','','','')


   ";

mysqli_query($con, $procedimientos);


echo $idReporte;


//------------------
mysqli_close($con);
//------------------