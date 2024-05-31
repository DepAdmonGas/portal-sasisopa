<?php
$id = $_POST['id'];

 ?>
 <div class="modal-header">
   <h4 class="modal-title">Fo.ADMONGAS.026 (Formato para el informe detallado de la Investigación de Causa Raíz de los Eventos tipo 1)</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<div class="mb-2"><small class="text-secondary">* DOCUMENTO FORMATO PARA EL INFORME DETALLADO:</small></div>
<input class="mt-2" type="file" id="ArchivoPdf">
<div id="ResultIA"></div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BTNArchivoID(<?=$id;?>)">Agregar archivo</button>
</div>