<?php
class PreparacionEmergencias{
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

    public function validaTelefonos($id_estacion){

        $this->agregarTelefono($id_estacion,'Emergencias','',1);
        $this->agregarTelefono($id_estacion,'Cruz Roja','',1);
        $this->agregarTelefono($id_estacion,'Denuncia Anonima','',1);

    }

    public function agregarTelefono($id_estacion,$titulo,$telefono,$prioridad){

        $sql_telefono = "SELECT id FROM tb_telefonos_emergencias WHERE id_estacion = '".$id_estacion."' AND titulo = '".$titulo."' ";
        $result_telefono = mysqli_query($this->con, $sql_telefono);
        $numero_telefono = mysqli_num_rows($result_telefono);
        if ($numero_telefono == 0) {
        $sql = "INSERT INTO tb_telefonos_emergencias (
        id_estacion,
        titulo,
        telefono,
        prioridad
        )
        VALUES (
        '".$id_estacion."',
        '".$titulo."',
        '".$telefono."',
        '".$prioridad."'
        )";
        
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        }else{
        return false;
        }       
        
        }

        public function editarTelefono($titulo,$telefono,$id){
            $sql = "UPDATE tb_telefonos_emergencias SET
            titulo = '".$titulo."',
            telefono = '".$telefono."'
            WHERE id = '".$id."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
        }

        public function eliminarTelefono($id){
            $sql = "DELETE FROM tb_telefonos_emergencias WHERE id = '".$id."'  ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
        }

    public function agregarProtocoloEmergencias($id_estacion,$fecha,$file_name,$file_tmp_name,$hoy){
               
        $ruta_file = "../../archivos/protocolo/"."PROTOCOLO-".$id_estacion."-".strtotime($hoy).".pdf";
        
        if($file_name != "") {
        $ruta_protocolo = "archivos/protocolo/"."PROTOCOLO-".$id_estacion."-".strtotime($hoy).".pdf";
        }else{
        $ruta_protocolo = "";
        }
        
        if(move_uploaded_file($file_tmp_name, $ruta_file)) {}
        
        $sql = "INSERT INTO tb_protocolo_emergencias (
        id_estacion,
        fechacreacion,
        archivo
        )
        VALUES 
        (
        '".$id_estacion."',
        '".$fecha."',
        '".$ruta_protocolo."'
        )";

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarProtocoloEmergencias($id_estacion,$id,$fecha,$file_name,$file_tmp_name,$hoy){
      
        $ruta_file = "../../archivos/protocolo/"."PROTOCOLO-".$id_estacion."-".strtotime($hoy).".pdf";
        
        if($file_name != "") {
        $ruta_protocolo = "archivos/protocolo/"."PROTOCOLO-".$id_estacion."-".strtotime($hoy).".pdf";
        }else{
        $ruta_protocolo = "";
        }
        
        if(move_uploaded_file($file_tmp_name, $ruta_file)) {
            $sql = "UPDATE tb_protocolo_emergencias SET
            fechacreacion = '".$fecha."',
            archivo = '".$ruta_protocolo."'
            WHERE id = '".$id."' ";   
        }else{
        $sql = "UPDATE tb_protocolo_emergencias SET
        fechacreacion = '".$fecha."'
        WHERE id = '".$id."' ";
        }

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarAnexo($id_protocolo,$nombre_anexo,$file_name,$file_tmp_name,$hoy){

        $ruta_file = "../../archivos/protocolo/"."ANEXO-".strtotime($hoy).".pdf";

        if($file_name != "") {
        $ruta_protocolo = "archivos/protocolo/"."ANEXO-".strtotime($hoy).".pdf";
        }else{
        $ruta_protocolo = "";
        }

        if(move_uploaded_file($file_tmp_name, $ruta_file)) {

        $sql = "INSERT INTO tb_protocolo_emergencias_anexo (
        nombre_anexo,
        id_protocolo,
        archivo
        )
        VALUES 
        (
        '".$nombre_anexo."',
        '".$id_protocolo."',
        '".$ruta_protocolo."'
        )";

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

        }else{
            return false;
        }

    }

    public function eliminarAnexo($id){
        $sql = "DELETE FROM tb_protocolo_emergencias_anexo WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function eliminarProtocoloEmergencias($id){
        $sql = "DELETE FROM tb_protocolo_emergencias WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    //----------------------------------------------------------------------------------------

        public function PersonalA($id){
        $sql = "SELECT id FROM tb_programa_anual_simulacros_personal WHERE id_programa = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        return $numero;
        }
        
        public function Resumen($id){
        $sql = "SELECT id FROM tb_programa_anual_simulacros_resumen WHERE id_programa = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        return $numero;
        }
        
        public function Evaluacion($id){
        $img = "";
        $sql = "SELECT archivo FROM tb_programa_anual_simulacros_evaluacion WHERE id_programa = '".$id."' order by fechacreacion desc LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if($numero > 0){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $img = $row['archivo'];
        }
        return $img;
        }

        public function agregarProgramaAnualSimulacro($id_estacion,$id,$nombre_simulacro,$periodicidad,$fecha){

            if($id == 0){
                $sql = "INSERT INTO tb_programa_anual_simulacros (
                id_estacion,
                nombre_simulacro,
                periodicidad,
                fecha
                )
                VALUES (
                '".$id_estacion."',
                '".$nombre_simulacro."',
                '".$periodicidad."',
                '".$fecha."'
                )";
                }else{                
                $sql = "UPDATE tb_programa_anual_simulacros SET
                fecha = '".$fecha."',
                nombre_simulacro = '".$nombre_simulacro."'
                 WHERE id = '".$id."' ";
                }

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

        }

        public function validaPersonalAsiste($idPrograma,$nombre){

            $sql_programa = "SELECT id FROM tb_programa_anual_simulacros_personal WHERE id_programa = '".$idPrograma."' AND nombre = '".$nombre."' ";
            $result_programa = mysqli_query($this->con, $sql_programa);
            $numero_programa = mysqli_num_rows($result_programa);
            return $numero_programa;
            }

        public function agregarPersonalSimulacro($array,$id_programa){

            foreach ($array as &$valor) {
            
            $sql = "INSERT INTO tb_programa_anual_simulacros_personal (
            id_programa,
            nombre
            )
            VALUES (
            '".$id_programa."',
            '".$valor."'
            )";
            $this->sqlQuery($sql);
            
            }

            $this->class_base_datos->desconectarBD($this->con);

        }

    public function eliminarPersonalSimulacro($id_personal){
        $sql = "DELETE FROM tb_programa_anual_simulacros_personal WHERE id = '".$id_personal."'  ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function agregarResumenSimulacro($resumen,$id_programa){

        $idPrograma = $_POST['idPrograma'];

        $sql_resumen = "SELECT id FROM tb_programa_anual_simulacros_resumen WHERE id_programa = '".$id_programa."' ";
        $result_resumen = mysqli_query($this->con, $sql_resumen);
        $numero_resumen = mysqli_num_rows($result_resumen);
        
        if ($numero_resumen == 0) {        
        $sql = "INSERT INTO tb_programa_anual_simulacros_resumen (
        id_programa,
        resumen
        )
        VALUES (
        '".$id_programa."',
        '".$resumen."'
        )";        
        }else{  
        
        while($row_resumen = mysqli_fetch_array($result_resumen, MYSQLI_ASSOC)){
        $id = $row_resumen['id'];
        }

        $sql = "UPDATE tb_programa_anual_simulacros_resumen SET
        resumen = '".$resumen."'
         WHERE id = '".$id."' ";        
        }

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarEvaluacionSimulacro($id_programa,$file_name,$file_tmp_name,$hoy){
    
        $ruta_file = "../../archivos/protocolo/"."EVALUACION-SIMULACRO-".$id_programa."-".strtotime($hoy).".pdf";
        
        if($file_name != "") {
        $ruta_protocolo = "archivos/protocolo/"."EVALUACION-SIMULACRO-".$id_programa."-".strtotime($hoy).".pdf";
        }else{
        $ruta_protocolo = "";
        }
        
        if(move_uploaded_file($file_tmp_name, $ruta_file)) {
        
        $sql = "INSERT INTO tb_programa_anual_simulacros_evaluacion (
        id_programa,
        archivo
        )
        VALUES 
        (
        '".$id_programa."',
        '".$ruta_protocolo."'
        )";

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        }else{
            return false;
        }

    }

    public function eliminarProgramaAnualSimulacro($id){
        $sql = "DELETE FROM tb_programa_anual_simulacros WHERE id = '".$_POST['id']."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

}