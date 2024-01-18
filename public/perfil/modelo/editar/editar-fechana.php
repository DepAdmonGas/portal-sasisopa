 <?php 
require('../../../../app/help.php');

$sql = "UPDATE tb_usuarios SET
fecha_nacimiento = '".$_POST['FechaNac']."'
WHERE id= '".$_POST['idUsuario']."' ";
mysqli_query($con, $sql);
mysqli_close($con);
?>
