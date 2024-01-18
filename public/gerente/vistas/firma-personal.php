<?php
require('../../../app/help.php');
$idUsuario = $_GET['idUsuario'];

$sql = "SELECT firma FROM tb_usuarios WHERE id = '".$idUsuario."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
if($row['firma'] != ""){
echo '<div class="text-center"><img style="width: 80%" src="'.RUTA_IMG_FIRMA_PERSONAL.$row['firma'].'" /></div>';
}
}
}
?>
