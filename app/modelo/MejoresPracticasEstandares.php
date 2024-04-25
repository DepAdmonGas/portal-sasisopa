<?php
class MejoresPracticasEstandares
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

    public function agregarDisenoConstruccion($id_estacion,$codigo,$area){

        $sql = "INSERT INTO tb_diseno_construccion (
            valor1,
            valor2,
            estado
            )
            VALUES (
            '".$codigo."',
            '".$area."',
            '".$id_estacion."'
            )";
        
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarDisenoConstruccion($id_estacion,$id){

        $sql = "SELECT id FROM tb_diseno_construccion WHERE id = '".$id."' AND estado = '".$id_estacion."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        
        if ($numero > 0) {
        $sql_query = "DELETE FROM tb_diseno_construccion WHERE id = '".$id."' AND estado = '".$id_estacion."' ";
        return $this->sqlQuery($sql_query);
        }else{
        return false;
        }

        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarOperacionMantenimiento($id_estacion,$fecha,$norma,$nombre,$link){

        $sql = "INSERT INTO tb_operacion_mantenimiento (
            fecha,
            norma,
            nombre,
            link,
            estado
            )
            VALUES (
            '".$fecha."',
            '".$norma."',
            '".$nombre."',
            '".$_POST['Link']."',
            '".$id_estacion."'
            )";

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarOperacionMantenimiento($id_estacion,$id){

        $sql = "SELECT id FROM tb_operacion_mantenimiento WHERE id = '".$id."' AND estado = '".$id_estacion."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);

        if ($numero > 0) {
        $sql_query = "DELETE FROM tb_operacion_mantenimiento WHERE id = '".$id."' AND estado = '".$id_estacion."' ";
        return $this->sqlQuery($sql_query);
        }else{
        return false;
        }

        $this->class_base_datos->desconectarBD($this->con);

    }



}