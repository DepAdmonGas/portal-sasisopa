<?php
require('../../../app/help.php');

function Usuario($id,$con){
$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id = '".$id."' LIMIT 1 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$explodeUsuario = explode(" ", $row_usuarios['nombre']);
$nombre = $explodeUsuario[0]." ".$explodeUsuario[1];
}
return $nombre;
}

$sql_insert1 = "INSERT INTO re_reporte_cre_mensajes (id_reporte,id_fecha,id_usuario,fecha,mensaje,tipo)
VALUES (
'".$_POST['idReporte']."',
'".$_POST['idMensajes']."',
'".$_POST['idUsuario']."',
'".$hoy."',
'".$_POST['NewMensaje']."',
0
)";
mysqli_query($con, $sql_insert1);


$fechaBD = explode(" ", $hoy);

$fechaMensaje = $fechaBD[0];
$hora = explode(":",$fechaBD[1]);

$horaMensaje = $hora[0].":".$hora[1];

echo "<div class='padding-left' style='margin-bottom: 15px;'>
<div style='font-size: .8em;margin-bottom: 3px;color: #686868;'>".Usuario($_POST['idUsuario'],$con)."</div>
<div class='style-usuario-1'>".$_POST['NewMensaje']."</div>
<div style='font-size: .7em;margin-top: 3px;color: #C3C3C3;'>".FormatoFecha($fechaMensaje).', '.$horaMensaje."</div>
</div>";
?>

<style type="text/css">
.padding-left{
padding-left: 60px;
}
.style-usuario-1{
background: #036EAF;
border-top-left-radius: 15px;
border-top-right-radius: 15px;
border-bottom-right-radius: 15px;
border-bottom-left-radius: 0;
padding-top: 5px;
padding-bottom: 5px;
padding-left: 15px;
padding-right: 10px;
color: white;
}
</style>
