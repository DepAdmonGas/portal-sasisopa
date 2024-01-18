<?php
require('../../../app/help.php');

$id = $_POST['id'];
?>
<div class="border p-3">

<div class="text-right">
<a onclick="ListaGrupoI(<?=$id;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."eliminar.png"; ?>"></a>
</div>

<div class="mb-2 mt-2"><small class="text-secondary">* Nombre:</small></div>
<input type="text" class="form-control rounded-0" id="NombreG">

<div class="mb-2 mt-2"><small class="text-secondary">* Puesto:</small></div>
<input type="text" class="form-control rounded-0" id="PuestoG">

<div class="mb-2 mt-2"><small class="text-secondary">* Especialidad:</small></div>
<input type="text" class="form-control rounded-0" id="EspecialidadG">

<hr>

<div class="text-right">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BTNAgregarGrupo(<?=$id;?>)">Agregar personal</button>	
</div>

</div>