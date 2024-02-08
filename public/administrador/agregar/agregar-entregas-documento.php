<?php
require('../../../app/help.php');


$sql_insert1 = "INSERT INTO tb_entregas_documentos (
    id_entrega,
    id_estacion,
    documento,
    fecha,
    detalle,
    archivo)
    VALUES (
    '".$_POST['id']."',
    '".$_POST['idEstacion']."',
    '".$_POST['Documento']."',
    '".$_POST['Fecha']."',
    '".$_POST['OriginalCopia']."',
    ''
    )";
    
    if(mysqli_query($con, $sql_insert1)){
    echo 1;
    }else{
    echo 0;
    }
?>