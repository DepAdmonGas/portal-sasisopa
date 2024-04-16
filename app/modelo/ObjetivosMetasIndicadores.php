<?php
class ObjetivosMetasIndicadores
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

        public function folioSeguridadObjetivosMetas(){

            $sql_folio = "SELECT id FROM tb_seguimiento_objetivos_metas ORDER BY id desc LIMIT 1 ";
            $result_folio = mysqli_query($this->con, $sql_folio);
            $numero_folio = mysqli_num_rows($result_folio);
            
            if ($numero_folio == 0) {
            $NumFolio = 1;
            }else{
            $row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC);
            $NumFolio = $row_folio['id'] + 1;
            }

            return $NumFolio;
        }

    public function agregarSeguimientoObjetivosMetas($id_estacion,$id_usuario,$array){

        $folio = $this->folioSeguridadObjetivosMetas();

        $sql = "INSERT INTO tb_seguimiento_objetivos_metas (
            id,
            id_estacion,
            id_usuario
            )
            VALUES 
            (
            '".$folio."',
            '".$id_estacion."', 
            '".$id_usuario."'
            )";

            $sql_2 = "INSERT INTO tb_seguimiento_objetivos_metas_detalle (
                id_seguimiento,
                fecha,
                objetivo_meta,
                nivel_cumplimiento,
                medidas,
                fecha_aplicacion
                )
                VALUES 
                ('".$folio."','".$array['Dato1']."','Satisfacción del cliente','".$array['Dato2']."','".$array['Dato3']."','".$array['Dato4']."'),
                ('".$folio."','".$array['Dato5']."','Mantenimiento','".$array['Dato6']."','".$array['Dato7']."','".$array['Dato8']."'),
                ('".$folio."','".$array['Dato9']."','Capacitación','".$array['Dato10']."','".$array['Dato11']."','".$array['Dato12']."'),
                ('".$folio."','".$array['Dato13']."','Quejas y sugerencias','".$array['Dato14']."','".$array['Dato15']."','".$array['Dato16']."'),
                ('".$folio."','".$array['Dato17']."','Cumplimiento de legislación','".$array['Dato18']."','".$array['Dato19']."','".$array['Dato20']."')";

            $valida = $this->sqlQuery($sql);
            if($valida){
                return $this->sqlQuery($sql_2);
            }else{
                return false;
            }

            $this->class_base_datos->desconectarBD($this->con);
    }

    public function editarSeguimientoObjetivoMetas($idSeguimiento,$opcion,$detalle){

        if($opcion == 1){

        $sql = "UPDATE tb_seguimiento_objetivos_metas_detalle SET
        fecha = '".$detalle."'
        WHERE id = '".$idSeguimiento."' ";
                      
        }else if($opcion == 2){
            
        $sql = "UPDATE tb_seguimiento_objetivos_metas_detalle SET
        medidas = '".$detalle."'
        WHERE id = '".$idSeguimiento."' ";
                
        }else if($opcion == 3){
            
        $sql = "UPDATE tb_seguimiento_objetivos_metas_detalle SET
        nivel_cumplimiento = '".$detalle."'
        WHERE id = '".$idSeguimiento."' ";
                     
        }else if($opcion == 4){
            
        $sql = "UPDATE tb_seguimiento_objetivos_metas_detalle SET
        fecha_aplicacion = '".$detalle."'
        WHERE id = '".$idSeguimiento."' ";
                        
        }

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarObjetivoMetasIndicadores($seccion,$id){

        if($seccion == 1){

            $sql1 = "DELETE FROM tb_seguimiento_objetivos_metas_detalle WHERE id_seguimiento = '".$id."' ";
            $val1 = $this->sqlQuery($sql1);
            if($val1){
                $sql2 = "DELETE FROM tb_seguimiento_objetivos_metas WHERE id = '".$id."' ";
                return $this->sqlQuery($sql2);
            }else{
                return false;
            }     

            }else if($seccion == 2){            
            $sql1 = "DELETE FROM tb_seguimiento_reporte_indicador WHERE id = '".$id."' ";
            return $this->sqlQuery($sql1);            
            }

            $this->class_base_datos->desconectarBD($this->con);
    }

    public function agregarSeguimientoReporteIndicador($id_estacion,$id_usuario,$fecha,$capacitacion,$experiencia_c,$ventas,$medidas_c,$fecha_aplicacion){

        $sql_insert = "INSERT INTO tb_seguimiento_reporte_indicador (
            id_estacion,
            id_usuario,
            fecha,
            capacitacion,
            exp_cliente,
            ventas,
            medidas_correctivas,
            fecha_aplicacion
            )
            VALUES 
            (
            '".$id_estacion."', 
            '".$id_usuario."',
            '".$fecha."',
            '".$capacitacion."',
            '".$experiencia_c."',
            '".$ventas."',
            '".$medidas_c."',
            '".$fecha_aplicacion."'            
            )";

            return $this->sqlQuery($sql_insert);
            $this->class_base_datos->desconectarBD($this->con);
    }

    public function editarSeguimientoReporteIndicador($id_seguimiento,$fecha,$capacitacion,$experiencia_c,$ventas,$medidas_c,$fecha_aplicacion){

        $sql = "UPDATE tb_seguimiento_reporte_indicador SET
        fecha = '".$fecha."',
        capacitacion = '".$capacitacion."',
        exp_cliente = '".$experiencia_c."',
        ventas = '".$ventas."',
        medidas_correctivas = '".$medidas_c."',
        fecha_aplicacion = '".$fecha_aplicacion."'
         WHERE id = '".$id_seguimiento."' ";

         return $this->sqlQuery($sql);
         $this->class_base_datos->desconectarBD($this->con);

    }

    public function TotalPersonal($IDEstacion){
        $sql = "SELECT * FROM tb_usuarios WHERE id_gas = '".$IDEstacion."' AND (id_puesto = 6 OR id_puesto = 7 OR id_puesto = 9 OR id_puesto = 10 OR id_puesto = 11) AND estatus = 0 ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        return $numero;
        }

        public function TotalCapacitacionPersonal($IDEstacion,$Year){
            $Total = 0;
            $sql = "SELECT id FROM tb_capacitacion_externa WHERE id_estacion = '".$IDEstacion."' AND YEAR(fechacreacion) = '".$Year."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            
            if($numero == 0){
            $Resultado = 0;
            }else{
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            
            $sqlCP = "SELECT id FROM tb_capacitacion_externa_personal WHERE id_capacitacion = '".$row['id']."' ";
            $resultCP = mysqli_query($this->con, $sqlCP);
            $numeroCP = mysqli_num_rows($resultCP);
            
            $Total = $Total + $numeroCP;
            }	
            
            $Resultado = ceil($Total / $numero);
            
            }
            
            return $Resultado;
            }

            public function TotalCapacitacion($IDEstacion,$Year){
                $sql = "SELECT * FROM tb_capacitacion_externa WHERE id_estacion = '".$IDEstacion."' AND YEAR(fechacreacion) = '".$Year."' ";
                $result = mysqli_query($this->con, $sql);
                $numero = mysqli_num_rows($result);
                return $numero;
                }

                function Encuestados($IdReporte){
                    $sql_encuesta = "SELECT id FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$IdReporte."'";
                    $result_encuesta = mysqli_query($this->con, $sql_encuesta);
                    $numero_encuesta = mysqli_num_rows($result_encuesta);
                    return $numero_encuesta;
                    }

                    function Total($IdReporte){

                        $resultado4 = 0;
                        $resultado3 = 0;
                        $resultado2 = 0;
                        $resultado1 = 0;

                        $sql_encuesta = "SELECT id FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$IdReporte."' ";
                        $result_encuesta = mysqli_query($this->con, $sql_encuesta);
                        $numero_encuesta = mysqli_num_rows($result_encuesta);
                        while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){
                        
                        $IdCliente = $row_encuesta['id'];
                        
                        $sql_encuestaP = "SELECT resultado FROM tb_encuentas_estacion_cliente_preguntas WHERE id_cliente = '".$IdCliente."' ORDER BY resultado desc";
                        $result_encuestaP = mysqli_query($this->con, $sql_encuestaP);
                        $numero_encuestaP = mysqli_num_rows($result_encuestaP);
                        while($row_encuestaP = mysqli_fetch_array($result_encuestaP, MYSQLI_ASSOC)){
                        
                        if($row_encuestaP['resultado'] == 4){
                        $resultado4 = $resultado4 + 1;
                        }else if($row_encuestaP['resultado'] == 3){
                        $resultado3 = $resultado3 + 1;
                        }else if($row_encuestaP['resultado'] == 2){
                        $resultado2 = $resultado2 + 1;
                        }else if($row_encuestaP['resultado'] == 1){
                        $resultado1 = $resultado1 + 1;
                        }
                        
                        } 
                        }
                        
                        $ResultArray = array(
                        "resultado1" => $resultado1,
                        "resultado2" => $resultado2,
                        "resultado3" => $resultado3,
                        "resultado4" => $resultado4,
                        );
                        
                        return $ResultArray;
                        $this->class_base_datos->desconectarBD($this->con);
                    
                    }

                        public function eliminarEncuestaEstacion($id_reporte){

                            $sql_encuesta = "SELECT id FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$id_reporte."' ";
                            $result_encuesta = mysqli_query($this->con, $sql_encuesta);
                            $row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC);
                            $idcliente = $row_encuesta['id'];
                            
                            $sql_1 = "DELETE FROM tb_encuentas_estacion_cliente_comentarios WHERE id_cliente = '".$idcliente."'  ";
                            $sql_2 = "DELETE FROM tb_encuentas_estacion_cliente_preguntas WHERE id_cliente = '".$idcliente."'  ";                           
                            $sql_3 = "DELETE FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$id_reporte."'  ";
                            $sql_4 = "DELETE FROM tb_encuentas_estacion WHERE id = '".$id_reporte."'  ";

                            $val_1 = $this->sqlQuery($sql_1);

                            if($val_1){
                                $val_2 = $this->sqlQuery($sql_2);
                                if($val_2){
                                    $val_3 = $this->sqlQuery($sql_3);                                    
                                    if($val_3){
                                        return $val_4 = $this->sqlQuery($sql_4);                                        
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

    //------------------ AGREGAR EXPERIENCIA CLIENTE -------------------------
    //------------------------------------------------------------------------

    public function idEncuestas($id_estacion,$id_usuario){
        $sql_encuesta = "SELECT id FROM tb_encuentas_estacion WHERE id_estacion = '".$id_estacion."' AND estado = 0 ORDER BY id DESC LIMIT 1";
        $result_encuesta = mysqli_query($this->con, $sql_encuesta);
        $numero_encuesta = mysqli_num_rows($result_encuesta);
        if ($numero_encuesta == 0) {
        $result = $this->crearEscuesta($id_estacion,$id_usuario);
        }else{
        $row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC);
        $result = $row_encuesta['id'];
        }
        return $result;
        $this->class_base_datos->desconectarBD($this->con);
        }

        public function crearEscuesta($id_estacion,$id_usuario){
            $sql_encuesta = "SELECT id, estado FROM tb_encuestas WHERE estado = 1 ";
            $result_encuesta = mysqli_query($this->con, $sql_encuesta);
            $row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC);
            $idencuesta = $row_encuesta['id'];
            
            $sql_insert = "INSERT INTO tb_encuentas_estacion (id_estacion,id_usuario,id_encuesta,estado)
            VALUES (
            '".$id_estacion."',
            '".$id_usuario."',
            '".$idencuesta."',
            0)";

            $this->sqlQuery($sql_insert);

            $sql_encuestaID = "SELECT id FROM tb_encuentas_estacion WHERE id_estacion = '".$id_estacion."' AND estado = 0 ORDER BY id DESC LIMIT 1";
            $result_encuestaID = mysqli_query($this->con, $sql_encuestaID);
            $row_encuestaID = mysqli_fetch_array($result_encuestaID, MYSQLI_ASSOC);
            $result = $row_encuestaID['id'];
            return $result;
            $this->class_base_datos->desconectarBD($this->con);
            }

    public function agregarUsuarioEncuestas($id_reporte,$nombre,$hoy){

        $IdUsuario = strtotime($hoy);

        $sql_insert = "INSERT INTO tb_encuentas_estacion_cliente (
        id, id_cuentas_estacion, nombre)
        VALUES (
        '".$IdUsuario."',
        '".$id_reporte."',
        '".$nombre."'
        )";
        $this->sqlQuery($sql_insert);

        return $IdUsuario;
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarUsuarioEncuestasResultado($id_usuario,$id_pregunta,$respuesta){

        $sql_insert = "INSERT INTO tb_encuentas_estacion_cliente_preguntas (
            id_cliente,id_pregunta,resultado)
            VALUES (
              '".$id_usuario."',
              '".$id_pregunta."',
              '".$respuesta."'
            )";

        return $this->sqlQuery($sql_insert);
        $this->class_base_datos->desconectarBD($this->con);
    
    }

    public function agregarUsuarioEncuestasComentario($id_usuario,$comentario){

        $sql_insert = "INSERT INTO tb_encuentas_estacion_cliente_comentarios (
            id_cliente,comentario)
            VALUES (
              '".$id_usuario."',
              '".$comentario."'
            )";

            return $this->sqlQuery($sql_insert);
            $this->class_base_datos->desconectarBD($this->con);

    }

    public function actualizarEncuestasEstacion($id_reporte,$fecha,$hora_del_dia){

        $FechaCompleta = $fecha.' '.$hora_del_dia;

        $sql = "UPDATE tb_encuentas_estacion SET
        fechacreacion = '".$FechaCompleta."',
        estado = 1
         WHERE id = '".$id_reporte."' ";
        
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    //---------------------- INDICADORES DE VENTAS -------------------------
    //------------------------------------------------------------------------

    function BuscaVentas($mes,$fecha_year,$producto_uno,$producto_dos,$producto_tres,$id_estacion){
        $sql_reportecre = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$id_estacion."' AND mes = '".$mes."' AND year = '".$fecha_year."' ORDER BY mes asc ";
      $result_reportecre = mysqli_query($this->con, $sql_reportecre);
      while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
      $idReporte = $row_reportecre['id'];
      
      $sql_producto1 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$producto_uno."' LIMIT 1 ";
      $result_producto1 = mysqli_query($this->con, $sql_producto1);
      while($row_producto1 = mysqli_fetch_array($result_producto1, MYSQLI_ASSOC)){
      $total1 = $row_producto1['totalProducto'];
      }
      
      $sql_producto2 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$producto_dos."' LIMIT 1 ";
      $result_producto2 = mysqli_query($this->con, $sql_producto2);
      while($row_producto2 = mysqli_fetch_array($result_producto2, MYSQLI_ASSOC)){
      $total2 = $row_producto2['totalProducto'];
      }
      
      $sql_producto3 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$producto_tres."' LIMIT 1 ";
      $result_producto3 = mysqli_query($this->con, $sql_producto3);
      while($row_producto3 = mysqli_fetch_array($result_producto3, MYSQLI_ASSOC)){
      $total3 = $row_producto3['totalProducto'];
      } 
      
      }
      
      $array = array(
      'Producto1' => $total1,
      'Producto2' => $total2,
      'Producto3' => $total3
      );
      
      return $array;
      }

      public function construirCols($producto_uno,$producto_dos,$producto_tres){

        $colid = array('id' => '','label' => '', 'pattern' => '', 'type' => 'string');
        
        if ($producto_uno != "") {
        $colprod1 = array('id' => '','label' => $producto_uno, 'pattern' => '', 'type' => 'number');
        }
        
        if ($producto_dos != "") {
        $colprod2 = array('id' => '','label' => $producto_dos, 'pattern' => '', 'type' => 'number');
        }
        
        if ($producto_tres != "") {
        $colprod3 = array('id' => '','label' => $producto_tres, 'pattern' => '', 'type' => 'number');
        }
        
        if ($producto_uno != "" && $producto_dos != "" && $producto_tres != "") {
        $myarray = array($colid, $colprod1, $colprod2,$colprod3);
        }if ($producto_uno != "" && $producto_dos != "" && $producto_tres == "") {
        $myarray = array($colid, $colprod1, $colprod2);
        }
        
        return $myarray;
        
        }

        public function construirRows($producto_uno,$producto_dos,$producto_tres,$id_estacion,$fecha_year,$fecha_mes){

            for ($i=1; $i <= $fecha_mes; $i++) {
            
            if ($producto_uno != "") {
            $da[] = $this->detalleVentas($i,$fecha_year,$producto_uno,$producto_dos,$producto_tres,$id_estacion);
            }
            }
            return $da;
        }

        public function detalleVentas($mes,$fecha_year,$producto_uno,$producto_dos,$producto_tres,$id_estacion){


            $sql_reportecre = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$id_estacion."' AND mes = '".$mes."' AND year = '".$fecha_year."' ORDER BY mes asc ";
            $result_reportecre = mysqli_query($this->con, $sql_reportecre);
            while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
            $idReporte = $row_reportecre['id'];
            
            $sql_producto1 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$producto_uno."' LIMIT 1 ";
            $result_producto1 = mysqli_query($this->con, $sql_producto1);
            while($row_producto1 = mysqli_fetch_array($result_producto1, MYSQLI_ASSOC)){
            $total1 = $row_producto1['totalProducto'];
            }
            
            $sql_producto2 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$producto_dos."' LIMIT 1 ";
            $result_producto2 = mysqli_query($this->con, $sql_producto2);
            while($row_producto2 = mysqli_fetch_array($result_producto2, MYSQLI_ASSOC)){
            $total2 = $row_producto2['totalProducto'];
            }
            
            $sql_producto3 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$producto_tres."' LIMIT 1 ";
            $result_producto3 = mysqli_query($this->con, $sql_producto3);
            while($row_producto3 = mysqli_fetch_array($result_producto3, MYSQLI_ASSOC)){
            $total3 = $row_producto3['totalProducto'];
            }
            
            $temp[] = array('v' => nombremes($mes));
            
            if ($producto_uno != "" && $producto_dos != "" && $producto_tres != "") {
            
            $temp[] = array('v' => $total1);
            $temp[] = array('v' => $total2);
            $temp[] = array('v' => $total3);
            
            }if ($producto_uno != "" && $producto_dos != "" && $producto_tres == "") {
            
            $temp[] = array('v' => $total1);
            $temp[] = array('v' => $total2);
            
            }
            
            }
            $rows = array('c' => $temp);
            return $rows;
            
            }
}