<?php

class RequisitoLegal 
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

    public function agregarRequisitoLegalConfiguracion($id_estacion,$ng,$ma,$dependencia,$permiso,$fundamento){

        if($ma == "NA"){
            $MA = "";	
            }else{
            $MA = $ma;	
            }
            
            $sql = "INSERT INTO rl_requisitos_legales_lista (
            nivel_gobierno,
            mun_alc_est,
            dependencia,
            permiso,
            fundamento,
            id_estacion,
            disabled,
            estado
            )
            VALUES 
            (
            '".$ng."',
            '".$MA."',
            '".$dependencia."',
            '".$permiso."',
            '".$fundamento."',            
            '".$id_estacion."', 
            0,
            1
            )";

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
            
    }

    public function eliminarRequisitoLegalConfiguracion($id){

        $sql = "SELECT id FROM rl_requisitos_legales_lista WHERE id = '".$id."' AND disabled = 0 ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if ($numero == 1) {

            $sql = "UPDATE rl_requisitos_legales_lista SET
            estado = 0
            WHERE id = '".$id."' ";

            return $this->sqlQuery($sql);

        }else{
            return false;
        }

        $this->class_base_datos->desconectarBD($this->con);

    }

    public function ToRequisitos($id,$NGobierno){

        $ToReFin = 0;
        $TotalCmp = 0;
        $sql_programa_c = "SELECT * FROM rl_requisitos_legales_calendario
        WHERE id_estacion = '".$id."' AND nivel_gobierno = '".$NGobierno."' ";
        $result_programa_c = mysqli_query($this->con, $sql_programa_c);
        $numero_programa_c = mysqli_num_rows($result_programa_c);
        while($row_programa_c = mysqli_fetch_array($result_programa_c, MYSQLI_ASSOC)){
        $idCa = $row_programa_c['id'];  
        
        $sql_programa_m = "SELECT * FROM rl_requisitos_legales_matriz
        WHERE idcalendario = '".$idCa."' ORDER BY fecha_emision asc LIMIT 1 ";
        $result_programa_m = mysqli_query($this->con, $sql_programa_m);
        $numero_programa_m = mysqli_num_rows($result_programa_m);
        while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
        
        if ($row_programa_m['acusepdf'] == "" && $row_programa_m['requisitolegalpdf'] == "") {
          $Refin = 0;
          $toCumpli = 0;
          }else if ($row_programa_m['acusepdf'] != "" && $row_programa_m['requisitolegalpdf'] == "") {
          $Refin = 0;
          $toCumpli = 50;
          }else if($row_programa_m['acusepdf'] == "" && $row_programa_m['requisitolegalpdf'] != ""){
          $Refin = 1;
          $toCumpli = 100;
          }else if($row_programa_m['acusepdf'] != "" && $row_programa_m['requisitolegalpdf'] != ""){
          $Refin = 1;
          $toCumpli = 100;
          }
        
          $ToReFin = $ToReFin + $Refin;
          $TotalCmp = $TotalCmp + $toCumpli;
        }
        }

        if ($ToReFin == 0) {
        $ToReFin = 0;
        }else{
        $ToReFin = $ToReFin; 
        }
    
        return array("ToReFin" => $ToReFin, "ToRe" => $numero_programa_c);
        $this->class_base_datos->desconectarBD($this->con);
        }

        public function ToPorcentaje($id,$NGobierno){
            $TotalCmp = 0;
            $sql_programa_c = "SELECT id FROM rl_requisitos_legales_calendario
            WHERE id_estacion = '".$id."' AND nivel_gobierno = '".$NGobierno."' ";
            $result_programa_c = mysqli_query($this->con, $sql_programa_c);
            $numero_programa_c = mysqli_num_rows($result_programa_c);
            while($row_programa_c = mysqli_fetch_array($result_programa_c, MYSQLI_ASSOC)){
            $idCa = $row_programa_c['id'];  
            $UltimaA = $this->UltimaAct($idCa);
            $TotalCmp = $TotalCmp + $UltimaA['toCumpli'];
            }

            if ($TotalCmp == 0) {
                $Sicumple = 0;
                }else{
                $Sicumple = $TotalCmp / $numero_programa_c;
            }
            
            return $Sicumple;  
            $this->class_base_datos->desconectarBD($this->con);
            }

            public function UltimaAct($idre){

                $sql_matriz = "SELECT fecha_emision, fecha_vencimiento, acusepdf, requisitolegalpdf FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' ORDER BY id desc LIMIT 1";
                $result_matriz = mysqli_query($this->con, $sql_matriz);
                $numero_matriz = mysqli_num_rows($result_matriz);
                if($numero_matriz > 0){
                while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){
                
                
                if($row_matriz['fecha_emision'] == "0000-00-00"){
                $fechaemision = "S/I"; 
                }else{
                $fechaemision = $row_matriz['fecha_emision'];
                }
                
                if($row_matriz['fecha_vencimiento'] == "0000-00-00"){
                $fechavencimiento = "S/I"; 
                }else{
                $fechavencimiento = $row_matriz['fecha_vencimiento'];
                }
                
                $acusepdf = $row_matriz['acusepdf'];
                $requisitolegalpdf = $row_matriz['requisitolegalpdf'];
                }
                }else{
                $fechaemision = "S/I";
                $fechavencimiento = "S/I"; 
                $acusepdf = "";
                $requisitolegalpdf = "";
                }
                
                if ($acusepdf == "" && $requisitolegalpdf == "") {
                  $cumplimiento = "0 %";
                  $toCumpli = 0;
                  }else if ($acusepdf != "" && $requisitolegalpdf == "") {
                  $cumplimiento = "50 %";
                  $toCumpli = 50;
                  }else if($acusepdf == "" && $requisitolegalpdf != ""){
                  $cumplimiento = "100 %";
                  $toCumpli = 100;
                  }else if($acusepdf != "" && $requisitolegalpdf != ""){
                  $cumplimiento = "100 %";
                  $toCumpli = 100;
                  }
                
                return array(
                'fechaemision' => $fechaemision,
                'fechavencimiento' => $fechavencimiento,
                'acusepdf' => $acusepdf,
                'requisitolegalpdf' => $requisitolegalpdf,
                'cumplimiento' => $cumplimiento,
                'toCumpli' => $toCumpli);
                
                $this->class_base_datos->desconectarBD($this->con);
                }

                public function NivelGobierno($NGobierno,$IDEstacion){

                    $sql_programa_c = "SELECT * FROM rl_requisitos_legales_calendario WHERE id_estacion = '".$IDEstacion."' AND nivel_gobierno = '".$NGobierno."' AND estado = 1";
                    $result_programa_c = mysqli_query($this->con, $sql_programa_c);
                    $numero_programa_c = mysqli_num_rows($result_programa_c);

                    $contenid0 = "";
                    $contenid0 .= '<tr>';
                    $contenid0 .= '<td class="text-center table-info" colspan="6"><b>Nivel de Gobierno '.$NGobierno.'</b></td>';
                    $contenid0 .= '</tr>';
                    
                    while($row_programa_c = mysqli_fetch_array($result_programa_c, MYSQLI_ASSOC)){
                    
                    $idrequisitol = $row_programa_c['id_requisito_legal'];
                    $idre = $row_programa_c['id'];
                    $enero = $row_programa_c['enero'];
                    $febrero = $row_programa_c['febrero'];
                    $marzo = $row_programa_c['marzo'];
                    $abril = $row_programa_c['abril'];
                    $mayo = $row_programa_c['mayo'];
                    $junio = $row_programa_c['junio'];
                    $julio = $row_programa_c['julio'];
                    $agosto = $row_programa_c['agosto'];
                    $septiembre = $row_programa_c['septiembre'];
                    $octubre = $row_programa_c['octubre'];
                    $noviembre = $row_programa_c['noviembre'];
                    $diciembre = $row_programa_c['diciembre'];
                    
                    if($row_programa_c['id_requisito_legal'] == 0){
                    $dependencia = 'S/I';
                    $requisitol = $row_programa_c['requisito_legal'];
                    }else{
                    $DetalleRL = $this->DetalleRL($idrequisitol);
                    $dependencia = $DetalleRL['dependencia'];
                    $requisitol = $DetalleRL['permiso'];
                    }
                    
                    $UltimaA = $this->UltimaAct($idre);
                    
                    if ($enero == 1) {
                    $Colenero = "Enero,";
                    }else{
                    $Colenero = ""; 
                    }
                    
                    if ($febrero == 1) {
                    $Colfebrero = "Febrero,";
                    }else{
                    $Colfebrero = ""; 
                    }
                    
                    if ($marzo == 1) {
                    $Colmarzo = "Marzo,";
                    }else{
                    $Colmarzo = ""; 
                    }
                    
                    if ($abril == 1) {
                    $Colabril = "Abril,";
                    }else{
                    $Colabril = ""; 
                    }
                    
                    if ($mayo == 1) {
                    $Colmayo = "Mayo,";
                    }else{
                    $Colmayo = ""; 
                    }
                    
                    if ($junio == 1) {
                    $Coljunio = "Junio,";
                    }else{
                    $Coljunio = ""; 
                    }
                    
                    if ($julio == 1) {
                    $Coljulio = "Julio,";
                    }else{
                    $Coljulio = ""; 
                    }
                    
                    if ($agosto == 1) {
                    $Colagosto = "Agosto,";
                    }else{
                    $Colagosto = ""; 
                    }
                    
                    if ($septiembre == 1) {
                    $Colseptiembre = "Septiembre,";
                    }else{
                    $Colseptiembre = ""; 
                    }
                    
                    if ($octubre == 1) {
                    $Coloctubre = "Octubre,";
                    }else{
                    $Coloctubre = ""; 
                    }
                    
                    if ($noviembre == 1) {
                    $Colnoviembre = "Noviembre,";
                    }else{
                    $Colnoviembre = ""; 
                    }
                    
                    if ($diciembre == 1) {
                    $Coldiciembre = "Diciembre,";
                    }else{
                    $Coldiciembre = ""; 
                    }
                    
                    $Renovacion = $Colenero.$Colfebrero.$Colmarzo.$Colabril.$Colmayo.$Coljunio.$Coljulio.$Colagosto.$Colseptiembre.$Coloctubre.$Colnoviembre.$Coldiciembre;
                    $Renovacion = trim($Renovacion, ',');
                    
                    $contenid0 .= '<tr>';
                    $contenid0 .= '<td>'.$dependencia.'</td>';
                    $contenid0 .= '<td><b>'.$requisitol.'</b></td>';
                    $contenid0 .= '<td>'.$row_programa_c['vigencia'].'</td>';
                    $contenid0 .= '<td>'.$UltimaA['fechaemision'].'</td>';
                    $contenid0 .= '<td>'.$UltimaA['fechavencimiento'].'</td>';
                    $contenid0 .= '<td>'.$Renovacion.'</td>';
                    $contenid0 .= '</tr>';
                    }
                    
                    return $contenid0;
                    $this->class_base_datos->desconectarBD($this->con);
                    }

                    public function DetalleRL($idrequisitol){

                        $sql = "SELECT dependencia, permiso, nivel_gobierno, mun_alc_est,fundamento FROM rl_requisitos_legales_lista WHERE id = '".$idrequisitol."' LIMIT 1 ";
                        $result = mysqli_query($this->con, $sql);
                        $numero = mysqli_num_rows($result);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                            $nivelgobierno = $row['nivel_gobierno'];
                            $munalcest = $row['mun_alc_est'];
                            $dependencia = $row['dependencia']; 
                            $permiso = $row['permiso']; 
                            $fundamento = $row['fundamento']; 
                        
                        return array(
                        'nivelgobierno' => $nivelgobierno,
                        'munalcest' => $munalcest,
                        'dependencia' => $dependencia,
                        'permiso' => $permiso,
                        'fundamento' => $fundamento);
                        
                        $this->class_base_datos->desconectarBD($this->con);
                        }

                        function valRequisito($idEstacion,$id){
                            $sql = "SELECT id_requisito_legal FROM rl_requisitos_legales_calendario WHERE id_estacion = '".$idEstacion."' AND id_requisito_legal = '".$id."' LIMIT 1";
                            $result = mysqli_query($this->con, $sql);
                            $numero = mysqli_num_rows($result);
                            return $numero;
                            $this->class_base_datos->desconectarBD($this->con);
                            }

            public function agregarDetalleRequisitoLegal($id_estacion,$array){

                $ext_acuse = pathinfo($array['acuse_name'], PATHINFO_EXTENSION);
                $ext_requisito = pathinfo($array['requisito_name'], PATHINFO_EXTENSION);
                
                if($array['vigencia'] == "Anual"){
                $Resultado = $array['vencimiento'];	
                }else if($array['vigencia'] == "Bianual"){
                $Resultado = $array['vencimiento'];	
                }else if($array['vigencia'] == "Permanente"){
                $Resultado = "0000-00-00";	
                }else if($array['vigencia'] == "Trimestral"){
                $Resultado = $array['vencimiento'];		
                }else if($array['vigencia'] == "Diario"){
                $Resultado = $array['vencimiento'];	
                }else if($array['vigencia'] == "Cuando se realice cambio"){
                $Resultado = "0000-00-00";	
                }else if($array['vigencia'] == "Semestral"){
                $Resultado = $array['vencimiento'];		
                }else if($array['vigencia'] == "Mejora continua"){
                $Resultado = "0000-00-00";	
                }else if($array['vigencia'] == "3 años"){
                $Resultado = $array['vencimiento'];	
                }else if($array['vigencia'] == "5 años"){
                $Resultado = $array['vencimiento'];	
                }

                $sql_val = "SELECT id_requisito_legal FROM rl_requisitos_legales_calendario WHERE id_estacion = '".$id_estacion."' AND id_requisito_legal = '".$array['requisitolegal']."' ";
                $result_val = mysqli_query($this->con, $sql_val);
                $numero_val = mysqli_num_rows($result_val);

                if($numero_val == 0){

                    $sql = "SELECT nivel_gobierno FROM rl_requisitos_legales_lista WHERE id = '".$array['requisitolegal']."' LIMIT 1 ";
                    $result = mysqli_query($this->con, $sql);
                    $numero = mysqli_num_rows($result);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $NG = $row['nivel_gobierno'];

                        if($array['acuse_name'] == "") {
                        $ruta_a = "";
                        }else{
                        $ruta_a = "archivos/reuisitos-legales/"."PDF-ACUSE-".$id_estacion."-".strtotime($array['hoy']).".".$ext_acuse;
                        move_uploaded_file($array['acuse_tmp'], '../../'.$ruta_a);
                        }
                        
                        if($array['requisito_name'] == "") {
                        $ruta_rl = "";
                        }else{
                        $ruta_rl = "archivos/reuisitos-legales/"."PDF-REQUISITOL-".$id_estacion."-".strtotime($array['hoy']).".".$ext_requisito;
                        move_uploaded_file($array['requisito_tmp'], '../../'.$ruta_rl);
                        }

                        $sql_registro = "SELECT MAX(id) AS idReporte FROM rl_requisitos_legales_calendario";
                        $result_registro = mysqli_query($this->con, $sql_registro);
                        $row_registro = mysqli_fetch_array($result_registro, MYSQLI_ASSOC);
                        $idReporteRL =  $row_registro['idReporte'] + 1;

                        $sql_insert1 = "INSERT INTO rl_requisitos_legales_calendario (
                            id,
                            id_estacion,
                            id_requisito_legal,
                            nivel_gobierno,
                            requisito_legal,
                            vigencia,
                            enero,
                            febrero,
                            marzo,
                            abril,
                            mayo,
                            junio,
                            julio,
                            agosto,
                            septiembre, 
                            octubre,
                            noviembre,
                            diciembre,
                            categoria,
                            estado
                            )
                            VALUES (
                            '".$idReporteRL."', 
                            '".$id_estacion."',
                            '".$_POST['requisitolegal']."',
                            '".$NG."',
                            '',
                            '".$array['vigencia']."',
                            '".$array['ene']."',
                            '".$array['feb']."',
                            '".$array['mar']."',
                            '".$array['abr']."',
                            '".$array['may']."',
                            '".$array['jun']."',
                            '".$array['jul']."',
                            '".$array['ago']."',
                            '".$array['sep']."',
                            '".$array['oct']."',
                            '".$array['nov']."',
                            '".$array['dic']."',
                            '".$array['categoria']."',
                            1
                            )";

                            $sql_insert2 = "INSERT INTO rl_requisitos_legales_matriz (
                                idcalendario,
                                fecha_emision,  
                                fecha_vencimiento,
                                acusepdf,  
                                requisitolegalpdf, 
                                estado
                                )
                                VALUES 
                                (
                                '".$idReporteRL."', 
                                '".$array['fechaemision']."',
                                '".$Resultado."',
                                '".$ruta_a."',
                                '".$ruta_rl."',
                                1
                                )";

                            $consulta_1 = $this->sqlQuery($sql_insert1);

                            if($consulta_1){  
                            return $this->sqlQuery($sql_insert2);
                            }else{
                            return false;
                            }
                }else{
                    return false;
                }

            }

            public function editarDetalleRequisitoLegal($array){

                $sql = "UPDATE rl_requisitos_legales_calendario SET
                id_requisito_legal = '".$array['requisitolegal']."',
                vigencia = '".$array['vigencia']."',
                enero = '".$array['ene']."',
                febrero = '".$array['feb']."',
                marzo = '".$array['mar']."',
                abril = '".$array['abr']."',
                mayo = '".$array['may']."',
                junio = '".$array['jun']."',
                julio = '".$array['jul']."',
                agosto = '".$array['ago']."',
                septiembre = '".$array['sep']."',
                octubre = '".$array['oct']."',
                noviembre = '".$array['nov']."',
                diciembre = '".$array['dic']."'
                WHERE id = '".$array['id']."' ";

                return $this->sqlQuery($sql);

            }

            public function agregarRequisitoLegalHistorial($id_estacion,$array){

                $fechaemision = $array['fecha_emision'];
                $acuse = $array['acuse_name'];
                $requisito = $array['requisito_name'];
                $ext_acuse = pathinfo($array['acuse_name'], PATHINFO_EXTENSION);
                $ext_requisito = pathinfo($array['requisito_name'], PATHINFO_EXTENSION);

                $ruta_a_file = "../../archivos/reuisitos-legales/"."PDF-ACUSE-".$id_estacion."-".strtotime($array['hoy']).".".$ext_acuse;
                $ruta_rl_file = "../../archivos/reuisitos-legales/"."PDF-REQUISITOL-".$id_estacion."-".strtotime($array['hoy']).".".$ext_requisito;

                if($acuse != "") {
                $ruta_a = "archivos/reuisitos-legales/"."PDF-ACUSE-".$id_estacion."-".strtotime($array['hoy']).".".$ext_acuse;
                }else{
                $ruta_a = "";
                }

                if($requisito != "") {
                $ruta_rl = "archivos/reuisitos-legales/"."PDF-REQUISITOL-".$id_estacion."-".strtotime($array['hoy']).".".$ext_requisito;
                }else{
                $ruta_rl = "";
                }

                $sql_programa_m = "SELECT vigencia FROM rl_requisitos_legales_calendario WHERE id = '".$array['idre']."' ";
                $result_programa_m = mysqli_query($this->con, $sql_programa_m);
                $numero_programa_m = mysqli_num_rows($result_programa_m);
                while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
                $vigencia = $row_programa_m['vigencia'];
                }

                    if($vigencia == "Anual"){
                    $Resultado = $array['vencimiento'];	
                    }else if($vigencia == "Bianual"){
                    $Resultado = $array['vencimiento'];	
                    }else if($vigencia == "Permanente"){
                    $Resultado = "0000-00-00";	
                    }else if($vigencia == "Trimestral"){
                    $Resultado = $array['vencimiento'];		
                    }else if($vigencia == "Diario"){
                    $Resultado = $array['vencimiento'];	
                    }else if($vigencia == "Cuando se realice cambio"){
                    $Resultado = "0000-00-00";	
                    }else if($vigencia == "Semestral"){
                    $Resultado = $array['vencimiento'];	
                    }else if($vigencia == "Mejora continua"){
                    $Resultado = "0000-00-00";	
                    }else if($vigencia == "3 años"){
                    $Resultado = $array['vencimiento'];	
                    }else if($vigencia == "5 años"){
                    $Resultado = $array['vencimiento'];	
                    }

                    if(move_uploaded_file($array['acuse_tmp'], $ruta_a_file)) {}
                    if(move_uploaded_file($array['requisito_tmp'], $ruta_rl_file)) {}

                    echo $sql = "INSERT INTO rl_requisitos_legales_matriz (
                        idcalendario,
                        fecha_emision,  
                        fecha_vencimiento,
                        acusepdf,  
                        requisitolegalpdf, 
                        estado
                        )
                        VALUES 
                        (
                        '".$array['idre']."', 
                        '".$fechaemision."',
                        '".$Resultado."',
                        '".$ruta_a."',
                        '".$ruta_rl."',
                        1
                        )";

                        return $this->sqlQuery($sql);
            }

            public function editarRequisitoLegalHistorial($id_estacion,$array){

                $idmatriz = $array['idmatriz'];

                $acuse = $array['acuse_name'];
                $requisito = $array['requisito_name'];
                $ext_acuse = pathinfo($array['acuse_name'], PATHINFO_EXTENSION);
                $ext_requisito = pathinfo($array['requisito_name'], PATHINFO_EXTENSION);
                
                $ruta_a_file = "../../archivos/reuisitos-legales/"."PDF-ACUSE-".$id_estacion."-".strtotime($array['hoy']).".".$ext_acuse;
                $ruta_rl_file = "../../archivos/reuisitos-legales/"."PDF-REQUISITOL-".$id_estacion."-".strtotime($array['hoy']).".".$ext_requisito;
            
                if($acuse != "") {
                    $ruta_a = "archivos/reuisitos-legales/"."PDF-ACUSE-".$id_estacion."-".strtotime($array['hoy']).".".$ext_acuse;
                    }else{
                    $ruta_a = "";
                    }
                    
                    if($requisito != "") {
                    $ruta_rl = "archivos/reuisitos-legales/"."PDF-REQUISITOL-".$id_estacion."-".strtotime($array['hoy']).".".$ext_requisito;
                    }else{
                    $ruta_rl = "";
                    }
                    
                    if(move_uploaded_file($_FILES['acusepdf']['tmp_name'], $ruta_a_file)) {}
                    if(move_uploaded_file($_FILES['requisitopdf']['tmp_name'], $ruta_rl_file)) {}

                    if ($acuse != "") {
                        $sql1 = "UPDATE rl_requisitos_legales_matriz SET
                        acusepdf = '".$ruta_a."'
                        WHERE id = '".$idmatriz."' ";
                        $this->sqlQuery($sql1);
                        }
                        
                        if ($requisito != "") {
                        $sql2 = "UPDATE rl_requisitos_legales_matriz SET
                        requisitolegalpdf = '".$ruta_rl."'
                        WHERE id = '".$idmatriz."' ";
                        $this->sqlQuery($sql2);
                        }

                        if($array['fecha_emision'] != ""){
                            $sql3 = "UPDATE rl_requisitos_legales_matriz SET
                            fecha_emision = '".$array['fecha_emision']."'
                            WHERE id = '".$idmatriz."' ";
                            $this->sqlQuery($sql3);                            
                            }

                            $sql4 = "UPDATE rl_requisitos_legales_matriz SET
                            fecha_vencimiento = '".$array['fechavencimiento']."'
                            WHERE id = '".$idmatriz."' ";
                            return $this->sqlQuery($sql4);  
            }

            public function eliminarDetalleRequisitoLegal($idmatriz){
                $sql1 = "DELETE FROM rl_requisitos_legales_matriz WHERE id = '".$idmatriz."' ";
                return $this->sqlQuery($sql1); 
            }

            public function eliminarRequisitoLegal($idre){

                $sql = "DELETE FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' ";
                $sql1 = "DELETE FROM rl_requisitos_legales_calendario WHERE id = '".$idre."' ";

                $val1 = $this->sqlQuery($sql); 
                if($val1){
                    return $this->sqlQuery($sql1);
                }else{
                    return false;
                }

            }

            //-------------------------------------------------------------------------------------------------------

            public function RequisitosLegales($idEstacion,$NivelGobierno){
                $contenido = "";
                $sql = "SELECT
                rl_requisitos_legales_calendario.id,
                rl_requisitos_legales_calendario.nivel_gobierno,
                rl_requisitos_legales_calendario.vigencia,
                rl_requisitos_legales_calendario.id_requisito_legal,
                rl_requisitos_legales_calendario.estado,
                rl_requisitos_legales_lista.dependencia,
                rl_requisitos_legales_lista.permiso,
                rl_requisitos_legales_lista.fundamento
                FROM rl_requisitos_legales_calendario
                INNER JOIN 
                rl_requisitos_legales_lista ON 
                rl_requisitos_legales_calendario.id_requisito_legal = rl_requisitos_legales_lista.id
                WHERE rl_requisitos_legales_calendario.id_estacion = '".$idEstacion."' AND rl_requisitos_legales_calendario.nivel_gobierno = '".$NivelGobierno."' AND rl_requisitos_legales_calendario.estado = 1 ORDER BY dependencia ASC";
                $result = mysqli_query($this->con, $sql);
                $numero = mysqli_num_rows($result);
                
                $contenido .= '<table class="table table-bordered table-sm">';
                $contenido .= '<thead>';
                $contenido .= '<tr class="bg-light">
                <th class="align-middle">Dependencia</th>
                <th class="align-middle">Permiso</th>
                <th class="align-middle">Fundamento</th>
                </tr>';
                $contenido .= '</thead>';
                $contenido .= '<tbody>';
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                
                $idrequisitol = $row['id_requisito_legal'];
                $idre = $row['id'];
                $vigencia = $row['vigencia'];
                
                  $UltimaA = $this->UltimaAct($idre);
                
                  if($UltimaA['fechaemision'] == "S/I"){
                  $fechaEmision = $UltimaA['fechaemision'];
                  }else{
                  $fechaEmision = FormatoFecha($UltimaA['fechaemision']);
                  }
                
                  if($UltimaA['fechavencimiento'] == "S/I"){
                  $fechaVencimiento = $UltimaA['fechavencimiento'];
                  }else{
                  $fechaVencimiento = FormatoFecha($UltimaA['fechavencimiento']);
                  }
                
                $contenido .= '<tr>
                <td class="align-middle"><b>'.$row['dependencia'].'</b></td>
                <td class="align-middle"><b>'.$row['permiso'].'</b></td>
                <td class="align-middle">'.$row['fundamento'].'</td>
                </tr>';
                
                }
                $contenido .= '</tbody>';
                $contenido .= '</table>';
                
                return $contenido;
                }
                        

}