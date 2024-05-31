<?php
require('../../../../app/help.php');

$id = $_POST['id'];

?>
<script type="text/javascript">
$(document).ready(function(){

});
</script>
 <div class="modal-header">
   <h4 class="modal-title">Grupo interdiciplinario</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">
<div class="text-right">
<button type="button" class="btn btn-info btn-sm" style="border-radius: 0px;" onclick="FormularioGrupoInter(<?=$id;?>)">Agregar personal al grupo</button>	
</div>
<hr>
<div id="ConteListaGrupo"></div>

</div>
