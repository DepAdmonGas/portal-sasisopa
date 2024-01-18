  <?php 

  $idTema = $_GET['idTema'];
  $idModulo = $_GET['idModulo']; 
  $valEvaluacion = $_GET['valEvaluacion']; 
  ?>
  <script type="text/javascript">
    
    $(document).ready(function()
    {

    $("#validate").click(function () {  
      $('.pregunta-1').css('border',''); 
      $('.pregunta-2').css('border',''); 
      $('.pregunta-3').css('border',''); 
      $('.pregunta-4').css('border',''); 
      $('.pregunta-5').css('border',''); 
      $('.pregunta-6').css('border',''); 
      $('.pregunta-7').css('border',''); 
      $('.pregunta-8').css('border',''); 
      

      var respuesta1 = $('input:radio[name=preg1]:checked').val();
      var respuesta2 = $('input:radio[name=preg2]:checked').val();
      var respuesta3 = $('input:radio[name=preg3]:checked').val();
      var respuesta4 = $('input:radio[name=preg4]:checked').val();
      var respuesta5 = $('input:radio[name=preg5]:checked').val();
      var respuesta6 = $('input:radio[name=preg6]:checked').val();
      var respuesta7 = $('input:radio[name=preg7]:checked').val();
      var respuesta8 = $('input:radio[name=preg8]:checked').val();
      

      var Titulo1 = $("#Titulo-1").html();
      var Titulo2 = $("#Titulo-2").html();
      var Titulo3 = $("#Titulo-3").html();
      var Titulo4 = $("#Titulo-4").html();
      var Titulo5 = $("#Titulo-5").html();
      var Titulo6 = $("#Titulo-6").html();
      var Titulo7 = $("#Titulo-7").html();
      var Titulo8 = $("#Titulo-8").html();
      
      
      if (respuesta1 != undefined) {
      if (respuesta2 != undefined) {
      if (respuesta3 != undefined) {
      if (respuesta4 != undefined) {
      if (respuesta5 != undefined) {
      if (respuesta6 != undefined) {
      if (respuesta7 != undefined) {
      if (respuesta8 != undefined) {

      var parametros = {
      "idTema" : <?php echo $idTema; ?>,
      "idModulo" : <?php echo $idModulo; ?>,
      "valEvaluacion" : <?php echo $valEvaluacion; ?>,
      "Titulo1" : Titulo1,
      "respuesta1" : respuesta1,
      "Titulo2" : Titulo2,
      "respuesta2" : respuesta2,
      "Titulo3" : Titulo3,
      "respuesta3" : respuesta3,
      "Titulo4" : Titulo4,
      "respuesta4" : respuesta4,
      "Titulo5" : Titulo5,
      "respuesta5" : respuesta5,
      "Titulo6" : Titulo6,
      "respuesta6" : respuesta6,
      "Titulo7" : Titulo7,
      "respuesta7" : respuesta7,
      "Titulo8" : Titulo8,
      "respuesta8" : respuesta8
      };

      $.ajax({
      data:  parametros,
      url:   '../../public/cursos/evaluacion/tema2/modulo-7/evaluacion.php',
      type:  'post',
      beforeSend: function() {
      
      },
      complete: function(){
     $('#DivPrincipal').html("");
      },
      success:  function (response) {
      
     
$('#DivPrincipal').load('../../public/cursos/ver-resultado-modulo.php?' + response + '&idTema=<?=$idTema;?>');

      }
      });

      }else{ $('.pregunta-8').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-7').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-6').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-5').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-4').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-3').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-2').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-1').css('border','2px solid #A52525'); }
            
      });

     });

  </script>
  <style type="text/css">
    .title-pregunta{
      font-size: 1.2em;
    }
    .padding-5{padding: 5px;}
  </style>


  <div class="card animated fadeIn">
  <div class="card-body">
  <div style="font-size: 1.3em;">EVALUACION</div>
  <div style="font-size: 1em;">Responde correctamente las siguientes preguntas </div> 

  <div style="padding: 20px;">

    <div id="resultado"></div>
  
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <!-- --- Pregunta numero 1 --- -->
  <div class="padding-5 pregunta-1">
  <div class="font-weight-bold title-pregunta" id="Titulo-1">1.- ¿Qué se debe de realizar exclusivamente para el mantenimiento de los tanques?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio1Pregunta1" value="a,c,0">
  <label class="form-check-label" for="Radio1Pregunta1">
 a) Sera con base a su programa de mantenimiento o cuando la administración de la estación lo determine.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio2Pregunta2" value="b,c,0">
  <label class="form-check-label" for="Radio2Pregunta2">
  b) Se debe realizar preferentemente con equipo automatizado de limpieza de tanques.
Ser ejecutadas con personal interno o externo, competente en la actividad.


  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg1" id="Radio3Pregunta3" value="c,c,1">
  <label class="form-check-label" for="Radio3Pregunta3">
  c)  Todos los anteriores 
  </label>
  </div>   
  </div>
  <div class="padding-5 pregunta-2">
    <!-- --- Pregunta numero 2 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-2">2.- ¿Son algunos puntos importantes que el encargado de la estación debe de realizar de acuerdo al procedimiento interno de trabajos en áreas confinadas?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio4Pregunta4" value="a,a,1">
  <label class="form-check-label" for="Radio4Pregunta4">
  a)  Extender autorización por escrito, registrando esta autorización y los trabajos realizados en la Bitácora.
Utilizará equipo de protección y seguridad personal, un arnés y cuerda resistente a las sustancias químicas que se encuentren en el espacio confinado.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio5Pregunta5" value="b,a,0">
  <label class="form-check-label" for="Radio5Pregunta5">
  b) Drenar y vaporizar los tanques de almacenamiento, antes de realizar cualquier trabajo en su interior.
Llamar a un apoyo auxiliar como bomberos o policía. 

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg2" id="Radio6Pregunta6" value="c,a,0">
  <label class="form-check-label" for="Radio6Pregunta6">
  c) Estará vigilado y supervisado por trabajadores de acuerdo con los procedimientos de seguridad establecidos.
Parar las actividades en toda la estación y acordonar el área de tanques. 


  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-3">
  <!-- --- Pregunta numero 3 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-3">3.- Requisito esencial que debe de tener la atmosfera, en específico el oxígeno para poder realizar el trabajo en el interior del tanque.</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio7Pregunta7" value="a,c,0">
  <label class="form-check-label" for="Radio7Pregunta7">
  a)  Oxígeno entre 18.5% y 23.5%.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio8Pregunta8" value="b,c,0">
  <label class="form-check-label" for="Radio8Pregunta8">
  b) Oxígeno entre 19.5% y 24.4%.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg3" id="Radio9Pregunta9" value="c,c,1">
  <label class="form-check-label" for="Radio9Pregunta9">
  c) Oxígeno entre 19.5% y 23.5%.

  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-4">
    <!-- --- Pregunta numero 4 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-4">4.- Selecciona el porcentaje de la concentración de gases o vapores inflamables. </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio10Pregunta10" value="a,a,1">
  <label class="form-check-label" for="Radio10Pregunta10">
  a) 5% del valor del límite inferior de inflamabilidad, y de 0% en el caso de que se vaya a realizar un trabajo de corte y/o soldadura.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio11Pregunta11" value="b,a,0">
  <label class="form-check-label" for="Radio11Pregunta11">
  b) 8% del valor del límite inferior de inflamabilidad, y de 0% en el caso de que se vaya a realizar un trabajo de corte y/o soldadura.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg4" id="Radio12Pregunta12" value="c,a,0">
  <label class="form-check-label" for="Radio12Pregunta12">
  c) 6% del valor del límite inferior de inflamabilidad, y de 0% en el caso de que se vaya a realizar un trabajo de corte y/o soldadura.
  </label>
  </div> 
  </div>
  <div class="padding-5 pregunta-5">
  <!-- --- Pregunta numero 5 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-5">5.- ¿Qué procedimiento es el adecuado para la desinfección de la cisterna?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio13Pregunta13" value="a,a,1">
  <label class="form-check-label" for="Radio13Pregunta13">
  a)  Abrir la llave del agua hasta llegar a un nivel de tirante de 10 cm.
Agregar 10 lt de cloro.
Enjuagar las paredes con cloro y agua.
Tallar con escoba durante 10 min.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio14Pregunta14" value="b,a,0">
  <label class="form-check-label" for="Radio14Pregunta14">
 b) Agregarle cloro con aguas
Abrir la llave de paso para que se llene la cisterna.
Darle aviso al Gerente de la estación de servicio.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg5" id="Radio15Pregunta15" value="c,a,0">
  <label class="form-check-label" for="Radio15Pregunta15">
  c) Todas las anteriores.

  </label>
  </div> 
  </div>
  <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --  -- - - - - -   -->
  <div class="padding-5 pregunta-6">
  <!-- --- Pregunta numero 6 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-6">6.- En caso de que el tanque de almacenamiento se deje temporalmente fuera de operación, se aplicará lo siguiente (tres meses)</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg6" id="Radio16Pregunta16" value="a,a,1">
  <label class="form-check-label" for="Radio16Pregunta16">
  a)  Mantener en operación el equipo del sistema de control de inventarios y el de detección electrónica de fugas, o remover el producto que contenga, de tal forma que el volumen remanente no exceda 0.3% de la capacidad total del tanque o su nivel sea como máximo 25 mm con respecto a la parte más baja del interior del tanque.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg6" id="Radio17Pregunta17" value="b,a,0">
  <label class="form-check-label" for="Radio17Pregunta17">
 b) Cerrar todas las boquillas del tanque de almacenamiento (de llenado, bomba sumergible, etc.), excepto la de la tubería de venteo.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg6" id="Radio18Pregunta18" value="c,a,0">
  <label class="form-check-label" for="Radio18Pregunta18">
  c) Dejar abierta y en funcionamiento la tubería de venteo.
  </label>
  </div> 
  </div>

  <div class="padding-5 pregunta-7">
  <!-- --- Pregunta numero 7 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-7">7.- ¿Qué es un área confinada?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg7" id="Radio19Pregunta19" value="a,b,0">
  <label class="form-check-label" for="Radio19Pregunta19">
  a)  Espacio muy extenso, tiene una atmosfera deficiente de oxígeno.  

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg7" id="Radio20Pregunta20" value="b,b,1">
  <label class="form-check-label" for="Radio20Pregunta20">
b) Es un espacio con aberturas limitadas de entrada y salida, con una ventilación desfavorable.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg7" id="Radio21Pregunta21" value="c,b,0">
  <label class="form-check-label" for="Radio21Pregunta21">
  c) Espacio de difícil acceso para personas no autorizadas, el cual acumula contaminantes tóxicos e inflamables.
  </label>
  </div> 
  </div>

    <div class="padding-5 pregunta-8">
  <!-- --- Pregunta numero 8 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-8">8.- ¿Cuáles son las áreas confinadas en una estación de servicio?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg8" id="Radio22Pregunta22" value="a,c,0">
  <label class="form-check-label" for="Radio22Pregunta22">
  a) Tanques de almacenamiento
Dispensarios.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg8" id="Radio23Pregunta23" value="b,c,0">
  <label class="form-check-label" for="Radio23Pregunta23">
 b) Dispensarios
Tienda de conveniencia
Estacionamiento.


  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg8" id="Radio24Pregunta24" value="c,c,1">
  <label class="form-check-label" for="Radio24Pregunta24">
  c) Tanques de gasolina
Cisterna de aguas.



  </label>
  </div> 
  </div>

    
     <div class="float-right"><button type="button" id="validate" class="btn btn-outline-primary">Finalizar Evaluación</button></div>

  </div>
  <div class="col-2"></div>

  </div>
  </div>

  
 
  


  </div>
  </div>