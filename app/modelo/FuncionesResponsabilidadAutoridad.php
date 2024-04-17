<?php 
class FuncionesResponsabilidadAutoridad
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

    public function agregarRepresentanteTecnico($id_estacion,$nombre_rt,$fecha_asignacion,$pdf_name,$pdf_tmp_name,$hoy){

        $ruta_file = "../../archivos/representante-tecnico/"."Formato-".strtotime($hoy).".pdf";

        if($pdf_name != "") {
        $ruta = "archivos/representante-tecnico/"."Formato-".strtotime($hoy).".pdf";
        }else{
        $ruta = "";
        }
        
        if(move_uploaded_file($pdf_tmp_name, $ruta_file)) {}
        
        $sql = "INSERT INTO tb_representante_tecnico (
        id_estacion,
        nom_representante,
        fecha,
        archivo
        )
        VALUES 
        (
        '".$id_estacion."',
        '".$nombre_rt."',
        '".$fecha_asignacion."',
        '".$ruta."'
        )";

        return $this->sqlQuery($sql);

    }

    public function eliminarRepresentanteTecnico($id){

        $sql = "DELETE FROM tb_representante_tecnico WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        
    }

}