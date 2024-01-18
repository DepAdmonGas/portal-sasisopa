<?php
require('../../../app/help.php');

$sql_noticias = "SELECT * FROM no_noticias WHERE id_usuario = '".$Session_IDUsuarioBD."' AND estado = 0";
$result_noticias = mysqli_query($con, $sql_noticias);
$numero_noticias = mysqli_num_rows($result_noticias);

?>
<script type="text/javascript">
$(document).ready(function($){
ListaNoticias();
});

function ListaNoticias(){
  $('#DivNoticias').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");

  $('#DivNoticias').load('public/gerente/vistas/lista-noticias.php');
}

function btnclick(){
  if (Notification.permission !== "granted")
      Notification.requestPermission();
    else {
      var notification = new Notification('Notification title', {
        icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
        body: "Hey there! You've been notified!",
      });

      notification.onclick = function () {
        window.open("http://stackoverflow.com/a/13328397/1269037");
      };

    }
}
</script>



<div class="border-0 p-3"> 

  <div class="row"> 
  <div class="col-10">
  <h5 class="mb-2">Noticias </h5>
  </div>

  <div class="col-2">
  <span class="badge bg-success float-end p-2"><?=$numero_noticias;?></span> 
  </div>

  </div> 
  <hr>

<div id="DivNoticias"></div>

</div>



