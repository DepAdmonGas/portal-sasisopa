<?php
require('../../../app/help.php');

$id = $_GET['id'];
$formato = $_GET['formato'];

$sql = "SELECT * FROM tb_auditoria_interna_anexos WHERE id_auditoria = '".$id."' AND formato = '".$formato."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>

  <div class="modal-header">
  <h4 class="modal-title">Anexos</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">

  <div class="text-secondary">* Documento:</div>
  <select class="form-control" id="Documento">
    <option value=""></option>
    <option value="Lista de verificación">Lista de verificación</option>
    <option value="Acta de verificación">Acta de verificación</option>
    <option value="Acta de verificación">Evidencia</option>
  </select>
  <input type="file" id="ArchivoPdf" class="mt-3">
  <div id="ResultIA"></div>

  <div class="text-right">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnGuardar(<?=$id;?>,<?=$formato;?>)">Agregar</button>
  </div>
  <hr>

    <table class="table table-bordered table-striped table-sm">
    <tbody>
    <?php 
    if ($numero > 0) {
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){


    echo "<tr>";
    echo '<td class="text-center align-middle">'.$row['documento'].'</td>
    <td class="text-center align-middle" width="30"><a target="_BLANK" href="'.$row['archivo'].'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></td>';
    echo "</tr>";
    }
    }else{
    echo "<td colspan='7' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
    }
    ?>
    </tbody>
    </table>
  </div>
