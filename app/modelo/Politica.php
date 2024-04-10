<?php

class Politica{

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

    public function actualizarPolitica($id_estacion, $politica, $mision, $vision){

        $sql = "UPDATE tb_estaciones SET
        politica = '".$politica."',
        mision = '".$mision."',
        vision = '".$vision."'
        WHERE id= '".$id_estacion."' ";

        $result = $this->sqlQuery($sql);        
        return $result;
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarListaComprobacion($id_estacion,$id_usuario,$fecha,$r1,
    $r2,$r3,$r4,$r5,$r6,$r7,$asistentes,$comentarios){

        $id_comprobacion = $this->idListaComprobacion();

        $sql_lista = "INSERT INTO tb_politica_lista_comprobacion (
        id,
        id_estacion,
        id_usuario,
        fecha,
        asistentes,
        comentarios
        )
        VALUES (
        '".$id_comprobacion."',
        '".$id_estacion."',
        '".$id_usuario."',
        '".$fecha."',
        '".$asistentes."',
        '".$comentarios."'
        )";

        $sql_detalle = "INSERT INTO tb_politica_lista_comprobacion_detalle (id_lista_comprobacion,criterio,resultado) VALUES 
        ('".$id_comprobacion."','La política es adecuada a la naturaleza magnitud y actividades del proyecto','".$r1."'),
        ('".$id_comprobacion."','La política incluye la seguridad operativa','".$r2."'),
        ('".$id_comprobacion."','La política incluye la protección al medio ambiente','".$r3."'),
        ('".$id_comprobacion."','Los trabajadores, la alta dirección, los clientes y los subcontratistas tienen conocimiento de la política','".$r4."'),
        ('".$id_comprobacion."','La política se revisa periódicamente','".$r5."'),
        ('".$id_comprobacion."','La política se compromete al control de los peligros e impactos ambientales','".$r6."'),
        ('".$id_comprobacion."','La política considera la participación del personal','".$r7."')";
        
        $result_lista_comprobacion = $this->sqlQuery($sql_lista);
        if($result_lista_comprobacion){

            $result_detalle = $this->sqlQuery($sql_detalle);
            return $result_detalle;

        }else{
        return false;
        }
    
    $this->class_base_datos->desconectarBD($this->con);
    }

    private function idListaComprobacion(){

        $sql = "SELECT id FROM tb_politica_lista_comprobacion ORDER BY id desc LIMIT 1";
        $query = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($query);
        if ($numero == 0) {
        $id = 1;
        }else{
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $id = $row['id'] + 1;
        }
        return $id;
    }

    public function politicaListaComprobacion($id){
        $sql = "SELECT fecha, asistentes, comentarios FROM tb_politica_lista_comprobacion WHERE id = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function politicaListaComprobacionDetalle($id){
        $sql = "SELECT criterio, resultado FROM tb_politica_lista_comprobacion_detalle WHERE id_lista_comprobacion = '".$id."' ORDER BY id ASC ";
        $result = mysqli_query($this->con, $sql);
        return $result;
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function editarListaComprobacion($id,$fecha,$r1,$r2,$r3,$r4,$r5,$r6,$r7,$asistentes,$comentarios){

        $sql_insert_1 = "UPDATE tb_politica_lista_comprobacion_detalle SET resultado = '".$r1."' WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política es adecuada a la naturaleza magnitud y actividades del proyecto'";
        $sql_insert_2 = "UPDATE tb_politica_lista_comprobacion_detalle SET resultado = '".$r2."' WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política incluye la seguridad operativa' ";
        $sql_insert_3 = "UPDATE tb_politica_lista_comprobacion_detalle SET resultado = '".$r3."' WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política incluye la protección al medio ambiente' ";
        $sql_insert_4 = "UPDATE tb_politica_lista_comprobacion_detalle SET resultado = '".$r4."' WHERE id_lista_comprobacion = '".$id."' AND criterio = 'Los trabajadores, la alta dirección, los clientes y los subcontratistas tienen conocimiento de la política' ";
        $sql_insert_5 = "UPDATE tb_politica_lista_comprobacion_detalle SET resultado = '".$r5."' WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política se revisa periódicamente' ";
        $sql_insert_6 = "UPDATE tb_politica_lista_comprobacion_detalle SET resultado = '".$r6."' WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política se compromete al control de los peligros e impactos ambientales' ";
        $sql_insert_7 = "UPDATE tb_politica_lista_comprobacion_detalle SET resultado = '".$r7."' WHERE id_lista_comprobacion = '".$id."' AND criterio = 'La política considera la participación del personal' ";
        $sql_insert_8 = "UPDATE tb_politica_lista_comprobacion SET fecha = '".$fecha."', asistentes = '".$asistentes."', comentarios = '".$comentarios."' WHERE id = '".$id."' ";
    
        $result_1 = $this->sqlQuery($sql_insert_1);
        $result_2 = $this->sqlQuery($sql_insert_2);
        $result_3 = $this->sqlQuery($sql_insert_3);
        $result_4 = $this->sqlQuery($sql_insert_4);
        $result_5 = $this->sqlQuery($sql_insert_5);
        $result_6 = $this->sqlQuery($sql_insert_6);
        $result_7 = $this->sqlQuery($sql_insert_7);
        $result_8 = $this->sqlQuery($sql_insert_8);

        return $result_8;
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarListaComprobacion($id){

        $sql_delete_1 = "DELETE FROM tb_politica_lista_comprobacion_detalle WHERE id_lista_comprobacion = '".$id."'  ";
        $sql_delete_2 = "DELETE FROM tb_politica_lista_comprobacion WHERE id = '".$id."'  ";
        $result_1 = $this->sqlQuery($sql_delete_1);
        if($result_1){
            return $result_2 = $this->sqlQuery($sql_delete_2);    
        }else{
            return false;
        }
        
        $this->class_base_datos->desconectarBD($this->con);
    }

}