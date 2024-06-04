<?php 
class InformeDesempeno{

    private $class_base_datos;
	private $con;

    function __construct()
	{
        $this->class_base_datos = new ConexionBD();
		$this->con = $this->class_base_datos->conectarBD();
    }

    private function sqlQuery($sql){
        if(mysqli_query($this->con, $sql)){
        return true;
        }else{
        return false;
        }
        }   

    public function agregarEvaluacionDesempeno($id_estacion,$id_usuario,$file_name,$file_tmp_name,$hoy){

        $ruta = "../../archivos/evaluacion-desempeño/".$id_estacion."-EVALUACION-".strtotime($hoy).".pdf";
        $nom = "archivos/evaluacion-desempeño/".$id_estacion."-EVALUACION-".strtotime($hoy).".pdf";

        if(move_uploaded_file($file_tmp_name, $ruta)) {

        $sql = "INSERT INTO tb_evaluacion_desempeno (
        id_estacion,
        id_usuario,
        archivo
        )
        VALUES 
        (
        '".$id_estacion."',
        '".$id_usuario."',
        '".$nom."'
        )";

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        
        }else{
            return false;
        }

    }

    public function eliminarEvaluacionDesempeno($id){

        $sql = "DELETE FROM tb_evaluacion_desempeno WHERE id = '".$id."'";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function editarEvaluacionDesempeno($id,$fecha,$file_name,$file_tmp_name,$hora_del_dia,$hoy){

        $ruta = "../../archivos/evaluacion-desempeño/".$id."-EVALUACION-".strtotime($hoy).".pdf";
        $nom = "archivos/evaluacion-desempeño/".$id."-EVALUACION-".strtotime($hoy).".pdf";

        if(move_uploaded_file($file_tmp_name, $ruta)) {

        $sql1 = "UPDATE tb_evaluacion_desempeno SET
        archivo = '".$nom."'
        WHERE id = '".$id."' ";

        $sql2 = "UPDATE tb_evaluacion_desempeno SET
        fecha_hora = '".$fecha." ".$hora_del_dia."'
        WHERE id = '".$id."' ";

        $this->sqlQuery($sql1);
        $this->sqlQuery($sql2);
        return true;
        $this->class_base_datos->desconectarBD($this->con);

        }else{
            return false;
        }

    }

    public function agregarControlImplementacionSasisopa($id_estacion,$id_usuario){
        $id_reporte = $this->idReporte();

        $sql1 = "INSERT INTO tb_implementacion_sasisopa (
            id,
            id_estacion,
            id_usuario
            )
            VALUES 
            (
            '".$id_reporte."',
            '".$id_estacion."',
            '".$id_usuario."'
            )";

            $procedimientos = "INSERT INTO tb_implementacion_sasisopa_procedimientos (id_reporte,fecha_implementacion,procedimiento,descripcion,informacion,observaciones)
            VALUES
            ('".$id_reporte."','','I. Política.','','',''),
            ('".$id_reporte."','','II. Identificación de peligros y aspectos ambientales, análisis de riesgo y evaluación de impactos ambientales.','','',''),
            ('".$id_reporte."','','III. Requisitos legales.','','',''),
            ('".$id_reporte."','','IV. Objetivos, metas, indicadores.','','',''),
            ('".$id_reporte."','','V. Funciones, responsabilidades y autoridad.','','',''),
            ('".$id_reporte."','','VI. Competencia del personal, capacitación y entrenamiento','','',''),
            ('".$id_reporte."','','VII. Comunicación, participación y consulta.','','',''),
            ('".$id_reporte."','','VIII. Control de documentos y registros.','','',''),
            ('".$id_reporte."','','IX. Mejores prácticas y estándares.','','',''),
            ('".$id_reporte."','','X. Control de actividades y procesos.','','',''),
            ('".$id_reporte."','','XI. Integridad mecánica y aseguramiento de la calidad.','','',''),
            ('".$id_reporte."','','XII. Seguridad de contratistas.','','',''),
            ('".$id_reporte."','','XIII. Preparación y respuesta a emergencias.','','',''),
            ('".$id_reporte."','','XIV. Monitoreo, verificación y evaluación.','','',''),
            ('".$id_reporte."','','XV. Auditorias.','','',''),
            ('".$id_reporte."','','XVI. Investigación de incidentes y accidentes.','','',''),
            ('".$id_reporte."','','XVII. Revisión de resultados.','','',''),
            ('".$id_reporte."','','XVIII. Informes de desempeño.','','','')";

            if($this->sqlQuery($sql1)){
                $this->sqlQuery($procedimientos);
                return $id_reporte;
                $this->class_base_datos->desconectarBD($this->con);
            }else{
                return false;
            }
    }

    private function idReporte(){

        $sql_reporte = "SELECT id FROM tb_implementacion_sasisopa ORDER BY id desc LIMIT 1";
        $result_reporte = mysqli_query($this->con, $sql_reporte);
        $numero_reporte = mysqli_num_rows($result_reporte);
     
        if ($numero_reporte > 0) {
            $row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC);
            $idReporte = $row_reporte['id'] + 1;   
        }else{
            $idReporte = 1;   
        }

        return $idReporte;
    }

    public function eliminarImplementacionSasisopa($id_implementacion){

        $sql_resultado = "SELECT id FROM tb_implementacion_sasisopa_procedimientos WHERE id_reporte = '".$id_implementacion."' ";
        $result_resultado = mysqli_query($this->con, $sql_resultado);
        $numero_resultado = mysqli_num_rows($result_resultado);
        while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){        
        $id = $row_resultado['id'];        
        $sql1 = "DELETE FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."'  ";
        $this->sqlQuery($sql1);
        }
        $sql2 = "DELETE FROM tb_implementacion_sasisopa_procedimientos WHERE id_reporte = '".$id_implementacion."'  ";
        $this->sqlQuery($sql2);
        $sql3 = "DELETE FROM tb_implementacion_sasisopa WHERE id = '".$id_implementacion."'  ";
        $this->sqlQuery($sql3);

        return true;

    }

    public function actualizarFechaProcedimiento($id,$fecha){

        $sql = "UPDATE tb_implementacion_sasisopa_procedimientos SET
        fecha_implementacion = '".$fecha."'
        WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function actualizarDescripcionProcedimiento($id,$descripcion){

        $sql = "UPDATE tb_implementacion_sasisopa_procedimientos SET
        descripcion = '".$descripcion."'
         WHERE id = '".$id."' ";
         return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function actualizarObservacionProcedimiento($id,$observaciones){

        $sql = "UPDATE tb_implementacion_sasisopa_procedimientos SET
        observaciones = '".$observaciones."'
         WHERE id = '".$id."' ";
         return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function actualizarConocerProcedimiento($id,$estado,$fecha = ''){

        if ($estado == 1) {

            $sql = "UPDATE tb_implementacion_sasisopa_procedimientos SET
            informacion = 'Si'
             WHERE id = '".$id."' ";
            
            }else if ($estado == 2) {
            
            $sql = "UPDATE tb_implementacion_sasisopa_procedimientos SET
            informacion = 'No'
             WHERE id = '".$id."' ";
            
            }else if ($estado == 3) {
            
            $hora = date("H:i:s");
            
            $sql = "UPDATE tb_implementacion_sasisopa SET
            fecha_hora = '".$fecha.' '.$hora."'
             WHERE id = '".$id."' ";
            
            }

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

   public function actualizarPuestoProcedimiento($id,$id_puesto,$puesto,$estado){

    if ($estado == 1) {

        $sql = "INSERT INTO tb_implementacion_sasisopa_procedimientos_puesto (
        id_reporte,
        id_lista,
        puesto
        )
        VALUES 
        (
        '".$id."',
        '".$id_puesto."',
        '".$puesto."'
        )";       

    }else if ($estado == 0) {
        
        $sql = "DELETE FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."' AND id_lista = '".$id_puesto."'  ";
        
    }

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

   }

}
