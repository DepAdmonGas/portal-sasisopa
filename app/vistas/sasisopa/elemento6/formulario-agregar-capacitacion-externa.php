<div class="modal-header rounded-0 head-modal">
   <h4 class="modal-title text-white">CAPACITACIÓN EXTERNA</h4>
   <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
 </div>
 <div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Nombre del curso:</small></div>
<textarea class="form-control rounded-0" id="Curso"></textarea>

<div class="mt-2 mb-2"><small class="text-secondary">* Fecha programada:</small></div>
<input type="date" class="form-control rounded-0" id="FechaCurso">

<div class="mt-2 mb-2">
<small class="text-secondary">Duración:</small></div>

<div class="form-inline">

<input type="text" class="form-control rounded-0 col-8" id="Duracion">

<select class="col-4 form-control rounded-0" id="DuracionDetalle">
<option value="">Selecciona</option>
<option value="Minutos">Minutos</option>
<option value="Horas">Horas</option>
</select>
</div>

<div class="mt-2 mb-2"><small class="text-secondary">Nombre del instructor:</small></div>
<input type="text" class="form-control rounded-0" id="Instructor">

 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAgregar()">Agregar</button>
 </div>