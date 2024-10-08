<?php
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];
$Mes = $_GET['Mes'];
$Year = $_GET['Year'];

if ($Mes == 1) {

  $MesAnterior = 12;
  $YearAnterior = $Year - 1;

  $MesSiguiente = $Mes + 1;
  $YearSiguiente = $Year;
} else if ($Mes == 12) {

  $MesAnterior = $Mes - 1;
  $YearAnterior = $Year;

  $MesSiguiente = 1;
  $YearSiguiente = $Year + 1;
} else {
  $MesAnterior = $Mes - 1;
  $YearAnterior = $Year;

  $MesSiguiente = $Mes + 1;
  $YearSiguiente = $Year;
}

function Actividades($idEstacion, $CalenDate, $con)
{

  $sql = "SELECT * FROM tb_calendario_actividades WHERE id_estacion = '" . $idEstacion . "' AND fecha_inicio = '" . $CalenDate . "' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);

  if ($numero > 0) {
    $result = $numero;
  } else {
    $result = '';
  }

  return $result;
}

function generar_calendario($idEstacion, $month, $year, $lang, $con)
{
  date_default_timezone_set('America/Mexico_City');
  $fecha_del_dia = date("Y-m-d");

  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar" width="100%">';

  if ($lang == 'en') {
    $headings = array('M', 'T', 'W', 'T', 'F', 'S', 'S');
  }
  if ($lang == 'es') {
    $headings = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
  }
  if ($lang == 'ca') {
    $headings = array('DI', 'Dm', 'Dc', 'Dj', 'Dv', 'Ds', 'Dg');
  }

  $calendar .= '<tr class="calendar-row"><td class="calendar-day-head font-weight-bold p-3 text-center">' . implode('</td><td class="calendar-day-head font-weight-bold text-center">', $headings) . '</td></tr>';

  $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
  $running_day = ($running_day > 0) ? $running_day - 1 : $running_day;
  $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();

  $calendar .= '<tr class="calendar-row">';

  for ($x = 0; $x < $running_day; $x++):
    $calendar .= '<td class="calendar-day-np"> </td>';
    $days_in_this_week++;
  endfor;

  for ($list_day = 1; $list_day <= $days_in_month; $list_day++):


    $class = "day-number ";

    if ($running_day == 6) {
      $class .= "not-work ";
    }

    $key_month_day = "month_{$month}_day_{$list_day}";

    $CalenDate = $year . '-' . $month . '-' . $list_day;

    if (strtotime($CalenDate) == strtotime($fecha_del_dia)) {
      $classYes = "yes-day ";
    } else {
      $classYes = "not-day ";
    }

    $Actividades = Actividades($idEstacion, $CalenDate, $con);


    $calendar .= '<td class="calendar-day td-efect ' . $classYes . '">';
    $calendar .= "<div class='{$class}' onclick='SelDay(" . $idEstacion . "," . strtotime($CalenDate) . ")'>
        <div class='style-day'><h6>" . $list_day . "</h6></div>
        <div class='text-end p-1'><small><span class='badge bg-danger text-white'>" . $Actividades . "</span></small></div>
        </div>";

    $calendar .= '</td>';
    if ($running_day == 6):
      $calendar .= '</tr>';
      if (($day_counter + 1) != $days_in_month):
        $calendar .= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++;
    $running_day++;
    $day_counter++;
  endfor;

  if ($days_in_this_week < 8):
    for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar .= '<td class="calendar-day-np"> </td>';
    endfor;
  endif;

  $calendar .= '</tr>';

  $calendar .= '</table>';

  return $calendar;
}

?>

<div class="card rounded-0">
  <div class="card-body">
    <div class="row">
      <div class="col-11">
        <h5 class="text-secondary"><?= nombremes($Mes) . ' ' . $Year; ?></h5>
      </div>
      <div class="col-1 text-end">
        <a onclick="Modal(<?= $idEstacion; ?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar">
          <img src="<?php echo RUTA_IMG_ICONOS . "agregar.png"; ?>">
        </a>
      </div>
    </div>
    <?= generar_calendario($idEstacion, $Mes, $Year, "es", $con); ?>


    <div class="text-right">
      <div class="btn-group mt-2" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-outline-light btn-sm rounded-0" onclick="Calendario(<?= $idEstacion; ?>,<?= $MesAnterior; ?>,<?= $YearAnterior; ?>)"><img class="text-center cursor" src="<?php echo RUTA_IMG_ICONOS . "icon-anterior.png"; ?>"></button>
        <button type="button" class="btn btn-outline-light btn-sm rounded-0" onclick="Calendario(<?= $idEstacion; ?>,<?= $MesSiguiente; ?>,<?= $YearSiguiente; ?>)"><img class="text-center cursor" src="<?php echo RUTA_IMG_ICONOS . "icon-siguiente.png"; ?>"></button>
      </div>
    </div>

  </div>
</div>