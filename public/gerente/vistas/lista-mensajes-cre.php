<?php
require('../../../app/help.php');

$idFecha = $_GET['idFecha'];
$idReporte = $_GET['idReporte'];

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

$sql_reportecre = "SELECT * FROM re_reporte_cre_mensajes WHERE id_reporte = '".$idReporte."' AND id_fecha = '".$idFecha."' ORDER BY
id DESC  ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);

if ($numero_reportecre != 0) {

while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
$mensaje = $row_reportecre['mensaje'];
$IDUsuario = $row_reportecre['id_usuario'];
$tipoMensaje = $row_reportecre['tipo'];


$fechaBD = explode(" ", $row_reportecre['fecha']);

$fechaMensaje = $fechaBD[0];
$hora = explode(":",$fechaBD[1]);

$horaMensaje = $hora[0].":".$hora[1];

if ($tipoMensaje == 0) {
if ($Session_IDUsuarioBD == $IDUsuario) {
$style_padding = "padding-left";
$style_usuario = "style-usuario-1";
}else{
$style_padding = "padding-right";
$style_usuario = "style-usuario-2";
}
}else{
if ($Session_IDUsuarioBD == $IDUsuario) {
$style_padding = "padding-left";
$style_usuario = "style-act";
}else{
$style_padding = "padding-right";
$style_usuario = "style-act";
}
}

?>

<div class="<?=$style_padding;?>" style="margin-bottom: 15px;">
<div style="font-size: .8em;margin-bottom: 3px;color: #686868;"><?=Usuario($IDUsuario,$con);?></div>
<div class="<?=$style_usuario;?>"><?=$mensaje;?></div>
<div style="font-size: .7em;margin-top: 3px;color: #C3C3C3;"><?=FormatoFecha($fechaMensaje).", ".$horaMensaje;?></div>
</div>
<?php
}
}else{
echo "<div class='text-secondary text-center' style='font-size: .7em;margin-top: 100px;'>No se encontraron mensajes</div>";
}
?>
<style type="text/css">

.padding-left{
padding-left: 60px;
}
.padding-right{
padding-right: 60px;
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
.style-usuario-2{
background: #E8E8E8;
border-top-left-radius: 0;
border-top-right-radius: 15px;
border-bottom-right-radius: 15px;
border-bottom-left-radius: 15px;
padding-top: 5px;
padding-bottom: 5px;
padding-left: 15px;
padding-right: 10px;
color: #393939;
}
.style-act{
background: #F2F077;
border-top-left-radius: 0;
border-top-right-radius: 15px;
border-bottom-right-radius: 15px;
border-bottom-left-radius: 15px;
padding-top: 5px;
padding-bottom: 5px;
padding-left: 15px;
padding-right: 10px;
color: #393939;
}

</style>
