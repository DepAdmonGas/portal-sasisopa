<?php
require('../../../app/help.php');

if ($Session_TipoPuestoBD != "Administrador-Root" || $Session_TipoPuestoBD != "Administrador") {
$ClassCursos->ValidaTemasUsuario($Session_IDUsuarioBD,$con);
}


$sql = "SELECT cu_evaluacion_tema.id, cu_evaluacion_tema.id_tema,cu_evaluacion_tema.id_usuario,cu_evaluacion_tema.estado, cu_temas.tema
FROM cu_evaluacion_tema
INNER JOIN cu_temas ON cu_evaluacion_tema.id_tema = cu_temas.id WHERE cu_evaluacion_tema.id_usuario = '".$Session_IDUsuarioBD."' ";
$query = mysqli_query($con, $sql);


?>
<script type="text/javascript">
      $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

  function BTNverModulos(idtema){
  window.location.href = "modulos/" + idtema;
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

<div class="row no-gutters">
<?php
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){

  $temaid = $row['id'];
  $estado = $row['estado'];

   $resultmodulos = $ClassCursos->TotalModulos($temaid,$con);
   $numero_modulos = mysqli_num_rows($resultmodulos);
   $resultmodulosFin = $ClassCursos->TotalModulosFinalizados($temaid,$con);
   $numero_modulos_fin = mysqli_num_rows($resultmodulosFin);

   if ($estado == 0) {

    $disabled = "disabled";
    $cardcurso_disables = "card-cursos-disabled";

   }else if($estado == 1){

    $disabled = "";
    $cardcurso_disables = "card-cursos-home";

   }

?>
<div class="col-4">
<div class="" style="padding: 10px;" >
  <div class="card-cursos-float">
  <div class="card <?php echo $cardcurso_disables; ?>" >
  <div class="card-body text-center">
  <h5 data-toggle="tooltip" data-placement="top" title="<?php echo $row['tema']; ?>"><?php echo $row['tema']; ?></h5>
  <div><a><a style="color: #1BB05F;font-size: 3.5em;font-weight: bold"><?php echo $numero_modulos; ?></a> <a class="text-muted" style="font-size: .9em;">Módulos</a></a></div>
  <div><a class="text-muted" style="font-size: .8em;"> <?php echo "Finalizados ".$numero_modulos_fin." de ".$numero_modulos; ?></a></div>
  <div align="right"><button type="button" class="btn btn-outline-success btn-sm" onclick="BTNverModulos(<?php echo $temaid; ?>)" <?php echo $disabled; ?> >Ver Módulos</button></div>
  </div>
  </div>
  </div>
</div>
</div>
 <?php
 }
 ?>
</div>
