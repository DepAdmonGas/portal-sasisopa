<?php
require('../../../app/help.php');

$Totpreguntas =  36;
$porcentaje   =  $Totpreguntas * 10;
$resultado = 
$_POST['respuesta1'] + 
$_POST['respuesta2'] + 
$_POST['respuesta3'] + 
$_POST['respuesta4'] + 
$_POST['respuesta5'] + 
$_POST['respuesta6'] + 
$_POST['respuesta7'] + 
$_POST['respuesta8'] + 
$_POST['respuesta9'] + 
$_POST['respuesta10'] + 
$_POST['respuesta11'] + 
$_POST['respuesta12'] + 
$_POST['respuesta13'] + 
$_POST['respuesta14'] + 
$_POST['respuesta15'] + 
$_POST['respuesta16'] + 
$_POST['respuesta17'] + 
$_POST['respuesta18'] + 
$_POST['respuesta19'] + 
$_POST['respuesta20'] + 
$_POST['respuesta21'] + 
$_POST['respuesta22'] + 
$_POST['respuesta23'] + 
$_POST['respuesta24'] + 
$_POST['respuesta25'] + 
$_POST['respuesta26'] + 
$_POST['respuesta27'] + 
$_POST['respuesta28'] + 
$_POST['respuesta29'] + 
$_POST['respuesta30'] + 
$_POST['respuesta31'] + 
$_POST['respuesta32'] + 
$_POST['respuesta33'] + 
$_POST['respuesta34'] + 
$_POST['respuesta35'] + 
$_POST['respuesta36'];

function Respuesta($id){
if ($id == 1) {
$resultado = "Si";
}else{
$resultado = "No";
}
return $resultado;
}

$puntosTotal =  ($resultado / $porcentaje) * 100;
$Promedio = $puntosTotal * 10;

$sql_temas = "SELECT id FROM tb_implementacionsa ORDER BY id desc LIMIT 1 ";
$result_temas = mysqli_query($con, $sql_temas);
$count_temas = mysqli_num_rows($result_temas);
if ($count_temas == 0) {
$id = 1;
}else{
while($row_temas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {
$id = $row_temas['id'] + 1;
}	
}

$sql_modulo_detalle = "INSERT INTO tb_implementacionsa (id, id_estacion, id_usuario, preguntas, respuestas, puntos )
VALUES ('".$id."', '".$_POST['idEstacion']."', '".$_POST['idUsuario']."', '".$Totpreguntas."', '".$resultado."', '".$Promedio."')";
mysqli_query($con, $sql_modulo_detalle);

//----------1
$sql_1 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo1']."', '".Respuesta($_POST['respuesta1'])."', '".$_POST['respuesta1']."')";
mysqli_query($con, $sql_1);
//----------2
$sql_2 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo2']."', '".Respuesta($_POST['respuesta2'])."', '".$_POST['respuesta2']."')";
mysqli_query($con, $sql_2);
//----------3
$sql_3 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo3']."', '".Respuesta($_POST['respuesta3'])."', '".$_POST['respuesta3']."')";
mysqli_query($con, $sql_3);
//----------4
$sql_4 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo4']."', '".Respuesta($_POST['respuesta4'])."', '".$_POST['respuesta4']."')";
mysqli_query($con, $sql_4);
//----------5
$sql_5 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo5']."', '".Respuesta($_POST['respuesta5'])."', '".$_POST['respuesta5']."')";
mysqli_query($con, $sql_5);
//----------6
$sql_6 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo6']."', '".Respuesta($_POST['respuesta6'])."', '".$_POST['respuesta6']."')";
mysqli_query($con, $sql_6);
//----------7
$sql_7 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo7']."', '".Respuesta($_POST['respuesta7'])."', '".$_POST['respuesta7']."')";
mysqli_query($con, $sql_7);
//----------8
$sql_8 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo8']."', '".Respuesta($_POST['respuesta8'])."', '".$_POST['respuesta8']."')";
mysqli_query($con, $sql_8);
//----------9
$sql_9 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo9']."', '".Respuesta($_POST['respuesta9'])."', '".$_POST['respuesta9']."')";
mysqli_query($con, $sql_9);
//----------10
$sql_10 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo10']."', '".Respuesta($_POST['respuesta10'])."', '".$_POST['respuesta10']."')";
mysqli_query($con, $sql_10);
//----------11
$sql_11 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo11']."', '".Respuesta($_POST['respuesta11'])."', '".$_POST['respuesta11']."')";
mysqli_query($con, $sql_11);
//----------12
$sql_12 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo12']."', '".Respuesta($_POST['respuesta12'])."', '".$_POST['respuesta12']."')";
mysqli_query($con, $sql_12);
//----------13
$sql_13 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo13']."', '".Respuesta($_POST['respuesta13'])."', '".$_POST['respuesta13']."')";
mysqli_query($con, $sql_13);
//----------14
$sql_14 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo14']."', '".Respuesta($_POST['respuesta14'])."', '".$_POST['respuesta14']."')";
mysqli_query($con, $sql_14);
//----------15
$sql_15 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo15']."', '".Respuesta($_POST['respuesta15'])."', '".$_POST['respuesta15']."')";
mysqli_query($con, $sql_15);
//----------16
$sql_16 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo16']."', '".Respuesta($_POST['respuesta16'])."', '".$_POST['respuesta16']."')";
mysqli_query($con, $sql_16);
//----------17
$sql_17 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo17']."', '".Respuesta($_POST['respuesta17'])."', '".$_POST['respuesta17']."')";
mysqli_query($con, $sql_17);
//----------18
$sql_18 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo18']."', '".Respuesta($_POST['respuesta18'])."', '".$_POST['respuesta18']."')";
mysqli_query($con, $sql_18);
//----------19
$sql_19 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo19']."', '".Respuesta($_POST['respuesta19'])."', '".$_POST['respuesta19']."')";
mysqli_query($con, $sql_19);
//----------20
$sql_20 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo20']."', '".Respuesta($_POST['respuesta20'])."', '".$_POST['respuesta20']."')";
mysqli_query($con, $sql_20);
//----------21
$sql_21 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo21']."', '".Respuesta($_POST['respuesta21'])."', '".$_POST['respuesta21']."')";
mysqli_query($con, $sql_21);
//----------22
$sql_22 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo22']."', '".Respuesta($_POST['respuesta22'])."', '".$_POST['respuesta22']."')";
mysqli_query($con, $sql_22);
//----------23
$sql_23 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo23']."', '".Respuesta($_POST['respuesta23'])."', '".$_POST['respuesta23']."')";
mysqli_query($con, $sql_23);
//----------24
$sql_24 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo24']."', '".Respuesta($_POST['respuesta24'])."', '".$_POST['respuesta24']."')";
mysqli_query($con, $sql_24);
//----------25
$sql_25 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo25']."', '".Respuesta($_POST['respuesta25'])."', '".$_POST['respuesta25']."')";
mysqli_query($con, $sql_25);
//----------26
$sql_26 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo26']."', '".Respuesta($_POST['respuesta26'])."', '".$_POST['respuesta26']."')";
mysqli_query($con, $sql_26);
//----------27
$sql_27 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo27']."', '".Respuesta($_POST['respuesta27'])."', '".$_POST['respuesta27']."')";
mysqli_query($con, $sql_27);
//----------28
$sql_28 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo28']."', '".Respuesta($_POST['respuesta28'])."', '".$_POST['respuesta28']."')";
mysqli_query($con, $sql_28);
//----------29
$sql_29 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo29']."', '".Respuesta($_POST['respuesta29'])."', '".$_POST['respuesta29']."')";
mysqli_query($con, $sql_29);
//----------30
$sql_30 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo30']."', '".Respuesta($_POST['respuesta30'])."', '".$_POST['respuesta30']."')";
mysqli_query($con, $sql_30);
//----------31
$sql_31 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo31']."', '".Respuesta($_POST['respuesta31'])."', '".$_POST['respuesta31']."')";
mysqli_query($con, $sql_31);
//----------32
$sql_32 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo32']."', '".Respuesta($_POST['respuesta32'])."', '".$_POST['respuesta32']."')";
mysqli_query($con, $sql_32);
//----------33
$sql_33 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo33']."', '".Respuesta($_POST['respuesta33'])."', '".$_POST['respuesta33']."')";
mysqli_query($con, $sql_33);
//----------34
$sql_34 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo34']."', '".Respuesta($_POST['respuesta34'])."', '".$_POST['respuesta34']."')";
mysqli_query($con, $sql_34);
//----------35
$sql_35 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo35']."', '".Respuesta($_POST['respuesta35'])."', '".$_POST['respuesta35']."')";
mysqli_query($con, $sql_35);
//----------36
$sql_36 = "INSERT INTO tb_implementacionsa_detalle (id_implementacion, pregunta, respuesta, resultado )
VALUES ('".$id."', '".$_POST['Titulo36']."', '".Respuesta($_POST['respuesta36'])."', '".$_POST['respuesta36']."')";
mysqli_query($con, $sql_36);

//------------------
mysqli_close($con);
//------------------