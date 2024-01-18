<?php
  require('../../../../../app/help.php');

//---------------------------------------------------------
$Pregunta1 = explode(",", $_POST['respuesta1']);

$Usuario1 = $Pregunta1[0];
$Respuesta1 = $Pregunta1[1];
$Resultado1 = $Pregunta1[2];
//---------------------------------------------------------
$Pregunta2 = explode(",", $_POST['respuesta2']);

$Usuario2 = $Pregunta2[0];
$Respuesta2 = $Pregunta2[1];
$Resultado2 = $Pregunta2[2];
//---------------------------------------------------------
$Pregunta3 = explode(",", $_POST['respuesta3']);

$Usuario3 = $Pregunta3[0];
$Respuesta3 = $Pregunta3[1];
$Resultado3 = $Pregunta3[2];
//---------------------------------------------------------
$Pregunta4 = explode(",", $_POST['respuesta4']);

$Usuario4 = $Pregunta4[0];
$Respuesta4 = $Pregunta4[1];
$Resultado4 = $Pregunta4[2];
//---------------------------------------------------------
$Pregunta5 = explode(",", $_POST['respuesta5']);

$Usuario5 = $Pregunta5[0];
$Respuesta5 = $Pregunta5[1];
$Resultado5 = $Pregunta5[2];
//---------------------------------------------------------
$Totpreguntas =  5;
$porcentaje   =  $Totpreguntas * 10;
$resultado = $Resultado1 + $Resultado2 + $Resultado3 + $Resultado4 + $Resultado5;   

$puntosTotal =  ($resultado / $porcentaje) * 100;
$Promedio = $puntosTotal * 10;


 $sql_temas = "SELECT * FROM cu_evaluacion_modulos_detalle ORDER BY id desc LIMIT 1 ";
  $result_temas = mysqli_query($con, $sql_temas);
  $count_temas = mysqli_num_rows($result_temas);
  if ($count_temas == 0) {
  $id = 1;
  }else{
  while($row_temas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {
  $id = $row_temas['id'] + 1;
  }	
  }

$sql_modulo_detalle = "INSERT INTO cu_evaluacion_modulos_detalle (id, id_evaluacion_modulo, fecha, preguntas, respuestas, puntos )
VALUES ('".$id."','".$_POST['valEvaluacion']."', '".$fecha_del_dia."', '".$Totpreguntas."', '".$resultado."', '".$Promedio."')";
mysqli_query($con, $sql_modulo_detalle);



//------------- Pregunta 1
$sql_pregunta_1 = "INSERT INTO cu_evaluacion_modulos_preguntas (id_evaluacion_modulo_detalle, pregunta, respuesta_correcta, respuesta_usuario, resultado )
VALUES ('".$id."','".$_POST['Titulo1']."', '".$Respuesta1."', '".$Usuario1."', '".$Resultado1."')";
mysqli_query($con, $sql_pregunta_1);
//------------- Pregunta 2
$sql_pregunta_2 = "INSERT INTO cu_evaluacion_modulos_preguntas (id_evaluacion_modulo_detalle, pregunta, respuesta_correcta, respuesta_usuario, resultado )
VALUES ('".$id."','".$_POST['Titulo2']."', '".$Respuesta2."', '".$Usuario2."', '".$Resultado2."')";
mysqli_query($con, $sql_pregunta_2);
//------------- Pregunta 3
$sql_pregunta_3 = "INSERT INTO cu_evaluacion_modulos_preguntas (id_evaluacion_modulo_detalle, pregunta, respuesta_correcta, respuesta_usuario, resultado )
VALUES ('".$id."','".$_POST['Titulo3']."', '".$Respuesta3."', '".$Usuario3."', '".$Resultado3."')";
mysqli_query($con, $sql_pregunta_3);
//------------- Pregunta 4
$sql_pregunta_4 = "INSERT INTO cu_evaluacion_modulos_preguntas (id_evaluacion_modulo_detalle, pregunta, respuesta_correcta, respuesta_usuario, resultado )
VALUES ('".$id."','".$_POST['Titulo4']."', '".$Respuesta4."', '".$Usuario4."', '".$Resultado4."')";
mysqli_query($con, $sql_pregunta_4);
//------------- Pregunta 5
$sql_pregunta_5 = "INSERT INTO cu_evaluacion_modulos_preguntas (id_evaluacion_modulo_detalle, pregunta, respuesta_correcta, respuesta_usuario, resultado )
VALUES ('".$id."','".$_POST['Titulo5']."', '".$Respuesta5."', '".$Usuario5."', '".$Resultado5."')";
mysqli_query($con, $sql_pregunta_5);


$sql_modulo = "SELECT * FROM tb_capacitacion_interna WHERE id_usuario = '".$Session_IDUsuarioBD."' AND id_modulo = '".$_POST['valEvaluacion']."' AND fechareal = '0000-00-00' AND id_detalle = '0' LIMIT 1 ";
$query_modulo = mysqli_query($con, $sql_modulo);
$numero_modulos = mysqli_num_rows($query_modulo);

if ($numero_modulos == 1) {
while($row_modulo = mysqli_fetch_array($query_modulo, MYSQLI_ASSOC)){
$idCapacitacion = $row_modulo['id'];

}

$sql = "UPDATE tb_capacitacion_interna SET
fechareal = '".$fecha_del_dia."',
id_detalle = '".$id."'
WHERE id = '".$idCapacitacion."' ";
mysqli_query($con, $sql);

}else{

$sql_insert2 = "INSERT INTO tb_capacitacion_interna (
id_usuario,
id_tema,
id_modulo,
id_submodulo,
fechaprogramada,
fechareal,
id_detalle
)
VALUES (
'".$Session_IDUsuarioBD."',
'".$_POST['idTema']."',
'".$_POST['valEvaluacion']."',
'',
'".$fecha_del_dia."',
'".$fecha_del_dia."',
'".$id."'
)";
mysqli_query($con, $sql_insert2);

}

echo "promedio=".$Promedio."&preguntas=".$Totpreguntas."&totrespuesta=".$resultado."&idmodulo=".$_POST['idModulo']."&valEvaluacion=".$_POST['valEvaluacion'];

?>