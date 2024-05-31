<?php

class MonitoreoVerificacionEvaluacion{
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

    public function agregarIndicadores($id_estacion){

        $this->validaIndicadores($id_estacion,1,'60%');
        $this->validaIndicadores($id_estacion,2,'80%');
        $this->validaIndicadores($id_estacion,3,'60%');
        $this->validaIndicadores($id_estacion,4,'Buena');
        $this->validaIndicadores($id_estacion,5,'60%');

    }

    private function validaIndicadores($id_estacion,$objeto,$meta){

        $sql_medicion1 = "SELECT id FROM tb_medicion_indicadores WHERE id_estacion = '".$id_estacion."' AND objeto = '".$objeto."' ";
        $result_medicion1 = mysqli_query($this->con, $sql_medicion1);
        $numero_medicion1 = mysqli_num_rows($result_medicion1);
        
        if ($numero_medicion1 == 0) {
        $sql = "INSERT INTO tb_medicion_indicadores (
        id_estacion,
        objeto,
        meta
        )
        VALUES (
        '".$id_estacion."',
        '".$objeto."',
        '".$meta."'
        )";
        return $this->sqlQuery($sql);
        }else{
        return false;
        }
        $this->class_base_datos->desconectarBD($this->con);        

    }

    public function meta($id_estacion,$objeto){
        $sql = "SELECT meta FROM tb_medicion_indicadores WHERE id_estacion = '".$id_estacion."' AND objeto = '".$objeto."' ORDER BY id DESC LIMIT 1 ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $meta = $row['meta'];
        return $meta;
    }

    public function resultadoImplementacion($id_estacion,$year){
        $calificacion = 0;
        $sql_implementacion = "SELECT puntos FROM tb_implementacionsa WHERE id_estacion = '".$id_estacion."' AND YEAR(fecha) = '".$year."' ";
        $result_implementacion = mysqli_query($this->con, $sql_implementacion);
        $numero_implementacion = mysqli_num_rows($result_implementacion);
        
        if ($numero_implementacion > 0) {
        while($row_implementacion = mysqli_fetch_array($result_implementacion, MYSQLI_ASSOC)){
        $calificacion = $calificacion + $row_implementacion['puntos'];
        }
        $Resultado = $calificacion / $numero_implementacion;
        if($Resultado >= 60  && $Resultado <= 100){
        $title = "<b class='text-success'>".$Resultado."% Excelente</b>";                
        }else if($Resultado >= 0 && $Resultado <= 59){
        $title = "<b class='text-warning'>".$Resultado."% Regular</b>";               
        }
        }else{
        $title = "<b>S/I</b>"; 
        }
        return $title;
        }

    public function ventas($id_estacion,$mes,$year){

        $sql_reporte = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$id_estacion."' AND mes = '".$mes."' AND year = '".$year."' ";
        $result_reporte = mysqli_query($this->con, $sql_reporte);
        $numero_reporte = mysqli_num_rows($result_reporte);
        $row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC);
        $idReporte = $row_reporte['id'];

        $ventas = 0;
        $sql_reporte_mes = "SELECT volumen_venta FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."'  ";
        $result_reporte_mes = mysqli_query($this->con, $sql_reporte_mes);
        $numero_reporte_mes = mysqli_num_rows($result_reporte_mes);
        while($row_reporte_mes = mysqli_fetch_array($result_reporte_mes, MYSQLI_ASSOC)){
        $ventas = $ventas + $row_reporte_mes['volumen_venta'];
        }
               
        return $ventas;
        }

        public function resultadoCapacitacion($id_estacion,$Year,$Semestre){

            $SumD = 0;
            $Total = 0;

            if($Semestre == 1){
            $Rango = 'AND (MONTH(fecha_programada) >= 1 AND MONTH(fecha_programada) <= 6)';
            }else if($Semestre == 2){
            $Rango = 'AND (MONTH(fecha_programada) >= 7 AND MONTH(fecha_programada) <= 12)';  
            }
            
            $sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = '".$id_estacion."'  ";
            $result_usuarios = mysqli_query($this->con, $sql_usuarios);
            $numero_usuarios = mysqli_num_rows($result_usuarios);
            while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
            $idUsuario = $row_usuarios['id'];
                        
            $sql_detalle = "SELECT * FROM tb_cursos_calendario WHERE id_personal = '".$idUsuario."' AND YEAR(fecha_programada) = '".$Year."' $Rango  GROUP BY fecha_programada   ";
            $result_detalle = mysqli_query($this->con, $sql_detalle);
            $numero_detalle = mysqli_num_rows($result_detalle);
            
            $SumD = $SumD + $numero_detalle;
            while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
            $Total = $Total + $row_detalle['resultado'];
            
            }
            
            }
            
            if($SumD == 0){
            $title = "<b class='text-warning'>S/I</b>";
            }else{
            $Porcentaje = $Total / $SumD;
            $calificacion = number_format($Porcentaje,2);
            
            if( $calificacion >= 60  && $calificacion <= 100){
            $title = "<b class='text-success'>".$calificacion."% Excelente</b>";
                                
            }else if($calificacion >= 0 && $calificacion <= 59){
            $title = "<b class='text-warning'>".$calificacion."% Regular</b>";
                                
            }
            
            }
              return $title;
            }

            public function resultadoSatisfaccion($id_estacion,$Year,$Semestre){
                $resultado1 = 0;
                $resultado2 = 0;
                $resultado3 = 0;
                $resultado4 = 0;
                if($Semestre == 1){
                $Rango = 'AND (MONTH(fechacreacion) >= 1 AND MONTH(fechacreacion) <= 6)';
                }else if($Semestre == 2){
                $Rango = 'AND (MONTH(fechacreacion) >= 7 AND MONTH(fechacreacion) <= 12)';  
                }
                
                $sql_encuesta1 = "SELECT id FROM tb_encuentas_estacion WHERE id_estacion = '".$id_estacion."' AND YEAR(fechacreacion) = '".$Year."' $Rango ORDER BY fechacreacion DESC LIMIT 1 ";
                $result_encuesta1 = mysqli_query($this->con, $sql_encuesta1);
                $numero_encuesta1 = mysqli_num_rows($result_encuesta1);
                while($row_encuesta1 = mysqli_fetch_array($result_encuesta1, MYSQLI_ASSOC)){
                
                $IdReporte = $row_encuesta1['id'];
                
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
                
                } 
                
                if ($resultado1 == 0) {
                $resultado1 = 0;
                }else{
                $resultado1 = $resultado1;
                }
                
                if ($resultado2 == 0) {
                $resultado2 = 0;
                }else{
                $resultado2 = $resultado2;
                }
                
                if ($resultado3 == 0) {
                $resultado3 = 0;
                }else{
                $resultado3 = $resultado3;
                }
                
                if ($resultado4 == 0) {
                $resultado4 = 0;
                }else{
                $resultado4 = $resultado4;
                }
                
                $resultado = "
                <div class='text-danger'>Mala: <b>".$resultado1."</b></div>
                <div class='text-warning'>Regular: <b>".$resultado2."</b></div>
                <div class='text-info'>Buena: <b>".$resultado3."</b></div>
                <div class='text-success'>Excelente: <b>".$resultado4."</b></div>
                ";
                
                return $resultado;
                
                }

            public function resultadoIncidentes($Session_IDEstacion,$Year,$Semestre){

                    if($Semestre == 1){
                    $Rango = 'AND (MONTH(fechacreacion) >= 1 AND MONTH(fechacreacion) <= 6)';
                    }else if($Semestre == 2){
                    $Rango = 'AND (MONTH(fechacreacion) >= 7 AND MONTH(fechacreacion) <= 12)';  
                    }
                    
                    $sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente WHERE id_estacion= '".$Session_IDEstacion."' AND YEAR(fechacreacion) = '".$Year."' $Rango ORDER BY id desc ";
                    $result_inv = mysqli_query($this->con, $sql_inv);
                    $numero_inv = mysqli_num_rows($result_inv);
                    
                    if ($numero_inv == 0) {
                    $title = "<b class='text-success'>100% Excelente</b>";
                    }else{
                    $totalRe = 0;
                    while($row_inv = mysqli_fetch_array($result_inv, MYSQLI_ASSOC)){
                    $id = $row_inv['id'];
                    $formato026 = formatos($id);
                    $Grupo = grupo($id);
                    
                    $Total = $formato026 + $Grupo;
                    
                    if ($Total >= 2) {
                    $suma = 1;
                    }else{
                    $suma = 0;
                    }
                    
                    $totalRe = $totalRe + $suma;
                    
                    }
                    
                    if ($totalRe == 0) {
                    $title = "<b class='text-warning'>50% Regular</b>";
                    }else{
                    
                    $calificacion = $totalRe / $numero_inv  * 100;
                    
                    if( $calificacion >= 60  && $calificacion <= 100){
                    $title = "<b class='text-success'>".$calificacion."% Excelente</b>";
                                        
                    }else if($calificacion >= 0 && $calificacion <= 59){
                    $title = "<b class='text-warning'>".$calificacion."% Regular</b>";
                                        
                    }
                    
                    }
                    
                    }
                    
                    return $title;
    }

    private function formatos($id){

        $sql_archivo = "SELECT id FROM tb_investigacion_incidente_accidente_formato WHERE id_investigacion = '".$id."' ORDER BY id asc ";
        $result_archivo = mysqli_query($this->con, $sql_archivo);
        $numero_archivo = mysqli_num_rows($result_archivo);
        return $numero_archivo;
        }
        
        private function grupo($id){
        
        $sql_inv = "SELECT id FROM tb_investigacion_incidente_accidente_grupo WHERE id_investigacion= '".$id."' ORDER BY id desc ";
        $result_inv = mysqli_query($this->con, $sql_inv);
        $numero_inv = mysqli_num_rows($result_inv);
        
        return $numero_inv;
        }

    public function agregarCuestionarioSasisopa($array){

        $Totpreguntas =  36;
        $porcentaje   =  $Totpreguntas * 10;
        $resultado = 
        $array['respuesta1'] + 
        $array['respuesta2'] + 
        $array['respuesta3'] + 
        $array['respuesta4'] + 
        $array['respuesta5'] + 
        $array['respuesta6'] + 
        $array['respuesta7'] + 
        $array['respuesta8'] + 
        $array['respuesta9'] + 
        $array['respuesta10'] + 
        $array['respuesta11'] + 
        $array['respuesta12'] + 
        $array['respuesta13'] + 
        $array['respuesta14'] + 
        $array['respuesta15'] + 
        $array['respuesta16'] + 
        $array['respuesta17'] + 
        $array['respuesta18'] + 
        $array['respuesta19'] + 
        $array['respuesta20'] + 
        $array['respuesta21'] + 
        $array['respuesta22'] + 
        $array['respuesta23'] + 
        $array['respuesta24'] + 
        $array['respuesta25'] + 
        $array['respuesta26'] + 
        $array['respuesta27'] + 
        $array['respuesta28'] + 
        $array['respuesta29'] + 
        $array['respuesta30'] + 
        $array['respuesta31'] + 
        $array['respuesta32'] + 
        $array['respuesta33'] + 
        $array['respuesta34'] + 
        $array['respuesta35'] + 
        $array['respuesta36'];

        $puntosTotal =  ($resultado / $porcentaje) * 100;
        $Promedio = $puntosTotal * 10;
        $id_implementacion = $this->idImplementacion();

        $sql = "INSERT INTO tb_implementacionsa (id, id_estacion, id_usuario, preguntas, respuestas, puntos )
        VALUES ('".$id_implementacion."', '".$array['id_estacion']."', '".$array['id_usuario']."', '".$Totpreguntas."', '".$resultado."', '".$Promedio."')";

        if($this->sqlQuery($sql)){
        
        $sql_detalle = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado ) VALUES 
        ('".$id_implementacion."', '".$array['Titulo1']."', '".$this->Respuesta($array['respuesta1'])."', '".$array['respuesta1']."'),
        ('".$id_implementacion."', '".$array['Titulo2']."', '".$this->Respuesta($array['respuesta2'])."', '".$array['respuesta2']."'),
        ('".$id_implementacion."', '".$array['Titulo3']."', '".$this->Respuesta($array['respuesta3'])."', '".$array['respuesta3']."'),
        ('".$id_implementacion."', '".$array['Titulo4']."', '".$this->Respuesta($array['respuesta4'])."', '".$array['respuesta4']."'),
        ('".$id_implementacion."', '".$array['Titulo5']."', '".$this->Respuesta($array['respuesta5'])."', '".$array['respuesta5']."'),
        ('".$id_implementacion."', '".$array['Titulo6']."', '".$this->Respuesta($array['respuesta6'])."', '".$array['respuesta6']."'),
        ('".$id_implementacion."', '".$array['Titulo7']."', '".$this->Respuesta($array['respuesta7'])."', '".$array['respuesta7']."'),
        ('".$id_implementacion."', '".$array['Titulo8']."', '".$this->Respuesta($array['respuesta8'])."', '".$array['respuesta8']."'),
        ('".$id_implementacion."', '".$array['Titulo9']."', '".$this->Respuesta($array['respuesta9'])."', '".$array['respuesta9']."'),
        ('".$id_implementacion."', '".$array['Titulo10']."', '".$this->Respuesta($array['respuesta10'])."', '".$array['respuesta10']."'),
        ('".$id_implementacion."', '".$array['Titulo11']."', '".$this->Respuesta($array['respuesta11'])."', '".$array['respuesta11']."'),
        ('".$id_implementacion."', '".$array['Titulo12']."', '".$this->Respuesta($array['respuesta12'])."', '".$array['respuesta12']."'),
        ('".$id_implementacion."', '".$array['Titulo13']."', '".$this->Respuesta($array['respuesta13'])."', '".$array['respuesta13']."'),
        ('".$id_implementacion."', '".$array['Titulo14']."', '".$this->Respuesta($array['respuesta14'])."', '".$array['respuesta14']."'),
        ('".$id_implementacion."', '".$array['Titulo15']."', '".$this->Respuesta($array['respuesta15'])."', '".$array['respuesta15']."'),
        ('".$id_implementacion."', '".$array['Titulo16']."', '".$this->Respuesta($array['respuesta16'])."', '".$array['respuesta16']."'),
        ('".$id_implementacion."', '".$array['Titulo17']."', '".$this->Respuesta($array['respuesta17'])."', '".$array['respuesta17']."'),
        ('".$id_implementacion."', '".$array['Titulo18']."', '".$this->Respuesta($array['respuesta18'])."', '".$array['respuesta18']."'),
        ('".$id_implementacion."', '".$array['Titulo19']."', '".$this->Respuesta($array['respuesta19'])."', '".$array['respuesta19']."'),
        ('".$id_implementacion."', '".$array['Titulo20']."', '".$this->Respuesta($array['respuesta20'])."', '".$array['respuesta20']."'),
        ('".$id_implementacion."', '".$array['Titulo21']."', '".$this->Respuesta($array['respuesta21'])."', '".$array['respuesta21']."'),
        ('".$id_implementacion."', '".$array['Titulo22']."', '".$this->Respuesta($array['respuesta22'])."', '".$array['respuesta22']."'),
        ('".$id_implementacion."', '".$array['Titulo23']."', '".$this->Respuesta($array['respuesta23'])."', '".$array['respuesta23']."'),
        ('".$id_implementacion."', '".$array['Titulo24']."', '".$this->Respuesta($array['respuesta24'])."', '".$array['respuesta24']."'),
        ('".$id_implementacion."', '".$array['Titulo25']."', '".$this->Respuesta($array['respuesta25'])."', '".$array['respuesta25']."'),
        ('".$id_implementacion."', '".$array['Titulo26']."', '".$this->Respuesta($array['respuesta26'])."', '".$array['respuesta26']."'),
        ('".$id_implementacion."', '".$array['Titulo27']."', '".$this->Respuesta($array['respuesta27'])."', '".$array['respuesta27']."'),
        ('".$id_implementacion."', '".$array['Titulo28']."', '".$this->Respuesta($array['respuesta28'])."', '".$array['respuesta28']."'),
        ('".$id_implementacion."', '".$array['Titulo29']."', '".$this->Respuesta($array['respuesta29'])."', '".$array['respuesta29']."'),
        ('".$id_implementacion."', '".$array['Titulo30']."', '".$this->Respuesta($array['respuesta30'])."', '".$array['respuesta30']."'),
        ('".$id_implementacion."', '".$array['Titulo31']."', '".$this->Respuesta($array['respuesta31'])."', '".$array['respuesta31']."'),
        ('".$id_implementacion."', '".$array['Titulo32']."', '".$this->Respuesta($array['respuesta32'])."', '".$array['respuesta32']."'),
        ('".$id_implementacion."', '".$array['Titulo33']."', '".$this->Respuesta($array['respuesta33'])."', '".$array['respuesta33']."'),
        ('".$id_implementacion."', '".$array['Titulo34']."', '".$this->Respuesta($array['respuesta34'])."', '".$array['respuesta34']."'),
        ('".$id_implementacion."', '".$array['Titulo35']."', '".$this->Respuesta($array['respuesta35'])."', '".$array['respuesta35']."'),
        ('".$id_implementacion."', '".$array['Titulo36']."', '".$this->Respuesta($array['respuesta36'])."', '".$array['respuesta36']."');
        ";

        return $this->sqlQuery($sql_detalle);

        }else{
        return false;
        }
        $this->class_base_datos->desconectarBD($this->con); 

    }

    private function Respuesta($id){
        if ($id == 1) {
        $resultado = "Si";
        }else{
        $resultado = "No";
        }
        return $resultado;
        }

        private function idImplementacion(){
            $sql = "SELECT id FROM tb_implementacionsa ORDER BY id desc LIMIT 1 ";
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

        public function editarCuestionarioSasisopa($id,$fecha,$hora_del_dia){

            $sql = "UPDATE tb_implementacionsa SET
            fecha = '".$fecha.' '.$hora_del_dia."'
            WHERE id = '".$id."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con); 

        }

        function ventasMensual($id_estacion,$mes,$year){
            $ventas = 0;
            $sql_reporte = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$id_estacion."' AND mes = '".$mes."' AND year = '".$year."' ";
            $result_reporte = mysqli_query($this->con, $sql_reporte);
            $numero_reporte = mysqli_num_rows($result_reporte);
            if($numero_reporte > 0){

                $row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC);
                $idReporte = $row_reporte['id'];
                        
            $sql_reporte_mes = "SELECT volumen_venta FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."'  ";
            $result_reporte_mes = mysqli_query($this->con, $sql_reporte_mes);
            $numero_reporte_mes = mysqli_num_rows($result_reporte_mes);
            while($row_reporte_mes = mysqli_fetch_array($result_reporte_mes, MYSQLI_ASSOC)){
            $ventas = $ventas + $row_reporte_mes['volumen_venta'];
            }
            }else{
            $ventas = 0;
            }

            return $ventas;
            }

    //-----------------------------------------------------------------------------------------
    //------------------ Calibración, Verificación y mantenimiento de equipos -----------------

    public function tanquesAlmacenamiento($IDEstacion){
        $Contenido = "";
        $sql = "SELECT * FROM tb_tanque_almacenamiento WHERE id_estacion = '".$IDEstacion."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if ($numero > 0) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $Contenido .= "<tr>";
        $Contenido .= "<td class='text-center align-middle'>".$row['no_tanque']."</td>";
        $Contenido .= "<td class='text-center align-middle'>".$row['capacidad'].", ".$row['producto']."</td>";
        $Contenido .= "<td class='text-center align-middle'>Tanques de almacenamiento</td>";
        $Contenido .= "<td class='text-center align-middle'>10 años</td>";
        $Contenido .= "</tr>";
        }
        }
        return $Contenido;
        }

        public function sondasMedicion($IDEstacion){
            $Contenido = "";
            $sql = "SELECT * FROM tb_sondas_medicion WHERE id_estacion = '".$IDEstacion."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            if ($numero > 0) {
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Contenido .= "<tr>";
            $Contenido .= "<td class='text-center align-middle'>".$row['no_sonda']."</td>";
            $Contenido .= "<td class='text-center align-middle'>".$row['marca'].", ".$row['modelo']."</td>";
            $Contenido .= "<td class='text-center align-middle'>Sondas de medición</td>";
            $Contenido .= "<td class='text-center align-middle'>2 años</td>";
            $Contenido .= "</tr>";
            }
            }
            return $Contenido;
        }

        public function dispensario($IDEstacion){
            $Contenido = "";
            $sql = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$IDEstacion."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            if ($numero > 0) {
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Contenido .= "<tr>";
            $Contenido .= "<td class='text-center align-middle'>".$row['no_dispensario']."</td>";
            $Contenido .= "<td class='text-center align-middle'>".$row['marca'].", ".$row['modelo']."</td>";
            $Contenido .= "<td class='text-center align-middle'>Dispensario</td>";
            $Contenido .= "<td class='text-center align-middle'>Semestral</td>";
            $Contenido .= "</tr>";
            }
            }
            return $Contenido;
            }
        
            public function JarraPatron($IDEstacion){
                $Contenido = "";
                $i = 1;
                $sql = "SELECT * FROM tb_jarra_patron WHERE id_estacion = '".$IDEstacion."' ";
                $result = mysqli_query($this->con, $sql);
                $numero = mysqli_num_rows($result);
                if ($numero > 0) {
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $Contenido .= "<tr>";
                $Contenido .= "<td class='text-center align-middle'>".$i."</td>";
                $Contenido .= "<td class='text-center align-middle'>".$row['marca'].", ".$row['no_serie']."</td>";
                $Contenido .= "<td class='text-center align-middle'>Jarra patron</td>";
                $Contenido .= "<td class='text-center align-middle'>Anual</td>";
                $Contenido .= "</tr>";
                
                $i++;
                }
                }
                return $Contenido;
                }

        public function yearCol($Year, $Mes, $MesCom,$estado){
        
                    if($estado == 0){
                    $Color = 'table-warning';
                    }else{
                    $Color = 'table-success';    
                    }
            
                    if($Mes == $MesCom){
                    $YearR = $Year;
                    $ColR = $Color;
                    }else{
                    $YearR = '';
                    $ColR = ''; 
                    }
            
                    $array = array('Year' => $YearR, 'Col' => $ColR );
                    return $array;
        }

        public function agregarInformeRevisionResultado($id_estacion,$fecha,$file_name,$file_tmp_name,$hoy){
        
            $File  =  $file_name;
            $upload_folder = "../../archivos/informe-revision-resultados/Informe-revision-resultados-".strtotime($hoy).".pdf";
            
            if ($File != "") {
            $archivo = "Informe-revision-resultados-".strtotime($hoy).".pdf";
            }else{
            $archivo = ""; 
            }
            
              if(move_uploaded_file($file_tmp_name, $upload_folder)) {
                      
              $sql = "INSERT INTO tb_informe_revision_resultados (
              id_estacion,
              fecha,
              archivo
              )
              VALUES (
              '".$id_estacion."',
              '".$fecha."',
              '".$archivo."'
              )";
              
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
            
            }else{
            return false;
            }

        }

        public function eliminarInformeRevisionResultado($id){
            $sql = "DELETE FROM tb_informe_revision_resultados WHERE id = '".$id."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
        }

       //----------------------------------------------------------------------------------------------
       //------------------------------- Atención de Hallazgos ----------------------------------------

        public function agregarAtencionHallazgos($id_estacion){
            $id_contenido = $this->idContenido();
            $folio = $this->folio($id_estacion);

            $sql = "INSERT INTO tb_atencion_hallazgos (
                id,
                id_estacion,
                folio,
                fecha_auditoria,
                no_control,
                tipo_auditoria
                )
                VALUES (
                '".$id_contenido."',
                '".$id_estacion."',
                '".$folio."',
                '',
                '',
                ''
                )";

            if($this->sqlQuery($sql)){
                return $id_contenido;
            }else{
                return false;
            }
            $this->class_base_datos->desconectarBD($this->con);
        }

        private function idContenido(){
            $sql_folio = "SELECT id FROM tb_atencion_hallazgos ORDER BY id desc LIMIT 1 ";
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
            
            private function folio($IDEstacion){
            $sql_folio = "SELECT folio FROM tb_atencion_hallazgos WHERE id_estacion = '".$IDEstacion."' ORDER BY folio desc LIMIT 1 ";
            $result_folio = mysqli_query($this->con, $sql_folio);
            $numero_folio = mysqli_num_rows($result_folio);
            if ($numero_folio == 0) {
            $NumFolio = 1;
            }else{
            $row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC);
            $folio = $row_folio['folio'] + 1;
            $NumFolio = $folio;
            }
            return $NumFolio;
            }

    public function eliminarAtencionHallazgos($id,$categoria){

        if($categoria == 1){
        $sql = "DELETE FROM tb_atencion_hallazgos WHERE id = '".$id."' ";
        }else if($categoria == 2){
        $sql = "DELETE FROM tb_atencion_hallazgos_evidencia WHERE id = '".$id."' ";            
        }

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarHallazgos($id,$id_hallazgo,$id_sasisopa,$hallazgos,$accion,$fecha){

        if($id_hallazgo == 0){

            $sqlAH = "SELECT id FROM tb_atencion_hallazgos_detalle WHERE id_atencion = '".$id."' AND id_sasisopa = '".$id_sasisopa."' ";
            $resultAH = mysqli_query($this->con, $sqlAH);
            $numeroAH = mysqli_num_rows($resultAH);
            
            if($numeroAH == 0){
            
            $sql = "INSERT INTO tb_atencion_hallazgos_detalle (
            id_atencion,
            id_sasisopa,
            hallazgos,
            accion,
            fecha_implementacion
            )
            VALUES (
            '".$id."',
            '".$id_sasisopa."',
            '".$hallazgos."',
            '".$accion."',
            '".$fecha."'
            )";
            
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
            
            }else{
            return false;
            }
            
            
            }else{
            
            $sql = "UPDATE tb_atencion_hallazgos_detalle SET
            id_sasisopa = '".$id_sasisopa."',
            hallazgos = '".$hallazgos."',
            accion = '".$accion."',
            fecha_implementacion = '".$fecha."'
             WHERE id = '".$id_hallazgo."' ";
                        
             return $this->sqlQuery($sql);
             $this->class_base_datos->desconectarBD($this->con);
            
            }

    }

    public function actualizarAtencionHallazgos($id,$valor,$dato){

        if($dato == 1){

            $sql = "UPDATE tb_atencion_hallazgos SET
            fecha_auditoria = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if($dato == 2){
            
            $sql = "UPDATE tb_atencion_hallazgos SET
            no_control = '".$valor."'
            WHERE id = '".$id."' ";
            
            }else if($dato == 3){
            
            $sql = "UPDATE tb_atencion_hallazgos SET
            tipo_auditoria = '".$valor."'
            WHERE id = '".$id."' ";
            
            }

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);           

    }

    public function eliminarHallazgos($id_hallazgo){

        $sql = "DELETE FROM tb_atencion_hallazgos_detalle WHERE id = '".$id_hallazgo."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);      

    }

    public function agregarEvidenciaHallazgos($id,$file_name,$file_tmp_name,$hoy){

        $extension = pathinfo($file_name, PATHINFO_EXTENSION);

        $ruta_file = "../../archivos/atencion-hallazgos/Atencion-Hallazgos-".strtotime($hoy).".".$extension;

        $ruta_protocolo = "Atencion-Hallazgos-".strtotime($hoy).".".$extension;


        if(move_uploaded_file($file_tmp_name, $ruta_file)) {

        $sql = "INSERT INTO tb_atencion_hallazgos_evidencia (
        id_hallazgo,
        archivo
        )
        VALUES 
        (
        '".$id."',
        '".$ruta_protocolo."'
        )";

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);  

        }

    }

    public function sasisopa($id){
        $sql = "SELECT nombre FROM sa_sasisopa WHERE id = '".$id."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $Nombre = $row['nombre'];
        return $Nombre;
    }

    public function validarHallazgo($idAtencion,$idSasisopa){
        $sql = "SELECT id FROM tb_atencion_hallazgos_detalle WHERE id_atencion = '".$idAtencion."' AND id_sasisopa = '".$idSasisopa."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        return $numero;
        }

        public function evidencia($id){
          $contenido = "";
          $sql = "SELECT * FROM tb_atencion_hallazgos_evidencia WHERE id_hallazgo = '".$id."' ";
          $result = mysqli_query($this->con, $sql);
          $numero = mysqli_num_rows($result);
          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
          $archivo = $row['archivo'];
          $contenido .= '<div><a>'.$row['archivo'].'</a></div>';
          } 
          return $contenido;
          }

          function Cumplimiento($id){
            $sql = "SELECT id_hallazgo FROM tb_atencion_hallazgos_evidencia WHERE id_hallazgo = '".$id."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result); 
            
            if($numero == 0){
            $Result = '0%';
            }else{
            $Result = '100%'; 
            }
            
            return $Result;
            }
        //-----------------------------------------------------------------------------------------------

        public function agregarRevisionResultado($id_usuario,$id_estacion,$file_name,$filetmp_name,$hoy){

            $ruta = "../../archivos/revision-resultados/".$id_estacion."-RESULTADOS-".strtotime($hoy).".pdf";
            $nom = "archivos/revision-resultados/".$id_estacion."-RESULTADOS-".strtotime($hoy).".pdf";

            if(move_uploaded_file($filetmp_name, $ruta)) {

            $sql = "INSERT INTO tb_revision_resultados (
            id_estacion,
            id_usuario,
            archivo
            )
            VALUES 
            (
            '".$id_estacion."',
            '".$id_usuario."',
            '".$nom."'
            )";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con); 
            
            }else{
                return false;
            }

        }

        public function eliminarRevisionResultados($id){

            $sql = "DELETE FROM tb_revision_resultados WHERE id = '".$id."'";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con); 

        }

        public function editarRevisionResultado($id,$fecha,$file_name,$file_tmp_name,$hoy,$hora_del_dia){

            $ruta = "../../archivos/revision-resultados/".$id."-RESULTADOS-".strtotime($hoy).".pdf";
            $nom = "archivos/revision-resultados/".$id."-RESULTADOS-".strtotime($hoy).".pdf";

            if(move_uploaded_file($file_tmp_name, $ruta)) {

            $sql1 = "UPDATE tb_revision_resultados SET
            archivo = '".$nom."'
            WHERE id = '".$id."' ";
            $this->sqlQuery($sql1);

            $sql2 = "UPDATE tb_revision_resultados SET
            fecha_hora = '".$fecha." ".$hora_del_dia."'
            WHERE id = '".$id."' ";
            $this->sqlQuery($sql2);

            return true;
            }else{
                return false;
            }

            $this->class_base_datos->desconectarBD($this->con);            

        }


}