<?php
class SeguridadContratistas{

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

    function formato12($id){
        $sql = "SELECT id FROM tb_requisicion_obra_formato_12 WHERE id_requisicion = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);        
        if ($numero == 0) {
        $img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
        }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $idFormato = $row['id'];
        $img ="<a onclick='DescargarARTP(".$idFormato.")'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
        }        
        return $img;        
        }

    public function formato14($id){
        $sql = "SELECT archivo FROM tb_requisicion_obra_formato_14 WHERE id_requisicion = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if ($numero == 0) {
        $img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
        }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $url = $row['archivo'];
        $img ="<a target='BLANK' href='".SERVIDOR.$url."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
        }
        return $img;
        }

        function formato15($id){
            $sql = "SELECT id FROM tb_requisicion_obra_formato_15 WHERE id_requisicion = '".$id."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            if ($numero == 0) {
            $img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
            }else{
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $idFormato = $row['id'];
            $img ="<a onclick='DescargarLV(".$idFormato.")'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
            }            
            return $img;            
        }

        public function cartaResponsiva($id){
            $sql = "SELECT id FROM tb_requisicion_obra_carta_responsiva WHERE id_requisicion = '".$id."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            if ($numero == 0) {
            $img = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
            }else{
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $id = $row['id'];
            $img ="<a onclick='DescargarCR(".$id.")'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
            }            
            return $img;            
        }

        public function agregarRequisicionObraServicio($id_estacion,$id_usuario,$descripcion,$justificacion,$fecha,$hora_del_dia){
            $numero_folio = $this->numeroFolio($id_estacion);
            $sql = "INSERT INTO tb_requisicion_obra (id_estacion,id_usuario,no_folio,fecha,descripcion,justificacion,estado)
            VALUES (
            '".$id_estacion."',
            '".$id_usuario."',
            '".$numero_folio."',
            '".$fecha." ".$hora_del_dia."',
            '".$descripcion."',
            '".$justificacion."',
            1)";

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

        }

        public function numeroFolio($id_estacion){

            $sql = "SELECT no_folio FROM tb_requisicion_obra WHERE id_estacion = '".$id_estacion."' ORDER BY no_folio desc LIMIT 1 ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            if ($numero == 0) {
            $numero_folio = 1;
            }else{
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $folio = $row['no_folio'] + 1;
            $numero_folio = $folio;
            } 
            
            return $numero_folio;
        }

        public function editarRequisicionObraServicio($id,$fecha,$descripcion,$justificacion){

            $sql = "UPDATE tb_requisicion_obra SET
            fecha = '".$fecha.' '.$hora_del_dia."',
            descripcion = '".$descripcion."',
            justificacion = '".$justificacion."'
            WHERE id = '".$id."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

        }

        public function eliminarSeguridadContratistas($id){
            $sql = "DELETE FROM tb_requisicion_obra WHERE id = '".$id."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
        }

        public function agregarFormato14($id,$file_name,$file_tmp_name,$hoy){

            $upload_folder = "../../archivos/seguridad-contratistas/Fo.ADMONGAS.014-".strtotime($hoy).".pdf";
            
            if ($file_name != "") {
            $archivo = "archivos/seguridad-contratistas/Fo.ADMONGAS.014-".strtotime($hoy).".pdf";
            }else{
            $archivo = ""; 
            }
            
            if(move_uploaded_file($file_tmp_name, $upload_folder)) {}
            
            if ($file_name != "") {
            
            $sql = "DELETE FROM tb_requisicion_obra_formato_14 
            WHERE id_requisicion = '".$id."' ";
            
            if($this->sqlQuery($sql)){
                $sql_insert = "INSERT INTO tb_requisicion_obra_formato_14 (
                    id_requisicion,
                    archivo
                    )
                    VALUES (
                    '".$id."',
                    '".$archivo."'
                    )";
                return $this->sqlQuery($sql_insert);
            }else{
                return false;
            }
            $this->class_base_datos->desconectarBD($this->con);
          }
        }

    public function validarCartaResponsiva($id,$municipio,$estado,$apoderado_legal,$razon_social,$direccion,$firma_apoderado_legal){

        $sql = "SELECT id FROM tb_requisicion_obra_carta_responsiva WHERE id_requisicion = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if($numero == 0){

        $sql = "INSERT INTO tb_requisicion_obra_carta_responsiva (
        id_requisicion,
        archivo,
        dia,
        mes,
        year,
        municipio,
        estado,
        representante_legal,
        razon_social,
        domicilio,
        apoderado_legal,
        firma
        )
        VALUES (
        '".$id."',
        '',
        '".date("d")."',
        '".nombremes(date("m"))."',
        '".date("Y")."',
        '".$municipio."',
        '".$estado."',
        '".$apoderado_legal."',
        '".$razon_social."',
        '".$direccion."',
        '".$apoderado_legal."',
        '".$firma_apoderado_legal."'
        )";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        }
    }

    public function editarCartaResponsiva($array){

        $sql = "UPDATE tb_requisicion_obra_carta_responsiva SET
        dia = '".$array['dia']."',
        mes = '".$array['mes']."',
        year = '".$array['year']."',
        municipio = '".$array['municipio']."',
        estado = '".$array['estado']."',
        representante_legal = '".$array['representante_legal']."',
        razon_social = '".$array['razon_social']."',
        domicilio = '".$array['domicilio']."',
        apoderado_legal = '".$array['apoderado_legal']."'
        WHERE id = '".$array['id']."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarListaVerificacion($array){

        $sql = "DELETE FROM tb_requisicion_obra_formato_15 WHERE id_requisicion = '".$array['id']."' ";
        if($this->sqlQuery($sql)){

            $sql_insert = "INSERT INTO tb_requisicion_obra_formato_15 (
                id_requisicion,
                archivo,
                fecha_lv,
                hora_lv,
                id_usuario,
                pregunta1,
                pregunta2,
                pregunta3,
                pregunta4,
                pregunta5
                )
                VALUES 
                (
                '".$array['id']."', 
                '',
                '".$array['fecha']."',
                '".$array['hora']."',
                '".$array['id_supervisor']."',
                '".$array['r1']."',
                '".$array['r2']."',
                '".$array['r3']."',
                '".$array['r4']."',
                '".$array['r5']."'
                )";
                return $this->sqlQuery($sql_insert);
                $this->class_base_datos->desconectarBD($this->con);

        }else{
            return false;
        }

    }

    public function validarRequisicionObra($id,$municipio,$estado){
        $numero_folio = $this->folioRequisicionObra();

        $sql = "SELECT id FROM tb_requisicion_obra_formato_12 WHERE id_requisicion = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if($numero == 0){

        $sql_insert = "INSERT INTO tb_requisicion_obra_formato_12 (
        id,
        id_requisicion,
        archivo,
        dia,
        mes,
        year,
        municipio,
        estado,
        trabajo_realizar,
        descripcion,
        area,
        fecha_inicio,
        fecha_termino,
        hora_inicio,
        hora_termino,
        prestador_servicio,
        cprtp,
        cteppc,
        nombre_empresa,
        nombre_responsable
        )
        VALUES (
        '".$numero_folio."',
        '".$id."',
        '',
        '".date("d")."',
        '".nombremes(date("m"))."',
        '".date("Y")."',

        '".$municipio."',
        '".$estado."',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        ''
        )";
        $this->sqlQuery($sql_insert);

        $sql_insert1 = "INSERT INTO tb_requisicion_obra_formato_12_procedimiento (
        id_requisicion,
        detalle,
        valor
        )
        VALUES 
        ('".$numero_folio."','Trabajos en alturas',0), 
        ('".$numero_folio."','Trabajos en áreas confinadas',0),
        ('".$numero_folio."','Trabajos que generen fuentes de ignición',0),
        ('".$numero_folio."','Etiquetado, bloqueo y candadeo de líneas eléctricas',0),
        ('".$numero_folio."','Etiquetado, bloqueo y candadeo de líneas de productos',0)";
        return $this->sqlQuery($sql_insert1);
        $this->class_base_datos->desconectarBD($this->con);

        }else{
        return false;
        }
    }

    public function folioRequisicionObra(){

        $sql_folio = "SELECT id FROM tb_requisicion_obra_formato_12 ORDER BY id desc LIMIT 1 ";
        $result_folio = mysqli_query($this->con, $sql_folio);
        $numero_folio = mysqli_num_rows($result_folio);        
        if ($numero_folio == 0) {
        $NumFolio = 1;
        }else{
        $row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC);
        $folio = $row_folio['id'] + 1;
        $NumFolio = $folio;
        }
        return $NumFolio;
    }

    public function editarFormato12($id,$valor,$dato,$nombre_t,$puesto,$categoria,$numero_seguro){

        if ($dato == 1) {

            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            municipio = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 2) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            estado = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 3) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            dia = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 4) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            mes = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 5) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            year = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 6) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            trabajo_realizar = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 7) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            descripcion = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 8) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            area = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 9) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            fecha_inicio = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 10) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            fecha_termino = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 11) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            hora_inicio = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 12) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            hora_termino = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 13) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            prestador_servicio = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 14) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12_procedimiento SET
            valor = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 15) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            cprtp = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 16) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            cteppc = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 17) {
            
            $sql = "INSERT INTO tb_requisicion_obra_formato_12_trabajador_encargado (
            id_requisicion,
            id_personal,
            nombre,
            puesto,
            no_seguro,
            categoria
            )
            VALUES (
            '".$id."',
            '".$valor."',
            
            '".$nombre_t."',
            '".$puesto."',
            '".$numero_seguro."',
            
            '".$categoria."'
            )";
            
            
            }else if ($dato == 18) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            nombre_empresa = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 19) {
            
            $sql = "UPDATE tb_requisicion_obra_formato_12 SET
            nombre_responsable = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if ($dato == 20) {
            
            $sql = "DELETE FROM tb_requisicion_obra_formato_12_trabajador_encargado WHERE id = '".$id."' ";
            
            }

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

}
