 <?php
require('../../../../app/help.php');

$sql = "DELETE FROM tb_usuarios_experiencia_laboral WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

?>

