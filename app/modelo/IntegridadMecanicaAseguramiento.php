<?php

class IntegridadMecanicaAseguramiento{

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

    public function agregarEquipoCritico($array,$hoy){
        $id_estacion = $array['id_estacion'];
        $numero_equipo = $this->numeroEquipo($id_estacion);
        $upload_folder = "../../archivos/manuales/MANUAL-EQUIPO-".$id_estacion.strtotime($hoy).".pdf";

        if ($array['file_name'] != "") {
        $ManualPDF = "archivos/manuales/MANUAL-EQUIPO-".$id_estacion.strtotime($hoy).".pdf";
        }else{
        $ManualPDF = ""; 
        }

        if(move_uploaded_file($array['file_tmp_name'], $upload_folder)) {

            $sql = "INSERT INTO tb_equipo_critico (
            id_estacion,
            id_equipo,
            nombre_equipo,
            marca_modelo,
            funciones,
            fecha_instalacion,
            tiempo_vida,
            manual,
            estado
            )
            VALUES (
            '".$id_estacion."',
            '".$numero_equipo."',
            '".$array['nombre_equipo']."',
            '".$array['marca_modelo']."',
            '".$array['funcion']."',
            '".$array['fecha_instalacion']."',
            '".$array['tiempo_vida']."',
            '".$ManualPDF."',
            1
            )";  
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

        }else{
        return false;
        }
           
    }

    private function numeroEquipo($id_estacion){
    $sql = "SELECT id_equipo FROM tb_equipo_critico WHERE id_estacion = '".$id_estacion."' ORDER BY id_equipo desc LIMIT 1";
    $result = mysqli_query($this->con, $sql);
    $numero = mysqli_num_rows($result);
    if ($numero == 0) {
    $numero_equipo = 1;
    }else{
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $numero_equipo = $row['id_equipo'] + 1;
    }
    return $numero_equipo;
    }

    public function actualizarBaja($id_equipo){

        $sql = "UPDATE tb_equipo_critico SET
        estado = 2
         WHERE id = '".$id_equipo."' ";
         return $this->sqlQuery($sql);
         $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarEquipoCritico($id_equipo){

        $sql = "UPDATE tb_equipo_critico SET
        estado = 3
        WHERE id = '".$id_equipo."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

}