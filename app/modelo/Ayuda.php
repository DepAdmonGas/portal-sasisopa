<?php

class Ayuda
{

    private $class_base_datos;
	private $con;

    function __construct()
	{
        $this->class_base_datos = new ConexionBD();
		$this->con = $this->class_base_datos->conectarBD();
    }

    public function sasisopaAyuda($id_usuario, $detalle){

        $sql = "SELECT id,estado FROM pu_sasisopa_ayuda WHERE id_usuario = '".$id_usuario."' and detalle = '".$detalle."' and estado = 0 LIMIT 1";
        $query = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($query);

        if ($numero == 1) {

            $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $result = $row;

        }else{
            $result = array('id' => 0, 'estado' => 0);
        }

        return $result;

        $this->class_base_datos->desconectarBD($this->con);
    }

    public function actualizarAyuda($id_ayuda){

        $sql = "UPDATE pu_sasisopa_ayuda SET
        estado = 1
        WHERE id = '".$id_ayuda."' ";
        if(mysqli_query($this->con, $sql)){
            return true;
        }else{
            return false;
        }

        $this->class_base_datos->desconectarBD($this->con);

    }

}