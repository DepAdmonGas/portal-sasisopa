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
      

      var respuesta1 = $('input:radio[name=preg1]:checked').val();
      var respuesta2 = $('input:radio[name=preg2]:checked').val();
      var respuesta3 = $('input:radio[name=preg3]:checked').val();
      var respuesta4 = $('input:radio[name=preg4]:checked').val();
      var respuesta5 = $('input:radio[name=preg5]:checked').val();
      

      var Titulo1 = $("#Titulo-1").html();
      var Titulo2 = $("#Titulo-2").html();
      var Titulo3 = $("#Titulo-3").html();
      var Titulo4 = $("#Titulo-4").html();
      var Titulo5 = $("#Titulo-5").html();
      
      
      if (respuesta1 != undefined) {
      if (respuesta2 != undefined) {
      if (respuesta3 != undefined) {
      if (respuesta4 != undefined) {
      if (respuesta5 != undefined) {

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
      "respuesta5" : respuesta5
      };

      $.ajax({
      data:  parametros,
      url:   '../../public/cursos/evaluacion/tema2/modulo-6/evaluacion.php',
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
  <div class="font-weight-bold title-pregunta" id="Titulo-1">1.- ¿Qué elemento se requiere para que los trabajadores puedan realizar trabajos “en caliente” dentro de la estación solo de ser necesario?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio1Pregunta1" value="a,b,0">
  <label class="form-check-label" for="Radio1Pregunta1">
  a)  Área acordonada
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio2Pregunta2" value="b,b,1">
  <label class="form-check-label" for="Radio2Pregunta2">
  b)  La autorización por escrito por el encargado de la Estación de Servicio
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg1" id="Radio3Pregunta3" value="c,b,0">
  <label class="form-check-label" for="Radio3Pregunta3">
  c)  La autorización de los bomberos 
  </label>
  </div>   
  </div>
  <div class="padding-5 pregunta-2">
    <!-- --- Pregunta numero 2 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-2">2.- ¿Una vez que el encargado sepa de los trabajos “en caliente” que se tienen que realizar, con quien se dirigirá el mismo para una segunda valoración?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio4Pregunta4" value="a,c,0">
  <label class="form-check-label" for="Radio4Pregunta4">
  a)  Encargado de una bomba de despacho
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio5Pregunta5" value="b,c,0">
  <label class="form-check-label" for="Radio5Pregunta5">
  b) Representante legal de la estación 
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg2" id="Radio6Pregunta6" value="c,c,1">
  <label class="form-check-label" for="Radio6Pregunta6">
  c) Encargado de mantenimiento
  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-3">
  <!-- --- Pregunta numero 3 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-3">3.- ¿Qué puntos son necesarios analizar para poder realizar este tipo de trabajos en la estación?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio7Pregunta7" value="a,b,0">
  <label class="form-check-label" for="Radio7Pregunta7">
 a) </br>• Identificación de peligros y riesgos</br>
• Que se va a realizar o como se va a realizar</br>
• Qué departamento auxiliar (bomberos, policía…) lo va a realizar</br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio8Pregunta8" value="b,b,1">
  <label class="form-check-label" for="Radio8Pregunta8">
  b)  </br>• Identificación de peligros y riesgos</br>
• Que se va a realizar</br>
• Que herramientas y equipo se va a utilizar</br>
• Como se va a realizar</br>
• Tiempos de realización</br>
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg3" id="Radio9Pregunta9" value="c,b,0">
  <label class="form-check-label" for="Radio9Pregunta9">
  c) </br>•  Identificación de peligros y riesgos</b>
• Que se va a realizar</br>
• Como se va a realizar</br>
• Tiempos de realización</br>
  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-4">
    <!-- --- Pregunta numero 4 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-4">4.- Para poder autorizar un trabajo de corte y/o soldadura es necesario contar con:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio10Pregunta10" value="a,a,1">
  <label class="form-check-label" for="Radio10Pregunta10">
  a)  </br>• Análisis de riesgos </br>
• Plan de trabajo </br>
• Check list de equipos a utilizar </br>
• Permiso de trabajo </br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio11Pregunta11" value="b,a,0">
  <label class="form-check-label" for="Radio11Pregunta11">
  b) </br>•  Análisis de riesgos </br>
• Plan de trabajo </br>
• Lentes y casco </br>
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg4" id="Radio12Pregunta12" value="c,a,0">
  <label class="form-check-label" for="Radio12Pregunta12">
  c) </br>•  Análisis de riesgos</br> 
• Plan de trabajo </br>
• Parar actividades en la estación</br>
• Check list de equipos a utilizar </br>
• Permiso de trabajo de la policía </br>

  </label>
  </div> 
  </div>
  <div class="padding-5 pregunta-5">
   <!-- --- Pregunta numero 5 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-5">5.- Fecha y hora programadas de inicio y término, ubicación, nombre de los trabajadores, nombre y firma de quien vigilara y de quien autoriza, indicación de anexar procedimientos… son algunos elementos que debe de contener:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio13Pregunta13" value="a,c,0">
  <label class="form-check-label" for="Radio13Pregunta13">
  a)  El plan de inicio de actividades 
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio14Pregunta14" value="b,c,0">
  <label class="form-check-label" for="Radio14Pregunta14">
  b)  Gafete del trabajador 
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg5" id="Radio15Pregunta15" value="c,c,1">
  <label class="form-check-label" for="Radio15Pregunta15">
  c)   El permiso para poder proceder a realizarlas actividades 
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