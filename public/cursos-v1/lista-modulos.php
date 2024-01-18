<?php
require('../../app/help.php');
$idTema = $_GET['idTema'];
?>
<script type="text/javascript">
      $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


  function BTNIniciar(idtema,idmodulo){
  window.location.href = "<?php echo RUTA_MODULOS_INICIAR; ?>/" + idtema + "/" + idmodulo;
  }

  function BTNSubModulos(idtema,idmodulo){
  ndow.location.href = "<?php echo RUTA_SUBMODULOS; ?>/" + idtema + "/" + idmodulo;
  }

function btnReconocimiento(idmosulo){
window.location.href = "<?php echo RUTA_RECONOCIMIENTO.'/'.$idTema.'/'; ?>"+idmosulo + '/<?=$Session_IDUsuarioBD;?>';
}
</script>
<style type="text/css">

.card-cursos-home{
border: 0px;
border-radius: 0;
box-shadow: 1px 1px 5px #EDEDED;
margin: 0px;
border-bottom: 4px solid #2975C1;
}
  
.card-cursos-disabled{
 
border: 0px;
border-radius: 0;
box-shadow: 1px 1px 5px #EDEDED;
margin: 0px;
border-bottom: 4px solid #979797;
background: rgba(204, 204, 204, 0.35);

}
</style>
 

 <div id="div-cursos" class="row">

      <?php
      $sql= "
      SELECT cu_evaluacion_modulos.id,cu_evaluacion_modulos.id_evaluacion_tema,cu_evaluacion_modulos.id_modulo,cu_evaluacion_modulos.num_modulo,cu_evaluacion_modulos.estado, cu_modulos.descripcion
          FROM cu_evaluacion_modulos
          INNER JOIN cu_modulos ON cu_evaluacion_modulos.id_modulo = cu_modulos.id where cu_evaluacion_modulos.id_evaluacion_tema = '".$idTema."' ";
                $query = mysqli_query($con, $sql);

        for ($i=1; $row = mysqli_fetch_array($query); $i++){
          $moduloid = $row['id'];
          $nummodulo = $row['num_modulo'];
          $estado = $row['estado'];

          $resultSubModulos = $ClassCursos->BuscarSubModulosID($moduloid,$con);
          $numeroSubModulos = mysqli_num_rows($resultSubModulos);

          $resultdiapositivas = $ClassCursos->ModuloDiapositivas($row['id_modulo'],$con);
          $numero_diapositivas = mysqli_num_rows($resultdiapositivas);

          $resultDetaModulo = $ClassCursos->BuscarEvaluacionDetalle($moduloid,$con);
          $estadoModulo = $resultDetaModulo['estado'];
          $preguntas   =  $resultDetaModulo['preguntas'];
          $puntos      =  $resultDetaModulo['puntos'];

          if ($estadoModulo == 1) {
            $calificacion = $puntos;

            if( $calificacion >= 80  && $calificacion <= 100){
                    $colorC = "text-success";
                    $title = "Excelente";
                    $btnReco = "<div class='float-right' style='padding-right: 20px;'><button onclick='btnReconocimiento(".$moduloid.")' type='button' class='btn btn-outline-primary btn-sm' >Reconocimiento</button></div>";
            }else if($calificacion >= 70 && $calificacion <= 7){
                    $colorC = "text-warning";
                    $title = "Bueno";
                    $btnReco = "<div class='float-right' style='padding-right: 20px;'><button onclick='btnReconocimiento(".$moduloid.")' type='button' class='btn btn-outline-primary btn-sm' >Reconocimiento</button></div>";
            }else if($calificacion >= 0 && $calificacion <= 69){
                    $colorC = "text-danger";
                    $title = "Malo";
                    $btnReco = "";
                  }

                  $calificacion = "<div class='text-right'><label class='".$colorC." font-weight-bold' data-toggle='tooltip' data-placement='top' title='".$title."'><img src='".RUTA_IMG."iconos/insignia.png'> ".$calificacion."% </label></div>";


                  }else{
                    $calificacion = "";
                    $btnReco = "";
                  }


                  if ($numeroSubModulos != 0) {

                   $submodulos = "<div><a><a style='color: #1BB05F;font-size: 3.5em;font-weight: bold'>".$numeroSubModulos."</a> <a class='text-muted' style='font-size: .9em;'>Sub módulos</a></a></div>";
                   $btn_titulo = "Ver Sub Módulos";
                   $onclick = "BTNSubModulos(".$idTema.",".$moduloid.")";

                  }else{

                   $submodulos = "<div>
                   <a style='color: #1BB05F;font-size: 3.5em;font-weight: bold'>".$numero_diapositivas."</a>
                   <a class='text-muted'>Diapositivas</a>
                   </div>";
                   $btn_titulo = "Iniciar Módulo";
                   $onclick = "BTNIniciar(".$idTema.",".$moduloid.")";

                  }

                   if ($estado == 0) {

                    $disabled = "disabled";
                    $cardcurso_disables = "card-cursos-disabled";

                   }else if($estado == 1){

                    $disabled = "";
                    $cardcurso_disables = "card-cursos-home";

                   }else if($estado == 3){
                    $disabled = "";
                    $cardcurso_disables = "card-cursos-home";
                   }

                    ?>




  <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-2">
  <div style="padding: 10px;" >
  
  <div class="card-cursos-float">
  <div class="card <?php echo $cardcurso_disables; ?>" >
  
  <div class="card-body text-center">
  <?php echo $calificacion; ?>

  <div class="row">

 <div class="col-12 mb-2">
  <h5 class="d-inline-block text-truncate float-left" data-toggle="tooltip" data-placement="top" title="<?php echo $row['descripcion']; ?>">
 
  <span class="badge badge-pill badge-secondary">
  <?php echo $nummodulo ?>
  </span> 
  </h5>
  </div>

 <div class="col-12">
  <h5>
  <?php echo $row['descripcion']; ?>
  </h5>
</div>

  </div>

  <?php echo $submodulos; ?>
  
  <div>
  
  <div class="float-right" >
  <button type="button" class="btn btn-outline-success btn-sm mt-3" onclick="<?php echo $onclick; ?>" <?php echo $disabled; ?> ><?php echo $btn_titulo; ?></button>
  </div>
  
  <?php echo $btnReco; ?>
   </div>

  </div>

  </div>
  </div>

  </div>

  </div>



  <?php
  }
  ?>

  </div>

  <hr>



