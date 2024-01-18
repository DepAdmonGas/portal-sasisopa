<?php
require('../../../app/help.php');

$idReport = $_POST['Idresult'];

if ($_POST['IdProd'] == 2) {

	if ($_POST['IdType'] == 1) {
	
	$ruta1 = "../../../archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$ruta2 = "../../../archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";
	$nom1 = "archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$nom2 = "archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";

	if(move_uploaded_file($_FILES['file1']['tmp_name'], $ruta1)) {

	}

	if(move_uploaded_file($_FILES['file2']['tmp_name'], $ruta2)) {

	}

		$sql = "UPDATE re_reporte_cre_mes SET
		f_producto_uno = '".$nom1."',
		f_producto_dos = '".$nom2."'
		WHERE id= '".$idReport."' ";
		mysqli_query($con, $sql);

	}else if ($_POST['IdType'] == 2) {
	
	$ruta1 = "../../../archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$ruta2 = "../../../archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";
	$nom1 = "archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$nom2 = "archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";

	if(move_uploaded_file($_FILES['file1']['tmp_name'], $ruta1)) {

	}

	if(move_uploaded_file($_FILES['file2']['tmp_name'], $ruta2)) {

	}

		$sql = "UPDATE re_reporte_cre_mes SET
		fi_producto_uno = '".$nom1."',
		fi_producto_dos = '".$nom2."'
		WHERE id= '".$idReport."' ";
		mysqli_query($con, $sql);
	
	}else if ($_POST['IdType'] == 3) {
	
	$ruta1 = "../../../archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$ruta2 = "../../../archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";
	$nom1 = "archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$nom2 = "archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";

	if(move_uploaded_file($_FILES['file1']['tmp_name'], $ruta1)) {

	}

	if(move_uploaded_file($_FILES['file2']['tmp_name'], $ruta2)) {

	}

		$sql = "UPDATE re_reporte_cre_mes SET
		ff_producto_uno = '".$nom1."',
		ff_producto_dos = '".$nom2."'
		WHERE id= '".$idReport."' ";
		mysqli_query($con, $sql);
	
	}

}else if ($_POST['IdProd'] == 3) {

if ($_POST['IdType'] == 1) {
	
	$ruta1 = "../../../archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$ruta2 = "../../../archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";
	$ruta3 = "../../../archivos/cre/".$Session_IDEstacion."-P3-".strtotime($hoy).".pdf";
	$nom1 = "archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$nom2 = "archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";
	$nom3 = "archivos/cre/".$Session_IDEstacion."-P3-".strtotime($hoy).".pdf";

	if(move_uploaded_file($_FILES['file1']['tmp_name'], $ruta1)) {

	}

	if(move_uploaded_file($_FILES['file2']['tmp_name'], $ruta2)) {

	}

	if(move_uploaded_file($_FILES['file3']['tmp_name'], $ruta3)) {

	}

		$sql = "UPDATE re_reporte_cre_mes SET
		f_producto_uno = '".$nom1."',
		f_producto_dos = '".$nom2."',
		f_producto_tres = '".$nom3."'
		WHERE id= '".$idReport."' ";
		mysqli_query($con, $sql);

	}else if ($_POST['IdType'] == 2) {
	
	$ruta1 = "../../../archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$ruta2 = "../../../archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";
	$ruta3 = "../../../archivos/cre/".$Session_IDEstacion."-P3-".strtotime($hoy).".pdf";
	$nom1 = "archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$nom2 = "archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";
	$nom3 = "archivos/cre/".$Session_IDEstacion."-P3-".strtotime($hoy).".pdf";

	if(move_uploaded_file($_FILES['file1']['tmp_name'], $ruta1)) {

	}

	if(move_uploaded_file($_FILES['file2']['tmp_name'], $ruta2)) {

	}

	if(move_uploaded_file($_FILES['file3']['tmp_name'], $ruta3)) {

	}

		$sql = "UPDATE re_reporte_cre_mes SET
		fi_producto_uno = '".$nom1."',
		fi_producto_dos = '".$nom2."',
		fi_producto_tres = '".$nom3."'
		WHERE id= '".$idReport."' ";
		mysqli_query($con, $sql);
	
	}else if ($_POST['IdType'] == 3) {
	
	$ruta1 = "../../../archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$ruta2 = "../../../archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";
	$ruta3 = "../../../archivos/cre/".$Session_IDEstacion."-P3-".strtotime($hoy).".pdf";
	$nom1 = "archivos/cre/".$Session_IDEstacion."-P1-".strtotime($hoy).".pdf";
	$nom2 = "archivos/cre/".$Session_IDEstacion."-P2-".strtotime($hoy).".pdf";
	$nom3 = "archivos/cre/".$Session_IDEstacion."-P3-".strtotime($hoy).".pdf";

	if(move_uploaded_file($_FILES['file1']['tmp_name'], $ruta1)) {

	}

	if(move_uploaded_file($_FILES['file2']['tmp_name'], $ruta2)) {

	}

	if(move_uploaded_file($_FILES['file3']['tmp_name'], $ruta3)) {

	}

		$sql = "UPDATE re_reporte_cre_mes SET
		ff_producto_uno = '".$nom1."',
		ff_producto_dos = '".$nom2."',
		ff_producto_tres = '".$nom3."'
		WHERE id= '".$idReport."' ";
		mysqli_query($con, $sql);
	
	}

}







