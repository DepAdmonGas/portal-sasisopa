<?php
require('../../../../app/help.php');

$IdEquipo = $_POST['IdEquipo'];
$Fecha = $_POST['Fecha'];

function patronesInstrumentos($id_equipo,$con){
$sql = "SELECT id, nombre, periodicidad, categoria FROM sgm_patrones_instrumentos WHERE id = '".$id_equipo."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$nombre = $row['nombre'];
$periodicidad = $row['periodicidad']; 
$categoria = $row['categoria']; 
$array = array('nombre' => $nombre, 'periodicidad' => $periodicidad, 'categoria' => $categoria);
return $array;
}

function AgregarPrograma($id_estacion,$id_equipo,$fecha,$con){

$sql = "SELECT * FROM sgm_programa_anual_calibracion_verificacion WHERE id_estacion = '".$id_estacion."' AND id_equipo = '".$id_equipo."' AND fecha = '".$fecha."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

$sql_insert = "INSERT INTO sgm_programa_anual_calibracion_verificacion (
id_estacion,
id_equipo,
fecha,
id_verificar,
estado
  )
  VALUES (
  '".$id_estacion."',
  '".$id_equipo."',
  '".$fecha."',
  0,
  0
  )";
  if(mysqli_query($con, $sql_insert)){
  return true;
  }else{
  return false;
  }

}else{
return false;
}

}

function AgregarProgramaVerificacion($id_estacion,$id_equipo,$fecha,$categoria,$con){

$sql = "SELECT id FROM sgm_inventario_equipo WHERE id_estacion = '".$id_estacion."' AND nombre = '".$categoria."' AND estado = 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$sql_insert = "INSERT INTO sgm_programa_anual_calibracion_verificacion (
id_estacion,
id_equipo,
fecha,
id_verificar,
estado
  )
  VALUES (
  '".$id_estacion."',
  '".$id_equipo."',
  '".$fecha."',
  '".$row['id']."',
  0
  )";
  mysqli_query($con, $sql_insert);

}

}
 
	$equipo_detalle = patronesInstrumentos($IdEquipo,$con);

	switch ($equipo_detalle['periodicidad']) {
		case 'Mensual':	

		for ($i = 0; $i <= 120; $i++) {
		$SumaMes = 1 * $i;
		$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaMes month"));
		AgregarProgramaVerificacion($Session_IDEstacion,$IdEquipo,$FechaNuevaM,'Dispensarios',$con);
		}
		echo 1;

		break;
		case 'Trimestral':	

		for ($i = 0; $i <= 40; $i++) {
		$SumaMes = 3 * $i;
		$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaMes month"));
		AgregarProgramaVerificacion($Session_IDEstacion,$IdEquipo,$FechaNuevaM,'Tanques de almacenamiento',$con);
		}
		echo 1;

		break;
		case 'Semestral':	

		AgregarPrograma($Session_IDEstacion,$IdEquipo,$Fecha,$con);
		for ($i = 1; $i <= 20; $i++) {
		$SumaMes = 6 * $i;
		$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaMes month"));
		AgregarPrograma($Session_IDEstacion,$IdEquipo,$FechaNuevaM,$con);
		}
		echo 1;

		break;
		case 'Anual':	

		AgregarPrograma($Session_IDEstacion,$IdEquipo,$Fecha,$con);
		for ($i = 1; $i <= 10; $i++) {
		$SumaYear = 1 * $i;
		$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaYear year"));
		AgregarPrograma($Session_IDEstacion,$IdEquipo,$FechaNuevaM,$con);
		}
		echo 1;

		break;
		case '2 años':	

		AgregarPrograma($Session_IDEstacion,$IdEquipo,$Fecha,$con);
		for ($i = 1; $i <= 10; $i++) {
		$SumaYear = 2 * $i;
		$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaYear year"));
		AgregarPrograma($Session_IDEstacion,$IdEquipo,$FechaNuevaM,$con);
		}
		echo 1;

		break;
		case '10 años':	

		AgregarPrograma($Session_IDEstacion,$IdEquipo,$Fecha,$con);
		for ($i = 1; $i <= 5; $i++) {
		$SumaYear = 10 * $i;
		$FechaNuevaM = date("Y-m-d",strtotime($Fecha."+ $SumaYear year"));
		AgregarPrograma($Session_IDEstacion,$IdEquipo,$FechaNuevaM,$con);
		}
		echo 1;

		break;
	}






