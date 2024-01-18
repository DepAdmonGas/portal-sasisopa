<?php 
require('../../../app/help.php');

$Year = $_GET['Year'];
$Porcentaje = 0;
$TotalCapacitacionPersonal = 0;

function TotalPersonal($IDEstacion,$con){
$sql = "SELECT * FROM tb_usuarios WHERE id_gas = '".$IDEstacion."' AND (id_puesto = 6 OR id_puesto = 7 OR id_puesto = 9 OR id_puesto = 10 OR id_puesto = 11) AND estatus = 0 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
return $numero;
}

function TotalCapacitacion($IDEstacion,$Year,$con){
$sql = "SELECT * FROM tb_capacitacion_externa WHERE id_estacion = '".$IDEstacion."' AND YEAR(fechacreacion) = '".$Year."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
return $numero;
}

function TotalCapacitacionPersonal($IDEstacion,$Year,$con){

$sql = "SELECT id FROM tb_capacitacion_externa WHERE id_estacion = '".$IDEstacion."' AND YEAR(fechacreacion) = '".$Year."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

if($numero == 0){
$Resultado = 0;
}else{
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$sqlCP = "SELECT id FROM tb_capacitacion_externa_personal WHERE id_capacitacion = '".$row['id']."' ";
$resultCP = mysqli_query($con, $sqlCP);
$numeroCP = mysqli_num_rows($resultCP);

$Total = $Total + $numeroCP;
}	

$Resultado = ceil($Total / $numero);

}

return $Resultado;
}

$TotalPersonal = TotalPersonal($Session_IDEstacion,$con);
$TotalCapacitacionPersonal = TotalCapacitacionPersonal($Session_IDEstacion,$Year,$con);

?>

<h5>Año <?=$Year;?></h5>
<div class="row">
	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
		
	<div class="border">
    <div class="p-3">

    	<h5>Programa de capacitación interna </h5>
        <hr>

        <?php 



        $sql = "SELECT * FROM tb_cursos_modulos ";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $numModulo = $row['num_modulo'];
        $noacreditado = 0;
        $acreditado = 0;
        $numero_curso = 0;
        echo '<div class="text-secondary mt-2 mb-2"><b>'.$numModulo.'.- '.$row['titulo'].'</b></div>';

		$sql_curso = "SELECT 
		tb_cursos_calendario.id, 
		tb_cursos_calendario.fecha_programada, 
		tb_cursos_calendario.id_estacion, 
		tb_cursos_calendario.id_personal, 
		tb_cursos_calendario.id_tema,
		tb_cursos_calendario.resultado, 
		tb_cursos_calendario.estado, 
		tb_cursos_temas.num_tema,
		tb_cursos_temas.titulo,
		tb_cursos_modulos.id,
		tb_cursos_modulos.num_modulo,
		tb_cursos_modulos.titulo AS nomModulo
		FROM tb_cursos_calendario 
		INNER JOIN tb_cursos_temas 
		ON tb_cursos_calendario.id_tema = tb_cursos_temas.id 
		INNER JOIN tb_cursos_modulos
		ON tb_cursos_temas.id_modulo = tb_cursos_modulos.id
		WHERE tb_cursos_calendario.id_estacion = '".$Session_IDEstacion."' AND tb_cursos_modulos.id = '".$row['id']."' AND YEAR(fecha_programada) = '".$Year."' ORDER BY tb_cursos_calendario.fecha_programada DESC "; 
		$result_curso = mysqli_query($con, $sql_curso);
        $numero_curso = mysqli_num_rows($result_curso);
        while($row_curso = mysqli_fetch_array($result_curso, MYSQLI_ASSOC)){

        if($row_curso['resultado'] >= 60){
        $acreditado = $acreditado + 1;
        }else{
        $noacreditado = $noacreditado + 1;
        }

        }

        if($acreditado == 0){
        $TotalAcreditado = 0;
        }else{
        $TotalAcreditado = ceil(round(($acreditado / $numero_curso) * 100));
        }

        if($noacreditado == 0){
        $TotalNoAcreditado = 0;
        }else{
        $TotalNoAcreditado = ceil(round(($noacreditado / $numero_curso) * 100));
        }

        $TotalCursos = $TotalCursos + $numero_curso;
        $NetoAcreditado = $NetoAcreditado + $acreditado;
        $NetoNoAcreditado = $NetoNoAcreditado + $noacreditado;
        ?>

            <div class="row mt-3">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
              
              <div class="bg-light p-2">
              <div class="text-center text-secondary"><small>Número de personas capacitadas</small></div>
              <div class="text-center text-info" style="font-size: 3.5em;">
              <b><?=$numero_curso;?></b>
              </div>          
              </div>

            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
              
              <div class="bg-light p-2">
              <div class="text-center text-secondary"><small>Porcentaje de acreditación</small></div>
              <div class="text-center text-success" style="font-size: 3.5em;">
              <b><?=$TotalAcreditado;?> %</b>
              </div>          
              </div>

            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
              
              <div class="bg-light p-2">
              <div class="text-center text-secondary"><small>Porcentaje de no acreditación</small></div>
              <div class="text-center text-danger" style="font-size: 3.5em;">
              <b><?=$TotalNoAcreditado;?> %</b>
              </div>          
              </div>

            </div>
          </div>

        <?php
    	}
        ?>

        <hr>

        <div>Porcentaje total de capacitación</div>

        <?php 

        if($NetoAcreditado == 0){
        $ToPoAcreditado = 0;
        }else{
        $ToPoAcreditado = ceil(round(($NetoAcreditado / $TotalCursos) * 100));
        }

        if($NetoNoAcreditado == 0){
        $ToPoNoAcreditado = 0;
        }else{
        $ToPoNoAcreditado = ceil(round(($NetoNoAcreditado / $TotalCursos) * 100));
        }

        ?>

        <div class="row mt-3">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
              
              <div class="bg-light p-2">
              <div class="text-center text-secondary"><small>Total cursos tomados por personal</small></div>
              <div class="text-center text-info" style="font-size: 3.5em;">
              <b><?=$TotalCursos;?></b>
              </div>          
              </div>

            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
              
              <div class="bg-light p-2">
              <div class="text-center text-secondary"><small>Porcentaje de acreditación</small></div>
              <div class="text-center text-success" style="font-size: 3.5em;">
              <b><?=$ToPoAcreditado;?> %</b>
              </div>          
              </div>

            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
              
              <div class="bg-light p-2">
              <div class="text-center text-secondary"><small>Porcentaje de no acreditación</small></div>
              <div class="text-center text-danger" style="font-size: 3.5em;">
              <b><?=$ToPoNoAcreditado;?> %</b>
              </div>          
              </div>

            </div>
          </div>

    </div>
	</div>

	</div>
	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
	
	<div class="border p-3">
        <h5>Programa de capacitación externa</h5>
        <hr>
          <div class="row mt-3">
            
             <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
              
              <div class="bg-light p-2">
              <div class="text-center text-secondary"><small>Total Personal</small></div>
              <div class="text-center text-info" style="font-size: 3.5em;">
              <b><?=$TotalPersonal;?></b>
              </div>          
              </div>

            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
              
              <div class="bg-light p-2">
              <div class="text-center text-secondary"><small>Total capacitaciones</small></div>
              <div class="text-center text-primary" style="font-size: 3.5em;">
              <b><?=TotalCapacitacion($Session_IDEstacion,$Year,$con);?></b>
              </div>          
              </div>

            </div>
            

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">

              <div class="bg-light p-2">
              <div class="text-center text-secondary"><small>Personal capacitado</small></div>
              <div class="text-center text-secondary" style="font-size: 3.5em;">
              <b><?=$TotalCapacitacionPersonal;?></b>
              </div>          
              </div>

            </div>
          </div>

          <hr>

          <?php 
          $Porcentaje = ceil(($TotalCapacitacionPersonal / $TotalPersonal) * 100);
          ?>
              <div class="text-center text-secondary"><small>Porcentaje de capacitación</small></div>
              <div class="text-center text-success" style="font-size: 3.5em;">
              <b><?=$Porcentaje;?> %</b>
              </div>

        </div>

	</div>
</div>