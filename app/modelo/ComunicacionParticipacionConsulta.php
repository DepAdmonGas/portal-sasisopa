<?php
class ComunicacionParticipacionConsulta
{
    
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

    public function listaComunicacion($id_estacion,$year){

        if($year == 0){
        $Query = " se_comunicacion_i_e.id_estacion = '".$id_estacion."' ORDER BY se_comunicacion_i_e.no_comunicacion desc ";
        }else{
        $Query = " se_comunicacion_i_e.id_estacion = '".$id_estacion."' AND YEAR(se_comunicacion_i_e.fecha) = '".$year."' ORDER BY se_comunicacion_i_e.no_comunicacion desc ";
        }
        $sql_comunicado = "SELECT 
        se_comunicacion_i_e.id,
        se_comunicacion_i_e.no_comunicacion,
        se_comunicacion_i_e.fecha,
        se_comunicacion_i_e.tema,
        se_comunicacion_i_e.tipo_comunicacion,
        se_comunicacion_i_e.material,
        se_comunicacion_i_e.seguimiento,
        se_comunicacion_i_e.asistencia,
        tb_usuarios.nombre
        FROM se_comunicacion_i_e 
        INNER JOIN tb_usuarios 
        ON se_comunicacion_i_e.encargado_comunicacion = tb_usuarios.id WHERE $Query ";
        $result_comunicado = mysqli_query($this->con, $sql_comunicado);
        return $result_comunicado;

    }

    public function agregarComunicacion($array){
    $no_comunicado = $this->id_comunicacion($array['id_estacion']);

    if($array['dirigido_a'] == ""){
        $dirigidoa = "";
    }else{
        $dirigidoa = implode(",", $array['dirigido_a']);
    }
    

    $sql = "INSERT INTO se_comunicacion_i_e (id_estacion,no_comunicacion,fecha,tema,detalle,encargado_comunicacion,tipo_comunicacion,material,seguimiento,dirigidoa,url,asistencia)
    VALUES (
    '".$array['id_estacion']."',
    '".$no_comunicado."',
    '".$array['fecha_del_dia']."',
    '".$array['tema_comunicar']."',
    '".$array['detalle']."',
    '".$array['id_usuario']."',
    '".$array['tipo_comunicacion']."',
    '".$array['material_comunicar']."',
    '".$array['seguimiento_comunicacion']."',
    '".$dirigidoa."','',0)";

    return $this->sqlQuery($sql);
    $this->class_base_datos->desconectarBD($this->con);

    }

    private function id_comunicacion($id_estacion){

        $sql = "SELECT no_comunicacion FROM se_comunicacion_i_e WHERE id_estacion = '".$id_estacion."' ORDER BY no_comunicacion desc LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
     
        if ($numero == 0) {
        $return = 1;
        }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $return = $row['no_comunicacion'] + 1;        
        }

        return $return;

    }

    public function temaComunicacion($id){

        $sql = "SELECT tema FROM se_comunicacion_i_e WHERE id = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $tema = $row['tema'];

        return $tema;

    }

    public function agregarEvidenciaComunicacion($id,$file_name,$file_tmp_name,$hoy){

       
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $ruta_file = "../../archivos/evidencias/"."EVIDENCIA-".$id."-".strtotime($hoy).".".$extension;
        
        $ruta_protocolo = "EVIDENCIA-".$id."-".strtotime($hoy).".".$extension;
        
        $allowTypes = array('jpg','png','jpeg','gif','PNG'); 
        
        if(in_array($extension, $allowTypes)){ 
      
        $compressedImage = $this->compressImage($file_tmp_name, $ruta_file, 50); 
        
        if($compressedImage){ 
                        
        $sql = "INSERT INTO se_comunicacion_evidencia (        
        id_comunicacion,
        archivo
        )
        VALUES 
        (
        '".$id."', 
        '".$ruta_protocolo."'
        )";
        
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
            
        }else{
            return false;             
        } 
        }else{
            return false;        
        }

    }

    private function compressImage($source, $destination, $quality) { 
        // Obtenemos la información de la imagen
        $imgInfo = getimagesize($source); 
        $mime = $imgInfo['mime']; 
         
        // Creamos una imagen
        switch($mime){ 
            case 'image/jpeg': 
                $image = imagecreatefromjpeg($source); 
                break; 
            case 'image/png': 
                $image = imagecreatefrompng($source); 
                break; 
            case 'image/gif': 
                $image = imagecreatefromgif($source); 
                break; 
            default: 
                $image = imagecreatefromjpeg($source); 
        } 
    
        //$rotate = imagerotate($image, 270, 0);
        $rotate = $image;
         
        // Guardamos la imagen
        imagejpeg($rotate, $destination, $quality); 
         
        // Devolvemos la imagen comprimida
        return $destination; 
    }

    public function eliminarEvidenciaComunicacion($id){

        $sql = "DELETE FROM se_comunicacion_evidencia WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarComunicacion($array){

        if($array['edit_dirigido_a'] == ""){
            $dirigidoa = "";
        }else{
            $dirigidoa = implode(",", $array['edit_dirigido_a']);
        }

        $sql = "UPDATE se_comunicacion_i_e SET
        fecha = '".$array['edit_fecha']."',
        tema = '".$array['edit_tema_comunicar']."',
        detalle = '".$array['edit_detalle']."',
        tipo_comunicacion = '".$array['edit_tipo_comunicacion']."',
        material = '".$array['edit_material_comunicar']."',
        seguimiento = '".$array['edit_seguimiento_comunicacion']."',
        dirigidoa = '".$dirigidoa."'
        WHERE id = '".$array['id']."' ";

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarComunicacion($id){
    
        $sql = "DELETE FROM se_comunicacion_i_e WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarQuejaSugerencia($array){
        
        $sql = "INSERT INTO se_quejas_sugerencias (
            id_estacion,
            fecha,
            nombre,
            motivos_causas,
            nombre_dirigido,
            contacto,
            nombre_puesto,
            consecuencias,
            solucion,
            plazo,
            confirmacion
            )
            VALUES 
            (
            '".$array['id_estacion']."', 
            '".$array['qs_fecha']."',
            '".$array['qs_nombre']."',
            '".$array['qs_motivo_causa']."',
            '".$array['qs_nombre_dirigido']."',
            '".$array['qs_contacto']."',
            '".$array['qs_nombre_puesto']."',
            '".$array['qs_efectos_consecuencias']."',
            '".$array['qs_solucion']."',
            '".$array['qs_plazo']."',
            '".$array['qs_confirmacion']."'
            )";

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }
    public function eliminarQuejaSugerencia($id){
        $sql = "DELETE FROM se_quejas_sugerencias WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

}