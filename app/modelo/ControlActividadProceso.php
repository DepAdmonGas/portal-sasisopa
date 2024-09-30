<?php
class ControlActividadProceso
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

    private function idProgramaAnual(){

        $sql = "SELECT id FROM po_programa_anual_mantenimiento ORDER BY id desc limit 1";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if ($numero > 0) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $id = $row['id'] + 1;
        }
        }else{
        $id = 1;
        }

        return $id;
    }

    public function agregarProgramaAnual($id_estacion,$year){

        $sql = "SELECT id FROM po_programa_anual_mantenimiento WHERE id_estacion = '".$id_estacion."' AND year = '".$year."'";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        
        if ($numero > 0) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $idreporte = $row['id'];
        }
        }else{
        
        $id = $this->idProgramaAnual(); 
        
        $sql_insert = "INSERT INTO po_programa_anual_mantenimiento (id, id_estacion,year,estado)
        VALUES (
        '".$id."','".$id_estacion."','".$year."',0)";

        if($this->sqlQuery($sql_insert)){
        $idreporte = $id;
        }else{
        return false;
        }
        
        }
        return $idreporte;

    }

    public function yearProgramaAnual($idReporte){

        $sql = "SELECT year FROM po_programa_anual_mantenimiento WHERE id = '".$idReporte."' ";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['year'];

    }

    public function validaMesAnterior($id_estacion,$id_reporte,$year_anterior){

        $sql = "SELECT id FROM po_programa_anual_mantenimiento WHERE id_estacion = '".$id_estacion."' AND year = '".$year_anterior."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if ($numero == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $idYearAnte = $row['id'];        
        $this->CreaPrograma($id_estacion,$idYearAnte, $id_reporte);
        }

    }

    function CreaPrograma($id_estacion,$idYearAnte, $idReporte){

        $year_anterior = $this->yearProgramaAnual($idYearAnte);

        $sql_mantenimiento_lista = "SELECT po_mantenimiento_lista.id, po_mantenimiento_lista.detalle, po_mantenimiento_lista.periodicidad, po_programa_anual_mantenimiento_detalle.id AS idreporte, po_programa_anual_mantenimiento_detalle.id_programa_fecha, po_programa_anual_mantenimiento_detalle.enero,po_programa_anual_mantenimiento_detalle.febrero,po_programa_anual_mantenimiento_detalle.marzo,po_programa_anual_mantenimiento_detalle.abril,po_programa_anual_mantenimiento_detalle.mayo,po_programa_anual_mantenimiento_detalle.junio,po_programa_anual_mantenimiento_detalle.julio,po_programa_anual_mantenimiento_detalle.agosto,po_programa_anual_mantenimiento_detalle.septiembre,po_programa_anual_mantenimiento_detalle.octubre,po_programa_anual_mantenimiento_detalle.noviembre,po_programa_anual_mantenimiento_detalle.diciembre FROM po_mantenimiento_lista INNER JOIN po_programa_anual_mantenimiento_detalle ON po_mantenimiento_lista.id = po_programa_anual_mantenimiento_detalle.id_mantenimiento WHERE po_programa_anual_mantenimiento_detalle.id_programa_fecha = '".$idYearAnte."' ";
        $result_mantenimiento_lista = mysqli_query($this->con, $sql_mantenimiento_lista);
        $numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
        while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){
        $idMantenimiento = $row_mantenimiento_lista['id'];
        $periodicidad = $row_mantenimiento_lista['periodicidad'];
        
        $enero = $row_mantenimiento_lista['enero'];
        $febrero = $row_mantenimiento_lista['febrero'];
        $marzo = $row_mantenimiento_lista['marzo'];
        $abril = $row_mantenimiento_lista['abril'];
        $mayo = $row_mantenimiento_lista['mayo'];
        $junio = $row_mantenimiento_lista['junio'];
        $julio = $row_mantenimiento_lista['julio'];
        $agosto = $row_mantenimiento_lista['agosto'];
        $septiembre = $row_mantenimiento_lista['septiembre'];
        $octubre = $row_mantenimiento_lista['octubre'];
        $noviembre = $row_mantenimiento_lista['noviembre'];
        $diciembre = $row_mantenimiento_lista['diciembre'];
        
        $sql_programa = "SELECT id FROM po_programa_anual_mantenimiento_detalle WHERE id_programa_fecha = '".$idReporte."' AND id_mantenimiento = '".$idMantenimiento."' ";
        $result_programa = mysqli_query($this->con, $sql_programa);
        $numero_programa = mysqli_num_rows($result_programa);
        
        if ($numero_programa == 0) {
        
        if ($periodicidad == "Semanal" || $periodicidad == "Mensual" || $periodicidad == "Trimestral" || $periodicidad == "Cuatrimestral" || $periodicidad == "Semestral" || $periodicidad == "Anual" || $periodicidad == "Determinado por el Representante Legal") {
        
        if ($enero == "0000-00-00") {
        $mes1 = "0000-00-00";
        }else{
        $mes1 = date("Y-m-d",strtotime($enero."+ 1 year"));
        
        }
        
        if ($febrero == "0000-00-00") {
        $mes2 = "0000-00-00";
        }else{
        $mes2 = date("Y-m-d",strtotime($febrero."+ 1 year"));
        }
        
        if ($marzo == "0000-00-00") {
        $mes3 = "0000-00-00";
        }else{
        $mes3 = date("Y-m-d",strtotime($marzo."+ 1 year"));
        }
        
        if ($abril == "0000-00-00") {
        $mes4 = "0000-00-00";
        }else{
        $mes4 = date("Y-m-d",strtotime($abril."+ 1 year"));
        }
        
        if ($mayo == "0000-00-00") {
        $mes5 = "0000-00-00";
        }else{
        $mes5 = date("Y-m-d",strtotime($mayo."+ 1 year"));
        }
        
        if ($junio == "0000-00-00") {
        $mes6 = "0000-00-00";
        }else{
        $mes6 = date("Y-m-d",strtotime($junio."+ 1 year"));
        }
        
        if ($julio == "0000-00-00") {
        $mes7 = "0000-00-00";
        }else{
        $mes7 = date("Y-m-d",strtotime($julio."+ 1 year"));
        }
        
        if ($agosto == "0000-00-00") {
        $mes8 = "0000-00-00";
        }else{
        $mes8 = date("Y-m-d",strtotime($agosto."+ 1 year"));
        }
        
        if ($septiembre == "0000-00-00") {
        $mes9 = "0000-00-00";
        }else{
        $mes9 = date("Y-m-d",strtotime($septiembre."+ 1 year"));
        }
        
        if ($octubre == "0000-00-00") {
        $mes10 = "0000-00-00";
        }else{
        $mes10 = date("Y-m-d",strtotime($octubre."+ 1 year"));
        }
        
        if ($noviembre == "0000-00-00") {
        $mes11 = "0000-00-00";
        }else{
        $mes11 = date("Y-m-d",strtotime($noviembre."+ 1 year"));
        }
        
        if ($diciembre == "0000-00-00") {
        $mes12 = "0000-00-00";
        }else{
        $mes12 = date("Y-m-d",strtotime($diciembre."+ 1 year"));
        }
        
        $sql_insert = "INSERT INTO po_programa_anual_mantenimiento_detalle (id_programa_fecha,id_mantenimiento,ultimafecha,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,estado)
        VALUES (
        '".$idReporte."',
        '".$idMantenimiento."',
        '',
        '".$mes1."',
        '".$mes2."',
        '".$mes3."',
        '".$mes4."',
        '".$mes5."',
        '".$mes6."',
        '".$mes7."',
        '".$mes8."',
        '".$mes9."',
        '".$mes10."',
        '".$mes11."',
        '".$mes12."',
        1
        )";
        $this->sqlQuery($sql_insert);
        
        }else if ($periodicidad == "Bianual") {
        
        if ($enero == "0000-00-00") {
        $mes1 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $enero);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes1 = $enero;
        }else if($YearNu > $YearAn){
        $mes1 = date("Y-m-d",strtotime($enero."+ 2 year"));
        }
        }
        
        if ($febrero == "0000-00-00") {
        $mes2 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $febrero);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes2 = $febrero;
        }else if($YearNu > $YearAn){
        $mes2 = date("Y-m-d",strtotime($febrero."+ 2 year"));
        }
        }
        
        if ($marzo == "0000-00-00") {
        $mes3 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $marzo);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes3 = $marzo;
        }else if($YearNu > $YearAn){
        $mes3 = date("Y-m-d",strtotime($marzo."+ 2 year"));
        }
        }
        
        if ($abril == "0000-00-00") {
        $mes4 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $abril);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes4 = $abril;
        }else if($YearNu > $YearAn){
        $mes4 = date("Y-m-d",strtotime($abril."+ 2 year"));
        }
        }
        
        if ($mayo == "0000-00-00") {
        $mes5 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $mayo);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes5 = $mayo;
        }else if($YearNu > $YearAn){
        $mes5 = date("Y-m-d",strtotime($mayo."+ 2 year"));
        }
        }
        
        if ($junio == "0000-00-00") {
        $mes6 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $junio);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes6 = $junio;
        }else if($YearNu > $YearAn){
        $mes6 = date("Y-m-d",strtotime($junio."+ 2 year"));
        }
        }
        
        if ($julio == "0000-00-00") {
        $mes7 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $julio);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes7 = $julio;
        }else if($YearNu > $YearAn){
        $mes7 = date("Y-m-d",strtotime($julio."+ 2 year"));
        }
        }
        
        if ($agosto == "0000-00-00") {
        $mes8 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $agosto);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes8 = $agosto;
        }else if($YearNu > $YearAn){
        $mes8 = date("Y-m-d",strtotime($agosto."+ 2 year"));
        }
        }
        
        if ($septiembre == "0000-00-00") {
        $mes9 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $septiembre);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes9 = $septiembre;
        }else if($YearNu > $YearAn){
        $mes9 = date("Y-m-d",strtotime($septiembre."+ 2 year"));
        }
        }
        
        if ($octubre == "0000-00-00") {
        $mes10 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $octubre);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes10 = $octubre;
        }else if($YearNu > $YearAn){
        $mes10 = date("Y-m-d",strtotime($octubre."+ 2 year"));
        }
        }
        
        if ($noviembre == "0000-00-00") {
        $mes11 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $noviembre);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes11 = $noviembre;
        }else if($YearNu > $YearAn){
        $mes11 = date("Y-m-d",strtotime($noviembre."+ 2 year"));
        }
        }
        
        if ($diciembre == "0000-00-00") {
        $mes12 = "0000-00-00";
        }else{
        $ExplodeAn = explode("-", $diciembre);
        $YearAn = $ExplodeAn[0];
        $YearNu = date("Y");
        
        if ($YearAn == $YearNu) {
        $mes12 = $diciembre;
        }else if($YearNu > $YearAn){
        $mes12 = date("Y-m-d",strtotime($diciembre."+ 2 year"));
        }
        }
        
        $sql_insert2 = "INSERT INTO po_programa_anual_mantenimiento_detalle (id_programa_fecha,id_mantenimiento,ultimafecha,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,estado)
        VALUES (
        '".$idReporte."',
        '".$idMantenimiento."',
        '',
        '".$mes1."',
        '".$mes2."',
        '".$mes3."',
        '".$mes4."',
        '".$mes5."',
        '".$mes6."',
        '".$mes7."',
        '".$mes8."',
        '".$mes9."',
        '".$mes10."',
        '".$mes11."',
        '".$mes12."',
        1
        )";
        $this->sqlQuery($sql_insert2);
        
        }           
        }   

        //---------------------------------------------------------------
        //---------------------------------------------------------------
        if ($periodicidad == "Semanal"){
        $this->ultimaFechaSemanal($id_estacion,$idMantenimiento,$year_anterior);
        }

        }
        }

        public function ultimaFechaSemanal($id_estacion,$idMantenimiento,$year_anterior){
            $sql = "SELECT fecha FROM po_programa_anual_mantenimiento_calendario WHERE id_estacion = '".$id_estacion."' AND id_mantenimiento = '".$idMantenimiento."' AND YEAR(fecha) = '".$year_anterior."' ORDER BY fecha DESC LIMIT 1 ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);	
            if($numero > 0){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $fecha = $row['fecha'];
            $this->mantenimientoSemanal($id_estacion,$idMantenimiento,$fecha);
            }
        }

        public function txtFecha($fecha){
            $resultado = "";
            if($fecha != "0000-00-00"){
            $formato_fecha = explode("-",$fecha);
            $resultado = "<b>".$formato_fecha[2]."</b>.".substr(nombremes($formato_fecha[1]),0,3).".".substr($formato_fecha[0],-2,2);
            }
            return $resultado;
            }
            
            public function ColorTD($fecha){
            $fecha_del_dia = date("Y-m-d");
            
            if($fecha == "0000-00-00"){
            $resultado = "table-secondary";
            }else{
            
            $nuevafecha = strtotime ( '-3 day' , strtotime ($fecha)) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha);
            
            if ($fecha_del_dia == $fecha) 
            {
            $resultado = "table-danger";
            }
            else if ($fecha_del_dia > $fecha) 
            {
            $resultado = "table-success";  
            }
            else if ($fecha_del_dia >= $nuevafecha) 
            {
            $resultado = "table-warning";  
            }else{
              $resultado = "table-active";
            }
            
            }
            
            return $resultado;  
            }
            
            public function txtColor($fecha){

            $fecha_del_dia = date("Y-m-d");
            $nuevafecha = strtotime ( '-3 day' , strtotime ($fecha)) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha);
            
            if ($fecha_del_dia == $fecha) 
            {
            $resultado = "text-danger";
            }
            else if ($fecha_del_dia > $fecha) 
            {
            $resultado = "text-secondary";
            }
            else if ($fecha_del_dia >= $nuevafecha) 
            {
            $resultado = "text-danger";  
            }else{
              $resultado = "text-black";
            }
            
            return $resultado;  
            }

            public function Comprobar($id_reporte,$id){

                $sql = "SELECT id FROM po_programa_anual_mantenimiento_detalle WHERE id_programa_fecha = '".$id_reporte."' AND id_mantenimiento = '".$id."' ";
                $result = mysqli_query($this->con, $sql);
                $numero = mysqli_num_rows($result);	
                if ($numero > 0) {
                $result = 1;
                }else{
                $result = 0;
                }
                return $result;
            }

        public function buscarPeriodicidad($id_select){
            $sql = "SELECT periodicidad FROM po_mantenimiento_lista WHERE id = '".$id_select."' ";
            $result = mysqli_query($this->con, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return $row['periodicidad'];
        }

        public function agregarEquipoInstalacion($id_estacion,$id_reporte,$id,$fecha,$select){

            if ($id  != 43) {
                $sql = "SELECT periodicidad FROM po_mantenimiento_lista WHERE id = '".$id."' ";
                $result = mysqli_query($this->con, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $periodicidad = $row['periodicidad'];
            }else{
                $periodicidad = $select;
            }

                $mes1 = $this->valida($periodicidad,$fecha,'01');
                $mes2 = $this->valida($periodicidad,$fecha,'02');
                $mes3 = $this->valida($periodicidad,$fecha,'03');
                $mes4 = $this->valida($periodicidad,$fecha,'04');
                $mes5 = $this->valida($periodicidad,$fecha,'05');
                $mes6 = $this->valida($periodicidad,$fecha,'06');
                $mes7 = $this->valida($periodicidad,$fecha,'07');
                $mes8 = $this->valida($periodicidad,$fecha,'08');
                $mes9 = $this->valida($periodicidad,$fecha,'09');
                $mes10 = $this->valida($periodicidad,$fecha,'10');
                $mes11 = $this->valida($periodicidad,$fecha,'11');
                $mes12 = $this->valida($periodicidad,$fecha,'12');
    
                $sql_insert = "INSERT INTO po_programa_anual_mantenimiento_detalle (id_programa_fecha,id_mantenimiento,ultimafecha,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,estado)
                VALUES (
                '".$id_reporte."',
                '".$id."',
                '".$fecha."',
                '".$mes1."',
                '".$mes2."',
                '".$mes3."',
                '".$mes4."',
                '".$mes5."',
                '".$mes6."',
                '".$mes7."',
                '".$mes8."',
                '".$mes9."',
                '".$mes10."',
                '".$mes11."',
                '".$mes12."',
                1
                )";
            
            $this->sqlQuery($sql_insert);

            if($periodicidad == 'Semanal'){
            $this->mantenimientoSemanal($id_estacion,$id,$fecha);
            }
            return true;
            $this->class_base_datos->desconectarBD($this->con);

        }

        public function mantenimientoSemanal($id_estacion,$id,$fecha){
            for ($i = 1; $i <= 53; $i++) {         
            $semana = date("Y-m-d",strtotime($fecha."+ $i week")); 
            $validacion = $this->ValidaMantenimientoSemanal($id_estacion,$id,$semana);
            if($validacion == 0){
                $sql_insert = "INSERT INTO po_programa_anual_mantenimiento_calendario (id_estacion,id_mantenimiento, fecha)
                VALUES (
                '".$id_estacion."',
                '".$id."',
                '".$semana."'
                )";        
                $this->sqlQuery($sql_insert);
            }
            }
            return true;
        }

       
          public function buscaFechaSemanal($id_estacion,$id,$year,$mes){
            $sql = "SELECT fecha FROM po_programa_anual_mantenimiento_calendario WHERE id_estacion = '".$id_estacion."' AND id_mantenimiento = '".$id."' AND YEAR(fecha) = '".$year."' AND MONTH(fecha) = '".$mes."' ORDER BY fecha DESC LIMIT 1 ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);	
            if($numero > 0){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $fecha = $row['fecha'];
            }else{
                $fecha = '0000-00-00';
            }
            
            return $fecha;
          }

        public function ValidaMantenimientoSemanal($id_estacion,$id,$fecha){
            $sql = "SELECT id FROM po_programa_anual_mantenimiento_calendario WHERE id_estacion = '".$id_estacion."' AND id_mantenimiento  = '".$id."' AND fecha = '".$fecha."' ";
            $result = mysqli_query($this->con, $sql);
            return mysqli_num_rows($result);
        }

        public function getUltimoDiaMes($elAnio,$elMes) {
        return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
        }

        public function valida($periodo,$fecha,$mes){

            $newperiodo = strtolower($periodo);
            
            if ($newperiodo == "semanal") {
            
            $resultado = "";
                
            }else if ($newperiodo == "mensual") {
            
            $formato_fecha = explode("-",$fecha);
            $dia = $formato_fecha[2];
            
            $ultimoDia = $this->getUltimoDiaMes($formato_fecha[0],$mes);
            
            if ($dia > $ultimoDia) {
            $resultado = $formato_fecha[0]."-".$mes."-".$ultimoDia;
            }else{
            $resultado = $formato_fecha[0]."-".$mes."-".$formato_fecha[2];
            }
            
            }else if ($newperiodo == "trimestral") {
            
            $formato_fecha = explode("-",$fecha);
            
            if ($formato_fecha[0] == intval(date("Y"))) {
            
            if ($formato_fecha[1] > $mes) {
            for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 3) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }else{	
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 3) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }
            }else{
            $nuevafecha = strtotime ( '+3 month' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
            $formato_fecha = explode("-",$nuevafecha);
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 3) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }
            }else if ($newperiodo == "cuatrimestral") {
            
            $formato_fecha = explode("-",$fecha);
            
            if ($formato_fecha[0] == intval(date("Y"))) {
            
            if ($formato_fecha[1] > $mes) {
            for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 4) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }else{	
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 4) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }
            }else{
            $nuevafecha = strtotime ( '+4 month' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
            $formato_fecha = explode("-",$nuevafecha);
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 4) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }
            }else if ($newperiodo == "semestral") {
            
            $formato_fecha = explode("-",$fecha);
            
            if ($formato_fecha[0] == intval(date("Y"))) {
            
            if ($formato_fecha[1] > $mes) {
            for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 6) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }else{	
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 6) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }
            }else{
            $nuevafecha = strtotime ( '+6 month' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
            $formato_fecha = explode("-",$nuevafecha);
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 6) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }
            }else if ($newperiodo == "anual") {
            $formato_fecha = explode("-",$fecha);
            
            if ($formato_fecha[0] == intval(date("Y"))) {
            
            if ($formato_fecha[1] > $mes) {
            for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 12) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }else{	
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 12) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }
            }else{
            $nuevafecha = strtotime ( '+12 month' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
            $formato_fecha = explode("-",$nuevafecha);
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 12) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }
            }else if ($newperiodo == "bianual") {
            $formato_fecha = explode("-",$fecha);
            
            if ($formato_fecha[0] == intval(date("Y"))) {
            
            if ($formato_fecha[1] > $mes) {
            for ($i = intval($formato_fecha[1]); $i >= $mes; $i = $i - 24) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }else{	
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 24) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }
            }else{
            $nuevafecha = strtotime ( '+24 month' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
            $formato_fecha = explode("-",$nuevafecha);
            
            if ($formato_fecha[0] == intval(date("Y"))) {
            for ($i = intval($formato_fecha[1]); $i <= $mes; $i = $i + 24) {
            if ($i == $mes) {
            $resultado = $formato_fecha[0]."-".$i."-".$formato_fecha[2];
            }else{
            $resultado = "";	
            }
            }
            }else{
            $resultado = "";	
            }
            
            }
            }
            return $resultado;	
            }

        public function eliminarEquipoInstalacion($id){
        $sql = "DELETE FROM po_programa_anual_mantenimiento_detalle WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        }

        public function editarEquipoInstalacion($array){

            $sql = "UPDATE po_programa_anual_mantenimiento_detalle SET
            enero = '".$array['Enero']."',
            febrero = '".$array['Febrero']."',
            marzo = '".$array['Marzo']."',
            abril = '".$array['Abril']."',
            mayo = '".$array['Mayo']."',
            junio = '".$array['Junio']."',
            julio = '".$array['Julio']."',
            agosto = '".$array['Agosto']."',
            septiembre = '".$array['Septiembre']."',
            octubre = '".$array['Octubre']."',
            noviembre = '".$array['Noviembre']."',
            diciembre = '".$array['Diciembre']."'
            WHERE id = '".$array['id']."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

        }

        //--------------------------------------------------------------------------------------------
        //--------------------------------------------------------------------------------------------

        public function agregarAccesoTrabajador($id_estacion,$id_usuario,$categoria){
            $sql = "INSERT INTO tb_usuarios_firma_bitacora (
                id_estacion,
                id_usuario,
                categoria,
                comentario,
                estado
                )
                VALUES 
                (
                '".$id_estacion."', 
                '".$id_usuario."',
                '".$categoria."',
                '',
                1
                )";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
        }

        public function eliminarFirmaPersonal($id_firma,$comentario,$hoy){
        
            $sql = "UPDATE tb_usuarios_firma_bitacora SET
            fechatermino = '".$hoy."',
            comentario = '".$comentario."',
            estado = 0 
            WHERE id = '".$id_firma."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

        }

        public function FormatFolio($Folio){
            $NumString = strlen($Folio);     
            if($NumString == 1){
                $resultado = "00".$Folio;    
            }else if($NumString == 2){
                $resultado = "0".$Folio;    
            }else if($NumString == 3){
                $resultado = $Folio;    
            }
            return $resultado;    
        }

        public function recepcionDescargaFirma($idRecepcion,$tipoFirma,$width){

            $ruta = "http://portal.admongas.com.mx/bitacora-api-app/app/Recepcion/ImagenFirma/";
            $sql = "SELECT
            tb_recepcion_descargar_firma.imagen_firma,
            tb_usuarios.nombre
            FROM tb_recepcion_descargar_firma
            INNER JOIN tb_usuarios 
            ON tb_recepcion_descargar_firma.id_usuario = tb_usuarios.id
            WHERE tb_recepcion_descargar_firma.id_recepcion_descarga = '".$idRecepcion."' AND tb_recepcion_descargar_firma.tipo_firma = '".$tipoFirma."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            if($numero > 0){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);            
            $nombre = $row['nombre'];
            $firma = $row['imagen_firma'];
            
            return array('nombre' => $nombre, 'firma' => "<img width='".$width."' src='".$ruta.$firma."' />");
            }else{
            return array('nombre' => '', 'firma' => '');    
            }
        }

        public function recepcionDescargaFirmaPdf($idRecepcion,$tipoFirma,$width){

            $ruta = "http://portal.admongas.com.mx/bitacora-api-app/app/Recepcion/ImagenFirma/";
            $sql = "SELECT
            tb_recepcion_descargar_firma.imagen_firma,
            tb_usuarios.nombre
            FROM tb_recepcion_descargar_firma
            INNER JOIN tb_usuarios 
            ON tb_recepcion_descargar_firma.id_usuario = tb_usuarios.id
            WHERE tb_recepcion_descargar_firma.id_recepcion_descarga = '".$idRecepcion."' AND tb_recepcion_descargar_firma.tipo_firma = '".$tipoFirma."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            if($numero > 0){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);            
            $nombre = $row['nombre'];
            $firma = $row['imagen_firma'];

            $type = pathinfo($firma, PATHINFO_EXTENSION);
            $Data = file_get_contents($ruta.$firma);
            $base = 'data:image/' . $type . ';base64,' . base64_encode($Data);
            
            return array('nombre' => $nombre, 'firma' => "<img width='".$width."' src='".$base."' />");
            }else{
            return array('nombre' => '', 'firma' => '');    
            }
        }
        
        public function recepcionDescargaSellos($idRecepcion,$verificar){
        
            $sql = "SELECT verificar, resultado FROM tb_recepcion_descargar_sellos WHERE id_recepcion_descarga = '".$idRecepcion."'  AND verificar = '".$verificar."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            if($numero > 0){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $verificar = $row['verificar'];
            $resultado = $row['resultado'];
            return array('verificar' => $verificar, 'resultado' => $resultado);
            }else{
            return array('verificar' => '', 'resultado' => '');  
            }
        
        }

        public function recepcionDescargaTanques($id,$litros_compra){

            $return = "";
            $TotalII = 0;
            $TotalIF = 0;
    
            $return .= "<table class='table-bordered table-sm' width='100%'>";
            $return .= "<tr bgcolor='#F5F5F5'>";
            $return .= "<td ><b>No. Tanque</b></td>";
            $return .= "<td ><b>Inventario Inicial</b></td>";
            $return .= "<td ><b>Inventario Final</b></td>";
            $return .= "<td ><b>Aditivacón</b></td>";
            $return .= "</tr>";
    
            $sql = "SELECT 
            tb_recepcion_descargar_tanque.id,
            tb_recepcion_descargar_tanque.idlista,
            tb_recepcion_descargar_tanque.inventario_inicial,
            tb_recepcion_descargar_tanque.inventario_final,
            tb_recepcion_descargar_tanque.aditivacion,
            tb_tanque_almacenamiento.no_tanque
            FROM tb_recepcion_descargar_tanque
            INNER JOIN tb_tanque_almacenamiento 
            ON tb_recepcion_descargar_tanque.id_tanque = tb_tanque_almacenamiento.id
            WHERE tb_recepcion_descargar_tanque.id_recepcion_descarga = '".$id."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
       
            $return .= "<tr>";
            $return .= "<td ><b>".$row['no_tanque']."</b></td>";
            $return .= "<td >".number_format($row['inventario_inicial'],2)."</td>";
            $return .= "<td >".number_format($row['inventario_final'],2)."</td>";
            $return .= "<td >".$row['aditivacion']."</td>";
            $return .= "</tr>";
    
            $TotalII = $TotalII + $row['inventario_inicial'];
            $TotalIF = $TotalIF + $row['inventario_final'];
    
            }
    
            $sumacompra = $TotalII + $litros_compra;
            $Merma = $TotalIF - $sumacompra;
    
            $return .= "<tr>";
            $return .= "<td colspan='4' style='padding: 5px;text-align: center;'>Merma: <b>".number_format($Merma,2)."</b></td>";
            $return .= "</tr>";
            $return .= "</table>";
            
            return $return;

        }

        //------------------------------------------------------------------------------------------------------------------------------
        //------------------------------------------------------------------------------------------------------------------------------

        public function agregarEvidenciaMantenimientoPreventivo($id_mantenimiento,$file_name,$file_tmp_name,$hoy){

           
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            
            $ruta_file = "../../archivos/mantenimiento/"."MANTENIMIENTOP-".$id_mantenimiento."-".strtotime($hoy).".".$extension;
            
            if($file_name != "") {
            $ruta_protocolo = "http://portal.admongas.com.mx/portal-sasisopa/archivos/mantenimiento/"."MANTENIMIENTOP-".$id_mantenimiento."-".strtotime($hoy).".".$extension;
            }else{
            $ruta_protocolo = "";
            }
            
            if(move_uploaded_file($file_tmp_name, $ruta_file)) {
            
                $sql = "INSERT INTO po_mantenimiento_verificar_evidencias (
                    id_mantenimiento,
                    url
                    )
                    VALUES 
                    (
                    '".$id_mantenimiento."',
                    '".$ruta_protocolo."'
                    )";
                    return $this->sqlQuery($sql);

            }else{
                return false;
            }
         
            $this->class_base_datos->desconectarBD($this->con);
        }

        public function eliminarEvidenciaMantenimientoPreventivo($id_evidencia){
            $sql = "DELETE FROM po_mantenimiento_verificar_evidencias WHERE id = '".$id_evidencia."'";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
        }

        //------------------------------------------------------------------------------------------------------------------------------
        //------------------------------------------------------------------------------------------------------------------------------

        public function agregarExtintor($id_estacion,$no_extintor,$ubicacion,$fecha_recarga,$tipo_extintor,$peso){

            $sql = "INSERT INTO po_extintores_estacion (
                id_estacion,
                no_extintor,
                ubicacion,
                ultima_recarga,
                tipo_extintor,
                peso_kg,
                estado
                )
                VALUES 
                (
                '".$id_estacion."',
                '".$no_extintor."',
                '".$ubicacion."',
                '".$fecha_recarga."',
                '".$tipo_extintor."',
                '".$peso."',
                1
                )";

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

        }

        public function editarExtintor($id_extintor,$no_extintor,$ubicacion,$fecha_recarga,$tipo_extintor,$peso){

            $sql = "UPDATE po_extintores_estacion SET
            no_extintor = '".$no_extintor."',
            ubicacion = '".$ubicacion."',
            ultima_recarga = '".$fecha_recarga."',
            tipo_extintor = '".$tipo_extintor."',
            peso_kg = '".$peso."'
            WHERE id = '".$id_extintor."' ";

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

        }

        public function eliminarExtintor($id_extintor){

            $sql = "UPDATE po_extintores_estacion SET
            estado = 0
            WHERE id = '".$id_extintor."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

        }

    //----------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------

    public function firmaMantenimientoCorrectivo($id_mantenimiento, $tipo_firma){
        $sql = "SELECT nombre,imagen_firma FROM po_mantenimiento_correctivo_firma WHERE id_mantenimiento = '".$id_mantenimiento."'  AND tipo_firma = '".$tipo_firma."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);          
        return array('nombre' => $row['nombre'], 'firma' => $row['imagen_firma']);
    }

    public function actualizarMantenimientoCorrectivo($id_mantenimiento,$equipo_area,$hallazgo,$mantenimiento,$herramienta){

        $sql = "UPDATE po_mantenimiento_correctivo SET
        nombre_equipo = '".$equipo_area."',
        descripcion_hallazgo = '".$hallazgo."',
        descripcion_actividad = '".$mantenimiento."',
        herramienta = '".$herramienta."'
        WHERE id = '".$id_mantenimiento."' ";

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarEvidenciaMantenimientoCorrectivo($id_mantenimiento,$file_name,$file_tmp_name,$hoy){
      
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
        $ruta_file = "../../archivos/mantenimiento/"."MANTENIMIENTOC-".$id_mantenimiento."-".strtotime($hoy).".".$extension;
        
        if($file_name != "") {
        //---- Cambiar demo por portal
        $ruta_protocolo = "http://portal.admongas.com.mx/portal-sasisopa/archivos/mantenimiento/"."MANTENIMIENTOC-".$id_mantenimiento."-".strtotime($hoy).".".$extension;
        }else{
        $ruta_protocolo = "";
        }
        
        if(move_uploaded_file($file_tmp_name, $ruta_file)) {
                
        $sql = "INSERT INTO po_mantenimiento_correctivo_evidencia (
        id_mantenimiento,
        url
        )
        VALUES 
        (
        '".$id_mantenimiento."',
        '".$ruta_protocolo."'
        )";

        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        
        }else{
        return false;
        }

    }

    public function eliminarEvidenciaMantenimientoCorrectivo($id_evidencia){

        $sql = "DELETE FROM po_mantenimiento_correctivo_evidencia WHERE id = '".$id_evidencia."'";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }
    //----------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------
    //---- Calibración de equipos

    public function agregarTanqueAlmacenamiento($id_estacion,$no_tanque,$capacidad,$producto){

        $sql = "INSERT INTO tb_tanque_almacenamiento (
            id_estacion,
            no_tanque,
            capacidad,
            producto
            )
            VALUES 
            (
            '".$id_estacion."',
            '".$no_tanque."',
            '".$capacidad."',
            '".$producto."'
            )";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
    }

    public function eliminarTanqueAlmacenamiento($id_tanque){
    
        $sql = "DELETE FROM tb_tanque_almacenamiento WHERE id = '".$id_tanque."'  ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarTanqueAlmacenamiento($id_taqnue,$no_tanque,$capacidad,$producto){

        $sql = "UPDATE tb_tanque_almacenamiento SET
        no_tanque = '".$no_tanque."',
        capacidad = '".$capacidad."',
        producto = '".$producto."'
        WHERE id = '".$id_taqnue."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    function agregarDispensario($id_estacion,$no_dispensario,$marca,$modelo,$serie,$producto1,$produccto2,$producto3){
        
        $sql = "INSERT INTO tb_dispensarios (
            id_estacion,
            no_dispensario,
            marca,
            modelo,
            serie,
            producto1,
            producto2,
            producto3,
            estado
            )
            VALUES 
            (
            '".$id_estacion."',
            '".$no_dispensario."',
            '".$marca."',
            '".$modelo."',
            '".$serie."',
            '".$producto1."',
            '".$produccto2."',
            '".$producto3."',
            1
            )";

            return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function eliminarDispensario($id_dispensario){

        $sql = "UPDATE tb_dispensarios SET
        estado = 0
         WHERE id = '".$id_dispensario."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function agregarSondaMedicion($id_estacion,$no_sonda,$marca,$modelo,$ubicacion){

        $sql = "INSERT INTO tb_sondas_medicion (
            id_estacion,
            no_sonda,
            marca,
            modelo,
            ubicacion
            )
            VALUES 
            (
            '".$id_estacion."',
            '".$no_sonda."',
            '".$marca."',
            '".$modelo."',
            '".$ubicacion."'
            )";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
    }

    public function eliminarSondaMedicion($id_sonda){

        $sql = "DELETE FROM tb_sondas_medicion WHERE id = '".$id_sonda."'  ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarSondaMedicion($id_sonda,$no_sonda,$marca,$modelo,$ubicacion){

        $sql = "UPDATE tb_sondas_medicion SET
        no_sonda = '".$no_sonda."',
        marca = '".$marca."',
        modelo = '".$modelo."',
        ubicacion = '".$ubicacion."'
        WHERE id = '".$id_sonda."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarJarraPatron($id_estacion,$marca,$no_serie,$capacidad,$material){

        $sql = "INSERT INTO tb_jarra_patron (
            id_estacion,
            marca,
            no_serie,
            capacidad,
            material
            )
            VALUES 
            (
            '".$id_estacion."',
            '".$marca."',
            '".$no_serie."',
            '".$capacidad."',
            '".$material."'
            )";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarJarraPatron($id_jarra){
        $sql = "DELETE FROM tb_jarra_patron WHERE id = '".$id_jarra."'  ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function editarJarraPatron($id_jarra,$marca,$no_serie,$capacidad,$material){
        $sql = "UPDATE tb_jarra_patron SET
        marca = '".$marca."',
        no_serie = '".$no_serie."',
        capacidad = '".$capacidad."',
        material = '".$material."'
        WHERE id = '".$id_jarra."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    //----------------------------------------------------------------------------------
    //--------------------------- Bitácora calibración de equipos -----------------------
    
    public function agregarCalibracionEquipo($id_estacion,$id_usuario,$equipo){

        $sqlCE = "SELECT id FROM tb_calibracion_equipos WHERE id_estacion = '".$id_estacion."' AND equipo = '".$equipo."' AND estado = 0 ORDER BY id DESC LIMIT 1 ";
        $resultCE = mysqli_query($this->con, $sqlCE);
        $numeroCE = mysqli_num_rows($resultCE);
        
        if($numeroCE == 0){
        
        $ID = $this->idBitacoraCalibracion();
        $Folio = $this->folioBitacoraCalibracion($id_estacion,$equipo);
        $Agregar = $this->crearBitacoraCalibracion($id_estacion,$id_usuario,$ID,$Folio,$equipo);
        
        if($Agregar){
        
        if($equipo == 'Dispensario'){
            $this->bitacoraDispensario($ID,$id_estacion);	
        }else if($equipo == 'Jarra patron'){
            $this->bitacoraJarraPatron($ID,$id_estacion); 
        }else if($equipo == 'Sondas de medición'){
            $this->bitacoraSondasMedicion($ID,$id_estacion); 
        }else if($equipo == 'Tanques de almacenamiento'){
            $this->bitacoraTanque($ID,$id_estacion); 
        }
        
        return $ID;
        }
        
        }else{        
        $rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC);
        $ID = $rowCE['id'];        
        return $ID;
        }

    }

    private function idBitacoraCalibracion(){
        $sql = "SELECT id FROM tb_calibracion_equipos ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if($numero != 0){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id = $row['id'];
        $NoID = $id + 1;
        }else{
        $NoID = 1;
        }
        return $NoID;
        }

    private function folioBitacoraCalibracion($idEstacion,$Equipo){
        $sql = "SELECT folio FROM tb_calibracion_equipos WHERE id_estacion = '".$idEstacion."' AND equipo = '".$Equipo."' ORDER BY folio DESC LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        if($numero != 0){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $NoFolio = $row['folio'];
        $Folio = $NoFolio + 1;
        }else{
        $Folio = 1;
        }
        return $Folio;
        }

    private function crearBitacoraCalibracion($IDEstacion,$IDUsuarioBD,$ID,$Folio,$Equipo){
        $sql = "INSERT INTO tb_calibracion_equipos (
        id,
        id_estacion,
        id_usuario,
        folio,
        fecha,
        hora,
        fecha_termino,
        hora_termino,
        equipo,
        observaciones,
        responsable_verificacion,
        resultados,
        categoria,
        estado
        )
        VALUES (
        '".$ID."',
        '".$IDEstacion."',
        '".$IDUsuarioBD."',
        '".$Folio."',
        '',
        '',
        '',
        '',
        '".$Equipo."',
        '',
        '',
        '',
        1,
        0
        )";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        }

        private function bitacoraDispensario($ID,$IDEstacion){

            $this->Detalle($ID,'Unidad de verificación');
            $this->Detalle($ID,'No. de acreditación');
          
            $sql = "SELECT id FROM tb_dispensarios WHERE id_estacion = '".$IDEstacion."' AND estado = 1 ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
          
            $sql = "INSERT INTO tb_calibracion_equipos_dispensario (
            id_calibracion,
            id_dispensario,
            resultado1,
            resultado2,
            resultado3,
            resultado4
            )
            VALUES (
            '".$ID."',
            '".$row['id']."',
            '',
            '',
            '',
            ''
            )";
          
            $this->sqlQuery($sql);       
            
            }
          
            return true;
            $this->class_base_datos->desconectarBD($this->con);
            }

            private function bitacoraJarraPatron($ID,$IDEstacion){

                $this->Detalle($ID,'Temperatura ambiente');
                $this->Detalle($ID,'Presión atmosférica');
                $this->Detalle($ID,'Humedad');
                $this->Detalle($ID,'Liquido usado en la calibración');
                $this->Detalle($ID,'Temperatura del líquido');
                $this->Detalle($ID,'Laboratorio de calibración');
                $this->Detalle($ID,'No. de acreditación');
                $this->Detalle($ID,'Método de calibración');
              
                $sql = "SELECT id FROM tb_jarra_patron WHERE id_estacion = '".$IDEstacion."' ";
                $result = mysqli_query($this->con, $sql);
                $numero = mysqli_num_rows($result);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              
                $sql = "INSERT INTO tb_calibracion_equipos_jarra (
                id_calibracion,
                id_jarra,
                resultado1
                )
                VALUES (
                '".$ID."',
                '".$row['id']."',
                ''
                )";
              
                $this->sqlQuery($sql);
                
                }
              
                return true;
                $this->class_base_datos->desconectarBD($this->con);
                }

                private function bitacoraSondasMedicion($ID,$IDEstacion){

                    $this->Detalle($ID,'Unidad de verificación');
                    $this->Detalle($ID,'No. de acreditación');
                    $this->Detalle($ID,'Método usado para la calibración');
                  
                    $sql = "SELECT id FROM tb_sondas_medicion WHERE id_estacion = '".$IDEstacion."' ";
                    $result = mysqli_query($this->con, $sql);
                    $numero = mysqli_num_rows($result);
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                  
                    $sql = "INSERT INTO tb_calibracion_equipos_sonda (
                    id_calibracion,
                    id_sonda,
                    resultado1
                    )
                    VALUES (
                    '".$ID."',
                    '".$row['id']."',
                    ''
                    )";
                  
                    $this->sqlQuery($sql);
                    
                    }
                  
                    return true;
                    $this->class_base_datos->desconectarBD($this->con);
                    }

                    private function bitacoraTanque($ID,$IDEstacion){

                        $this->Detalle($ID,'Unidad de verificación');
                        $this->Detalle($ID,'No. de acreditación');
                        $this->Detalle($ID,'Método usado para la calibración');
                      
                        $sql = "SELECT id FROM tb_tanque_almacenamiento WHERE id_estacion = '".$IDEstacion."' ";
                        $result = mysqli_query($this->con, $sql);
                        $numero = mysqli_num_rows($result);
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      
                        $sql = "INSERT INTO tb_calibracion_equipos_tanques (
                        id_calibracion,
                        id_tanque,
                        resultado1,
                        resultado2,
                        resultados
                        )
                        VALUES (
                        '".$ID."',
                        '".$row['id']."',
                        '',
                        '',
                        ''
                        )";
                      
                        $this->sqlQuery($sql);
                        
                        }
                      
                        return true;
                        $this->class_base_datos->desconectarBD($this->con);
                      
                        }

                        private function Detalle($ID,$Categoria){
                            $sql = "INSERT INTO tb_calibracion_equipos_detalle (
                            id_calibracion,
                            categoria,
                            resultado
                            )
                            VALUES (
                            '".$ID."',
                            '".$Categoria."',
                            ''
                            )";

                            return $this->sqlQuery($sql);
                            $this->class_base_datos->desconectarBD($this->con);
                            
                            }
    
    //-------------------------------------------------------------------------------------------
    public function detalleCalibracion($ID,$categoria){
    $sql = "SELECT resultado FROM tb_calibracion_equipos_detalle WHERE id_calibracion = '".$ID."' AND categoria = '".$categoria."' ";
    $result = mysqli_query($this->con, $sql);
    $numero = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $resultado = $row['resultado'];
    return $resultado;
    }

    public function jarraPatron($idjarra){
        $sql = "SELECT * FROM tb_jarra_patron WHERE id = '".$idjarra."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);        
        $marca = $row['marca'];
        $serie = $row['no_serie'];
        $capacidad = $row['capacidad'];        
        $array = array('marca' => $marca, 'serie' => $serie, 'capacidad' => $capacidad);        
        return $array;
        }

    public function editarCalibracionEquipoJarraPatron($contenido,$id,$input){

            if($input == 1){
            $sql = "UPDATE tb_calibracion_equipos SET
            fecha = '".$contenido."'
             WHERE id = '".$id."' ";            
            }else if($input == 2){            
            $sql = "UPDATE tb_calibracion_equipos SET
            hora = '".$contenido."'
             WHERE id = '".$id."' ";            
            }else if($input == 3){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Temperatura ambiente' ";            
            }else if($input == 4){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Presión atmosférica' ";            
            }else if($input == 5){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Humedad' ";            
            }else if($input == 6){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Liquido usado en la calibración' ";            
            }else if($input == 7){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Temperatura del líquido' ";            
            }else if($input == 8){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Laboratorio de calibración' ";           
            }else if($input == 9){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'No. de acreditación' ";            
            }else if($input == 10){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Método de calibración' ";           
            }else if($input == 11){            
            $sql = "UPDATE tb_calibracion_equipos SET
            observaciones = '".$contenido."'
             WHERE id = '".$id."' ";            
            }else if($input == 12){            
            $sql = "UPDATE tb_calibracion_equipos SET
            responsable_verificacion = '".$contenido."'
             WHERE id = '".$id."' ";            
            }else if($input == 13){            
            $sql = "UPDATE tb_calibracion_equipos_jarra SET
            resultado1 = '".$contenido."'
             WHERE id = '".$id."' ";            
            }

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
    }

    public function finalizarCalibracionEquipos($id_estacion,$id_usuario,$Id,$Equipo){
      
        $sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$Id."' ";
        $resultCE = mysqli_query($this->con, $sqlCE);
        $numeroCE = mysqli_num_rows($resultCE);
        $rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC);
        $Fecha = $rowCE['fecha'];
        $FolioActual = $rowCE['folio'];
        $Categoria = $rowCE['categoria'];
        
        $ID = $this->idBitacoraCalibracion();
        $Folio = $this->folioBitacoraCalibracion($id_estacion,$Equipo);
        $this->Actualizar($Id);

        
        if($Equipo == 'Dispensario'){
        
        if($Categoria == 1){
        $this->agregarBitacoraCalibracionEquipo($id_estacion,$id_usuario,$ID,$Folio,$Equipo,$Fecha);
        $this->dispensarioAperturaBitacora($Id,$id_estacion,$id_usuario);
        $this->bitacoraDispensario($ID,$id_estacion); 
        }else{
        
        if($FolioActual != 1){
        $FechaAnterior = ValidaAnterior($id_estacion,$FolioActual);
        $this->agregarBitacoraCalibracionEquipo($id_estacion,$id_usuario,$ID,$Folio,$Equipo,$FechaAnterior);
        $this->dispensarioAperturaBitacora($Id,$id_estacion,$id_usuario);
        $this->bitacoraDispensario($ID,$id_estacion);
        }
        
        }
        
        }else if($Equipo == 'Jarra patron'){
        
        $this->agregarBitacoraCalibracionEquipo($id_estacion,$id_usuario,$ID,$Folio,$Equipo,$Fecha);
        $this->bitacoraJarraPatron($ID,$id_estacion); 
        
        }else if($Equipo == 'Sondas de medición'){
        
        $this->agregarBitacoraCalibracionEquipo($id_estacion,$id_usuario,$ID,$Folio,$Equipo,$Fecha);
        $this->bitacoraSondasMedicion($ID,$id_estacion); 
        
        }else if($Equipo == 'Tanques de almacenamiento'){
        
        $this->agregarBitacoraCalibracionEquipo($id_estacion,$id_usuario,$ID,$Folio,$Equipo,$Fecha);
        $this->bitacoraTanque($ID,$id_estacion); 
        
        }

    }

    private function Actualizar($Id){
    $sql = "UPDATE tb_calibracion_equipos SET estado = 1 WHERE id = '".$Id."' ";
    return $this->sqlQuery($sql);
    $this->class_base_datos->desconectarBD($this->con);      
    }

    private function agregarBitacoraCalibracionEquipo($IDEstacion,$IDUsuarioBD,$ID,$Folio,$Equipo,$Fecha){

        if($Equipo == 'Dispensario'){
        $FechaCali = date("Y-m-d",strtotime($Fecha."+ 6 month")); 
        }else if($Equipo == 'Jarra patron'){
        $FechaCali = date("Y-m-d",strtotime($Fecha."+ 1 year"));  
        }else if($Equipo == 'Sondas de medición'){
        $FechaCali = date("Y-m-d",strtotime($Fecha."+ 2 year"));  
        }else if($Equipo == 'Tanques de almacenamiento'){
        $FechaCali = date("Y-m-d",strtotime($Fecha."+ 10 year"));  
        }
    
      $sql = "INSERT INTO tb_calibracion_equipos (
      id,
      id_estacion,
      id_usuario,
      folio,
      fecha,
      hora,
      fecha_termino,
      hora_termino,
      equipo,
      observaciones,
      responsable_verificacion,
      resultados,
      categoria,
      estado
      )
      VALUES (
      '".$ID."',
      '".$IDEstacion."',
      '".$IDUsuarioBD."',
      '".$Folio."',
      '".$FechaCali."',
      '',
      '',
      '',
      '".$Equipo."',
      '',
      '',
      '',
      1,
      0
      )";

      return $this->sqlQuery($sql);
     $this->class_base_datos->desconectarBD($this->con);
      
      }

      //----------------------------------------------------------------------

      public function editarCalibracionEquipoDispensario($contenido,$id,$input){

        if($input == 1){
            $ValidaFecha = $this->ValidaFecha($contenido,$id,$con);
            if($ValidaFecha == 1){            
            $sql = "UPDATE tb_calibracion_equipos SET
            fecha = '".$contenido."'
             WHERE id = '".$id."' ";            
            }           
            }else if($input == 2){
            $sql = "UPDATE tb_calibracion_equipos SET
            hora = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 3){
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Unidad de verificación' ";
            }else if($input == 4){
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'No. de acreditación' ";
            }else if($input == 5){
            $sql = "UPDATE tb_calibracion_equipos SET
            observaciones = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 6){
            $sql = "UPDATE tb_calibracion_equipos SET
            responsable_verificacion = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 7){
            $sql = "UPDATE tb_calibracion_equipos_dispensario SET
            resultado1 = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 8){
            $sql = "UPDATE tb_calibracion_equipos_dispensario SET
            resultado2 = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 9){
            $sql = "UPDATE tb_calibracion_equipos_dispensario SET
            resultado3 = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 10){
            $sql = "UPDATE tb_calibracion_equipos_dispensario SET
            resultado4 = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 11){
            $sql = "UPDATE tb_calibracion_equipos SET
            categoria = '".$contenido."'
             WHERE id = '".$id."' ";
            }if($input == 12){
            $sql = "UPDATE tb_calibracion_equipos SET
            fecha_termino = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 13){
            $sql = "UPDATE tb_calibracion_equipos SET
            hora_termino = '".$contenido."'
             WHERE id = '".$id."' ";
            }
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
      }

      private function ValidaFecha($fecha,$id){

        $sqlCE = "SELECT equipo,fecha FROM tb_calibracion_equipos WHERE id = '".$id."' ";
        $resultCE = mysqli_query($this->con, $sqlCE);
        $numeroCE = mysqli_num_rows($resultCE);
        $rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC);
        $Equipo = $rowCE['equipo'];
        $FechaAnt = $rowCE['fecha'];
        
        if($Equipo == 'Dispensario'){        
        $sql = "UPDATE tb_dispensarios_apertura_bitacora SET
        fecha = '".$fecha."'
        WHERE fecha = '".$FechaAnt."' AND clave = 'CALI' AND motivo = 'Ajuste' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        }else{
        return true;
        }        
        }

        public function eliminarCalibracionEquipoDispensario($id){
        $sql = "DELETE FROM tb_calibracion_equipos_dispensario WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
        }

        public function agregarCalibracionEquipoDispensario($id,$id_dispensario){

            $sql = "INSERT INTO tb_calibracion_equipos_dispensario (
                id_calibracion,
                id_dispensario,
                resultado1,
                resultado2,
                resultado3,
                resultado4
                )
                VALUES (
                '".$id."',
                '".$id_dispensario."',
                '',
                '',
                '',
                ''
                )";

                return $this->sqlQuery($sql);
                $this->class_base_datos->desconectarBD($this->con);

        }

        public function dispensarioAperturaBitacora($ID,$IDEstacion,$IDUsuario){

          $sqlCE = "SELECT * FROM tb_calibracion_equipos WHERE id = '".$ID."' ";
          $resultCE = mysqli_query($this->con, $sqlCE);
          $numeroCE = mysqli_num_rows($resultCE);
          $rowCE = mysqli_fetch_array($resultCE, MYSQLI_ASSOC);
          $Folio = $rowCE['folio'];
          $Fecha = $rowCE['fecha'];
          $Hora = $rowCE['hora'];
          $Observaciones = $rowCE['observaciones'];
          $Responsableveri = $rowCE['responsable_verificacion'];
          $Estado = $rowCE['estado'];
              
            $sql = "SELECT id_dispensario FROM tb_calibracion_equipos_dispensario WHERE id_calibracion = '".$ID."' ";
            $result = mysqli_query($this->con, $sql);
            $numero = mysqli_num_rows($result);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
          
              $sql = "INSERT INTO tb_dispensarios_apertura_bitacora (
              id_dispensario,
              fecha,
              hora_inicio,
              hora_termino,
              lado,
              producto,
              clave,
              motivo,
              responsable,
              detalle
              )
              VALUES 
              (
              '".$row['id_dispensario']."',
              '".$Fecha."',
              '".$Hora."',
              '',
              '',
              '',
              'CALI',
              'Ajuste',
              '".$IDUsuario."',
              ''
              )";
          
            $this->sqlQuery($sql);
          
            }
          
            return true;
            $this->class_base_datos->desconectarBD($this->con);
          
            }

            public function Sondas($idsonda){
                $sql = "SELECT * FROM tb_sondas_medicion WHERE id = '".$idsonda."' ";
                $result = mysqli_query($this->con, $sql);
                $numero = mysqli_num_rows($result);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $nosonda = $row['no_sonda'];
                $marca = $row['marca'];
                $modelo = $row['modelo'];
                $array = array('nosonda' => $nosonda, 'marca' => $marca, 'modelo' => $modelo);
                return $array;
                }

    public function editarCalibracionEquipoSondaMedicion($contenido,$id,$input){

        if($input == 1){
            $sql = "UPDATE tb_calibracion_equipos SET
            fecha = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 2){
            $sql = "UPDATE tb_calibracion_equipos SET
            hora = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 3){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Unidad de verificación' ";
            }else if($input == 4){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'No. de acreditación' ";            
            }else if($input == 5){            
            $sql = "UPDATE tb_calibracion_equipos_detalle SET
            resultado = '".$contenido."'
             WHERE id_calibracion = '".$id."' AND categoria = 'Método usado para la calibración' ";
            }else if($input == 6){            
            $sql = "UPDATE tb_calibracion_equipos SET
            observaciones = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 7){            
            $sql = "UPDATE tb_calibracion_equipos SET
            responsable_verificacion = '".$contenido."'
             WHERE id = '".$id."' ";
            }else if($input == 8){            
            $sql = "UPDATE tb_calibracion_equipos_sonda SET
            resultado1 = '".$contenido."'
             WHERE id = '".$id."' ";
            }

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
    }

    public function Tanque($idsonda){
        $sql = "SELECT * FROM tb_tanque_almacenamiento WHERE id = '".$idsonda."' ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $notanque = $row['no_tanque'];
        $capacidad = $row['capacidad'];
        $producto = $row['producto'];
        $array = array('notanque' => $notanque, 'capacidad' => $capacidad, 'producto' => $producto);
        return $array;
        }

        public function editarCalibracionEquipoTanque($contenido,$id,$input){

            if($input == 1){

                $sql = "UPDATE tb_calibracion_equipos SET
                fecha = '".$contenido."'
                 WHERE id = '".$id."' ";
                
                }else if($input == 2){
                
                $sql = "UPDATE tb_calibracion_equipos SET
                hora = '".$contenido."'
                 WHERE id = '".$id."' ";
                
                }else if($input == 3){
                
                $sql = "UPDATE tb_calibracion_equipos_detalle SET
                resultado = '".$contenido."'
                 WHERE id_calibracion = '".$id."' AND categoria = 'Unidad de verificación' ";
                
                }else if($input == 4){
                
                $sql = "UPDATE tb_calibracion_equipos_detalle SET
                resultado = '".$contenido."'
                 WHERE id_calibracion = '".$id."' AND categoria = 'No. de acreditación' ";
                
                }else if($input == 5){
                
                $sql = "UPDATE tb_calibracion_equipos_detalle SET
                resultado = '".$contenido."'
                 WHERE id_calibracion = '".$id."' AND categoria = 'Método usado para la calibración' ";
                
                }else if($input == 6){
                
                $sql = "UPDATE tb_calibracion_equipos SET
                observaciones = '".$contenido."'
                 WHERE id = '".$id."' ";
                
                }else if($input == 7){
                
                $sql = "UPDATE tb_calibracion_equipos SET
                responsable_verificacion = '".$contenido."'
                 WHERE id = '".$id."' ";
                
                }else if($input == 8){
                
                $sql = "UPDATE tb_calibracion_equipos_tanques SET
                resultado1 = '".$contenido."'
                 WHERE id = '".$id."' ";
                
                }else if($input == 9){
                
                $sql = "UPDATE tb_calibracion_equipos_tanques SET
                resultado2 = '".$contenido."'
                 WHERE id = '".$id."' ";
                
                }

                return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);

        }

        public function agregarResultadosCalibracionTanque($id,$file_name,$hoy){

            $ruta = "../../archivos/calibracion/RESULTADOS-".strtotime($hoy).".pdf";
            $nom = "RESULTADOS-".strtotime($hoy).".pdf";
            
            if(move_uploaded_file($file_name, $ruta)) {
            
            $sql = "UPDATE tb_calibracion_equipos_tanques SET
            resultados = '".$nom."'
             WHERE id = '".$id."' ";
             return $this->sqlQuery($sql);
             $this->class_base_datos->desconectarBD($this->con);
            
            }

        }

        public function agregarResultadosCalibracion($id,$file_name,$hoy){

            $ruta = "../../archivos/calibracion/RESULTADOS-".strtotime($hoy).".pdf";
            $nom = "RESULTADOS-".strtotime($hoy).".pdf";

            if(move_uploaded_file($file_name, $ruta)) {

            $sql = "UPDATE tb_calibracion_equipos SET
            resultados = '".$nom."'
            WHERE id = '".$id."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
            }

        }
    //--------------------------------------------------------------------------------------------------------------
    //------------------ Bitácora de registro de eventos PROFECO

    public function agregarDispensarioBitacora($id_estacion,$id_usuario,$categoria,$fecha,$hora_inicio,$hora_termino,$dispensario,$lado,$producto,$detalle){

            if($categoria == 2){

            $this->CambioPrecio($id_estacion,$fecha,$hora_inicio,$hora_termino,$producto,$id_usuario,$detalle);
            
            return true;
            
            }else{
            
            if($categoria == 1){
            $Clave = 'CALI';
            $Motivo = 'Ajuste';
            }else if($categoria == 3){
            $Clave = 'APPU';
            $Motivo = 'Apertura en puerta';
            }else if($categoria == 4){
            $Clave = 'ACMO';
            $Motivo = 'Acceso al modo de programacion';
            }else if($categoria == 5){
            $Clave = 'CAMF';
            $Motivo = 'Cambio de fecha y hora';
            }else if($categoria == 6){
            $Clave = 'ACTU';
            $Motivo = 'Actualizacion del o los programas de computo';
            }else if($categoria == 7){
            $Clave = 'MAGRL';
            $Motivo = 'Mantenimiento General';
            }
            
            $sql = "INSERT INTO tb_dispensarios_apertura_bitacora (
            id_dispensario,
            fecha,
            hora_inicio,
            hora_termino,
            lado,
            producto,
            clave,
            motivo,
            responsable,
            detalle
            )
            VALUES 
            (
            '".$dispensario."',
            '".$fecha."',
            '".$hora_inicio."',
            '".$hora_termino."',
            '".$lado."',
            '".$producto."',
            '".$Clave."',
            '".$Motivo."',
            '".$id_usuario."',
            '".$detalle."'
            )";

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);    
            
            }

    }

    private function CambioPrecio($idEstacion,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle){

        $sql = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$idEstacion."' AND estado = 1 ORDER BY no_dispensario ASC ";
        $result = mysqli_query($this->con, $sql);
        $numero = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        
        $idDispensario = $row['id'];
        
        if($Producto == 'G SUPER' || $Producto == 'MAGNA'){
        $this->GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$row['producto1']);
        }else if($Producto == 'G PREMIUM' || $Producto == 'PREMIUM'){
        $this->GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$row['producto2']);
        }else if($Producto == 'G DIESEL' || $Producto == 'DIESEL'){
        $this->GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$row['producto3']);
        }        
        }        
        }

        public function GuardaRegistro($idDispensario,$Fecha,$HoraInicio,$HoraTermino,$Producto,$idUsuario,$Detalle,$mangueras){

            if ($mangueras > 0) {
            
            $lado = 1;
            for ($i=1; $i <= $mangueras; $i++) { 
            
            $sql = "INSERT INTO tb_dispensarios_apertura_bitacora (
            id_dispensario,
            fecha,
            hora_inicio,
            hora_termino,
            lado,
            producto,
            clave,
            motivo,
            responsable,
            detalle
            )
            VALUES 
            (
            '".$idDispensario."',
            '".$Fecha."',
            '".$HoraInicio."',
            '".$HoraTermino."',
            '".$lado."',
            '".$Producto."',
            'CAMP',
            'Cambio de precio',
            '".$idUsuario."',
            '".$Detalle."'
            )";
            
            $this->sqlQuery($sql);
            
            $lado++;
            }  
            
            }
           
            }

            public function editarDispensarioBitacora($id){
                $sql = "DELETE FROM tb_dispensarios_apertura_bitacora WHERE id = '".$id."' ";
                return $this->sqlQuery($sql);
                $this->class_base_datos->desconectarBD($this->con);  
            }

    //--------------------------------------------------------------------------------------------------------------
    //-------------------------------------- Bitacora Mantenimiento Quincenal --------------------------------------

    public function agregarMantenimientoQuincenal($id_estacion,$id_usuario,$array,$fecha_del_dia,$hoy,){
        
        $Folio = $this->folioMantenimientoQuincenal($id_estacion,$fecha_del_dia);

        $upload_folder1 = "../../archivos/mantenimiento-quincenal/MQ".$id_estacion."-F1-".strtotime($hoy).".pdf";
        $upload_folder2 = "../../archivos/mantenimiento-quincenal/MQ".$id_estacion."-F2-".strtotime($hoy).".pdf";
        $upload_folder3 = "../../archivos/mantenimiento-quincenal/MQ".$id_estacion."-F3-".strtotime($hoy).".pdf";
        $upload_folder4 = "../../archivos/mantenimiento-quincenal/MQ".$id_estacion."-F4-".strtotime($hoy).".pdf";
        $upload_folder5 = "../../archivos/mantenimiento-quincenal/MQ".$id_estacion."-F5-".strtotime($hoy).".pdf";
        $upload_folder6 = "../../archivos/mantenimiento-quincenal/MQ".$id_estacion."-F6-".strtotime($hoy).".pdf";
        $upload_folder7 = "../../archivos/mantenimiento-quincenal/MQ".$id_estacion."-F7-".strtotime($hoy).".pdf";

        if ($array['file_name_1'] != "") {
        $PDFNombre1 = "archivos/mantenimiento-quincenal/MQ".$id_estacion."-F1-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre1 = "";
        }

        if ($array['file_name_2'] != "") {
        $PDFNombre2 = "archivos/mantenimiento-quincenal/MQ".$id_estacion."-F2-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre2 = "";
        }

        if ($array['file_name_3'] != "") {
        $PDFNombre3 = "archivos/mantenimiento-quincenal/MQ".$id_estacion."-F3-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre3 = "";
        }

        if ($array['file_name_4'] != "") {
        $PDFNombre4 = "archivos/mantenimiento-quincenal/MQ".$id_estacion."-F4-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre4 = "";
        }

        if ($array['file_name_5'] != "") {
        $PDFNombre5 = "archivos/mantenimiento-quincenal/MQ".$id_estacion."-F5-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre5 = "";
        }

        if ($array['file_name_6'] != "") {
        $PDFNombre6 = "archivos/mantenimiento-quincenal/MQ".$id_estacion."-F6-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre6 = "";
        }

        if ($array['file_name_7'] != "") {
        $PDFNombre7 = "archivos/mantenimiento-quincenal/MQ".$id_estacion."-F7-".strtotime($hoy).".pdf";
        }else{
        $PDFNombre7 = "";
        }

        if(move_uploaded_file($array['file_tmp_name_1'], $upload_folder1)) {}
        if(move_uploaded_file($array['file_tmp_name_2'], $upload_folder2)) {}
        if(move_uploaded_file($array['file_tmp_name_3'], $upload_folder3)) {}
        if(move_uploaded_file($array['file_tmp_name_4'], $upload_folder4)) {}
        if(move_uploaded_file($array['file_tmp_name_5'], $upload_folder5)) {}
        if(move_uploaded_file($array['file_tmp_name_6'], $upload_folder6)) {}
        if(move_uploaded_file($array['file_tmp_name_7'], $upload_folder7)) {}

        $sql = "INSERT INTO bi_mantenimiento_quincenal (
            id_estacion,
            id_empleado,
            fechacreacion,	
            folio,	
            formato1,	
            formato2,	
            formato3,	
            formato4,	
            formato5,
            formato6,
            formato7
            )
            VALUES (
            '".$id_estacion."',
            '".$id_usuario."',
            '".$array['fecha']."',
            '".$Folio."',
            '".$PDFNombre1."',
            '".$PDFNombre2."',
            '".$PDFNombre3."',
            '".$PDFNombre4."',
            '".$PDFNombre5."',
            '".$PDFNombre6."',
            '".$PDFNombre7."'
            )";

            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con); 

    }

    public function folioMantenimientoQuincenal($idEstacion,$fecha_del_dia){
        $sql_reporte = "SELECT folio, fechacreacion FROM bi_mantenimiento_quincenal WHERE id_estacion = '".$idEstacion."' ORDER BY fechacreacion DESC LIMIT 1";
        $result_reporte = mysqli_query($this->con, $sql_reporte);
        $numero_reporte = mysqli_num_rows($result_reporte);
     
        if($numero_reporte != 0){
        $row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC);
        $NoFolio = $row_reporte['folio'];
        $FechaConsulta = $row_reporte['fechacreacion'];
     
        $ExplodeFA = explode("-", $fecha_del_dia);
        $ExplodeFC = explode("-", $FechaConsulta);
     
        $YearFA = $ExplodeFA[0];
        $YearFC = $ExplodeFC[0];
     
        if($YearFA == $YearFC){
        $Folio = $NoFolio + 1;
        }else{
        $Folio = 1;
        }
     
        }else{
         $Folio = 1;
        }

        return $Folio;
    }
    
        public function eliminarBitacoraQuincenal($id){
            $sql = "DELETE FROM bi_mantenimiento_quincenal WHERE id = '".$id."' ";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
        }

    //------------------------------------------------------------------------------------------------

    public function agregarDetectorHumo($id_estacion,$no_detector,$ubicacion){
        $sql = "INSERT INTO tb_detector_humo (
            id_estacion,
            no_detector,
            ubicacion,
            estado
            )
            VALUES (
            '".$id_estacion."',
            '".$no_detector."',
            '".$ubicacion."',
            1
            )";
            return $this->sqlQuery($sql);
            $this->class_base_datos->desconectarBD($this->con);
    }

    public function eliminarDetectorHumo($id){
        
        $sql = "UPDATE tb_detector_humo SET
        estado = 0
         WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

}