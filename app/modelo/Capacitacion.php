<?php
class Capacitacion
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

    public function agregarCapacitacionExterna($id_estacion,$id_usuario,$curso,$fecha_curso,$duracion,$duracion_detalle,$instructor){

        $id_capacitacion_externa = $this->idCapacitacionExterna();

        $sql = "INSERT INTO tb_capacitacion_externa (
            id,
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
            '".$id_capacitacion_externa."',
            '".$id_estacion."',
            '".$id_usuario."',
            '".$curso."',
            '".$fecha_curso."',
            '".$duracion."',
            '".$duracion_detalle."',
            '".$instructor."',
            ''
            )";

            if($this->sqlQuery($sql)){
                $query_capacitacion_personal = $this->queryCapacitacionExternaPersonal($id_capacitacion_externa,$id_estacion);
                return $this->sqlQuery($query_capacitacion_personal);
            }else{
                return false;
            }
            $this->class_base_datos->desconectarBD($this->con);
    }

    private function idCapacitacionExterna(){
        $sql = "SELECT id FROM tb_capacitacion_externa ORDER BY id desc LIMIT 1 ";
        $result = mysqli_query($this->con, $sql);
        $count = mysqli_num_rows($result);
        if ($count == 0) {
        $id = 1;
        }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id = $row['id'] + 1;
        }

        return $id;
    }

    public function queryCapacitacionExternaPersonal($id_capacitacion_externa,$id_estacion){
        $cont = 1;
        $return = "";
        $return .= "INSERT INTO tb_capacitacion_externa_personal (id_capacitacion,id_empleado) VALUES";

        $sql_usuario = "SELECT id FROM tb_usuarios WHERE id_gas = '".$id_estacion."' AND estatus = 0 ";
        $result_usuario = mysqli_query($this->con, $sql_usuario);
        $numero_usuario = mysqli_num_rows($result_usuario);
        while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){

        if($numero_usuario > $cont){
        $separar = ",";
        }else{
        $separar = ";";  
        }

        $return .= "('".$id_capacitacion_externa."','".$row_usuario['id']."')".$separar;

        $cont++;
        }

        return $return;
    }

    public function editarCapacitacionExterna($id_curso,$curso,$fecha_curso,$duracion,$duracion_detalle,$instructor,$fecha_curso_real){

        $sql = "UPDATE tb_capacitacion_externa SET
        curso = '".$curso."',
        fecha_programada = '".$fecha_curso."',
        duracion = '".$duracion."',
        duraciondetalle = '".$duracion_detalle."',
        instructor = '".$instructor."',
        fecha_real = '".$fecha_curso_real."'
        WHERE id = '".$id_curso."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function validaPersonal($id_capacitacion,$id_usuario){

        $sql = "SELECT id FROM tb_capacitacion_externa_personal WHERE id_capacitacion = '".$id_capacitacion."' AND id_empleado = '".$id_usuario."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if($numero == 0){
            return 0;
        }else{
            return 1;
        }
    }

    public function agregarPersonalCapacitacion($id_capacitacion,$id_personal){

        $sql = "INSERT INTO tb_capacitacion_externa_personal (
            id_capacitacion,
            id_empleado
            )
            VALUES (
            '".$id_capacitacion."',
            '".$id_personal."'
            )";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function eliminarPersonalCapacitacionExterna($id){
        $sql = "DELETE FROM tb_capacitacion_externa_personal WHERE id = '".$id."'  ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function eliminarCapacitacionExterna($id){

        $sql = "DELETE FROM tb_capacitacion_externa_personal WHERE id_capacitacion = '".$id."' ";
        if($this->sqlQuery($sql)){
            $sql_1 = "DELETE FROM tb_capacitacion_externa WHERE id = '".$id."' ";
            return $this->sqlQuery($sql_1);
        }else{
            return false;
        }
        $this->class_base_datos->desconectarBD($this->con);
    }

}