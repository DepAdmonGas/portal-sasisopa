<?php
require('../../../../app/help.php');
$id = $_POST['id'];

 ?>
<div class="border p-3">
<div class="text-right">
<a onclick="ListaAsea(<?=$id;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."eliminar.png"; ?>"></a>
</div>

<div class="mb-2"><small class="text-secondary">* DOCUMENTO INGRESO A LA ASEA:</small></div>
<input type="file" id="ArchivoPdf">
<div id="ResultIA"></div>

<div class="mb-2 mt-2"><small class="text-secondary">* COMENTARIO:</small></div>
<textarea class="form-control rounded-0" id="Comentario"></textarea>

<hr>
<div class="text-right">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BTNArchivoASEA(<?=$id;?>)">Agregar archivo</button>
</div>
</div>