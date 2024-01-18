<?php
require('../../../app/help.php');

$idYear = $_GET['idYear'];

$rep_year = date("Y");
$rep_mes = date("m");

$sql_listames = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' and year = '".$idYear."' ORDER BY mes ASC";
$result_listames = mysqli_query($con, $sql_listames);
$numero_listames = mysqli_num_rows($result_listames);
?>
<style type="text/css">
.hovercolor:hover{
	background: rgba(0, 120, 238, .8) !important;
}
</style>
<script type="text/javascript">
function listacre(mes,year){
 window.location.href = "<?=RUTA_REPORTE_DIARIO?>/" + mes + "/" + year;
}
</script>
<?php
while($row_listames = mysqli_fetch_array($result_listames, MYSQLI_ASSOC)){

if ($rep_year != $idYear){
$background = "bg-primary";
$text_color = "text-white";
$cursor = "cursor: pointer";
$hover = "hovercolor";
$onclick = "listacre(".$row_listames['mes'].",".$row_listames['year'].")";
}else{
if ($row_listames['mes'] <= $rep_mes) {
$background = "bg-primary";
$text_color = "text-white";
$cursor = "cursor: pointer";
$hover = "hovercolor";
$onclick = "listacre(".$row_listames['mes'].",".$row_listames['year'].")";
}else{
$background = "bg-light";	
$text_color = "text-secondary";
$cursor = "";
$hover = "";
$onclick = "";
}
}

echo "<div class='p-3 mb-2 $hover $background $text_color' style='$cursor' onclick='$onclick'><b>".nombremes($row_listames['mes'])." ".$row_listames['year']."</b></div>";
}
?>	
