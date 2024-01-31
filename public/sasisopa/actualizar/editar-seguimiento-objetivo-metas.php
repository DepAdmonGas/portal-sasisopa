<?php
require('../../../app/help.php');

if($_POST['opcion'] == 1){

$sql = "UPDATE tb_seguimiento_objetivos_metas_detalle SET
fecha = '".$_POST['detalle']."'
 WHERE id = '".$_POST['idSeguimiento']."' ";

 mysqli_query($con, $sql);

}else if($_POST['opcion'] == 2){

    $sql = "UPDATE tb_seguimiento_objetivos_metas_detalle SET
    medidas = '".$_POST['detalle']."'
     WHERE id = '".$_POST['idSeguimiento']."' ";
    
     mysqli_query($con, $sql);
    
    }else if($_POST['opcion'] == 3){

        $sql = "UPDATE tb_seguimiento_objetivos_metas_detalle SET
        nivel_cumplimiento = '".$_POST['detalle']."'
         WHERE id = '".$_POST['idSeguimiento']."' ";
        
         mysqli_query($con, $sql);
        
        }else if($_POST['opcion'] == 4){

            $sql = "UPDATE tb_seguimiento_objetivos_metas_detalle SET
            fecha_aplicacion = '".$_POST['detalle']."'
             WHERE id = '".$_POST['idSeguimiento']."' ";
            
             mysqli_query($con, $sql);
            
            }


//------------------
mysqli_close($con);
//------------------