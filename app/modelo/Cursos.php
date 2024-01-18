<?php

/**
 *
 */
class Cursos
{
  function ValidaTemasUsuario($idUsuario, $con){


  $sql_temas = "SELECT * FROM cu_temas WHERE estado = 1 ";
  $result_temas = mysqli_query($con, $sql_temas);

  while($row_tema = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {

  $idtema = $row_tema['id'];
  $tema = $row_tema['tema'];

  $sql_evaluacion_temas = "SELECT * FROM cu_evaluacion_tema WHERE id_tema = '".$idtema."' and id_usuario = '".$idUsuario."' ";
  $result_evaluacion_tema = mysqli_query($con, $sql_evaluacion_temas);
  $numero_evaluaciones_temas = mysqli_num_rows($result_evaluacion_tema);

  if ($idtema == 1) {
    $estado = 1;
  }else{
    $estado = 0;
  }

 if ($numero_evaluaciones_temas == 0) {
  $sql_insert = "INSERT INTO cu_evaluacion_tema
  (id_tema, id_usuario, estado)
  VALUES (
        '".$idtema."',
        '".$idUsuario."',
        '".$estado."'
        )";

  mysqli_query($con, $sql_insert);
  }
}

$sql_evaluacion_temas_m = "SELECT * FROM cu_evaluacion_tema WHERE id_usuario = '".$idUsuario."' ";
$result_evaluacion_tema_m = mysqli_query($con, $sql_evaluacion_temas_m);
$numero_evaluaciones_temas_m = mysqli_num_rows($result_evaluacion_tema_m);
while($row_tema_m = mysqli_fetch_array($result_evaluacion_tema_m, MYSQLI_ASSOC)) {

$id_Tema = $row_tema_m['id'];
$id_CuTema = $row_tema_m['id_tema'];

$sql_modulos = "SELECT * FROM cu_modulos WHERE id_tema = '".$id_CuTema."' and  estado = 1 ";
$result_modulos = mysqli_query($con, $sql_modulos);
$numero_modulos = mysqli_num_rows($result_modulos);

   while($row_modulos = mysqli_fetch_array($result_modulos, MYSQLI_ASSOC)) {

  $idModulo = $row_modulos['id'];
  $num_modulo = $row_modulos['num_modulo'];

  $sql_evaluacion_modulos = "SELECT * FROM cu_evaluacion_modulos WHERE id_evaluacion_tema = '".$id_Tema."' and id_modulo = '".$idModulo."' ";
  $result_evaluacion_modulos = mysqli_query($con, $sql_evaluacion_modulos);
  $numero_evaluaciones_modulos = mysqli_num_rows($result_evaluacion_modulos);

  if ($num_modulo == 1) {
    $estadoModulo = 1;
  }else{
    $estadoModulo = 0;
  }

if ($numero_evaluaciones_modulos == 0) {

$sql_insert = "INSERT INTO cu_evaluacion_modulos
  (id_evaluacion_tema, id_modulo, num_modulo,estado)
  VALUES (
        '".$id_Tema."',
        '".$idModulo."',
        '".$num_modulo."',
        '".$estadoModulo."'
        )";

  mysqli_query($con, $sql_insert);

}
}
}


$sql_evaluacion_temas_sm = "SELECT * FROM cu_evaluacion_tema WHERE id_usuario = '".$idUsuario."' ";
$result_evaluacion_tema_sm = mysqli_query($con, $sql_evaluacion_temas_sm);
$numero_evaluaciones_temas_sm = mysqli_num_rows($result_evaluacion_tema_sm);
while($row_tema_sm = mysqli_fetch_array($result_evaluacion_tema_sm, MYSQLI_ASSOC)) {

$id_Tema_sm = $row_tema_sm['id'];

$sql_evaluacion_modulos = "SELECT * FROM cu_evaluacion_modulos WHERE id_evaluacion_tema = '".$id_Tema_sm."' ";
$result_evaluacion_modulos = mysqli_query($con, $sql_evaluacion_modulos);
$numero_evaluaciones_modulos = mysqli_num_rows($result_evaluacion_modulos);
while($row_tema_modulos = mysqli_fetch_array($result_evaluacion_modulos, MYSQLI_ASSOC)) {

$id_modulos = $row_tema_modulos['id'];
$idModulo_EV = $row_tema_modulos['id_modulo'];

$sql_submodulos = "SELECT * FROM cu_submodulos WHERE id_modulo = '".$idModulo_EV."' and estado = 1 ";
  $result_submodulos = mysqli_query($con, $sql_submodulos);
  $numero_submodulos = mysqli_num_rows($result_submodulos);

    while($row_submodulos = mysqli_fetch_array($result_submodulos, MYSQLI_ASSOC)) {
    $idsubmodulo = $row_submodulos['id'];
    $num_submodulo = $row_submodulos['num_submodulo'];

    $sql_evaluacion_submodulos = "SELECT * FROM cu_evaluacion_submodulos
    WHERE id_evaluacion_modulo = '".$id_modulos."' and id_submodulo = '".$idsubmodulo."' ";
  $result_evaluacion_submodulos = mysqli_query($con, $sql_evaluacion_submodulos);
  $numero_evaluaciones_submodulos = mysqli_num_rows($result_evaluacion_submodulos);

if ($num_submodulo == 1) {
    $estadosubmodulo = 1;
  }else{
    $estadosubmodulo = 0;
  }

if ($numero_evaluaciones_submodulos == 0) {
  $sql_insert = "INSERT INTO cu_evaluacion_submodulos
  (id_evaluacion_modulo, id_submodulo, num_submodulo,estado)
  VALUES (
        '".$id_modulos."',
        '".$idsubmodulo."',
        '".$num_submodulo."',
        '".$estadosubmodulo."'
        )";

  mysqli_query($con, $sql_insert);
}


}
}
}

}

function TotalCursos($con){

  $sql_cursos = "SELECT * FROM cu_temas WHERE estado = 1 ";
  $result_cursos = mysqli_query($con, $sql_cursos);
  return $result_cursos;
}


/*------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------*/


/*------------------------------------------------------------------------------------------------------------------*/
/*----------------------------Total de modulos y total de modulos finalizados---------------------------------------*/
  function TotalModulos($idtema, $con){

  $sql_modulos = "SELECT * FROM cu_evaluacion_modulos WHERE id_evaluacion_tema = '".$idtema."' ";
  $result_modulos = mysqli_query($con, $sql_modulos);
  return $result_modulos;
}
  function TotalModulosFinalizados($idtema, $con){

  $sql_modulos = "SELECT * FROM cu_evaluacion_modulos WHERE id_evaluacion_tema = '".$idtema."' and estado = 3 ";
  $result_modulos = mysqli_query($con, $sql_modulos);
  return $result_modulos;
}
/*------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------*/

function NombreTemaEvaluacion($idTema,$con){

$sql_temas = "SELECT cu_evaluacion_tema.id,cu_evaluacion_tema.id_tema, cu_temas.tema
FROM cu_evaluacion_tema
INNER JOIN cu_temas ON cu_evaluacion_tema.id_tema = cu_temas.id WHERE cu_evaluacion_tema.id = '".$idTema."' ";
  $result_temas = mysqli_query($con, $sql_temas);
  while($row_tema = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {

  $temadesc = $row_tema['tema'];
  }

  $array = array(
      "tema" => $temadesc
  );

  return $array;
}

function NombreModuloEvaluacion($idModulo, $con){

$sql_temas = "SELECT cu_evaluacion_modulos.id,cu_evaluacion_modulos.id_modulo, cu_modulos.descripcion
FROM cu_evaluacion_modulos
INNER JOIN cu_modulos ON cu_evaluacion_modulos.id_modulo = cu_modulos.id WHERE cu_evaluacion_modulos.id = '".$idModulo."' ";
  $result_temas = mysqli_query($con, $sql_temas);
  while($row_tema = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {

  $temadesc = $row_tema['descripcion'];
  }

  $array = array(
      "descripcion" => $temadesc
  );

  return $array;

}

function NombreSubModuloEvaluacion($idSubmodulo, $con){

    $sql_temas = "SELECT cu_evaluacion_submodulos.id,cu_evaluacion_submodulos.id_submodulo, cu_submodulos.descripcion
FROM cu_evaluacion_submodulos
INNER JOIN cu_submodulos ON cu_evaluacion_submodulos.id_submodulo = cu_submodulos.id WHERE cu_evaluacion_submodulos.id = '".$idSubmodulo."' ";
  $result_temas = mysqli_query($con, $sql_temas);
  while($row_tema = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {

  $temadesc = $row_tema['descripcion'];
  }

  $array = array(
      "descripcion" => $temadesc
  );

  return $array;


}

/*------------------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------------------*/


  function ModuloDiapositivas($idmodulo, $con){

  $sql_modulos = "SELECT * FROM cu_modulos_diapositivas WHERE id_modulo = '".$idmodulo."' ";
  $result_modulos = mysqli_query($con, $sql_modulos);
  return $result_modulos;
}




function BuscarSubModulosID($idModulo,$con){

  $sql_submodulos = "SELECT * FROM cu_evaluacion_submodulos WHERE id_evaluacion_modulo = '".$idModulo."' ";
  $result_submodulos = mysqli_query($con, $sql_submodulos);
  return $result_submodulos;
}

  function SubModuloDiapositivas($idmodulo, $con){

  $sql_modulos = "SELECT * FROM cu_submodulos_diapositivas WHERE id_submodulo = '".$idmodulo."' ";
  $result_modulos = mysqli_query($con, $sql_modulos);
  return $result_modulos;
}


function NumeroDiapositivasModulo($idModulo, $con){

$sql_temas = "SELECT cu_evaluacion_modulos.id,cu_evaluacion_modulos.id_modulo, cu_modulos.id, cu_modulos.descripcion, cu_modulos_diapositivas.descripcion
FROM cu_evaluacion_modulos
INNER JOIN cu_modulos ON cu_evaluacion_modulos.id_modulo = cu_modulos.id
INNER JOIN cu_modulos_diapositivas ON cu_modulos.id = cu_modulos_diapositivas.id_modulo WHERE cu_evaluacion_modulos.id = '".$idModulo."' ";
  $result_temas = mysqli_query($con, $sql_temas);
  $count = mysqli_num_rows($result_temas);

   while($row_diapositivas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {

  $idmodulo = $row_diapositivas['id_modulo'];
  }

  $array = array(
      "idmodulo" => $idmodulo,
      "diapositivas" => $count
  );

  return $array;

}

function NumeroDiapositivasSubModulo($idSubmodulo, $con){

   $sql_temas = "SELECT cu_evaluacion_submodulos.id,cu_evaluacion_submodulos.id_submodulo,cu_submodulos.id, cu_submodulos.descripcion, cu_submodulos_diapositivas.descripcion
FROM cu_evaluacion_submodulos
INNER JOIN cu_submodulos ON cu_evaluacion_submodulos.id_submodulo = cu_submodulos.id
INNER JOIN cu_submodulos_diapositivas ON cu_submodulos.id = cu_submodulos_diapositivas.id_submodulo WHERE cu_evaluacion_submodulos.id = '".$idSubmodulo."' ";
  $result_temas = mysqli_query($con, $sql_temas);
  $count = mysqli_num_rows($result_temas);

   while($row_diapositivas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {

  $subidmodulo = $row_diapositivas['id_submodulo'];
  }

  $array = array(
      "idsubmodulo" => $subidmodulo,
      "diapositivas" => $count
  );

  return $array;

}
//-------------------------------------------------------------------------
function BuscarEvaluacionDetalle($moduloid,$con){

$sql_evaluacion = "SELECT * FROM cu_evaluacion_modulos_detalle WHERE id_evaluacion_modulo = '".$moduloid."' ORDER BY id DESC LIMIT 1 ";
$result_evaluacion = mysqli_query($con, $sql_evaluacion);
$count = mysqli_num_rows($result_evaluacion);

if ($count > 0) {
  while($row_evaluacion = mysqli_fetch_array($result_evaluacion, MYSQLI_ASSOC)) {
  $preguntas = $row_evaluacion['preguntas'];
  $puntos = $row_evaluacion['puntos'];
  }
  $estado = 1;

}else{
$preguntas = 0;
$puntos = 0;
$estado = 0;
}


  $array = array(
    "preguntas" => $preguntas,
    "puntos" => $puntos,
    "estado" => $estado
  );

  return $array;

}
  

}

?>
