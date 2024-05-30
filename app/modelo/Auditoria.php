<?php
class Auditoria{

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

        public function formatos($id, $formato){
            $sql_archivo = "SELECT * FROM tb_auditoria_interna_formato WHERE id_auditoria = '".$id."' AND formato = '".$formato."' ORDER BY id asc ";
            $result_archivo = mysqli_query($this->con, $sql_archivo);
            $numero_archivo = mysqli_num_rows($result_archivo);
            if($numero_archivo > 0){
            while($row_archivo = mysqli_fetch_array($result_archivo, MYSQLI_ASSOC)){
            $archivo = $row_archivo['archivo'];
            }
            }else{
            $archivo = "";
            }
            return $archivo;
        }

    public function agregarAuditoriaInterna($id_estacion,$id_usuario,$prestador_servicio){

        $sql = "INSERT INTO tb_auditoria_interna (
            id_estacion,
            id_usuario,
            auditor
            )
            VALUES (
            '".$id_estacion."',
            '".$id_usuario."',
            '".$prestador_servicio."'
            )";

        $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarArchivoInternaFormato24($id_documento,$file_name,$file_tmp_name,$hoy){

        $upload_folder = "../../archivos/auditorias/I-A-".$id_documento."-".strtotime($hoy).".pdf";

        if ($file_name != "") {
        $PDFNombre = "archivos/auditorias/I-A-".$id_documento."-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre = ""; 
        }

        if(move_uploaded_file($file_tmp_name, $upload_folder)) {

        $sql = "INSERT INTO tb_auditoria_interna_formato (
        id_auditoria,
        formato,
        archivo
        )
        VALUES (
        '".$id_documento."',
        'formato024',
        '".$PDFNombre."'
        )";
        
        $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        
        return $PDFNombre;
        }else{
        return false;
        }
        
    }

    public function agregarArchivoInternaFormato25($id_documento,$file_name,$file_tmp_name,$hoy){

        $upload_folder = "../../archivos/auditorias/P-D-H-".$id_documento."-".strtotime($hoy).".pdf";

        if ($file_name != "") {
        $PDFNombre = "archivos/auditorias/P-D-H-".$id_documento."-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre = ""; 
        }

        if(move_uploaded_file($file_tmp_name, $upload_folder)) {

        $sql = "INSERT INTO tb_auditoria_interna_formato (
        id_auditoria,
        formato,
        archivo
        )
        VALUES (
        '".$id_documento."',
        'formato025',
        '".$PDFNombre."'
        )";
        
        $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        return $PDFNombre;
        }else{
        return false;
        }

    }

    public function agregarAnexoAuditoriaInterna($id,$formato,$documento,$file_name,$file_tmp_name,$hoy){
        
        $upload_folder = "../../archivos/auditorias/A-I-ANEXO-".$id."-".strtotime($hoy).".pdf";
        
        if ($file_name != "") {
        $PDFNombre = "archivos/auditorias/A-I-ANEXO-".$id."-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre = ""; 
        }
        
        if(move_uploaded_file($file_tmp_name, $upload_folder)) {
        
        $sql = "INSERT INTO tb_auditoria_interna_anexos (
        id_auditoria,
        formato,
        documento,
        archivo
        )
        VALUES (
        '".$id."',
        '".$formato."',
        '".$documento."',
        '".$PDFNombre."'
        )";
        $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        
        }else{
            return false;
        }
    }

    //-----------------------------------------------------------------------------------------------------------------

    public function formatosExterna($id, $formato){
        $sql_archivo = "SELECT * FROM tb_auditoria_externa_formato WHERE id_auditoria = '".$id."' AND formato = '".$formato."' ORDER BY id asc ";
        $result_archivo = mysqli_query($this->con, $sql_archivo);
        $numero_archivo = mysqli_num_rows($result_archivo);
        if($numero_archivo > 0){
        $row_archivo = mysqli_fetch_array($result_archivo, MYSQLI_ASSOC);
        $archivo = $row_archivo['archivo'];
        }else{
        $archivo = "";
        }
        return $archivo;
        }

    public function agregarAuditoriaExterna($id_estacion,$id_usuario,$prestador_servicio){

        $sql = "INSERT INTO tb_auditoria_externa (
            id_estacion,
            id_usuario,
            prestador_servicio
            )
            VALUES (
            '".$id_estacion."',
            '".$id_usuario."',
            '".$prestador_servicio."'
            )";

            $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
    }

    public function agregarArchivoFormato24($id_documento,$file_name,$file_tmp_name,$hoy){
       
        $upload_folder = "../../archivos/auditorias/I-A-".$id_documento."-".strtotime($hoy).".pdf";

        if ($file_name != "") {
        $PDFNombre = "archivos/auditorias/I-A-".$id_documento."-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre = ""; 
        }

        if(move_uploaded_file($file_tmp_name, $upload_folder)) {

        $sql = "INSERT INTO tb_auditoria_externa_formato (
        id_auditoria,
        formato,
        archivo
        )
        VALUES (
        '".$id_documento."',
        'formato024',
        '".$PDFNombre."'
        )";
        
        $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        
        return $PDFNombre;
        }else{
        return false;
        }

    }

    public function agregarArchivoFormato25($id_documento,$file_name,$file_tmp_name,$hoy){

        $upload_folder = "../../archivos/auditorias/P-D-H-".$id_documento."-".strtotime($hoy).".pdf";

        if ($file_name != "") {
        $PDFNombre = "archivos/auditorias/P-D-H-".$id_documento."-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre = ""; 
        }

        if(move_uploaded_file($file_tmp_name, $upload_folder)) {

        $sql = "INSERT INTO tb_auditoria_externa_formato (
        id_auditoria,
        formato,
        archivo
        )
        VALUES (
        '".$id_documento."',
        'formato025',
        '".$PDFNombre."'
        )";
        
        $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        return $PDFNombre;
        }else{
        return false;
        }

    }

    public function agregarArchivoAsea($id_documento,$comentario,$file_name,$file_tmp_name,$hoy){

        $upload_folder = "../../archivos/auditorias/ASEA-".$id_documento."-".strtotime($hoy).".pdf";
        
        if ($file_name != "") {
        $PDFNombre = "archivos/auditorias/ASEA-".$id_documento."-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre = ""; 
        }
        
        if(move_uploaded_file($file_tmp_name, $upload_folder)) {
        
        $sql = "INSERT INTO tb_auditoria_externa_asea (
        id_auditoria,
        archivo,
        comentario
        )
        VALUES (
        '".$id_documento."',
        '".$PDFNombre."',
        '".$comentario."'
        )";
 
        return$this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        
        }else{
        return false;
        }

    }


}