<?php
$id = $_POST['id'];
?>

 <div class="modal-header">
   <h4 class="modal-title">Ingresos a la ASEA</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<div class="text-right">
<button type="button" class="btn btn-info btn-sm" style="border-radius: 0px;" onclick="BTNASEA(<?=$id;?>)">Agregar archivo ASEA</button>	
</div>
<hr>
<div id="ContenidoAsea"></div>

</div>
