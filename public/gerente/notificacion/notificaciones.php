<?php
require('../../../app/help.php');

$mesletra = nombremes(date("m"));

$PADM = ProgramaMantenimiento($fecha_del_dia,$mesletra,$con);

function ProgramaMantenimiento($fechadia,$mesletra,$con){
$hoy = date("Y-m-d h:i:s");
$formatomesletra = strtolower($mesletra);

$sql_mantenimiento_lista = "SELECT po_mantenimiento_lista.id, po_mantenimiento_lista.detalle, po_programa_anual_mantenimiento_detalle.id_programa_fecha, po_programa_anual_mantenimiento_detalle.enero,po_programa_anual_mantenimiento_detalle.febrero,po_programa_anual_mantenimiento_detalle.marzo,po_programa_anual_mantenimiento_detalle.abril,po_programa_anual_mantenimiento_detalle.mayo,po_programa_anual_mantenimiento_detalle.junio,po_programa_anual_mantenimiento_detalle.julio,po_programa_anual_mantenimiento_detalle.agosto,po_programa_anual_mantenimiento_detalle.septiembre,po_programa_anual_mantenimiento_detalle.octubre,po_programa_anual_mantenimiento_detalle.noviembre,po_programa_anual_mantenimiento_detalle.diciembre,po_programa_anual_mantenimiento_detalle.estado
	FROM po_mantenimiento_lista
	INNER JOIN po_programa_anual_mantenimiento_detalle
	ON po_mantenimiento_lista.id = po_programa_anual_mantenimiento_detalle.id_mantenimiento WHERE po_programa_anual_mantenimiento_detalle.febrero = '$fechadia' AND po_programa_anual_mantenimiento_detalle.estado = 1 ";
        $result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
        $numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);

        if($numero_mantenimiento_lista != 0){

        while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){
        	$id = $row_mantenimiento_lista['id_programa_fecha'];
        	$detalle = $row_mantenimiento_lista['detalle'];

			$sql_programa = "SELECT * FROM po_programa_anual_mantenimiento WHERE id = '".$id."' AND estado = 1" ;
			$result_programa = mysqli_query($con, $sql_programa);
			while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
			$idestacion = $row_programa['id_estacion'];
			}

			$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$idestacion."' AND id_puesto = 6" ;
			$result_usuarios = mysqli_query($con, $sql_usuarios);
			while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
			$idusuario = $row_usuarios['id'];

			$sql_noticias = "SELECT * FROM no_noticias WHERE id_usuario = '".$idusuario."' AND detalle = 'Tienes pendiente ".$detalle."' " ;
			$result_noticias = mysqli_query($con, $sql_noticias);
			$numero_noticias = mysqli_num_rows($result_noticias);
			
			if ($numero_noticias == 0) {
			$sql_insert = "INSERT INTO no_noticias (id_usuario,titulo,detalle,fecha_hora,url,estado,alerta)
			VALUES ('".$idusuario."','Programa de Mantenimiento','Tienes pendiente ".$detalle."',
			  '".$hoy."','programa-anual-mantenimiento',0,0)";
			mysqli_query($con, $sql_insert);	
			}else{

			}

			}

           }

           $result = 1;
       }

return $result;
}
?>