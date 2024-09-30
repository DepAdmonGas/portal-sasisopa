<?php 
require('../../../../app/help.php');
 
$idSeguimiento = $_GET['idSeguimiento'];

?>
        <div class="modal-header rounded-0 head-modal">
        <h4 class="modal-title text-white">Seguimiento de objetivos y metas</h4>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


        <?php  
        
        $sql = "SELECT * FROM tb_seguimiento_objetivos_metas_detalle WHERE id_seguimiento = '".$_GET['idSeguimiento']."' ";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $id = $row['id'];
        $fecha = $row['fecha'];
        $objetivometa = $row['objetivo_meta'];
        $nivelcumplimiento = $row['nivel_cumplimiento'];
        $medidas = $row['medidas'];
        $fechaaplicacion = $row['fecha_aplicacion'];
        ?>
            <div class="border p-2 mb-2">    
            <h5><?=$objetivometa;?></h5>
            <hr>

            <div class="row mt-1">

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
                <div class="mb-2">Fecha:</div>
                <input type="date" class="form-control" value="<?=$fecha;?>" onchange="BtnEditSOM(this,1,<?=$id;?>)">

                <div class="mt-2 mb-1">Medidas de acción para dar cumplimiento:</div>
                <textarea class="form-control" rows="1" onchange="BtnEditSOM(this,2,<?=$id;?>)"><?=$medidas;?></textarea>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
                <div class="mb-1">Nivel de cumplimiento:</div>
                <input type="text" class="form-control" value="<?=$nivelcumplimiento;?>" onchange="BtnEditSOM(this,3,<?=$id;?>)">

                <div class="mt-2 mb-1">Fecha de aplicación :</div>
                <input type="date" class="form-control" value="<?=$fechaaplicacion;?>" onchange="BtnEditSOM(this,4,<?=$id;?>)">
            </div>
            </div>
            </div>

        <?php
        }
        ?>


        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnReturnSOM(<?=$idSeguimiento;?>)">Editar</button>
        </div>