<?php 
require('../../../app/help.php');

$idCalendario = $_POST['idCalendario'];

$sql = "SELECT
tb_calendario_actividades.id,
tb_calendario_actividades.id_estacion,
tb_calendario_actividades.folio,
tb_calendario_actividades.fecha_inicio,
tb_calendario_actividades.fecha_termino,
tb_calendario_actividades.estado,
sa_sasisopa_actividades.id_sasisopa,
sa_sasisopa_actividades.formato,
sa_sasisopa_actividades.actividad,
sa_sasisopa_actividades.periodicidad
FROM tb_calendario_actividades 
INNER JOIN sa_sasisopa_actividades
ON tb_calendario_actividades.id_actividad = sa_sasisopa_actividades.id
WHERE tb_calendario_actividades.id  = '".$idCalendario."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

    $idActividad = $row['id'];
    $FechaInicio = $row['fecha_inicio'];
    $idSasisopa = $row['id_sasisopa'];
    $formato = $row['formato'];
    if($row['estado'] == 0){
        $Result = CreaActividadSasisopa($Session_IDEstacion,$Session_IDUsuarioBD,$idActividad,$FechaInicio,$idSasisopa,$formato,$con);
    }else if($row['estado'] == 1){
        $Result = urlDetalle($idSasisopa,$formato);
    }

    echo $Result;
}

function CreaActividadSasisopa($idEstacion,$idUsuario,$idActividad,$FechaInicio,$idSasisopa,$formato,$con){

    date_default_timezone_set('America/Mexico_City');
    $hora_del_dia = date("H:i:s");

    if($idSasisopa == 1 && $formato == 'Fo.ADMONGAS.001'){
        
        $idListaC = idListaComprobacion($con);
        $sql_insert = "INSERT INTO tb_politica_lista_comprobacion (
            id,
            id_estacion,
            id_usuario,
            fecha,
            asistentes,
            comentarios
            )
            VALUES (
            '".$idListaC."',
            '".$idEstacion."',
            '".$idUsuario."',
            '".$FechaInicio."',
            '',
            ''
            )";
            
            if(mysqli_query($con, $sql_insert)){

                $sqlDetalle = "INSERT INTO tb_politica_lista_comprobacion_detalle (id_lista_comprobacion,criterio,resultado) VALUES 
                    ('".$idListaC."','La política es adecuada a la naturaleza magnitud y actividades del proyecto',''),
                    ('".$idListaC."','La política incluye la seguridad operativa',''),
                    ('".$idListaC."','La política incluye la protección al medio ambiente',''),
                    ('".$idListaC."','Los trabajadores, la alta dirección, los clientes y los subcontratistas tienen conocimiento de la política',''),
                    ('".$idListaC."','La política se revisa periódicamente',''),
                    ('".$idListaC."','La política se compromete al control de los peligros e impactos ambientales',''),
                    ('".$idListaC."','La política considera la participación del personal','')
                    ";
                    mysqli_query($con, $sqlDetalle);

                actualizarActividad($idActividad,1,$con);
                $Result = urlDetalle($idSasisopa,$formato);
            }else{
                $Result = 0;  
            }

        }else if($idSasisopa == 2 && $formato == 'DLES/SA/005'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 3 && $formato == 'Fo.ADMONGAS.004'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);
            
        }else if($idSasisopa == 4 && $formato == 'Fo.ADMONGAS.005'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 4 && $formato == 'Fo.ADMONGAS.006'){

            $folioSOM = folioSOM($con);

            $sql_insert = "INSERT INTO tb_seguimiento_objetivos_metas (
                id,
                id_estacion,
                id_usuario
                )
                VALUES 
                (
                '".$folioSOM."',
                '".$idEstacion."', 
                '".$idUsuario."'
                )";
                
                if(mysqli_query($con, $sql_insert)){
                
                AgregarDSOM($folioSOM,'Satisfacción del cliente',$FechaInicio,'','','',$con);
                AgregarDSOM($folioSOM,'Mantenimiento',$FechaInicio,'','','',$con);
                AgregarDSOM($folioSOM,'Capacitación',$FechaInicio,'','','',$con);
                AgregarDSOM($folioSOM,'Quejas y sugerencias',$FechaInicio,'','','',$con);
                AgregarDSOM($folioSOM,'Cumplimiento de legislación',$FechaInicio,'','','',$con);
                
                actualizarActividad($idActividad,1,$con);
                $Result = urlDetalle($idSasisopa,$formato);
                }else{
                $Result = 0;
                }

        }else if($idSasisopa == 4 && $formato == 'Fo.ADMONGAS.007'){

            $sql_insert = "INSERT INTO tb_seguimiento_reporte_indicador (
                id_estacion,
                id_usuario,
                fecha,
                capacitacion,
                exp_cliente,
                ventas,
                medidas_correctivas,
                fecha_aplicacion
                )
                VALUES 
                (
                '".$idEstacion."', 
                '".$idUsuario."',
                '".$FechaInicio."',
                '',
                '',
                '',
                '',
                ''                
                )";
                
                if(mysqli_query($con, $sql_insert)){
                
                    actualizarActividad($idActividad,1,$con);
                    $Result = urlDetalle($idSasisopa,$formato);

                }else{
                    $Result = 0;
                }
                
        }else if($idSasisopa == 6 && $formato == 'Fo.ADMONGAS.008'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 6 && $formato == 'FO.ADMONGAS.009'){

           $sql_insert = "INSERT INTO tb_capacitacion_externa (
            id_estacion,
            id_usuario,
            curso,
            fecha_programada,
            duracion,
            duraciondetalle,
            instructor,
            fecha_real
            )
            VALUES (
            '".$idEstacion."',
            '".$idUsuario."',
            '',
            '".$FechaInicio.' '.$hora_del_dia."',
            '',
            '',
            '',
            ''
            )";

            if(mysqli_query($con, $sql_insert)){

                actualizarActividad($idActividad,1,$con);
                $Result = urlDetalle($idSasisopa,$formato);

            }else{
                $Result = 0;  
            }
            
        }else if($idSasisopa == 7 && $formato == 'Fo.ADMONGAS.010'){

            $folioRASCIE = folioRASCIE($idEstacion, $con);

            $sql_insert = "INSERT INTO se_comunicacion_i_e (id_estacion,no_comunicacion,fecha,tema,detalle,encargado_comunicacion,tipo_comunicacion,material,seguimiento,dirigidoa,url,asistencia)
            VALUES (
            '".$idEstacion."',
            '".$folioRASCIE."',
            '".$FechaInicio."',
            'Bitácoras con el registro de la atención y el seguimiento a la comunicación interna y externa.',
            '',
            '".$idUsuario."',
            '',
            '',
            '',
            '','',0)";
            if(mysqli_query($con, $sql_insert)){

                actualizarActividad($idActividad,1,$con);
                $Result = urlDetalle($idSasisopa,$formato);

            }else{
                $Result = 0; 
            }

        }else if($idSasisopa == 10 && $formato == 'DLES.ADMONGAS.001'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 10 && $formato == 'DLES.ADMONGAS.002'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);
            
        }else if($idSasisopa == 10 && $formato == 'DLES.ADMONGAS.003'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);
            
        }else if($idSasisopa == 10 && $formato == 'Fo.ADMONGAS.011'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);
            
        }else if($idSasisopa == 11 && $formato == 'DLES.ADMONGAS.001'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 11 && $formato == 'DLES.ADMONGAS.002'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 11 && $formato == 'Fo.ADMONGAS.011'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 12 && $formato == 'DLES.ADMONGAS.001'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 12 && $formato == 'Fo.ADMONGAS.012'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 12 && $formato == 'Fo.ADMONGAS.013'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 12 && $formato == 'FO.ADMONGAS.014'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 12 && $formato == 'Fo.ADMONGAS.015'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 13 && $formato == 'Fo.ADMONGAS.016'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 13 && $formato == 'Fo.ADMONGAS.16ª'){

            $sql_insert = "INSERT INTO tb_programa_anual_simulacros (
                id_estacion,
                nombre_simulacro,
                periodicidad,
                fecha
                )
                VALUES (
                '".$idEstacion."',
                '',
                'Trimestral',
                '".$FechaInicio."'
                )";
                if(mysqli_query($con, $sql_insert)){
                    actualizarActividad($idActividad,1,$con);
                    $Result = urlDetalle($idSasisopa,$formato);  
                }else{
                    $Result = 0; 
                } 

        }else if($idSasisopa == 13 && $formato == 'DLES/SA/005'){

        
            $sql_insert = "INSERT INTO tb_protocolo_emergencias (
                id_estacion,
                fechacreacion,
                archivo
                )
                VALUES 
                (
                '".$idEstacion."',
                '".$FechaInicio."',
                ''
                )";
                
                if(mysqli_query($con, $sql_insert)){
                    actualizarActividad($idActividad,1,$con);
                    $Result = urlDetalle($idSasisopa,$formato);  
                }else{
                    $Result = 0; 
                }                
        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.017'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);  

        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.019'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);  

        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.020'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);  

        }else if($idSasisopa == 14 && $formato == 'DLES.ADMONGAS.002'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.021'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.022'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.018'){

            $idAH = idAH($con);
            $FolioAH = FolioAH($idEstacion,$con);

            $sql_insert = "INSERT INTO tb_atencion_hallazgos (
                id,
                id_estacion,
                folio,
                fecha_auditoria,
                no_control,
                tipo_auditoria
                )
                VALUES (
                '".$idAH."',
                '".$idEstacion."',
                '".$FolioAH."',
                '".$FechaInicio."',
                '',
                ''
                )";
                
                if(mysqli_query($con, $sql_insert)){
                    actualizarActividad($idActividad,1,$con);
                    $Result = urlDetalle($idSasisopa,$formato);
                }else{
                    $Result = 0; 
                }

        }else if($idSasisopa == 15 && $formato == 'Fo.ADMONGAS.023'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 15 && $formato == 'Fo.ADMONGAS.024'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 15 && $formato == 'Fo.ADMONGAS.025'){

            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);

        }else if($idSasisopa == 16 && $formato == 'Fo.ADMONGAS.026'){
            actualizarActividad($idActividad,1,$con);
            $Result = urlDetalle($idSasisopa,$formato);
        }else if($idSasisopa == 17 && $formato == 'Fo.ADMONGAS.027'){

            $sql_insert = "INSERT INTO tb_revision_resultados (
                id_estacion,
                id_usuario,
                fecha_hora,
                archivo
                )
                VALUES 
                (
                '".$idEstacion."',
                '".$idUsuario."',
                '".$FechaInicio.' '.$hora_del_dia."',
                ''
                )";
                if(mysqli_query($con, $sql_insert)){
                    actualizarActividad($idActividad,1,$con);
                    $Result = urlDetalle($idSasisopa,$formato);
                }else{
                    $Result = 0; 
                }

        }else if($idSasisopa == 18 && $formato == 'Fo.ADMONGAS.028 IED.'){

            $sql_insert = "INSERT INTO tb_evaluacion_desempeno (
                id_estacion,
                id_usuario,
                fecha_hora,
                archivo
                )
                VALUES 
                (
                '".$idEstacion."',
                '".$idUsuario."',
                '".$FechaInicio.' '.$hora_del_dia."',
                ''
                )";
                if(mysqli_query($con, $sql_insert)){
                    actualizarActividad($idActividad,1,$con);
                    $Result = urlDetalle($idSasisopa,$formato);
                }else{
                    $Result = 0; 
                }

        }else if($idSasisopa == 18 && $formato == 'Fo.ADMONGAS.029'){

            $idReporteCIPS = idReporteCIPS($con);

            $sql_insert = "INSERT INTO tb_implementacion_sasisopa (
                id,
                id_estacion,
                id_usuario,
                fecha_hora
                )
                VALUES 
                (
                '".$idReporteCIPS."',
                '".$idEstacion."',
                '".$idUsuario."',
                '".$FechaInicio.' '.$hora_del_dia."'
                )";
                if(mysqli_query($con, $sql_insert)){

                    $procedimientos = "INSERT INTO tb_implementacion_sasisopa_procedimientos (id_reporte,fecha_implementacion,procedimiento,descripcion,informacion,observaciones)
                    VALUES
                    ('".$idReporteCIPS."','','I. Política.','','',''),
                    ('".$idReporteCIPS."','','II. Identificación de peligros y aspectos ambientales, análisis de riesgo y evaluación de impactos ambientales.','','',''),
                    ('".$idReporteCIPS."','','III. Requisitos legales.','','',''),
                    ('".$idReporteCIPS."','','IV. Objetivos, metas, indicadores.','','',''),
                    ('".$idReporteCIPS."','','V. Funciones, responsabilidades y autoridad.','','',''),
                    ('".$idReporteCIPS."','','VI. Competencia del personal, capacitación y entrenamiento','','',''),
                    ('".$idReporteCIPS."','','VII. Comunicación, participación y consulta.','','',''),
                    ('".$idReporteCIPS."','','VIII. Control de documentos y registros.','','',''),
                    ('".$idReporteCIPS."','','IX. Mejores prácticas y estándares.','','',''),
                    ('".$idReporteCIPS."','','X. Control de actividades y procesos.','','',''),
                    ('".$idReporteCIPS."','','XI. Integridad mecánica y aseguramiento de la calidad.','','',''),
                    ('".$idReporteCIPS."','','XII. Seguridad de contratistas.','','',''),
                    ('".$idReporteCIPS."','','XIII. Preparación y respuesta a emergencias.','','',''),
                    ('".$idReporteCIPS."','','XIV. Monitoreo, verificación y evaluación.','','',''),
                    ('".$idReporteCIPS."','','XV. Auditorias.','','',''),
                    ('".$idReporteCIPS."','','XVI. Investigación de incidentes y accidentes.','','',''),
                    ('".$idReporteCIPS."','','XVII. Revisión de resultados.','','',''),
                    ('".$idReporteCIPS."','','XVIII. Informes de desempeño.','','','')";
                    mysqli_query($con, $procedimientos);

                    actualizarActividad($idActividad,1,$con);
                    $Result = urlDetalle($idSasisopa,$formato);

                }else{
                    $Result = 0; 
                }
        }

        return $Result;

    }
    
    function urlDetalle($idSasisopa,$formato){

        date_default_timezone_set('America/Mexico_City');
        $year = date("Y");
        $variable = date("m");
        $mes = (int) $variable;
       
        if($idSasisopa == 1 && $formato == 'Fo.ADMONGAS.001'){
            $Url = '1-politica';
        }else if($idSasisopa == 2 && $formato == 'DLES/SA/005'){
            $Url = '2-analisis-riesgo-evaluacion-impactos-ambientales';
        }else if($idSasisopa == 3 && $formato == 'Fo.ADMONGAS.004'){
            $Url = '3-requisitos-legales';
        }else if($idSasisopa == 4 && $formato == 'Fo.ADMONGAS.005'){
            $Url = 'reporte-diario/'.$mes.'/'.$year;
        }else if($idSasisopa == 4 && $formato == 'Fo.ADMONGAS.006'){
            $Url = '4-objetivos-metas-indicadores';
        }else if($idSasisopa == 4 && $formato == 'Fo.ADMONGAS.007'){
            $Url = '4-objetivos-metas-indicadores';
        }else if($idSasisopa == 6 && $formato == 'Fo.ADMONGAS.008'){
            $Url = 'perfiles-personal';
        }else if($idSasisopa == 6 && $formato == 'FO.ADMONGAS.009'){
            $Url = 'capacitacion-externa';
        }else if($idSasisopa == 7 && $formato == 'Fo.ADMONGAS.010'){
            $Url = '7-comunicacion-participacion-consulta';
        }else if($idSasisopa == 10 && $formato == 'DLES.ADMONGAS.001'){
            $Url = '10-control-actividades-procesos';
        }else if($idSasisopa == 10 && $formato == 'DLES.ADMONGAS.002'){
            $Url = 'mantenimiento-preventivo-correctivo';
        }else if($idSasisopa == 10 && $formato == 'DLES.ADMONGAS.003'){
            $Url = 'recepcion-descargar-producto';
        }else if($idSasisopa == 10 && $formato == 'Fo.ADMONGAS.011'){
            $Url = 'programa-anual-mantenimiento';
        }else if($idSasisopa == 11 && $formato == 'DLES.ADMONGAS.001'){
            $Url = '11-integridad-mecanica-aseguramiento';
        }else if($idSasisopa == 11 && $formato == 'DLES.ADMONGAS.002'){
            $Url = 'mantenimiento-preventivo-correctivo';
        }else if($idSasisopa == 11 && $formato == 'Fo.ADMONGAS.011'){
            $Url = 'programa-anual-mantenimiento';
        }else if($idSasisopa == 12 && $formato == 'DLES.ADMONGAS.001'){
            $Url = '11-integridad-mecanica-aseguramiento';
        }else if($idSasisopa == 12 && $formato == 'Fo.ADMONGAS.012'){
            $Url = '12-seguridad-contratistas';
        }else if($idSasisopa == 12 && $formato == 'Fo.ADMONGAS.013'){
            $Url = '12-seguridad-contratistas';
        }else if($idSasisopa == 12 && $formato == 'FO.ADMONGAS.014'){
            $Url = '12-seguridad-contratistas';
        }else if($idSasisopa == 12 && $formato == 'Fo.ADMONGAS.015'){
            $Url = '12-seguridad-contratistas';
        }else if($idSasisopa == 13 && $formato == 'Fo.ADMONGAS.016'){
            $Url = '13-preparacion-emergencias';
        }else if($idSasisopa == 13 && $formato == 'Fo.ADMONGAS.16ª'){
            $Url = '13-preparacion-emergencias';
        }else if($idSasisopa == 13 && $formato == 'DLES/SA/005'){
            $Url = '13-preparacion-emergencias';
        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.017'){
            $Url = '14-monitoreo-verificacion-evaluacion';
        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.019'){
            $Url = 'calibracion-verificacion-mantenimiento-equipos';
        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.020'){
            $Url = 'calibracion-verificacion-mantenimiento-equipos';
        }else if($idSasisopa == 14 && $formato == 'DLES.ADMONGAS.002'){
            $Url = 'bitacora-calibracion-equipos';
        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.021'){
            $Url = 'evaluacion-cumplimiento-requisitos-legales';
        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.022'){
            $Url = 'evaluacion-cumplimiento-requisitos-legales';
        }else if($idSasisopa == 14 && $formato == 'Fo.ADMONGAS.018'){
            $Url = 'atencion-hallazgos';
        }else if($idSasisopa == 15 && $formato == 'Fo.ADMONGAS.023'){
            $Url = 'programa-auditorias-internas-externas';
        }else if($idSasisopa == 15 && $formato == 'Fo.ADMONGAS.024'){
            $Url = 'auditoria-interna';
        }else if($idSasisopa == 15 && $formato == 'Fo.ADMONGAS.025'){
            $Url = 'auditoria-interna';
        }else if($idSasisopa == 16 && $formato == 'Fo.ADMONGAS.026'){
            $Url = '16-investigacion-incidentes-accidentes';
        }else if($idSasisopa == 17 && $formato == 'Fo.ADMONGAS.027'){
            $Url = '17-revision-resultados';
        }else if($idSasisopa == 18 && $formato == 'Fo.ADMONGAS.028 IED.'){
            $Url = '18-informes-desempeno';
        }else if($idSasisopa == 18 && $formato == 'Fo.ADMONGAS.029'){
            $Url = '18-informes-desempeno';
        }
    
        return $Url;
    }

    function actualizarActividad($idActividad,$estado,$con){

        date_default_timezone_set('America/Mexico_City');
        $fecha_del_dia = date("Y-m-d");
    
        $sql = "UPDATE tb_calendario_actividades SET
        fecha_termino = '".$fecha_del_dia."',
        estado = '".$estado."'
        WHERE id = '".$idActividad."' ";
        mysqli_query($con, $sql);
    }

    //--------------------------------------------------------

function idListaComprobacion($con){

    $sql = "SELECT id FROM tb_politica_lista_comprobacion ORDER BY id desc LIMIT 1";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);

    if ($numero == 0) {
    $idiia = 1;
    }else{
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $idiia = $row['id'] + 1;
    }
    }
    return $idiia;
}

function folioSOM($con){

    $sql = "SELECT id FROM tb_seguimiento_objetivos_metas ORDER BY id desc LIMIT 1 ";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    
    if ($numero == 0) {
    $NumFolio = 1;
    }else{
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $folio = $row['id'] + 1;
    $NumFolio = $folio;
    }
    }  

    return $NumFolio;
}

function AgregarDSOM($NumFolio,$Objetivo,$Dato1,$Dato2,$Dato3,$Dato4,$con){

    $sql_insert = "INSERT INTO tb_seguimiento_objetivos_metas_detalle (
    id_seguimiento,
    fecha,
    objetivo_meta,
    nivel_cumplimiento,
    medidas,
    fecha_aplicacion
    )
    VALUES 
    (
    '".$NumFolio."', 
    '".$Dato1."',
    '".$Objetivo."',
    '".$Dato2."',
    '".$Dato3."',
    '".$Dato4."'
    
    )";
    
    mysqli_query($con, $sql_insert);
    }

    function folioRASCIE($idEstacion, $con){

        $sql = "SELECT no_comunicacion FROM se_comunicacion_i_e WHERE id_estacion = '".$idEstacion."' ORDER BY no_comunicacion desc LIMIT 1";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);

        if ($numero == 0) {
        $noComunicacion = 1;
        }else{
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $noComunicacion = $row['no_comunicacion'] + 1;
        }
        }

        return $noComunicacion;

    }

    function idAH($con){
        $sql_folio = "SELECT id FROM tb_atencion_hallazgos ORDER BY id desc LIMIT 1 ";
        $result_folio = mysqli_query($con, $sql_folio);
        $numero_folio = mysqli_num_rows($result_folio);
        if ($numero_folio == 0) {
        $NumFolio = 1;
        }else{
        while($row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC)){
        $folio = $row_folio['id'] + 1;
        $NumFolio = $folio;
        }
        }
        return $NumFolio;
        }
        
        function FolioAH($IDEstacion,$con){
        $sql_folio = "SELECT folio FROM tb_atencion_hallazgos WHERE id_estacion = '".$IDEstacion."' ORDER BY folio desc LIMIT 1 ";
        $result_folio = mysqli_query($con, $sql_folio);
        $numero_folio = mysqli_num_rows($result_folio);
        if ($numero_folio == 0) {
        $NumFolio = 1;
        }else{
        while($row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC)){
        $folio = $row_folio['folio'] + 1;
        $NumFolio = $folio;
        }
        }
        return $NumFolio;
        }

        function idReporteCIPS($con){

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

            return $idReporte;

        }

//------------------
mysqli_close($con);
//------------------
