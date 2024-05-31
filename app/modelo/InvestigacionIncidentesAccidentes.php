<?php 

class InvestigacionIncidentesAccidentes{
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

    public function usuario($id){
        $sql_usuarios = "SELECT 
        tb_usuarios.id,
        tb_usuarios.nombre,
        tb_puestos.tipo_puesto
        FROM tb_usuarios
        INNER JOIN tb_puestos ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$id."' ";
        $result_usuarios = mysqli_query($this->con, $sql_usuarios);
        $numero_usuarios = mysqli_num_rows($result_usuarios);
        $row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC);
        $nombre = $row_usuarios['nombre'];
        $puesto = $row_usuarios['tipo_puesto'];
        $array = array("nombre" => $nombre, "puesto" => $puesto);
        return $array;
        }

    public function grupo($id){
        $sql_inv = "SELECT id_investigacion FROM tb_investigacion_incidente_accidente_grupo WHERE id_investigacion= '".$id."' ORDER BY id desc ";
        $result_inv = mysqli_query($this->con, $sql_inv);
        $numero_inv = mysqli_num_rows($result_inv);
        return $numero_inv;
    }

    public function formatos($id){
        $sql_archivo = "SELECT archivo FROM tb_investigacion_incidente_accidente_formato WHERE id_investigacion = '".$id."' ORDER BY id asc ";
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

    public function agregarIncidentesAccidentes($array){
        $id_registro = $this->idRegistro();

        if ($array['TipoAdd'] == 1) {

            $sql = "INSERT INTO tb_investigacion_incidente_accidente (
            id,
            id_estacion,
            fechacreacion,
            id_usuario,
            descripcion,
            tipo_evento,
            muertes,
            tercer_autorizado
            )
            VALUES (
            '".$id_registro."',
            '".$array['id_estacion']."',
            '".$array['Fecha']." ".$array['hora_dia']."',
            '".$array['id_usuario']."',
            '".$array['Descripcion']."',
            '".$array['TipoEvento']."',
            0,
            0
            )";
            return $this->sqlQuery($sql);
            
        }else if($array['TipoAdd'] == 2){

            $sql_iia = "INSERT INTO tb_investigacion_incidente_accidente (
            id,
            id_estacion,
            fechacreacion,
            id_usuario,
            descripcion,
            tipo_evento,
            muertes,
            tercer_autorizado
            )
            VALUES (
            '".$id_registro."',
            '".$array['id_estacion']."',
            '".$array['Fecha']." ".$array['hora_dia']."',
            '".$array['id_usuario']."',
            '".$array['Descripcion']."',
            '".$array['TipoEvento']."',
            0,
            '".$array['TercerA']."'
            )";
            
            if($this->sqlQuery($sql_iia)){

                $sql_iiata = "INSERT INTO tb_investigacion_incidente_accidente_tercerautorizado (
                    id_investigacion,
                    nombre,
                    numero,
                    lider,
                    fecha,
                    archivo
                    )
                    VALUES (
                    '".$id_registro."',
                    '".$array['NombreTA']."',
                    '".$array['NumeroA']."',
                    '".$array['NombreLI']."',
                    '',
                    ''
                    )";
            
            return $this->sqlQuery($sql_iiata);
            }else{
            return false;
            }
            
            
            }else if($array['TipoAdd'] == 3){

                $sql_iia = "INSERT INTO tb_investigacion_incidente_accidente (
                id,
                id_estacion,
                fechacreacion,
                id_usuario,
                descripcion,
                tipo_evento,
                muertes,
                tercer_autorizado
                )
                VALUES (
                '".$id_registro."',
                '".$array['id_estacion']."',
                '".$array['Fecha']." ".$array['hora_dia']."',
                '".$array['id_usuario']."',
                '".$array['Descripcion']."',
                '".$array['TipoEvento']."',
                '".$array['Muertes']."',
                '".$array['TercerA']."'
                )";

                if($this->sqlQuery($sql_iia)){

                    $sql_iiata = "INSERT INTO tb_investigacion_incidente_accidente_tercerautorizado (
                        id_investigacion,
                        nombre,
                        numero,
                        lider,
                        fecha,
                        archivo
                        )
                        VALUES (
                        '".$id_registro."',
                        '".$array['NombreTA']."',
                        '".$array['NumeroA']."',
                        '".$array['NombreLI']."',
                        '',
                        ''
                        )";
                    return $this->sqlQuery($sql_iiata);

                }else{
                return false;
                }
                
                }

        
        $this->class_base_datos->desconectarBD($this->con);
    }

    private function idRegistro(){
        $sql_id = "SELECT id FROM tb_investigacion_incidente_accidente ORDER BY id desc LIMIT 1";
        $result_id = mysqli_query($this->con, $sql_id);
        $numero_id = mysqli_num_rows($result_id);
        if ($numero_id == 0) {
        $id = 1;
        }else{
        $row_id = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
        $id = $row_id['id'] + 1;
        }
        return $id;
    }

    public function agregarGrupoInterdiciplinario($id,$nombre,$puesto,$especialidad){

        $sql = "INSERT INTO tb_investigacion_incidente_accidente_grupo (
            id_investigacion,
            nombre,
            puesto,
            especialidad
            )
            VALUES (
            '".$id."',
            '".$nombre."',
            '".$puesto."',
            '".$especialidad."'
            )";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarArchivoFormato26($id_documento,$file_name,$file_tmp_name,$hoy){

        $File  =   $_FILES['ArchivoPdf_file']['name'];
        $upload_folder = "../../archivos/incidentes-accidentes/F-I-D-".$id_documento."-".strtotime($hoy).".pdf";

        if ($file_name != "") {
        $PDFNombre = "archivos/incidentes-accidentes/F-I-D-".$id_documento."-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre = ""; 
        }

        if(move_uploaded_file($file_tmp_name, $upload_folder)) {

        $sql = "INSERT INTO tb_investigacion_incidente_accidente_formato (
        id_investigacion,
        archivo
        )
        VALUES (
        '".$id_documento."',
        '".$PDFNombre."'
        )";

        $this->sqlQuery($sql);
        return $PDFNombre;
        $this->class_base_datos->desconectarBD($this->con);       

        }else{
        return false;
        }
        
        }

    public function agregarArchivoTercerAutorizado($id_documento,$id_tercer,$file_name,$file_tmp_name,$fecha_del_dia,$hoy){

        $upload_folder = "../../archivos/incidentes-accidentes/I-T-A-".$id_tercer."-".strtotime($hoy).".pdf";

        if ($file_name != "") {
        $PDFNombre = "archivos/incidentes-accidentes/I-T-A-".$id_tercer."-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre = ""; 
        }

        if(move_uploaded_file($file_tmp_name, $upload_folder)) {

        $sql = "UPDATE tb_investigacion_incidente_accidente_tercerautorizado SET
        fecha = '".$fecha_del_dia."',
        archivo = '".$PDFNombre."'
        WHERE id = '".$id_tercer."' ";
        
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

        }else{
        return false;
        }

    }

    public function eliminarIncidentesAccidentes($id){

        $sql1 = "DELETE FROM tb_investigacion_incidente_accidente_formato WHERE id_investigacion = '".$id."' ";
        $sql2 = "DELETE FROM tb_investigacion_incidente_accidente_grupo WHERE id_investigacion = '".$id."' ";
        $sql3 = "DELETE FROM tb_investigacion_incidente_accidente_tercerautorizado WHERE id_investigacion = '".$id."' ";
        $sql4 = "DELETE FROM tb_investigacion_incidente_accidente WHERE id = '".$id."' ";
        if($this->sqlQuery($sql1)){
            if($this->sqlQuery($sql2)){
                if($this->sqlQuery($sql3)){
                    return $this->sqlQuery($sql4);
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
        return false;
        }

        $this->class_base_datos->desconectarBD($this->con);

    }

    public function actualizarSinAccidentes($id,$fecha){

        $sql = "UPDATE tb_investigacion_incidente_accidente_no SET
        fecha = '".$fecha."',
        estatus = 1
         WHERE id = '".$id."' ";
         return $this->sqlQuery($sql);
         $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarSinAccidentes($id){
        $sql = "DELETE FROM tb_investigacion_incidente_accidente_no WHERE id = '".$id."'  ";
        return $this->sqlQuery($sql);
         $this->class_base_datos->desconectarBD($this->con);

    }

    //--------------------------------------------------------

        public function puesto($idpuesto){
        $sqlID = "SELECT tipo_puesto FROM tb_puestos WHERE id = '".$idpuesto."' ";
        $resultID = mysqli_query($this->con, $sqlID);
        $rowID = mysqli_fetch_array($resultID, MYSQLI_ASSOC);
        $Puesto = $rowID['tipo_puesto'];
        return $Puesto;
        }

        public function estacion($idestacion){
            $sql = "SELECT * FROM tb_estaciones WHERE id = '".$idestacion."' ";
            $result = mysqli_query($this->con, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $Razonsocial = $row['razonsocial'];
            $Estado = $row['di_estado'];
            $Municipio = $row['di_municipio'];
            $Direccion = $row['direccioncompleta'];
            $array = array('Razonsocial' => $Razonsocial, 'Estado' => $Estado, 'Municipio' => $Municipio, 'Direccion' => $Direccion);
            return $array;
            }

    public function agregarSinAccidentes($id_estacion,$id_usuario){
        $ID = $this->idSinAccidentes();
        $sql = "INSERT INTO tb_investigacion_incidente_accidente_no (
            id,
            id_estacion,
            fecha,
            id_usuario,
            estatus
            
              )
              VALUES (
              '".$ID."',
              '".$id_estacion."',
              '',
              '".$id_usuario."',
              0
              )";
         $this->sqlQuery($sql);
         return $ID;
         $this->class_base_datos->desconectarBD($this->con);
   
    }

    private function idSinAccidentes(){

    $sqlID = "SELECT id FROM tb_investigacion_incidente_accidente_no ORDER BY id desc LIMIT 1";
    $resultID = mysqli_query($this->con, $sqlID);
    $numeroID = mysqli_num_rows($resultID);
 
    if ($numeroID == 0) {
    $ID = 1;
    }else{
    $rowID = mysqli_fetch_array($resultID, MYSQLI_ASSOC);
    $ID = $rowID['id'] + 1;
    }

    return $ID;

    }

}