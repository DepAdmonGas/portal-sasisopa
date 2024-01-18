<?php
require('../../../app/help.php');

$sql = "UPDATE no_noticias SET
estado = 1
WHERE id = '".$_POST['idNoticia']."' ";
mysqli_query($con, $sql);

$sql = "SELECT url FROM no_noticias WHERE id = '".$_POST['idNoticia']."' ";
$result = mysqli_query($con, $sql);
while($row_noticia = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo $row_noticia['url'];
}
mysqli_close($con);

?>
