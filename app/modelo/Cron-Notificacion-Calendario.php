<?php 
if(isset($_GET['idCron'])){
if($_GET['idCron'] == '260120240127'){
require ('../bd/inc.conexion.php');	

	date_default_timezone_set('America/Mexico_City');
    $fecha_del_dia = date("Y-m-d");
	
	$sql = "SELECT id, nombre FROM tb_estaciones WHERE numlista <= 8 ORDER BY numlista ASC"; 
    $result = mysqli_query($con, $sql);
    $numero  = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $idEstacion = $row['id'];
    $detalle = 'La estación '.$row['nombre'].' tiene pendientes en actividades y cursos.';
	
	$Actividades = Actividades($idEstacion,$fecha_del_dia,$con);
    $Cursos = Cursos($idEstacion,$fecha_del_dia,$con);
    $TotalPendientes = $Actividades['Pendientes'] + $Cursos['Pendientes'];
		
	if($TotalPendientes > 0){

        $sql1 = "SELECT 
        tb_usuarios.id,
        tb_usuarios_token.id AS idToken,
        tb_usuarios_token.token
        FROM tb_usuarios
        INNER JOIN tb_usuarios_token 
        ON tb_usuarios.id = tb_usuarios_token.id_usuario WHERE tb_usuarios.id_gas = '".$idEstacion."' AND tb_usuarios.id_puesto = 6 AND 	
        tb_usuarios_token.herramienta = 'token-web' AND tb_usuarios.estatus = 0 GROUP BY tb_usuarios_token.id_usuario ORDER BY tb_usuarios_token.id DESC ";
        $result1 = mysqli_query($con, $sql1);
            while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
                $token = $row1['token'];
                sendNotification($token,$detalle);
            }
    
    }  
	
	}
	
	
	//------------------
	mysqli_close($con);
	//------------------
	
}
}

function sendNotification($token,$detalle){
    $url ="https://fcm.googleapis.com/fcm/send";

    $fields=array(

        "to"=>$token,

        "notification"=>array(

            "body"=> $detalle,
            "title"=>"Portal AdmonGas",
            "icon"=>"",
            "click_action"=>""
        )
    );

    $headers=array(
        'Authorization: key=AAAAccs8Ry4:APA91bFc3rlPHpHHyABA01dZPc4J9ZChulB2nmBZp0VW5ODR-uDq2Lnz0YvlpROjZrFgIl2UBFHqOPhPM8c5ho-8IR6XuFpwv8_WT_Y-av9vXav4_6eGsZrUdtrMl9GwDWDNZee0Ppli',
        'Content-Type:application/json'
    );

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result=curl_exec($ch);
 
    curl_close($ch);

}


function Actividades($idEstacion,$CalenDate,$con){

    $Pendientes = 0;
    $Finalizadas = 0;
  
  $sql = "SELECT * FROM tb_calendario_actividades WHERE id_estacion = '".$idEstacion."' AND fecha_inicio < '".$CalenDate."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  
  if($row['estado']  == 0){
  $Pendientes = $Pendientes + 1;
  }else if($row['estado']  == 1){
  $Finalizadas = $Finalizadas + 1;   
  }
  
  }
  $array = array('Total' => $numero, 
                'Pendientes' => $Pendientes, 
                'Finalizadas' => $Finalizadas);
  
  return $array; 
  }
  
  function Cursos($idEstacion,$CalenDate,$con){
    $Pendientes = 0;
    $Finalizadas = 0;
  
  $sql = "SELECT * FROM tb_cursos_calendario WHERE id_estacion = '".$idEstacion."' AND fecha_programada < '".$CalenDate."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  
  if($row['estado']  == 0){
  $Pendientes = $Pendientes + 1;
  }else if($row['estado']  == 1){
  $Finalizadas = $Finalizadas + 1;   
  }
  
  if($row['resultado'] <= 59){
  $Resultado = $Resultado + 1;   
  }
  
  }
  
  $array = array('Total' => $numero, 
                'Pendientes' => $Pendientes, 
                'Finalizadas' => $Finalizadas,
                'Resultado' => $Resultado);
  
  return $array;   
  }