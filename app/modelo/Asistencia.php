<?php 
class Asistencia
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

    public function listaAsistencia($id_estacion,$id_sasisopa){
        $sql = "SELECT id, fecha, hora, estado FROM tb_lista_asistencia WHERE id_estacion = '".$id_estacion."' AND punto_sasisopa = '".$id_sasisopa."' ORDER BY fecha DESC";
        $result = mysqli_query($this->con, $sql);
        return $result;
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function agregarAsistencia($id_estacion,$id_usuario,$punto_sasisopa,$herramiento){

        if($herramiento == 2){
            $sql = "SELECT
            sgm_autorizado.id_usuario,
            sgm_autorizado.estado,
            tb_usuarios.id_gas
            FROM sgm_autorizado 
            INNER JOIN tb_usuarios 
            ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$id_estacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            if ($numero > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $realizadopor = $row['id_usuario'];
            }else{
            $realizadopor = 0;
            }
            }else{
            $realizadopor = 0;	
            }

        $id_asistencia = $this->idAsistencia();

        $sql = "INSERT INTO tb_lista_asistencia (
            id, id_estacion, id_usuario, punto_sasisopa, fecha, hora, lugar, tema, finalidad, encargado,realizadopor,estado
            )
            VALUES (
            '".$id_asistencia."',
            '".$id_estacion."',
            '".$id_usuario."',
            '".$punto_sasisopa."',
            '',
            '',
            '',
            '',
            '',
            '',
            '".$realizadopor."',
            0
            )";

        $valida_query = $this->sqlQuery($sql);
        if($valida_query){
            return $id_asistencia;
        }else{
            return 0;
        }
        
        $this->class_base_datos->desconectarBD($this->con);

    }

    private function idAsistencia(){

        $sql = "SELECT id FROM tb_lista_asistencia ORDER BY id desc LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if ($numero == 0) {
        $id = 1;
        }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id = $row['id'] + 1;        
        }
        return $id;

    }

    public function eliminarAsistencia($id){

        $sql_1 = "DELETE FROM tb_lista_asistencia_detalle WHERE id_lista_asistencia = '".$id."'  ";
        $sql_2 = "DELETE FROM tb_lista_asistencia WHERE id = '".$id."'  ";
        $sql_3 = "DELETE FROM se_comunicacion_i_e WHERE asistencia = '".$id."'  ";

        $valida_1 = $this->sqlQuery($sql_1);
        if($valida_1){
            $valida_2 = $this->sqlQuery($sql_2);

            if($valida_2){

                return $valida_3 = $this->sqlQuery($sql_3);

            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function detalleAsistencia($id){
        $sql = "SELECT fecha, hora, lugar, tema, finalidad, encargado, estado, punto_sasisopa, realizadopor FROM tb_lista_asistencia WHERE id = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function detalleComunicacion($id){
        $sql = "SELECT tipo_comunicacion, material FROM se_comunicacion_i_e WHERE asistencia = '".$id."' ";
        $result = mysqli_query($this->con, $sql);        
        $numero = mysqli_num_rows($result);

        if($numero == 1){
            $array = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $row = array('numero_comunicacion' => 1, 'tipo_comunicacion' => $array['tipo_comunicacion'], 'material' => $array['material']);
        }else{
            $row = array('numero_comunicacion' => 0, 'tipo_comunicacion' => '', 'material' => '');
        }
        
        return $row;
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function listaAsistenciaDetalle($id){
        $sql = "SELECT id, usuario, puesto FROM tb_lista_asistencia_detalle WHERE id_lista_asistencia = '".$id."'";
        $result = mysqli_query($this->con, $sql);
        return $result;
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function BuscarFirma($usuario){
        $Firma = "";
        $sql = "SELECT firma FROM tb_usuarios WHERE nombre like '".$usuario."' AND estatus = 0 ORDER BY id DESC LIMIT 1 ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $Firma = $row['firma']; 
        return $Firma;
        }
        //-------------------------------------------------------------------------------------------------

    public function actualizarListaAsistencia($id_estacion,$id_registro,$fecha,$hora,$lugar,$nombre_encargado,$tema,$finalidad,$estado){

        $id_usuario = $this->idUsuario($nombre_encargado);

        $sql = "UPDATE tb_lista_asistencia SET
        fecha = '".$fecha."', 
        hora  = '".$hora."', 
        lugar  = '".$lugar."', 
        tema  = '".$tema."', 
        finalidad  = '".$finalidad."', 
        encargado  = '".$nombre_encargado."',
        estado = 1
        WHERE id = '".$id_registro."' ";

        $val_1 = $this->sqlQuery($sql);

        if($val_1){

            if($estado == 0){

            $idComunicacion = $this->idComunicacion($id_estacion);

            $sql_insert_1 = "INSERT INTO se_comunicacion_i_e (id_estacion,no_comunicacion,fecha,tema,detalle,encargado_comunicacion,tipo_comunicacion,material,seguimiento,dirigidoa,url,asistencia)
            VALUES (
            '".$id_estacion."',
            '".$idComunicacion."',
            '".$fecha."',
            '".$tema."',
            '".$finalidad."',
            '".$id_usuario."',
            'Interna',
            'Minutas y actas de reuniones',
            '',
            '6,7,9,10,11',
            '',
            '".$id_registro."')";

            $val_2 = $this->sqlQuery($sql_insert_1);

            return $val_2;

            }

            return $val_1;
        }else{
            return $val_1;
        }


    }

    public function idUsuario($nombre){
        $sql = "SELECT id FROM tb_usuarios WHERE nombre = '".$nombre."' ";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id = $row['id'];
        return $id;
    }

    public function idComunicacion($id_estacion){

        $sql = "SELECT no_comunicacion FROM se_comunicacion_i_e WHERE id_estacion = '".$id_estacion."' ORDER BY no_comunicacion desc LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
     
        if ($numero == 0) {
        $noComunicacion = 1;
        }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $noComunicacion = $row['no_comunicacion'] + 1;
        }
        
        return $noComunicacion;

    }

    public function agregarAsistenciaFirma($id_registro,$personal_firma){

        $cadena = implode(",", $personal_firma);
        $array = explode(",", $cadena);

        for ($i=0; $i < count($array) ; $i++) { 
        $nombreUsuario = $this->nombreUsuario($array[$i]);
    
        $sql_insert = "INSERT INTO tb_lista_asistencia_detalle (
        id_lista_asistencia,
        usuario,
        puesto,
        firma
        )
        VALUES 
        (
        '".$id_registro."',
        '".$nombreUsuario['nombre']."',
        '".$nombreUsuario['tipo_puesto']."',
        ''
        )";

        $val = $this->sqlQuery($sql_insert);
  
        }

        return true;

    }

    public function nombreUsuario($id){

        $sql = "SELECT
        tb_usuarios.nombre,
        tb_puestos.tipo_puesto
        FROM tb_usuarios
        INNER JOIN tb_puestos
        ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

    public function eliminarAsistenciaFirma($id){
        $sql = "DELETE FROM tb_lista_asistencia_detalle WHERE id = '".$id."'  ";
        $val = $this->sqlQuery($sql);
        return $val;
    }

    public function validaUsuario($idReporte,$personal){
        $sql = "SELECT id FROM tb_lista_asistencia_detalle WHERE id_lista_asistencia = '".$idReporte."' AND usuario = '".$personal."' ";
        $result = mysqli_query($this->con, $sql);
        return $numero = mysqli_num_rows($result);
        }
    

}

