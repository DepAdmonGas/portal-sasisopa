<?php
$id = $_POST['id'];

 ?>
 <div class="modal-header">
   <h4 class="modal-title">Fo.ADMONGAS.025 (PLAN DE ATENCIÓN DE HALLAZGOS)</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<div class="mb-2"><small class="text-secondary">* DOCUMENTO PLAN DE ATENCIÓN DE HALLAZGOS:</small></div>
<input type="file" id="ArchivoPdf">
<div id="ResultIA"></div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BTNArchivoPAH(<?=$id;?>)">Agregar archivo</button>
</div>