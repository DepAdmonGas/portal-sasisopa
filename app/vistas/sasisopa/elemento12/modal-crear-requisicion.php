<?php
require('../../../../app/help.php');


        $sql_folio = "SELECT no_folio FROM tb_requisicion_obra WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY no_folio desc LIMIT 1 ";
        $result_folio = mysqli_query($con, $sql_folio);
        $numero_folio = mysqli_num_rows($result_folio);

        if ($numero_folio == 0) {
        $NumFolio = "01";
        }else{
        $row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC);
        $folio = $row_folio['no_folio'] + 1;
        $NumFolio = "0".$folio;
        }

?>
  <div class="row">

  <div class="col-12 col-md-4">
  <div class="mb-2"><small class="text-secondary">No. De folio:</small></div>
  <input class="form-control input-style rounded-0 border-0 mb-2" value="<?=$NumFolio;?>" type="text" id="folio" disabled>        
  </div>

  <div class="col-12 col-md-8">
  <div class="mb-2"><small class="text-secondary">Fecha:</small></div>
  <input class="form-control input-style rounded-0" value="<?=$fecha_del_dia;?>" type="date" id="Fecha">  
  </div>
  </div>

  <div class="row mt-2">
  <div class="col-12 col-md-4">
  <div class="mb-2"><small class="text-secondary">Nombre del solicitante:</small></div>
  <input class="form-control input-style rounded-0 border-0 mb-2" value="<?=$session_nomusuario;?>" type="text" disabled>        
  </div>

  <div class="col-12 col-md-8">
  <div class="mb-2"><small class="text-secondary">Empresa solicitante:</small></div>
  <input class="form-control input-style rounded-0 border-0 mb-2" value="<?=$Session_Razonsocial;?>" type="text" disabled>        
  </div>
  </div>

  <div class="row mt-2">
  <div class="col-12 col-md-12">
  <div class="mb-2"><small class="text-secondary">* Descripcion detallada del servicio que requiere:</small></div>
  <textarea class="form-control rounded-0 mb-2" rows="4" id="Descripcion"></textarea>       
  </div>
  </div>
  
  <div class="row mt-2">
  <div class="col-12 col-md-12">
  <div class="mb-2"><small class="text-secondary">* Justificacion del servicio solicitado:</small></div>
  <textarea class="form-control rounded-0 mb-2" rows="4" id="Justificacion"></textarea>       
  </div>
  </div>