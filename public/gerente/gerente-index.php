<?php
require('../../app/help.php');
?>

<script type="text/javascript">
$(document).ready(function($){

AccesoDirecto();
PuntosSasisopa();
 });
 function AccesoDirecto(){
 $('#DivAccesoDirecto').load('public/gerente/vistas/acceso-directo.php');
 }
 function PuntosSasisopa(){
 $('#DivPuntosSasisopa').load('public/gerente/vistas/puntos-sasisopa.php');
 }
 function Noticias(){
   $('#DivPuntosSasisopa').load('public/gerente/vistas/noticias.php');
 }

function ReporteCRE(){
window.location.href = "reporte-diario";
}
function Personal(){
window.location.href = "personal";
}
function btnMisCursos(){
window.location.href = "mis-cursos";
}
function ProgramaImplementacion(){
window.location.href = "programa-implementacion";
}
function Comunicados(){
window.location.href = "comunicados";      
}
function ProgramaAnualM(){
window.location.href = "programa-anual-mantenimiento";     
}

function Nom035(){
window.location.href = "nom-035-etapas";  
}

function CambioPrecio(){
window.location.href = "cambio-precio";    
}

function BitacoraProfeco(){
window.location.href = "bitacora-profeco";      
}

</script>
<style>
.sidenav {
    height: 100%;
    width: 350px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    overflow-x: hidden;
    padding-top: 65px;
    padding-left: 5px;
    padding-right: 5px;
}

.main {
    margin-left: 350px; /* Same as the width of the sidenav */
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
</style>

<div class="sidenav">
<div id="DivAccesoDirecto"></div>
</div>

<div class="main">
<div id="DivPuntosSasisopa"></div>
</div>

