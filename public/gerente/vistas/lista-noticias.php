<?php
require('../../../app/help.php');
?>
<style media="screen">
.card-style-0{
  background-color: rgba( 228, 255, 233 ,0.5);
}
  .card-style-0:hover{
    background-color: rgba( 219, 247, 224 ,0.5);
    cursor: pointer;
  }

  .card-style-1{

  }
    .card-style-1:hover{
      background-color: rgba( 252, 252, 252 ,0.5);
      cursor: pointer;
    }
</style>
<script type="text/javascript">
function BtnNoticia(idNoticia) {

  var parametros = {
    "idNoticia" : idNoticia
  };
  $.ajax({
   data:  parametros,
   url:   'public/gerente/editar/noticia-leida.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if (response === "consulta-sasisopa") {    
    window.open ('<?=$Session_Sasisopa;?>', '_blank');
    }else{
    window.location.href = response; 
    }

   }
   });

}

</script>
<?php
$sql_noticias = "SELECT * FROM no_noticias WHERE id_usuario = '".$Session_IDUsuarioBD."' ORDER BY fecha_hora DESC ";
$result_noticias = mysqli_query($con, $sql_noticias);
$numero_noticias = mysqli_num_rows($result_noticias);
  while($row_noticias = mysqli_fetch_array($result_noticias, MYSQLI_ASSOC)){
  $NO_id = $row_noticias['id'];
  $NO_titulo = $row_noticias['titulo'];
  $NO_detalle = $row_noticias['detalle'];
  $NO_fecha_hora = $row_noticias['fecha_hora'];
  $NO_estado = $row_noticias['estado'];

$NO_fecha_entera = strtotime($NO_fecha_hora);
$No_year = date("Y", $NO_fecha_entera);
$NO_mes = date("m", $NO_fecha_entera);
$NO_dia = date("d", $NO_fecha_entera);
$NO_hora = date("H", $NO_fecha_entera);
$NO_minutos = date("i", $NO_fecha_entera);
$NO_segundos = date("s", $NO_fecha_entera);

if ($NO_estado == 0) {
$color_estado = "card-style-0";
}else{
  $color_estado = "card-style-1";
}
?>
<div class="card <?=$color_estado;?>" style="padding: 0px;border-radius: 0px;border: 1px solid #f4f4f4;margin-bottom: 3px;" onclick="BtnNoticia(<?=$NO_id;?>)">
<div class="card-body" style="padding: 10px;">
<div class="float-right" ><label style="font-size: .7em;"><?=$NO_dia.".".nombremes($NO_mes).".".$No_year; ?></label>, <label style="font-size: .7em;"><?=$NO_hora.":".$NO_minutos;?></label> </div>
<h6 class="card-title" style="font-size: 1em;"><?=$NO_titulo;?></h6>
<p class="card-text text-secondary" style="font-size: .9em;"><?=$NO_detalle;?></p>
</div>
</div>
<?php
}
?>
