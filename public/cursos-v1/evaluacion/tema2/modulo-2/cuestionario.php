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
      $('.pregunta-9').css('border',''); 
      $('.pregunta-10').css('border',''); 
      

      var respuesta1 = $('input:radio[name=preg1]:checked').val();
      var respuesta2 = $('input:radio[name=preg2]:checked').val();
      var respuesta3 = $('input:radio[name=preg3]:checked').val();
      var respuesta4 = $('input:radio[name=preg4]:checked').val();
      var respuesta5 = $('input:radio[name=preg5]:checked').val();
      var respuesta6 = $('input:radio[name=preg6]:checked').val();
      var respuesta7 = $('input:radio[name=preg7]:checked').val();
      var respuesta8 = $('input:radio[name=preg8]:checked').val();
      var respuesta9 = $('input:radio[name=preg9]:checked').val();
      var respuesta10 = $('input:radio[name=preg10]:checked').val();
      

      var Titulo1 = $("#Titulo-1").html();
      var Titulo2 = $("#Titulo-2").html();
      var Titulo3 = $("#Titulo-3").html();
      var Titulo4 = $("#Titulo-4").html();
      var Titulo5 = $("#Titulo-5").html();
      var Titulo6 = $("#Titulo-6").html();
      var Titulo7 = $("#Titulo-7").html();
      var Titulo8 = $("#Titulo-8").html();
      var Titulo9 = $("#Titulo-9").html();
      var Titulo10 = $("#Titulo-10").html();
      
      
      if (respuesta1 != undefined) {
      if (respuesta2 != undefined) {
      if (respuesta3 != undefined) {
      if (respuesta4 != undefined) {
      if (respuesta5 != undefined) {
      if (respuesta6 != undefined) {
      if (respuesta7 != undefined) {
      if (respuesta8 != undefined) {
      if (respuesta9 != undefined) {
      if (respuesta10 != undefined) {

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
      "respuesta8" : respuesta8,
      "Titulo9" : Titulo9,
      "respuesta9" : respuesta9,
      "Titulo10" : Titulo10,
      "respuesta10" : respuesta10
      };

      $.ajax({
      data:  parametros,
      url:   '../../public/cursos/evaluacion/tema2/modulo-2/evaluacion.php',
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


      }else{ $('.pregunta-10').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-9').css('border','2px solid #A52525'); }
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
  <div class="font-weight-bold title-pregunta" id="Titulo-1">1.- ¿Qué es una investigación de Accidentes e Incidentes?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio1Pregunta1" value="a,a,1">
  <label class="form-check-label" for="Radio1Pregunta1">
  a)  Análisis de eventos relevantes ocurridos en las instalaciones, que determinaran la causa raíz de los mismos. 
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio2Pregunta2" value="b,a,0">
  <label class="form-check-label" for="Radio2Pregunta2">
  b)  Investigación de la policía. 
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg1" id="Radio3Pregunta3" value="c,a,0">
  <label class="form-check-label" for="Radio3Pregunta3">
  c)  Conjunto de pasos para saber con exactitud lo ocurro de las instalaciones. 
  </label>
  </div>   
  </div>
  <div class="padding-5 pregunta-2">
    <!-- --- Pregunta numero 2 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-2">2.- ¿Quiénes son autorizados para realizar las investigaciones?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio4Pregunta4" value="a,b,0">
  <label class="form-check-label" for="Radio4Pregunta4">
  a)  Agencias investigadoras.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio5Pregunta5" value="b,b,1">
  <label class="form-check-label" for="Radio5Pregunta5">
  b) Tercero autorizado, Líder de investigaciones.
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg2" id="Radio6Pregunta6" value="c,b,0">
  <label class="form-check-label" for="Radio6Pregunta6">
  c) Los trabajadores de la estación de servicio.
  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-3">
  <!-- --- Pregunta numero 3 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-3">3.- ¿Quién realiza las entrevistas al personal?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio7Pregunta7" value="a,c,0">
  <label class="form-check-label" for="Radio7Pregunta7">
  a)  Personal de la estación de servicio.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio8Pregunta8" value="b,c,0">
  <label class="form-check-label" for="Radio8Pregunta8">
  b)  La agencia de investigaciones 
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg3" id="Radio9Pregunta9" value="c,c,1">
  <label class="form-check-label" for="Radio9Pregunta9">
  c) Líder de investigaciones. 
  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-4">
    <!-- --- Pregunta numero 4 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-4">4.- ¿Cuál es la clasificación de los eventos según el tipo?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio10Pregunta10" value="a,c,0">
  <label class="form-check-label" for="Radio10Pregunta10">
  a) <br>Tipo 1: Muerte de una o más personas dentro de las instalaciones del Regulado<br>
Tipo 2: Simultáneamente, una o más muertes de personal, daño a las instalaciones, interrupción de operaciones de las actividades del Sector Hidrocarburos<br>
Tipo 3: Lesiones del personal que requieran incapacidades médicas.<br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio11Pregunta11" value="b,c,0">
  <label class="form-check-label" for="Radio11Pregunta11">
  b) <br>Tipo 1: Simultáneamente, una o más muertes de personal, daño a las instalaciones, interrupción de operaciones de las actividades del Sector Hidrocarburos<br>
Tipo 2: Muerte de una o más personas dentro de las instalaciones del Regulado<br>
Tipo 3: Lesiones del personal que requieran incapacidades médicas.<br>

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg4" id="Radio12Pregunta12" value="c,c,1">
  <label class="form-check-label" for="Radio12Pregunta12">
  c)<br>Tipo 1: Lesiones del personal que requieran incapacidades médicas causadas en el ejercicio de sus actividades.<br>
Tipo 2: Muerte de una o más personas y exista la liberación al Ambiente de una sustancia o material peligroso.<br>
Tipo 3: Muerte de una o más personas dentro de las instalaciones, así como la evacuación de personal y de la población.<br>

  </label>
  </div> 
  </div>
  <div class="padding-5 pregunta-5">
  <!-- --- Pregunta numero 5 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-5">5.- ¿Cuáles son los informes que se deben de presentar a la Agencia de acuerdo a la evolución del evento?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio13Pregunta13" value="a,a,1">
  <label class="form-check-label" for="Radio13Pregunta13">
  a)
<br>I.  Inicial<br>
II. Evolución del evento<br>
III.  Reporte de hechos <br>
IV. De seguimiento del evento<br>
V.  Cierre <br>
VI. Consolidación mensual<br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio14Pregunta14" value="b,a,0">
  <label class="form-check-label" for="Radio14Pregunta14">
 b)
<br>I.  ¿Por qué paso?<br>
II. De seguimiento del evento<br>
III.  De quien fue la culpa<br>
IV. Cierre <br>
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg5" id="Radio15Pregunta15" value="c,a,0">
  <label class="form-check-label" for="Radio15Pregunta15">
  c) 
<br>I.  Evolución del evento<br>
II. Consolidación mensual<br>

  </label>
  </div> 
  </div>
  <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --  -- - - - - -   -->
  <div class="padding-5 pregunta-6">
  <!-- --- Pregunta numero 6 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-6">6.- Selecciona los datos mínimos correctos a seguir para la elaboración del informe inicial. </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg6" id="Radio16Pregunta16" value="a,b,0">
  <label class="form-check-label" for="Radio16Pregunta16">
  a)  <br>• Datos generales del Regulado<br>
• Nombre de quien fallece<br>
• En su caso, observaciones adicionales.<br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg6" id="Radio17Pregunta17" value="b,b,1">
  <label class="form-check-label" for="Radio17Pregunta17">
 b) <br>• Datos generales del Regulado<br>
• Nombre y cargo de la persona que informa<br>
• Ubicación del Evento<br>
• Fecha y hora del Evento<br>
• Breve descripción del Evento <br>
• En su caso, observaciones adicionales.<br>

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg6" id="Radio18Pregunta18" value="c,b,0">
  <label class="form-check-label" for="Radio18Pregunta18">
  c) <br>•  Datos generales del Regulado<br>
• Nombre y cargo de la persona que informa<br>
• Nombre de quien ocasiono el evento <br>
  </label>
  </div> 
  </div>

  <div class="padding-5 pregunta-7">
  <!-- --- Pregunta numero 7 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-7">7.- ¿Cuál de los siguientes puntos se incluye en el informe de evolución de evento?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg7" id="Radio19Pregunta19" value="a,c,0">
  <label class="form-check-label" for="Radio19Pregunta19">
  a)  Informes y lista de las personas a las que ha afectado el evento. 
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg7" id="Radio20Pregunta20" value="b,c,0">
  <label class="form-check-label" for="Radio20Pregunta20">
b) Cosas materiales a las que ha afectado el evento. 
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg7" id="Radio21Pregunta21" value="c,c,1">
  <label class="form-check-label" for="Radio21Pregunta21">
  c) Pérdidas humanas, desaparecidos y lesionados en relación con el personal, proporcionando nombre, empresa y tipo de lesión.
  </label>
  </div> 
  </div>

    <div class="padding-5 pregunta-8">
  <!-- --- Pregunta numero 8 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-8">8.- El informe de hechos incluye: </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg8" id="Radio22Pregunta22" value="a,c,0">
  <label class="form-check-label" for="Radio22Pregunta22">
  a)  Las medidas, los recursos humanos y recursos materiales empleados para controlar el evento.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg8" id="Radio23Pregunta23" value="b,c,0">
  <label class="form-check-label" for="Radio23Pregunta23">
 b) Relatoría de hechos, incluyendo pérdidas humanas de personal, Población y desaparecidos
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg8" id="Radio24Pregunta24" value="c,c,1">
  <label class="form-check-label" for="Radio24Pregunta24">
  c) Todas la anteriores 
  </label>
  </div> 
  </div>

    <div class="padding-5 pregunta-9">
  <!-- --- Pregunta numero 9 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-9">9.- Cuales son los datos que se requieren para el informe de cierre:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg9" id="Radio25Pregunta25" value="a,a,1">
  <label class="form-check-label" for="Radio25Pregunta25">
  a)  <br>• Datos generales del Regulado<br>
• Nombre y cargo de la persona que informa<br>
• Localización del Evento<br>
• Fecha y hora del Evento<br>
• Descripción de hechos, y<br>
• Número de personas lesionadas<br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg9" id="Radio26Pregunta26" value="b,a,0">
  <label class="form-check-label" for="Radio26Pregunta26">
 b)<br> • Datos generales del Regulado<br>
• Nombre y cargo de la persona que informa<br>
• Descripción de hechos, y<br>
• Número de personas lesionadas<br>
• Hora de cierre de la estación <br>

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg9" id="Radio27Pregunta27" value="c,a,0">
  <label class="form-check-label" for="Radio27Pregunta27">
  c)<br> •  Datos generales del Regulado<br>
• Nombre y cargo de la persona que informa<br>
• Lista de los trabajadores de la estación <br>
• Hora de apertura <br>
• Hora de cierre <br>

  </label>
  </div> 
  </div>

      <div class="padding-5 pregunta-10">
  <!-- --- Pregunta numero 10 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-10">10.- ¿A través de qué sistema se tienen que hacer los informes?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg10" id="Radio28Pregunta28" value="a,a,1">
  <label class="form-check-label" for="Radio28Pregunta28">
  a)  Ante el SIIA
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg10" id="Radio29Pregunta29" value="b,a,0">
  <label class="form-check-label" for="Radio29Pregunta29">
 b) Ante Protección civil 
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg10" id="Radio30Pregunta30" value="c,a,0">
  <label class="form-check-label" for="Radio30Pregunta30">
  c) Ante SEMARNAT
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